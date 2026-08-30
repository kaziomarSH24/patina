<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\VerificationController;
use App\Http\Controllers\Api\V1\Admin\ListingController as AdminListingController;
use App\Http\Controllers\Api\V1\Chat\ConversationController;
use App\Http\Controllers\Api\V1\Chat\GroupController;
use App\Http\Controllers\Api\V1\Chat\MessageController;
use App\Http\Controllers\Api\V1\ListingController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\Dealer\KycController as DealerKycController;
use App\Http\Controllers\Api\V1\Dealer\OnboardingController as DealerOnboardingController;
use App\Http\Controllers\Api\V1\Admin\KycController as AdminKycController;
use App\Http\Controllers\Api\V1\Admin\SubscriptionPlanController as AdminSubscriptionPlanController;
use App\Http\Controllers\Api\V1\Admin\DealerApplicationController as AdminDealerApplicationController;
use App\Http\Controllers\Api\V1\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\V1\SubscriptionPlanController;

// --- Public Routes (Authentication) ---
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('api.v1.auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.v1.auth.login');

    Route::post('/verify', [VerificationController::class, 'verify'])->name('api.v1.auth.verify');
    Route::post('/resend-verification', [VerificationController::class, 'resendVerification'])->name('api.v1.auth.resendVerification');

    Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('api.v1.auth.forgotPassword');
    Route::post('/verify-password-otp', [PasswordController::class, 'verifyResetOtp'])->name('api.v1.auth.verifyResetOtp');
    Route::post('/reset-password-with-token', [PasswordController::class, 'resetPasswordWithToken'])->name('api.v1.auth.resetPasswordWithToken');
});

// Route::post('/upload', [FileController::class, 'handleRequest'])->name('api.v1.file.upload');

// --- Webhooks ---
Route::post('/webhooks/razorpay', [\App\Http\Controllers\Api\V1\Webhook\RazorpayWebhookController::class, 'handle'])->name('api.v1.webhooks.razorpay');

// --- Public Routes (Listings) ---
Route::prefix('v1/listings')->group(function () {
    Route::get('/', [ListingController::class, 'index'])->name('api.v1.listings.index');
    Route::get('/{id}', [ListingController::class, 'show'])->name('api.v1.listings.show');
});

// --- Protected Routes (User must be logged in) ---
Route::middleware(['auth:sanctum', 'throttle:api'])->prefix('v1')->group(function () {

    // Auth related protected routes
    Route::prefix('auth')->name('api.v1.auth.')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/update-password', [PasswordController::class, 'updatePassword'])->name('updatePassword');
    });

    // Profile related protected routes
    Route::prefix('profile')->name('api.v1.profile.')->group(function () {
        Route::get('/me', [ProfileController::class, 'me'])->name('me');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
    });

    // Listings (Authenticated user portfolio and creation)
    Route::prefix('listings')->name('api.v1.listings.')->group(function () {
        Route::post('/', [ListingController::class, 'store'])->name('store');
        Route::post('/{listing}', [ListingController::class, 'update'])->name('update');
    });

    Route::prefix('user/listings')->name('api.v1.user.listings.')->group(function () {
        Route::get('/', [ListingController::class, 'userListings'])->name('index');
    });

    // Dealer/User KYC & Onboarding Routes
    Route::prefix('kyc')->name('api.v1.kyc.')->group(function () {
        Route::post('/submit', [DealerKycController::class, 'submit'])->name('submit');
        Route::get('/status', [DealerKycController::class, 'status'])->name('status');
    });

    // Public Subscription Plans Route
    Route::get('/subscription-plans', [SubscriptionPlanController::class, 'index'])->name('api.v1.subscription-plans.index');

    Route::prefix('dealer')->name('api.v1.dealer.')->group(function () {
        Route::post('/onboarding/submit', [DealerOnboardingController::class, 'submit'])->name('onboarding.submit');
        Route::get('/onboarding/status', [DealerOnboardingController::class, 'status'])->name('onboarding.status');
        Route::delete('/onboarding/cancel', [DealerOnboardingController::class, 'cancel'])->name('onboarding.cancel');
        
        // Subscription Initiation
        Route::post('/subscription/initiate', [\App\Http\Controllers\Api\V1\Dealer\SubscriptionController::class, 'initiate'])->name('subscription.initiate');
    });

    // Admin KYC Routes (Protected by role middleware)
    Route::middleware(['role:admin'])->prefix('admin')->name('api.v1.admin.')->group(function () {
        
        // Admin Dealers (Active)
        Route::get('/dealers', [\App\Http\Controllers\Api\V1\Admin\DealerController::class, 'index'])->name('dealers.index');

        // Admin KYC
        Route::prefix('kyc')->name('kyc.')->group(function () {
            Route::get('/pending', [AdminKycController::class, 'pending'])->name('pending');
            Route::get('/{userId}/documents', [AdminKycController::class, 'documents'])->name('documents');
            Route::post('/{userId}/approve', [AdminKycController::class, 'approve'])->name('approve');
            Route::post('/{userId}/reject', [AdminKycController::class, 'reject'])->name('reject');
        });

        // Admin Subscription Plans
        Route::apiResource('subscription-plans', AdminSubscriptionPlanController::class);

        // Admin Dealer Applications
        Route::prefix('dealer-applications')->name('dealer-applications.')->group(function () {
            Route::get('/', [AdminDealerApplicationController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminDealerApplicationController::class, 'show'])->name('show');
            Route::patch('/{id}/status', [AdminDealerApplicationController::class, 'updateStatus'])->name('status');
            Route::delete('/{id}', [AdminDealerApplicationController::class, 'destroy'])->name('destroy');
        });

        // Admin Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/{id}/history', [AdminUserController::class, 'history'])->name('history');
            Route::patch('/{id}/standing', [AdminUserController::class, 'updateStanding'])->name('update-standing');
        });

        // Admin Listings
        Route::prefix('listings')->name('listings.')->group(function () {
            Route::get('/', [AdminListingController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminListingController::class, 'show'])->name('show');
            Route::patch('/{id}', [AdminListingController::class, 'update'])->name('update');
            Route::patch('/{id}/status', [AdminListingController::class, 'updateStatus'])->name('update-status');
        });

    });

    /**
     ** Chat Module Routes
     */
    Route::prefix('chat')->name('api.v1.chat.')->group(function () {
        // Conversations
        Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
        Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');

        // Messages
        Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
        Route::patch('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::post('/messages/read', [MessageController::class, 'markAsRead'])->name('messages.read');

        // Group Management
        Route::post('/groups/{conversation}/members', [GroupController::class, 'addMember'])->name('groups.members.add');
        Route::delete('/groups/{conversation}/members', [GroupController::class, 'removeMember'])->name('groups.members.remove');
        Route::post('/groups/{conversation}/leave', [GroupController::class, 'leaveGroup'])->name('groups.leave');
        Route::post('/groups/{conversation}/promote', [GroupController::class, 'promoteToAdmin'])->name('groups.promote');
        Route::post('/groups/{conversation}/demote', [GroupController::class, 'demoteToMember'])->name('groups.demote');

        // Real-time
        Route::post('/conversations/{conversation}/typing', [MessageController::class, 'typing'])->name('typing');
    });


    //***--- Notification Routes ---***/
    Route::prefix('notifications')->name('api.v1.notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/stats', [NotificationController::class, 'stats'])->name('stats');
        Route::post('/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
        Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-as-read');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    Route::fallback(function () {
        return response_error('The requested API endpoint does not exist.', [], 404);
    });
});
