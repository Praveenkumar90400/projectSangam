<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RcDetail;

class StatsController extends Controller
{
    public function vehicle_stats_total()
    {
        $vehicle_registered_today=RcDetail::get();
    }
}
