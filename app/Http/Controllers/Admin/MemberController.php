<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberModel;
use App\Models\MemberPersonalDetailModel;
use App\Models\MemberProfessionalDetailModel;
use App\Models\MembershipPlanModel;
use App\Models\MembershipDetailModel;
use App\Traits\ResponseTrait;
use App\Models\MemberAddress;
use App\Models\User;

class MemberController extends Controller
{
    public function member_list()
    {
        $data['member_list'] = MemberModel::select('member.id as member_id', 'mobile_number', 'first_name', 'second_name','email','gender')
        ->join('user','member.user_id','=','user.id')
        ->get();
        return view('member.index',$data);
    }

    public function view_details(Request $request, $member_id)
    {
        $member['profile_details']=MemberModel::select('first_name','second_name','member_personal_detail.member_pic')
        ->join('user','member.user_id','=','user.id')
        ->join('member_personal_detail','member_personal_detail.member_id','=','member.id')
        ->where('member.id',$member_id)
        ->first();

        $member['professional_detail']=MemberProfessionalDetailModel::select('educational_qualification','work_category','job_designation','firm_name as company_name')
        ->where('member_id',$member_id)
        ->first();

        $member['contact_info']=MemberModel::select('mobile_number','email')
        ->join('user','member.user_id','=','user.id')
        ->where('member.id',$member_id)
        ->first();
        
        $member['basic_info']=MemberPersonalDetailModel::select('date_of_Birth','member.gender')
        ->join('member','member.id','=','member_personal_detail.member_id')
        ->where('member_id',$member_id)
        ->first();
        $member['place_lived']=MemberAddress::select('city','state','nationality')
        ->where('member_id',$member_id)
        ->first();
        return view('member.member_details',$member);
    }
}
