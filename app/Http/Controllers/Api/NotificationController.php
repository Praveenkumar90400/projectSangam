<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Traits\NotificationTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class NotificationController extends Controller
{
    use ValidationTrait;
    use NotificationTrait;
    // public function notificationData(Request $request)
    // {
    //     $user = $this->validate_user($request->connection_id, $request->auth_code);
    //     if ($user) {
    //         // Get records per page dynamically or default to 10
    //         $perPage = $request->input('per_page', 10);
    //         // Get the current page from the request, default to 1 if not provided
    //         $page = $request->input('page', 1);
    //         // Calculate the offset based on the current page and perPage
    //         $offset = ($page - 1) * $perPage;

    //         // Search keyword, if provided
    //         $searchKeyword = $request->input('search', null);

    //         // Build query and apply search if needed
    //         $query = Notification::orderBy('id', 'DESC');

    //         if ($searchKeyword) {
    //             // Apply search on the title field
    //             $query->where('title', 'like', '%' . $searchKeyword . '%');
    //         }

    //         // Count the total records AFTER search is applied (without pagination)
    //         $total = $query->count();

    //         // Apply pagination (offset and limit)
    //         $notifications = $query->offset($offset)->limit($perPage)->get();

    //         // Calculate the total pages based on filtered records
    //         $totalPages = ceil($total / $perPage);

    //         // Return the paginated and filtered results
    //         if ($notifications->isNotEmpty()) {
    //             return response()->json([
    //                 'message' => 'Notifications Retrieved Successfully',
    //                 'status' => 'success',
    //                 'total' => $total,            // Total filtered records
    //                 'per_page' => $perPage,       // Per-page value, dynamic
    //                 'current_page' => $page,      // Current page number
    //                 'total_pages' => $totalPages, // Total pages based on search and records
    //                 'notifications' => $notifications, // Paginated notifications
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'message' => 'No Notifications Found',
    //                 'status' => 'success',
    //                 'notifications' => [],
    //             ], 200);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
    //     }
    // }


    public function notificationData(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        // dd($user);
        if ($user) {
            // Get records per page dynamically or default to 10
            $perPage = $request->input('per_page', 10);
            // Get the current page from the request, default to 1 if not provided
            $page = $request->input('page', 1);
            // Calculate the offset based on the current page and perPage
            $offset = ($page - 1) * $perPage;

            // Search keyword, if provided
            $searchKeyword = $request->input('search', null);

            // Build query and apply search if needed
            // $query = Notification::orderBy('id', 'DESC');
            $query = Notification::where('user_id', $user) // Filter by the current user's ID
                             ->orderBy('id', 'DESC');

            if ($searchKeyword) {
            // Apply search on both title and notification fields
                $query->where(function($q) use ($searchKeyword) {
                    $q->where('title', 'like', '%' . $searchKeyword . '%')
                        ->orWhere('notification', 'like', '%' . $searchKeyword . '%');
                });
            }

            // Count the total records AFTER search is applied (without pagination)
            $total = $query->count();

            // Apply pagination (offset and limit)
            $notifications = $query->offset($offset)->limit($perPage)->get();

            // Calculate the total pages based on filtered records
            $totalPages = ceil($total / $perPage);

            // Process notifications to append date and time fields
            $notifications->transform(function ($notification) {
                // Extract date and time from created_at
                $notification->date = date('Y-m-d', strtotime($notification->created_at)); // Extract date
                $notification->time = date('H:i:s', strtotime($notification->created_at)); // Extract time
                
                return $notification;
            });

            // Return the paginated and filtered results
            if ($notifications->isNotEmpty()) {
                return response()->json([
                    'message' => 'Notifications Retrieved Successfully',
                    'status' => 'success',
                    'total' => $total,            // Total filtered records
                    'per_page' => $perPage,       // Per-page value, dynamic
                    'current_page' => $page,      // Current page number
                    'total_pages' => $totalPages, // Total pages based on search and records
                    'notifications' => $notifications, // Paginated notifications with date and time fields
                ], 200);
            } else {
                return response()->json([
                    'message' => 'No Notifications Found',
                    'status' => 'success',
                    'notifications' => [],
                ], 200);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
        }
    }


}
