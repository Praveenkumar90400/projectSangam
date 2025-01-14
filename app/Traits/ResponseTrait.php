<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
trait ResponseTrait
{
    public function processResponse($key="data",$data=null,$status,$message=null){
        
        if($status=='success'){
            return response()->json([
                'status'=>$status,
                 $key=>$data,
                'message'=>$message,
                'code'=>202,
            ]);
                
        }
        else{
            return response()->json([
                'status'=>$status,
                'message'=>$message,
                'code'=>404,
            ]);
        }
    }
  
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    
}