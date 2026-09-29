<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Http\Resources\UserResource;

class FollowController extends Controller
{
    /**
     * Toggle follow status for a user.
     */
    public function toggleFollow(Request $request, $id)
    {
        $targetUser = User::findOrFail($id);
        $currentUser = $request->user();

        if ($targetUser->id === $currentUser->id) {
            return response()->json(['message' => 'You cannot follow yourself.'], 400);
        }

        $existingFollow = Follower::where('follower_id', $currentUser->id)
                                  ->where('following_id', $targetUser->id)
                                  ->first();

        if ($existingFollow) {
            $existingFollow->delete();
            return response()->json([
                'message' => 'User unfollowed successfully.',
                'is_following' => false
            ]);
        } else {
            Follower::create([
                'follower_id' => $currentUser->id,
                'following_id' => $targetUser->id
            ]);
            return response()->json([
                'message' => 'User followed successfully.',
                'is_following' => true
            ]);
        }
    }

    /**
     * Get the followers of a user.
     */
    public function followers($id)
    {
        $user = User::findOrFail($id);
        
        $followers = $user->followers()
                          ->with('follower') 
                          ->paginate(20);
        
        $followerUsers = $followers->getCollection()->map(function ($follow) {
            return $follow->follower;
        });
        
        $followers->setCollection($followerUsers);

        return UserResource::collection($followers);
    }

    /**
     * Get the users a user is following.
     */
    public function following($id)
    {
        $user = User::findOrFail($id);
        
        $following = $user->following()
                          ->with('following')
                          ->paginate(20);
                          
        $followingUsers = $following->getCollection()->map(function ($follow) {
            return $follow->following;
        });
        
        $following->setCollection($followingUsers);

        return UserResource::collection($following);
    }
}
