<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\ConnectionRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


trait ValidationTrait
{

    public function getConnectionId(Request $request)
    {
        if ($request->api_key == "y9O2fffDuVFFWgynkYwP") {

            $random_string = Str::random(20);
            // dd($random_string);
            // Convert to numeric
            $numeric_string = '';
            for ($i = 0; $i < strlen($random_string); $i++) {
                $numeric_string .= ord($random_string[$i]);
            }
            // Ensure the numeric string is exactly 20 digits
            if (strlen($numeric_string) > 20) {
                $numeric_string = substr($numeric_string, 0, 20);
            } elseif (strlen($numeric_string) < 20) {
                // Append zeros if the length is less than 20
                $numeric_string .= str_repeat('0', 20 - strlen($numeric_string));
            }
            // dd($numeric_string);
            try {
                $insert_connection_id = ConnectionRequest::insert(['connection_id' => $numeric_string]);
                // return $insert_connection_id;
            } catch (\Exception $e) {
                return $e;
            }
            if ($insert_connection_id) {
                return $numeric_string;
            } else {
                return response()->json(['Connection Id' => null, 'Message' => 'Could not get Connection Id.']);
            }
        } else {
            return response()->json(['Connection Id' => null, 'Message' => 'API_key not matched.']);
        }
    }

    public function validate_connection_id($key)
    {
        $connection = ConnectionRequest::where('connection_id', $key)->first();
        if ($connection) {
            return true;
        } else {
            return false;
        }
    }

    public function validate_user($connection_id, $auth_code)
    {
        $find_user = ConnectionRequest::where('connection_id', $connection_id)->where('auth_code', $auth_code)->first();
        if ($find_user) {
            return $find_user->user_id;
        } else {
            return false;
        }
    }

    public function check_gate_radius($lat, $lng, $distance = 50)
    {
        //miles: 3959
        //km: 6371
        $distance = $distance / 1000;     //convert given meter distance in km;
        $results = DB::select(DB::raw('SELECT *, ( 6371 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians(latitude) ) ) ) AS distance FROM factory_gates HAVING distance <= ' . $distance . ' ORDER BY distance limit 1'));
        if (count($results) > 0)
            return $results[0];
        else
            return false;
        //echo json_encode($results);
    }


}
