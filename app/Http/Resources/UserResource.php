<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        // Include follow stats
        $data['followers_count'] = $this->followers()->count();
        $data['following_count'] = $this->following()->count();
        $data['is_followed_by_me'] = false;

        // Check if the current authenticated user follows this user
        if (auth('sanctum')->check()) {
            $data['is_followed_by_me'] = $this->followers()
                ->where('follower_id', auth('sanctum')->id())
                ->exists();
        }

        return $data;
    }
}
