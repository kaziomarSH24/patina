<?php

use Illuminate\Support\Facades\Route;

// Auth Controllers
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\VerificationController;

// Public & Core Feature Controllers
use App\Http\Controllers\Api\V1\DiscoverController;
use App\Http\Controllers\Api\V1\ListingController;
use App\Http\Controllers\Api\V1\ListingFeeController;
use App\Http\Controllers\Api\V1\MarketController;
use App\Http\Controllers\Api\V1\PortfolioController;
use App\Http\Controllers\Api\V1\SubscriptionPlanController;
use App\Http\Controllers\Api\V1\WatchCatalogController;

// Checkout & Escrow Controllers
use App\Http\Controllers\Api\V1\CheckoutController;
use App\Http\Controllers\Api\V1\EscrowController;

// Dealer Controllers
use App\Http\Controllers\Api\V1\Dealer\KycController as DealerKycController;
use App\Http\Controllers\Api\V1\Dealer\OnboardingController as DealerOnboardingController;
use App\Http\Controllers\Api\V1\Dealer\SubscriptionController as DealerSubscriptionController;

// Admin Controllers
use App\Http\Controllers\Api\V1\Admin\DealerApplicationController as AdminDealerApplicationController;
use App\Http\Controllers\Api\V1\Admin\DealerController as AdminDealerController;
use App\Http\Controllers\Api\V1\Admin\KycController as AdminKycController;
use App\Http\Controllers\Api\V1\Admin\ListingController as AdminListingController;
use App\Http\Controllers\Api\V1\Admin\SubscriptionPlanController as AdminSubscriptionPlanController;
use App\Http\Controllers\Api\V1\Admin\UserController as AdminUserController;

// Chat Controllers
use App\Http\Controllers\Api\V1\Chat\ConversationController;
use App\Http\Controllers\Api\V1\Chat\GroupController;
use App\Http\Controllers\Api\V1\Chat\MessageController;
use App\Http\Controllers\Api\V1\Chat\OfferController;

// Notification Controller
use App\Http\Controllers\Api\V1\NotificationController;

// Webhook Controller
use App\Http\Controllers\Api\V1\Webhook\RazorpayWebhookController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Authentication
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('api.v1.auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.v1.auth.login');

    Route::post('/verify', [VerificationController::class, 'verify'])->name('api.v1.auth.verify');
    Route::post('/resend-verification', [VerificationController::class, 'resendVerification'])->name('api.v1.auth.resendVerification');

    Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('api.v1.auth.forgotPassword');
    Route::post('/verify-password-otp', [PasswordController::class, 'verifyResetOtp'])->name('api.v1.auth.verifyResetOtp');
    Route::post('/reset-password-with-token', [PasswordController::class, 'resetPasswordWithToken'])->name('api.v1.auth.resetPasswordWithToken');
});

// Webhooks
Route::post('/webhooks/razorpay', [RazorpayWebhookController::class, 'handle'])->name('api.v1.webhooks.razorpay');
Route::post('/v1/webhooks/razorpay', [CheckoutController::class, 'webhook'])->name('api.v1.webhooks.razorpay');

// Public Listings, Discover & Market
Route::prefix('v1')->group(function () {
    // Discover Feed (Mobile Swipe UI - Publicly accessible)
    Route::get('/discover', [DiscoverController::class, 'index'])->name('api.v1.discover');

    // Public Listings
    Route::prefix('listings')->group(function () {
        Route::get('/', [ListingController::class, 'index'])->name('api.v1.listings.index');
        Route::get('/{id}', [ListingController::class, 'show'])->name('api.v1.listings.show');
    });

    // Market & Price Index
    Route::prefix('market')->group(function () {
        Route::get('/feed', [MarketController::class, 'indexFeed'])->name('api.v1.market.feed');
        Route::get('/price-history/{reference}', [MarketController::class, 'priceHistory'])
            ->where('reference', '.*')
            ->name('api.v1.market.price-history');
    });

    // Watch Data Proxy (For Listing Creation Dropdowns)
    Route::prefix('watch-data')->group(function () {
        Route::get('/brands', [\App\Http\Controllers\Api\V1\WatchDataController::class, 'brands'])->name('api.v1.watch-data.brands');
        Route::get('/models', [\App\Http\Controllers\Api\V1\WatchDataController::class, 'models'])->name('api.v1.watch-data.models');
        Route::get('/references', [\App\Http\Controllers\Api\V1\WatchDataController::class, 'references'])->name('api.v1.watch-data.references');
    });
});

/*
|--------------------------------------------------------------------------
| Protected Routes (auth:sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'throttle:api'])->prefix('v1')->group(function () {

    // Auth (Protected)
    Route::prefix('auth')->name('api.v1.auth.')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/update-password', [PasswordController::class, 'updatePassword'])->name('updatePassword');
    });

    // Profile
    Route::prefix('profile')->name('api.v1.profile.')->group(function () {
        Route::get('/me', [ProfileController::class, 'me'])->name('me');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
    });

    // Portfolio
    Route::prefix('portfolio')->name('api.v1.portfolio.')->group(function () {
        Route::get('/holdings', [PortfolioController::class, 'holdings'])->name('holdings');
        Route::post('/holdings', [PortfolioController::class, 'storeHolding'])->name('holdings.store');
        Route::put('/holdings/{id}', [PortfolioController::class, 'updateHolding'])->name('holdings.update');
        Route::delete('/holdings/{id}', [PortfolioController::class, 'destroyHolding'])->name('holdings.destroy');
        Route::get('/listings', [PortfolioController::class, 'listings'])->name('listings');
    });

    // Watch Catalog (TheWatchAPI Proxy)
    Route::get('/watch-catalog/search', [WatchCatalogController::class, 'search'])->name('api.v1.watch-catalog.search');

    // Listings (User management & Creation)
    Route::prefix('listings')->name('api.v1.listings.')->group(function () {
        Route::post('/pay-fee/initiate', [ListingFeeController::class, 'initiateFee'])->name('pay-fee.initiate');
        Route::post('/', [ListingController::class, 'store'])->name('store');
        Route::post('/{listing}', [ListingController::class, 'update'])->name('update');
        Route::delete('/{listing}', [ListingController::class, 'destroy'])->name('destroy');
    });

    // User Portfolio (Listings)
    Route::prefix('user/listings')->name('api.v1.user.listings.')->group(function () {
        Route::get('/', [ListingController::class, 'userListings'])->name('index');
    });

    // Price Alerts
    Route::prefix('price-alerts')->name('api.v1.price-alerts.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PriceAlertController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\V1\PriceAlertController::class, 'store'])->name('store');
        Route::post('/{id}/toggle', [\App\Http\Controllers\Api\V1\PriceAlertController::class, 'toggle'])->name('toggle');
        Route::delete('/{id}', [\App\Http\Controllers\Api\V1\PriceAlertController::class, 'destroy'])->name('destroy');
    });

    // Wishlists (Favorites)
    Route::prefix('wishlists')->name('api.v1.wishlists.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\WishlistController::class, 'index'])->name('index');
        Route::post('/toggle', [\App\Http\Controllers\Api\V1\WishlistController::class, 'toggle'])->name('toggle');
    });

    // Reviews
    Route::post('/reviews', [\App\Http\Controllers\Api\V1\ReviewController::class, 'store'])->name('api.v1.reviews.store');
    Route::get('/users/{user}/reviews', [\App\Http\Controllers\Api\V1\ReviewController::class, 'userReviews'])->name('api.v1.users.reviews');

    // Dealer/User KYC
    Route::prefix('kyc')->name('api.v1.kyc.')->group(function () {
        Route::post('/submit', [DealerKycController::class, 'submit'])->name('submit');
        Route::get('/status', [DealerKycController::class, 'status'])->name('status');

        // Sandbox Verification (For testing & frontend integration)
        Route::post('/sandbox/verify-pan', [\App\Http\Controllers\KycController::class, 'verifyPan'])->name('sandbox.verify-pan');
        Route::post('/sandbox/verify-bank', [\App\Http\Controllers\KycController::class, 'verifyBank'])->name('sandbox.verify-bank');
    });

    // Subscription Plans
    Route::get('/subscription-plans', [SubscriptionPlanController::class, 'index'])->name('api.v1.subscription-plans.index');

    // Dealer Onboarding & Subscription
    Route::prefix('dealer')->name('api.v1.dealer.')->group(function () {
        Route::post('/onboarding/submit', [DealerOnboardingController::class, 'submit'])->name('onboarding.submit');
        Route::get('/onboarding/status', [DealerOnboardingController::class, 'status'])->name('onboarding.status');
        Route::delete('/onboarding/cancel', [DealerOnboardingController::class, 'cancel'])->name('onboarding.cancel');
        Route::post('/subscription/initiate', [DealerSubscriptionController::class, 'initiate'])->name('subscription.initiate');
    });

    // Checkout & Escrow
    Route::prefix('checkout')->name('api.v1.checkout.')->group(function () {
        Route::post('/initiate', [CheckoutController::class, 'initiate'])->name('initiate');
    });

    Route::prefix('escrow')->name('api.v1.escrow.')->group(function () {
        Route::post('/{escrow}/ship', [EscrowController::class, 'ship'])->name('ship');
        Route::post('/{escrow}/confirm', [EscrowController::class, 'confirm'])->name('confirm');
    });

    // Admin Routes (role:admin)
    Route::middleware(['role:admin'])->prefix('admin')->name('api.v1.admin.')->group(function () {
        // Admin Dealers (Active)
        Route::get('/dealers', [AdminDealerController::class, 'index'])->name('dealers.index');

        // Admin KYC
        Route::prefix('kyc')->name('kyc.')->group(function () {
            Route::get('/pending', [AdminKycController::class, 'pending'])->name('pending');
            Route::get('/{userId}/documents', [AdminKycController::class, 'documents'])->name('documents');
            Route::post('/{userId}/approve', [AdminKycController::class, 'approve'])->name('approve');
            Route::post('/{userId}/reject', [AdminKycController::class, 'reject'])->name('reject');
        });

        // Admin Subscription Plans
        Route::apiResource('subscription-plans', AdminSubscriptionPlanController::class);

        // Admin Escrow Management
        Route::post('/escrow/{escrow}/release', [EscrowController::class, 'release'])->name('escrow.release');

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

    // Chat Module Routes
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

        // Offers (Escrow Flow)
        Route::post('/conversations/{conversation}/offers', [OfferController::class, 'store'])->name('offers.store');
        Route::patch('/conversations/{conversation}/offers/{offer}/status', [OfferController::class, 'updateStatus'])->name('offers.status');

        // Group Management
        Route::post('/groups/{conversation}/members', [GroupController::class, 'addMember'])->name('groups.members.add');
        Route::delete('/groups/{conversation}/members', [GroupController::class, 'removeMember'])->name('groups.members.remove');
        Route::post('/groups/{conversation}/leave', [GroupController::class, 'leaveGroup'])->name('groups.leave');
        Route::post('/groups/{conversation}/promote', [GroupController::class, 'promoteToAdmin'])->name('groups.promote');
        Route::post('/groups/{conversation}/demote', [GroupController::class, 'demoteToMember'])->name('groups.demote');

        // Real-time
        Route::post('/conversations/{conversation}/typing', [MessageController::class, 'typing'])->name('typing');
    });

    // Notification Routes
    Route::prefix('notifications')->name('api.v1.notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/stats', [NotificationController::class, 'stats'])->name('stats');
        Route::post('/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
        Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-as-read');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    // Fallback Route
    Route::fallback(function () {
        return response_error('The requested API endpoint does not exist.', [], 404);
    });
});
