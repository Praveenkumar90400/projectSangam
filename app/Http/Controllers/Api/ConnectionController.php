<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Utility;
use App\Models\ConnectionRequest;
use App\Models\UserModel;
use App\Models\Customer;
use App\Models\Otp;
use App\Models\OneTimePasswordModel;
use Illuminate\Support\Str;
use App\Traits\ValidationTrait;

class ConnectionController extends Controller
{   
    use ValidationTrait;

    /**--------------------------------------------- public functions -----------------------------------------------*/

    //Establich a new connection : parameters(api_key) -> connection_id is generated and saved in DB.
    public function secure_connection(Request $request)
    {
        $connection_id = $this->connection_request($request->api_key);
        if ($connection_id != false) {
            return response()->json([
                'Status' => 'success',
                'Message' => 'Connection established successfully.',
                'Data' => $connection_id
            ]);
        } else {
            return response()->json([
                'Status' => 'failed',
                'Error' => '1001',
                'Message' => 'Invalid key.'
            ]);
        }
    }
    private function connection_request($key)
    {
        if ($key == 'AS45$AS45D#A5SDAKLFJG54FD4!SDF34') {
            $connection = new ConnectionRequest();
            $connection->connection_id = $this->generateRandomString();
            $connection->save();
            return $connection->connection_id;
        }
        return false;
    }

    private function generateRandomString($length = 20)
    {
        return Str::random($length); // Generates a random string of letters and numbers
    }


    public function register(Request $request)
    {
        $user=$this->validate_connection_id($request->connection_id);
        $otp = new Otp();
        $otp->mobile_no = $request->mobile_no;
        $otp->otp = 123456;
        if ($otp->save()) {
            // Return success response if save is successful
            return response()->json([
                'success' => true,
                'message' => 'Otp send Successfully.',
                'data' => $otp
            ], 200);
        } else {
            // Return error response if save fails
            return response()->json([
                'success' => false,
                'message' => 'Failed to send opt.'
            ], 400);
        }
    }
}
