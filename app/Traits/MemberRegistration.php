<?php
namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\Models\ConnectionRequestModel;

trait MemberRegistration {
    public function validate_member_basic_info(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required',
            'second_name' => 'required',
            'gender' => 'required',
            'business_type' => 'required'
        ] );  
    }

    public function validate_member_personal_detail(array $data)
    {
        return Validator::make($data, [
            'father_first_name' => 'required',
            'marital_status' => 'required',
            'date_of_Birth' => 'required',
            'aadhar_number' => 'required',
            'aadhar_pic' => 'required',
            'member_pic' => 'required'
        ] );  
    }


    public function validate_member_professional_detail(array $data)
    {
        return Validator::make($data, [
            'educational_qualification' => 'required',
            'work_category' => 'required'
        ] );  
    }

    public function validate_member_membership_detail(array $data)
    {
        return Validator::make($data, [
            'business_state' => 'required',
            'home_state' => 'required',
            'duration_months' => 'required|integer'
        ] );  
    }

    public function validate_update_membership_detail(array $data)
    {
        return Validator::make($data, [
            'business_state' => 'required',
            'home_state' => 'required'
        ] );  
    }

    public function validate_update_membership_plan(array $data)
    {
        return Validator::make($data, [
            'duration_months' => 'required|integer',
        ] );  
    }
    
    public function find_user_id_by_conn_id($conn_id, $auth_code){
        if(!($conn_id && $auth_code)) return null;
        return ((new ConnectionRequestModel)->find_connection($conn_id, $auth_code));
    }
}