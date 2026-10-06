<?php

use App\Http\Controllers\Api\V1\PublicDealerController;
use App\Http\Controllers\Api\V1\WatchDataController;
use App\Http\Controllers\Api\V1\UserAddressController;
use App\Http\Controllers\Api\V1\PriceAlertController;
use App\Http\Controllers\Api\V1\EscrowController;
use App\Http\Controllers\Api\V1\WishlistController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\FollowController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\Api\V1\DisputeController;
use App\Http\Controllers\Api\V1\LogisticsController;
use App\Http\Controllers\Api\V1\AdminEscrowController;
use App\Http\Controllers\Api\V1\AdminDisputeController;
use App\Http\Controllers\Api\V1\Admin\AnalyticsController;
use App\Http\Controllers\Api\V1\Admin\AdminNotificationController;
use App\Http\Controllers\Api\V1\Admin\AdminProfileController;
use App\Http\Controllers\Api\V1\Admin\MarketPriceController;
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

// Webhooks (Unified Endpoint for Escrow & Subscriptions)
Route::post('/v1/webhooks/razorpay', [RazorpayWebhookController::class, 'handle'])->name('api.webhooks.razorpay');

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

    // Public Dealer Directory
    Route::get('/dealers', [PublicDealerController::class, 'index'])->name('api.v1.dealers.index');
    Route::get('/dealers/{id}', [PublicDealerController::class, 'show'])->name('api.v1.dealers.show');

    // Watch Data Proxy (For Listing Creation Dropdowns)
    Route::prefix('watch-data')->group(function () {
        Route::get('/brands', [WatchDataController::class, 'brands'])->name('api.v1.watch-data.brands');
        Route::get('/models', [WatchDataController::class, 'models'])->name('api.v1.watch-data.models');
        Route::get('/references', [WatchDataController::class, 'references'])->name('api.v1.watch-data.references');
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

    // Addresses
    Route::apiResource('addresses', UserAddressController::class);

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
        Route::get('/', [PriceAlertController::class, 'index'])->name('index');
        Route::post('/', [PriceAlertController::class, 'store'])->name('store');
        Route::post('/{id}/toggle', [PriceAlertController::class, 'toggle'])->name('toggle');
        Route::delete('/{id}', [PriceAlertController::class, 'destroy'])->name('destroy');
    });

    // User Purchases (History)
    Route::get('/user/purchases', [EscrowController::class, 'purchases'])->name('api.v1.user.purchases');

    // Wishlists (Favorites)
    Route::prefix('wishlists')->name('api.v1.wishlists.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
    });

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('api.v1.reviews.store');
    Route::get('/users/{user}/reviews', [ReviewController::class, 'userReviews'])->name('api.v1.users.reviews');

    // User Profile & Follow System
    Route::prefix('users')->name('api.v1.users.')->group(function () {
        Route::post('/{id}/follow', [FollowController::class, 'toggleFollow'])->name('follow');
        Route::get('/{id}/followers', [FollowController::class, 'followers'])->name('followers');
        Route::get('/{id}/following', [FollowController::class, 'following'])->name('following');
    });

    // Dealer/User KYC
    Route::prefix('kyc')->name('api.v1.kyc.')->group(function () {
        Route::post('/submit', [DealerKycController::class, 'submit'])->name('submit');
        Route::get('/status', [DealerKycController::class, 'status'])->name('status');

        // Sandbox Verification (For testing & frontend integration)
        Route::post('/sandbox/verify-pan', [KycController::class, 'verifyPan'])->name('sandbox.verify-pan');
        Route::post('/sandbox/verify-bank', [KycController::class, 'verifyBank'])->name('sandbox.verify-bank');
    });

    // Subscription Plans
    Route::get('/subscription-plans', [SubscriptionPlanController::class, 'index'])->name('api.v1.subscription-plans.index');

    // Dealer Onboarding & Subscription
    Route::prefix('dealer')->name('api.v1.dealer.')->group(function () {
        Route::post('/onboarding/submit', [DealerOnboardingController::class, 'submit'])->name('onboarding.submit');
        Route::get('/onboarding/status', [DealerOnboardingController::class, 'status'])->name('onboarding.status');
        Route::delete('/onboarding/cancel', [DealerOnboardingController::class, 'cancel'])->name('onboarding.cancel');
        Route::post('/subscription/initiate', [DealerSubscriptionController::class, 'initiate'])->name('subscription.initiate');
        Route::post('/subscription/cancel', [DealerSubscriptionController::class, 'cancel'])->name('subscription.cancel');
    });

    // Checkout & Escrow
    Route::prefix('checkout')->name('api.v1.checkout.')->group(function () {
        Route::post('/initiate', [CheckoutController::class, 'initiate'])->name('initiate');
    });

    Route::prefix('escrow')->name('api.v1.escrow.')->group(function () {
        Route::post('/{escrow}/generate-label', [EscrowController::class, 'generateLabel'])->name('generate-label');
        Route::get('/{escrow}/tracking', [EscrowController::class, 'tracking'])->name('tracking');
        Route::post('/{escrow}/ship', [EscrowController::class, 'ship'])->name('ship');
        Route::post('/{escrow}/confirm', [EscrowController::class, 'confirm'])->name('confirm');
        Route::post('/{escrow}/dispute', [DisputeController::class, 'raiseDispute'])->name('dispute');
        Route::post('/{escrow}/dispute/reply', [DisputeController::class, 'replyDispute'])->name('dispute.reply');
    });

    // Logistics
    Route::prefix('logistics')->name('api.v1.logistics.')->group(function () {
        Route::get('/pincode/{pincode}', [LogisticsController::class, 'checkPincode'])->name('checkPincode');
    });

    // Admin Routes (auth + role:admin)
    Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->name('api.v1.admin.')->group(function () {
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
        Route::controller(AdminEscrowController::class)->prefix('escrows')->name('escrows.')->group(function () {
            Route::get('/stats', 'stats')->name('stats');
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/tracking', 'tracking')->name('tracking');
            Route::post('/{id}/release', 'release')->name('release');
            Route::post('/{id}/refund', 'refund')->name('refund');
        });

        // Admin Disputes
        Route::controller(AdminDisputeController::class)->prefix('disputes')->name('disputes.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/{id}/resolve', 'resolve')->name('resolve');
            Route::post('/{id}/notes', 'saveNote')->name('notes');
        });

        // Admin Analytics
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics.index');

        // Admin Notifications
        Route::get('/notifications/critical', [AdminNotificationController::class, 'criticalAlerts'])->name('admin.notifications.critical');

        // Admin Profile Settings
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');


        // Admin Market Prices
        Route::controller(MarketPriceController::class)->prefix('market-prices')->name('market-prices.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/refresh', 'refresh')->name('refresh');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Admin Dealer Applications
        Route::controller(AdminDealerApplicationController::class)->prefix('dealer-applications')->name('dealer-applications.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::patch('/{id}/status', 'updateStatus')->name('status');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Admin Users
        Route::controller(AdminUserController::class)->prefix('users')->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/history', 'history')->name('history');
            Route::patch('/{id}/standing', 'updateStanding')->name('update-standing');
        });

        // Admin Listings
        Route::controller(AdminListingController::class)->prefix('listings')->name('listings.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::patch('/{id}', 'update')->name('update');
            Route::patch('/{id}/status', 'updateStatus')->name('update-status');
        });
    });

    // Chat Module Routes
    Route::prefix('chat')->name('api.v1.chat.')->group(function () {
        // Conversations
        Route::controller(ConversationController::class)->prefix('conversations')->name('conversations.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });

        // Messages
        Route::controller(MessageController::class)->group(function () {
            Route::get('/conversations/{conversation}/messages', 'index')->name('messages.index');
            Route::post('/messages', 'store')->name('messages.store');
            Route::patch('/messages/{message}', 'update')->name('messages.update');
            Route::delete('/messages/{message}', 'destroy')->name('messages.destroy');
            Route::post('/messages/read', 'markAsRead')->name('messages.read');
            Route::post('/conversations/{conversation}/typing', 'typing')->name('typing');
        });

        // Offers (Escrow Flow)
        Route::controller(OfferController::class)->prefix('conversations/{conversation}/offers')->name('offers.')->group(function () {
            Route::post('/', 'store')->name('store');
            Route::patch('/{offer}/status', 'updateStatus')->name('status');
        });

        // Group Management
        Route::controller(GroupController::class)->prefix('groups/{conversation}')->name('groups.')->group(function () {
            Route::post('/members', 'addMember')->name('members.add');
            Route::delete('/members', 'removeMember')->name('members.remove');
            Route::post('/leave', 'leaveGroup')->name('leave');
            Route::post('/promote', 'promoteToAdmin')->name('promote');
            Route::post('/demote', 'demoteToMember')->name('demote');
        });
    });

    // Notification Routes
    Route::controller(NotificationController::class)->prefix('notifications')->name('api.v1.notifications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/stats', 'stats')->name('stats');
        Route::post('/{notification}/mark-as-read', 'markAsRead')->name('mark-as-read');
        Route::post('/mark-all-as-read', 'markAllAsRead')->name('mark-all-as-read');
        Route::delete('/{notification}', 'destroy')->name('destroy');
    });

    // Fallback Route
    Route::fallback(function () {
        return response_error('The requested API endpoint does not exist.', [], 404);
    });
});

// TEMP: Public routes for seeding and clearing dummy analytics data
Route::get('/seed-analytics', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AnalyticsDataSeeder', '--force' => true]);
    return response()->json(['message' => 'Seeding completed successfully!']);
});

Route::get('/clear-analytics', function () {
    // Delete all users created by this seeder (email starts with seeded)
    $users = \App\Models\User::where('email', 'like', 'seeded%@patinawatches.com')->get();
    foreach ($users as $user) {
        $user->forceDelete(); // forceDelete in case of soft deletes
    }

    // Delete all listings created by this seeder (model starts with Seeded Model or Review Seed)
    $listings = \App\Models\Listing::where('model', 'like', 'Seeded Model %')
                                   ->orWhere('model', 'like', 'Review Seed %')->get();
    foreach ($listings as $listing) {
        $listing->forceDelete();
    }
    
    return response()->json(['message' => 'All seeded analytics dummy data has been permanently cleared!']);
});
