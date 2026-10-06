<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone_number' => 'sometimes|nullable|string|max:20',
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->has('name')) {
            $user->name = $validated['name'];
        }
        
        if ($request->has('email')) {
            $user->email = $validated['email'];
        }
        
        if ($request->has('phone_number')) {
            $user->phone_number = $validated['phone_number'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            // Check if there's a relative path stored previously
            $oldAvatar = $user->getRawOriginal('avatar');
            if ($oldAvatar && Storage::disk('public')->exists($oldAvatar)) {
                Storage::disk('public')->delete($oldAvatar);
            }
            
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return response()->json([
            'ok' => true,
            'message' => 'Profile updated successfully.',
            'data' => $user
        ]);
    }
}
