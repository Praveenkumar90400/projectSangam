<?php
namespace App\Traits;
use App\Models\Notification;

trait NotificationTrait
{
    public function dumpNotificationData($title, $notification, $gateNu = null, $userId = null)
    {
        try {
            // Create the notification
            $notification_created = Notification::create([
                'title' => $title,
                'notification' => $notification,
                'gate_nu' => $gateNu,
                'user_id' => $userId,
            ]);
    
            // If notification creation is successful, send a success response
            if ($notification_created) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Notification created successfully',
                    'notification' => $notification_created
                ], 201);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create notification'
                ], 500);
            }
        } catch (\Exception $e) {
            // If there is any exception, send an error response
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating notification',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}