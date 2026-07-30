<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserStandingRequest;
use App\Http\Resources\Admin\UserResource;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Get a paginated list of all users for the admin dashboard.
     */
    public function index()
    {
        // We pass a closure to the service's getAll method to attach the counts for purchases and sales
        $users = $this->userService->getAll(function ($query) {
            $query->withCount([
                'escrowTransactionsAsBuyer',
                'escrowTransactionsAsSeller'
            ]);
        });

        return response_success('Users retrieved successfully', [
            'users' => UserResource::collection($users)->response()->getData(true)
        ]);
    }

    /**
     * Get user history including activity logs and recent transactions.
     */
    public function history(int $id)
    {
        $user = $this->userService->getById($id, [
            'activities' => function($q) {
                $q->latest()->limit(50);
            },
            'escrowTransactionsAsBuyer' => function($q) {
                $q->latest()->limit(10);
            },
            'escrowTransactionsAsSeller' => function($q) {
                $q->latest()->limit(10);
            }
        ]);

        return response_success('User history retrieved successfully', [
            'user' => new UserResource($user),
            'activities' => $user->activities,
            'recent_purchases' => $user->escrowTransactionsAsBuyer,
            'recent_sales' => $user->escrowTransactionsAsSeller,
        ]);
    }

    /**
     * Update the account standing of a user.
     */
    public function updateStanding(UpdateUserStandingRequest $request, int $id)
    {
        $user = $this->userService->update($id, [
            'account_standing' => $request->validated('account_standing')
        ]);

        return response_success("User account standing updated to {$user->account_standing}", [
            'user' => new UserResource($user)
        ]);
    }
}
