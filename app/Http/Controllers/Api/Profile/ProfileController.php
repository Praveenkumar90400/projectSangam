<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConnectionRequest;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    use ValidationTrait;

    public function profile(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            $userData = DB::table('users')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.id', $user)
                ->select(
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.image',
                    'roles.role',
                    'users.phone',
                    'users.city',
                    'users.pincode',
                    'users.state',
                    'users.address',
                )
                ->first();

            return response()->json([
                'status' => 'success',
                'message' => 'User Found successfully',
                'userData' => $userData,
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found',
            ], 400);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        $userEmail = User::find($user);
        if ($user) {
            $staff = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                // 'email' => $userEmail->email,
                'image' => $request->input('image', $userEmail->image),
                'phone' => $request->input('phone'),
                'district' => $request->input('district'),
                'city' => $request->input('city'),
                'pincode' => $request->input('pincode'),
                'state' => $request->input('state'),
                'address' => $request->input('address'),
                'updated_at' => now(),
            ];
            // Check if a new password is provided
            // $newPassword = $request->input('password');
            // if ($newPassword) {
            //     // Hash and add the new password
            //     $staff['password'] = bcrypt($newPassword);
            // } else {
            //     // Keep the existing password
            //     $staff['password'] = $user->password;
            // }
            DB::table('users')
                ->where('id', $user)
                ->update($staff);

            $updated_profile = DB::table('users')->where('id', $user)->first();
            $updated_profile_data = [
                'name' => $updated_profile->name,
                'email' => $updated_profile->email,
                'image' => $updated_profile->image,
                'phone' => $updated_profile->phone,
                'district' => $updated_profile->district,
                'city' => $updated_profile->city,
                'pincode' => $updated_profile->pincode,
                'state' => $updated_profile->state,
                'address' => $updated_profile->address,
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'user_data' => $updated_profile_data
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found',
            ], 400);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        $userImage = User::find($user);
        if ($user) {
            $staff = [
                'image' => $request->input('image', $userImage->image),
                'updated_at' => now(),
            ];
            DB::table('users')
                ->where('id', $user)
                ->update($staff);

            $updated_profile = DB::table('users')->where('id', $user)->first();
            $updated_profile_data = ['image' => $updated_profile->image,];

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'user_data' => $updated_profile_data
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found',
            ], 400);
        }
    }

    public function uploadImage(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            $image = $request->image;
            $name = $request->name;

            $image_file = $image;
            $folderPath = '';

            if ($name == 'driver') {
                $folderPath = '/user-uploads/driver/';
            } elseif ($name == 'vehicle') {
                $folderPath = '/user-uploads/vehicle/';
            } elseif ($name == 'profile') {
                $folderPath = '/user-uploads/avatar/';
            } elseif ($name == 'attendance') {
                $folderPath = '/user-uploads/attendance/';
            }elseif ($name == 'profile_image') {
                $folderPath = '/user-uploads/profile_image/';
            }else {
                $folderPath = '/user-uploads/vehicle-entry/';
            }

            // Create the directory if it doesn't exist
            if (!is_dir(public_path($folderPath))) {
                mkdir(public_path($folderPath), 0777, true);
            }

            $image_file = str_replace('data:image/jpeg.base64,', '', $image_file);
            $image_file = str_replace(' ', '+', $image_file);
            $data = base64_decode($image_file);
            $image_name = uniqid();
            $filename = $image_name . '.png';
            $path = public_path($folderPath . $filename);
            $success = file_put_contents($path, $data);
            if ($success) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'image save successfully',
                    'file_path' => $folderPath,
                    'filename' => $filename,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'success', //we can change it
                    'message' => 'no image uploading'
                ], 200);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'invalid connection']);
        }
    }
}
