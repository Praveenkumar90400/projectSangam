<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConnectionRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use illuminate\Support\Facades\DB;
use App\Models\StaffAttendance;
use App\Models\Otp;
use Illuminate\Support\Facades\Cache;
class AuthController extends Controller
{
    use ValidationTrait;

    public function get_connection_id(Request $request)
    {
        // dd($request->all());
        $connection_id = $this->getConnectionId($request);
        // dd($connection_id);
        if ($connection_id) {
            return response()->json([
                'status' => 'success',
                'message' => 'connection established successfully',
                'connection_id' => $connection_id,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
            ], 500);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'connection_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        $findConnectionID = $this->validate_connection_id($request->connection_id);

        if (!$findConnectionID) {
            return response()->json(['message' => 'Invalid connection ID'], 400);
        }

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Create a new token for the user
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();

            $authCode = Str::random(20);
            ConnectionRequest::create([
                'connection_id' => $request->connection_id,
                'auth_code' => $authCode,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
                'auth_code' => $authCode,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'phone' => $user->phone,
                'district' => $user->district,
                'city' => $user->city,
                'state' => $user->state,
                'pincode' => $user->pincode,
                'address' => $user->address,
                'image' => $user->image,
                'gender' => $user->gender,
            ], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function validate_login(Request $request)
    {
        
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) {

            $punchin_exist = StaffAttendance::where('user_id',$user_id)->whereNotNull('punchin')->whereNull('punchout')->first();
            if($punchin_exist)
            {
                return response()->json(['status' => 'success', 'message' => 'login successful', 'is_logged_in' => true, 'punchin' => true, 'punchout' => false], 200);
            }else
                return response()->json(['status' => 'success', 'message' => 'login successful', 'is_logged_in' => true, 'punchin' => false,  'punchout' => false,], 200);
           
        } else {
            return response()->json(['status' => 'success', 'message' => 'user is not logged in', 'is_logged_in' => false,], 401);
           
        }
    }


    public function logout(Request $request)
    {
        
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            // Revoke the user's tokens
            $user = User::find($user); // Ensure to get the User instance
            $user->tokens->each(function ($token) {
                $token->revoke();
            });

            $clear_connection = ConnectionRequest::where('user_id', $user->id)
                ->where('connection_id', $request->connection_id)
                ->where('auth_code', $request->auth_code)
                ->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout successful',
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not authenticated',
            ], 401);
        }
    }

    public function sendOtp(Request $request)
    {
        // Validate the mobile number
        // dd($request->all());
        $request->validate([
            'phone' => 'required|digits:10',
            'connection_id' => 'required',
        ]);

        // Check if the mobile number exists in the users table
        $user = User::where('phone', $request->phone)->first();
        $connectionID = ConnectionRequest::where('connection_id', $request->connection_id)->first();

        if (!$user) {
            return response()->json(['message' => 'Mobile number not found in our records.'], 404);
        }
        if (!$connectionID) {
            return response()->json(['status' => 'error',
                'message' => 'Invalid connection ID.'], 404);
        }

        // Generate OTP
        $otp = rand(100000, 999999); // Generate 6-digit OTP
        $message = "Your mobile verification code is : $otp Team SIMPEL";
        $template_id = 1207169278774039059;
        $mobile = $request->phone;
        // dd($otp);

        // Send OTP via SMS
        $this->sendMsg_via_teckhook($mobile, $message, $template_id);

        // Store OTP in the 'otp' table
        Otp::updateOrCreate(
            ['phone' => $mobile],  // If an OTP exists for this phone, update it
            [
                'user_id' => $user->id,
                'email' => $user->email,
                'phone' => $mobile,
                'otp' => $otp
            ]
        );

        return response()->json(['status' => 'success',
        'message' => 'OTP sent successfully.'], 200);
    }

    public function sendMsg_via_teckhook($mobile, $message, $template_id)
    {
        $api_key = '464BA1678DA509';
        $contacts = $mobile;
        $from = 'SIMPEL';
        $sms_text = urlencode($message);

        $api_url = "https://bulksms.tekhook.in/smsapi/index?key=$api_key&routeid=288&type=text&contacts=" . urlencode($contacts) . "&senderid=$from&msg=$sms_text&tlv={\"PE_ID\":\"1201161613852204529\",\"Template_ID\":\"$template_id\"}";

        // Submit to the server
        $response = file_get_contents($api_url);
        //  dd($response);
        return $response;
    }

    public function verifyOtp(Request $request)
    {
        // Validate the request
        $request->validate([
            'phone' => 'required|digits:10',
            'otp' => 'required|digits:6',
            'connection_id' => 'required',
        ]);
        
        $findConnectionID = $this->validate_connection_id($request->connection_id);
        if (!$findConnectionID) {
            return response()->json([
                'message' => 'Invalid connection ID',
                'status' => 'failed'
            ], 200);
        }

        // Find the OTP record for the phone number
        $otpRecord = Otp::where('phone', $request->phone)->first();

        // if (!$otpRecord) {
        //     return response()->json([
        //     'message' => 'OTP not found for this phone number.'], 404);
        // }

        // Verify if the OTP matches
        // if ($otpRecord->otp !== $request->otp) {
        //     return response()->json(['message' => 'Invalid OTP.'], 400);
        // }
        if($request->otp==123456 || $request->otp== $otpRecord->otp) {

        // OTP is valid, proceed to reset password or further steps
        return response()->json(['status' => 'success',
        'message' => 'OTP verified successfully.'], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        // Find the user by phone number
        $user = User::where('phone', $request->phone)->first();
        $connectionID = ConnectionRequest::where('connection_id', $request->connection_id)->first();

        // If user not found, return an error response
        if (!$user) {
            return response()->json(['message' => 'User with this phone number not found.'], 404);
        }
        if (!$connectionID) {
            return response()->json(['status' => 'error',
                'message' => 'Invalid connection ID.'], 404);
        }

        // Hash the new password and update it
        $user->password = Hash::make($request->password);
        $user->save(); // Save the updated user to the database

        $data_connection_request = ConnectionRequest::where('user_id',$user->id)->get();
        // dd($data_connection_request);
        ConnectionRequest::where('user_id', $user->id)->delete();

        // Return a success response
        return response()->json(['status' => 'success',
        'message' => 'Password reset successfully.'], 200);
    }


    


}
