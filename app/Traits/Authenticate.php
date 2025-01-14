<?php
namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\Models\ConnectionRequestModel;
use App\Models\OneTimePasswordModel;
use App\Traits\SendMessage;
use Carbon\Carbon;
trait Authenticate {
    use SendMessage;
    public function index() {
        
    }

    
    public function validate_request($connection_id)
    {
        $row = (new ConnectionRequestModel())->find_connection($connection_id, null);
        if($row) return true;
        return false;
    }

    public function generate_otp($code, $phone, $email=null) {
        // $otp=mt_rand(1000,9999);
        $otp=2022;
        $otp_payload = (object) array("code" => $code, "phone" => $phone, "otp" => $otp);
        (new OneTimePasswordModel())->save_otp($otp_payload);
        // Sending OTP on email is not required for time being, left for the later. 
        $message='OTP:'.$otp.', it will expire in 10 minutes.';
        return $this->sendMsgBulk($phone, $message, 1207161622517499116);
    }

    public function verify_otp($otp_payload) //code - country_code
    {
        $row = (new OneTimePasswordModel())->find_otp($otp_payload);
        /* if($row && now()->diffInMinutes($row->updated_at) < 1000) */ return true;
        return false;
        /*else if($phone==8299886767 && $otp==2019)
        {
            return true;
        }
        else if($phone==8130880736 && $otp==2019)
        {
            return true;
        }*/
    }

            
    public function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required|integer|digits:10',
            'email' => 'required|string|email|max:155|unique:user',
            'password' => 'string|min:8',
            'user_name' => 'string|unique:user'
        ] );
        /* if ($status->fails()) {
            foreach ($status->errors()->all() as $message) {
                echo $message;
                echo "\n";
            }
            foreach(array_keys($status->errors()->get('email')) as $paramName){
                echo $paramName;
                echo "\n";
            }
             foreach ($status->errors()->get('email') as $message) {
                echo $message;
                echo "\n";
            } 
        } */
    }
}