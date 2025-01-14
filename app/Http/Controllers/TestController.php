<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Utility;
use App\Models\ConnectionRequestModel;
use App\Models\UserModel;
use App\Models\OneTimePasswordModel;

class TestController extends Controller
{

    /**--------------------------------------------- public functions -----------------------------------------------*/

    //Establich a new connection : parameters(api_key) -> connection_id is generated and saved in DB.
    public function secure_connection(Request $request, $api_key)
    {
        $connection_id = $this->connection_request($api_key);
        if ($connection_id != false) {
            return response()->json([
                'Status' => 'success',
                'Error' => '0000',
                'Message' => 'Connection established.',
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
            $connection_id = (new Utility())->generate_random();
            (new ConnectionRequestModel())->save_connection($connection_id);
            return $connection_id;
        }
        return false;
    }


}
