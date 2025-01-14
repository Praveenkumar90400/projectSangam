<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\MemberModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function home(){
        // $data['total_event'] = Event::select('id')->count();
        // $data['total_member'] = MemberModel::select('id')->count();
        // $data['this_month_event'] = Event::select('id')->whereMonth('date', Carbon::now()->month)->count();
        // $data['this_month_register'] = MemberModel::select('id')->whereMonth('registration_date', Carbon::now()->month)->count();
        // return view('dashboard.index',$data);
        return view('dashboard.index');

    }
    public function productlist(){
        // return view('productlist');
        return view('generalsettings');

    }
    public function addproduct(){
        return view('addproduct');
    }
    public function categorylist(){
        return view('categorylist');
    }
    public function addcategory(){
        return view('addcategory');
    }
    public function subaddcategory(){
        return view('subaddcategory');
    }
    public function brandlist(){
        return view('brandlist');
    }
    public function addbrand(){
        return view('addbrand');
    }
    public function importproduct(){
        return view('importproduct');
    }
    public function barcode(){
        return view('barcode');
    }
    public function saleslist(){
        return view('saleslist');
    }
    public function generalsettings(){
        return view('generalsettings');
    }
    public function emailsettings(){
        return view('emailsettings');
    }
    public function paymentsettings(){
        return view('paymentsettings');
    }
    public function currencysettings(){
        return view('currencysettings');
    }
    public function grouppermissions(){
        return view('grouppermissions');
    }
    public function taxrates(){
        return view('taxrates');
    }
    public function newuser(){
        return view('newuser');
    }
    public function userlists(){
        return view('userlists');
    }
}
