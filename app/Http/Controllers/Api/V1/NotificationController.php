<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

/**
 * @group Notifications
 *
 * APIs for managing the authenticated user's notifications.
 */
class NotificationController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->authorizeResource(DatabaseNotification::class, 'notification');
    }

    /**
     * List Notifications
     *
     * Get a paginated list of all notifications for the authenticated user.
     *
     * @apiResourceCollection App\Http\Resources\NotificationResource
     * @apiResourceModel Illuminate\Notifications\DatabaseNotification
     */
    public function index()
    {
        $notifications = $this->notificationService->getAllForUser(Auth::user(), request('per_page', 15));
        return NotificationResource::collection($notifications);
    }

    /**
     * Get Notification Stats
     *
     * Get the unread count for the authenticated user.
     */
    public function stats()
    {
        return response()->json([
            'ok' => true,
            'unread_count' => $this->notificationService->getUnreadCountForUser(Auth::user()),
        ]);
    }

    /**
     * Mark as Read
     *
     * Mark a specific notification as read.
     *
     * @urlParam notification string required The ID of the notification. Example: 99c72e27-6f81-432d-9486-d24830ffbc38
     */
    public function markAsRead(DatabaseNotification $notification)
    {
        $this->notificationService->markAsRead($notification);
        return response_success('Notification marked as read.');
    }

    /**
     * Mark All as Read
     *
     * Mark all unread notifications for the authenticated user as read.
     */
    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(Auth::user());
        return response_success('All unread notifications marked as read.');
    }

    /**
     * Delete Notification
     *
     * Delete a specific notification.
     *
     * @urlParam notification string required The ID of the notification. Example: 99c72e27-6f81-432d-9486-d24830ffbc38
     */
    public function destroy(DatabaseNotification $notification)
    {
        $this->notificationService->delete($notification);
        return response_success('Notification deleted successfully.');
    }
}
