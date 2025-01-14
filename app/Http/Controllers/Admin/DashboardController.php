<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\MemberModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function dashboard(){
        $data['total_event'] = Event::select('id')->count();
        $data['total_member'] = MemberModel::select('id')->count();
        $data['this_month_event'] = Event::select('id')->whereMonth('date', Carbon::now()->month)->count();
        $data['this_month_register'] = MemberModel::select('id')->whereMonth('registration_date', Carbon::now()->month)->count();
        return view('dashboard.index',$data);

    }

   
}
