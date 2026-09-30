<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserAddressController extends Controller
{
    /**
     * Get all addresses for the authenticated user.
     */
    public function index(Request $request)
    {
        $addresses = $request->user()->addresses()->get();
        return response_success('Addresses fetched successfully.', $addresses);
    }

    /**
     * Create a new address.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['shipping', 'billing', 'origin'])],
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'is_default' => 'boolean',
        ]);

        $user = $request->user();

        // If this is the first address, or is_default is true, set others to not default
        $isDefault = $validated['is_default'] ?? false;
        if ($user->addresses()->count() === 0) {
            $isDefault = true;
        }

        if ($isDefault) {
            $user->addresses()->update(['is_default' => false]);
        }

        $address = $user->addresses()->create(array_merge($validated, [
            'is_default' => $isDefault
        ]));

        return response_success('Address created successfully.', $address, 201);
    }

    /**
     * Update an existing address.
     */
    public function update(Request $request, UserAddress $address)
    {
        if ($address->user_id !== $request->user()->id) {
            return response_error('Unauthorized.', [], 403);
        }

        $validated = $request->validate([
            'type' => ['sometimes', Rule::in(['shipping', 'billing', 'origin'])],
            'name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'address_line_1' => 'sometimes|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'sometimes|string|max:100',
            'state' => 'sometimes|string|max:100',
            'pincode' => 'sometimes|string|max:20',
            'is_default' => 'boolean',
        ]);

        if (isset($validated['is_default']) && $validated['is_default']) {
            $request->user()->addresses()->update(['is_default' => false]);
        }

        $address->update($validated);

        return response_success('Address updated successfully.', $address);
    }

    /**
     * Delete an address.
     */
    public function destroy(Request $request, UserAddress $address)
    {
        if ($address->user_id !== $request->user()->id) {
            return response_error('Unauthorized.', [], 403);
        }

        $address->delete();

        // If default was deleted, set the most recent one as default
        if ($address->is_default) {
            $newDefault = $request->user()->addresses()->latest()->first();
            if ($newDefault) {
                $newDefault->update(['is_default' => true]);
            }
        }

        return response_success('Address deleted successfully.');
    }
}
