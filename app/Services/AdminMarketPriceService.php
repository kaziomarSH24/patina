<?php

namespace App\Services;

use App\Models\MarketPrice;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AdminMarketPriceService
{
    protected WatchApiService $watchApiService;

    public function __construct(WatchApiService $watchApiService)
    {
        $this->watchApiService = $watchApiService;
    }

    public function getTrackedPrices(): \Illuminate\Support\Collection
    {
        $marketPrices = MarketPrice::all();

        $counts = Listing::select('brand', 'model', DB::raw('count(*) as liveCount'))
            ->where('status', 'Live')
            ->groupBy('brand', 'model')
            ->get()
            ->keyBy(function($item) {
                return strtolower($item->brand . '|' . $item->model);
            });

        return $marketPrices->map(function ($mp) use ($counts) {
            $key = strtolower($mp->brand . '|' . $mp->model);
            $liveCount = isset($counts[$key]) ? $counts[$key]->liveCount : 0;
            
            $signal = 'Hold';
            if ($mp->mom_change >= 1.5) {
                $signal = 'Buy';
            } elseif ($mp->mom_change <= -1.5) {
                $signal = 'Sell';
            }

            $modelDisplay = str_starts_with(strtolower($mp->model), strtolower($mp->brand)) 
                ? $mp->model 
                : $mp->brand . ' ' . $mp->model;

            return [
                'id' => $mp->id,
                'model' => $modelDisplay,
                'ref' => $mp->model, 
                'fmv' => (float)$mp->current_price,
                'change30d' => (float)$mp->mom_change,
                'liveCount' => $liveCount,
                'signal' => $signal,
            ];
        });
    }

    public function addTrackedModel(array $data): MarketPrice
    {
        $parts = explode(' ', $data['model']);
        $reference = end($parts);
        $currentPrice = 0;
        $momChange = 0;
        
        \Illuminate\Support\Facades\Log::info("Adding tracked model: " . $data['model'] . " (Ref: " . $reference . ")");
        
        try {
            $history = $this->watchApiService->getPriceHistory($reference);
            \Illuminate\Support\Facades\Log::info("History data count: " . count($history));
            
            if (!empty($history)) {
                usort($history, function($a, $b) {
                    return strtotime($b['date']) - strtotime($a['date']);
                });
                $currentPrice = (float) $history[0]['price'];
                
                $thirtyDaysAgo = strtotime('-30 days');
                $momPrice = $currentPrice;
                
                foreach ($history as $point) {
                    if (strtotime($point['date']) <= $thirtyDaysAgo) {
                        $momPrice = (float) $point['price'];
                        break;
                    }
                }
                
                if ($momPrice > 0) {
                    $momChange = (($currentPrice - $momPrice) / $momPrice) * 100;
                }
            }
        } catch (\Exception $e) {
            // Ignore failure
        }

        return MarketPrice::create([
            'brand' => $data['brand'],
            'model' => $data['model'],
            'current_price' => $currentPrice,
            'mom_change' => round($momChange, 2),
            'liquidity_score' => 0,
            'volatility_score' => 0,
        ]);
    }

    public function refreshPrices(): int
    {
        $prices = MarketPrice::all();
        $updatedCount = 0;

        foreach ($prices as $price) {
            try {
                $parts = explode(' ', $price->model);
                $reference = end($parts);
                
                Cache::forget('watch_api_history_' . md5(strtolower(trim($reference))));
                
                $history = $this->watchApiService->getPriceHistory($reference);
                
                if (!empty($history)) {
                    usort($history, function($a, $b) {
                        return strtotime($b['date']) - strtotime($a['date']);
                    });
                    
                    $latest = $history[0];
                    $currentPrice = (float) $latest['price'];
                    
                    $thirtyDaysAgo = strtotime('-30 days');
                    $momPrice = $currentPrice;
                    
                    foreach ($history as $point) {
                        if (strtotime($point['date']) <= $thirtyDaysAgo) {
                            $momPrice = (float) $point['price'];
                            break;
                        }
                    }
                    
                    $momChange = 0;
                    if ($momPrice > 0) {
                        $momChange = (($currentPrice - $momPrice) / $momPrice) * 100;
                    }
                    
                    $price->update([
                        'current_price' => $currentPrice,
                        'mom_change' => round($momChange, 2),
                    ]);
                    
                    $updatedCount++;
                } else {
                    throw new \Exception("No history found");
                }
            } catch (\Exception $e) {
                // No dummy simulation in production. If API fails, keep existing real data.
                continue;
            }
        }

        return $updatedCount;
    }
}
