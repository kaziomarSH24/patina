<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\User;
use App\Models\EscrowTransaction;
use App\Models\KycDocument;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminAnalyticsService
{
    public function getDashboardMetrics(): array
    {
        // Helper variables for 30-day windows
        $now = Carbon::now();
        $thirtyDaysAgo = $now->copy()->subDays(30);
        $sixtyDaysAgo = $now->copy()->subDays(60);

        // 1. Live Listings (Change based on newly activated listings)
        $totalLiveListings = Listing::where('status', 'Live')->count();
        $newLiveCurrent = Listing::where('status', 'Live')->where('created_at', '>=', $thirtyDaysAgo)->count();
        $newLivePrevious = Listing::where('status', 'Live')->whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count();
        $liveListingsChange = $this->calculatePercentageChange($newLiveCurrent, $newLivePrevious);
        
        // 2. GMV to Date
        $gmvToDate = EscrowTransaction::where('status', 'Completed')->sum('amount');
        $gmvCurrent = EscrowTransaction::where('status', 'Completed')->where('updated_at', '>=', $thirtyDaysAgo)->sum('amount');
        $gmvPrevious = EscrowTransaction::where('status', 'Completed')->whereBetween('updated_at', [$sixtyDaysAgo, $thirtyDaysAgo])->sum('amount');
        $gmvChange = $this->calculatePercentageChange($gmvCurrent, $gmvPrevious);
        
        // 3. Avg Time to Sell
        $soldListings = Listing::where('status', 'Sold')->get();
        $avgTimeToSell = $this->calculateAvgDays($soldListings);
        
        $soldCurrent = Listing::where('status', 'Sold')->where('updated_at', '>=', $thirtyDaysAgo)->get();
        $soldPrevious = Listing::where('status', 'Sold')->whereBetween('updated_at', [$sixtyDaysAgo, $thirtyDaysAgo])->get();
        $avgSellCurrent = $this->calculateAvgDays($soldCurrent);
        $avgSellPrevious = $this->calculateAvgDays($soldPrevious);
        // The UI expects raw days difference for this specific metric, not a percentage!
        $avgSellChange = round($avgSellCurrent - $avgSellPrevious, 1);
        
        // 4. Total Funds in Escrow (Held funds: not yet completed)
        $heldStatuses = ['Payment Received', 'Confirmed', 'Shipped', 'Disputed'];
        $fundsInEscrow = EscrowTransaction::whereIn('status', $heldStatuses)->sum('amount');
        $fundsCurrent = EscrowTransaction::whereIn('status', $heldStatuses)->where('updated_at', '>=', $thirtyDaysAgo)->sum('amount');
        $fundsPrevious = EscrowTransaction::whereIn('status', $heldStatuses)->whereBetween('updated_at', [$sixtyDaysAgo, $thirtyDaysAgo])->sum('amount');
        $fundsChange = $this->calculatePercentageChange($fundsCurrent, $fundsPrevious);
        
        // 5. KYC Pass Rate
        $totalKyc = KycDocument::count();
        $passedKyc = KycDocument::where('status', 'verified')->count();
        $kycPassRate = $totalKyc > 0 ? round(($passedKyc / $totalKyc) * 100, 1) : 0;
        
        $passedKycCurrent = KycDocument::where('status', 'verified')->where('updated_at', '>=', $thirtyDaysAgo)->count();
        $passedKycPrevious = KycDocument::where('status', 'verified')->whereBetween('updated_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count();
        $kycChange = $this->calculatePercentageChange($passedKycCurrent, $passedKycPrevious);

        // Waitlist Growth and Seller Split
        $waitlistGrowth = $this->getWaitlistGrowth();
        
        $totalSellers = User::role(['dealer', 'customer'])->count();
        $dealersCount = User::role('dealer')->count();
        $individualsCount = User::role('customer')->count();
        
        $dealerPercent = $totalSellers > 0 ? round(($dealersCount / $totalSellers) * 100) : 0;
        $individualPercent = $totalSellers > 0 ? round(($individualsCount / $totalSellers) * 100) : 0;

        $photoReviewStats = $this->getPhotoReviewStats();

        return [
            'metrics' => [
                'live_listings' => [
                    'value' => $totalLiveListings,
                    'change' => $liveListingsChange
                ],
                'gmv' => [
                    'value' => $gmvToDate,
                    'change' => $gmvChange
                ],
                'avg_time_to_sell' => [
                    'value' => $avgTimeToSell,
                    'change' => $avgSellChange
                ],
                'escrow_funds' => [
                    'value' => $fundsInEscrow,
                    'change' => $fundsChange
                ],
                'kyc_pass_rate' => [
                    'value' => $kycPassRate,
                    'change' => $kycChange
                ]
            ],
            'charts' => [
                'waitlist_growth' => $waitlistGrowth,
                'seller_split' => [
                    ['name' => 'Dealers', 'value' => $dealerPercent],
                    ['name' => 'Individuals', 'value' => $individualPercent],
                ],
                'photo_review' => $photoReviewStats
            ]
        ];
    }

    private function getWaitlistGrowth(): array
    {
        // Generate last 7 months data
        $data = [];
        $cumulative = 0;
        
        // Ensure accurate historic accumulation
        $historicUsers = User::where('created_at', '<', Carbon::now()->subMonths(6)->startOfMonth())->count();
        $cumulative += $historicUsers;

        for ($i = 6; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            
            $count = User::whereYear('created_at', $month->year)
                         ->whereMonth('created_at', $month->month)
                         ->count();
            
            $cumulative += $count;
            
            $data[] = [
                'month' => $month->format('M'),
                'signups' => $cumulative
            ];
        }
        
        return $data;
    }

    private function getPhotoReviewStats(): array
    {
        // Bar chart data for last 7 days
        // Approximating review time by checking time difference between created_at and updated_at 
        // for listings that were updated on a particular day.
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Get listings that were reviewed/updated on this day
            $reviewedOnDay = Listing::whereDate('updated_at', $date->toDateString())
                                    ->where('status', '!=', 'Under Review')
                                    ->get();
            
            $avgHours = 0;
            if ($reviewedOnDay->count() > 0) {
                $totalHours = 0;
                $validListings = 0;
                foreach ($reviewedOnDay as $listing) {
                    if ($listing->created_at && $listing->updated_at) {
                        $totalHours += $listing->created_at->diffInHours($listing->updated_at);
                        $validListings++;
                    }
                }
                if ($validListings > 0) {
                    $avgHours = round($totalHours / $validListings, 1);
                }
            }

            $data[] = [
                'day' => $date->format('D'),
                'hours' => $avgHours
            ];
        }
        return $data;
    }

    private function calculatePercentageChange($current, $previous): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100.0 : 0.0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function calculateAvgDays($listings): float
    {
        if ($listings->count() == 0) {
            return 0;
        }
        $totalDays = 0;
        foreach ($listings as $listing) {
            $totalDays += $listing->created_at->diffInDays($listing->updated_at);
        }
        return round($totalDays / $listings->count(), 1);
    }
}
