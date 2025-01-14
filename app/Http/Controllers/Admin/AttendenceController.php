<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffAttendance;
use App\Models\User;
// use Session;
// use Auth;

class AttendenceController extends Controller
{
    public function attendence_listing(Request $request)
    {
        if ($request->has('startDate') && $request->has('endDate')) {
            date_default_timezone_set("Asia/Kolkata");

            $saveData_spc_lr = [
                "ssdate" => $request->input('startDate'),
                "sedate" => $request->input('endDate')
            ];
            Session::put('saveData_spc_lr', $saveData_spc_lr);
        } else {
            $saveData_spc_lr = Session::get('saveData_spc_lr', [
                "ssdate" => date('Y-m-d', strtotime('-29 days')),
                "sedate" => date('Y-m-d')
            ]);
        }

        // Calculate date range for the columns
        $dates = [];
        $currentDate = $saveData_spc_lr['ssdate'];
        while ($currentDate <= $saveData_spc_lr['sedate']) {
            $dates[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        return view('backend.staff_attendence.staff_attendence_listing', compact('saveData_spc_lr', 'dates'));
    }

    public function attendence_data(Request $request)
    {
        $factory_id = Auth::user()->factory_id;
        $role_id = Auth::user()->role_id;
        $params = $request->all();
        // dd($factory_id);

        // Build the base query
        if (Auth::user()->role_id == 1) {
        $query = StaffAttendance::join('users', 'users.id', '=', 'staff_attendances.user_id')
            ->select([
                'users.id',
                'users.name',
                'staff_attendances.punchin',
                'staff_attendances.punchout',
                'staff_attendances.created_at',
            ]);

        }
        else
        {
            $query = StaffAttendance::join('users', 'users.id', '=', 'staff_attendances.user_id')
            ->where('users.factory_id', $factory_id)
            ->join('factory_gates', 'factory_gates.id', '=', 'staff_attendances.gate_id')
            ->select([
                'users.id',
                'users.name',
                'staff_attendances.punchin',
                'staff_attendances.punchout',
                'staff_attendances.created_at',
            ]);
        }
        $records = $query->get();
        // dd($records);

        // Handle search
        if (!empty($params['search']['value'])) {
            $searchValue = trim($params['search']['value']);
            $records = $records->filter(function ($item) use ($searchValue) {
                return stripos($item->name, $searchValue) !== false;
            });
        }

        // Handle date range filtering
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('staff_attendances.created_at', [$startDate, $endDate]);
        }

        // Handle pagination
        // Total records for filtering

        $query->offset($params['start'])->limit($params['length']);

        // Process and format the data
        $groupedData = $records->groupBy('id')->map(function ($group) use ($startDate, $endDate) {
            // Initialize data for each employee
            $data = [
                'id' => $group->first()->id,
                'name' => $group->first()->name,
            ];

            // Generate an array for each date in the range
            $dateRange = [];
            $currentDate = $startDate;
            while ($currentDate <= $endDate) {
                $dateRange[$currentDate] = ''; // Initialize as an empty string for each date
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }
            // dd($group);
            foreach ($group as $record) {
                $date = date('Y-m-d', strtotime($record->created_at)); // Extract date part only
                if (array_key_exists($date, $dateRange)) {
                    // Check if punchout time is available
                    if (!empty($record->punchout)) {
                        $dateRange[$date] .= date('H:i', strtotime($record->punchin)) . ' - ' . date('H:i', strtotime($record->punchout)) . "\n"; // Combine punchin and punchout times
                    } else {
                        $dateRange[$date] .= date('H:i', strtotime($record->punchin)) . ' - ' . ' ' . "\n"; // Punchout time not available
                    }
                }
            }

            // Format the dateRange to string with newline characters
            $data = array_merge($data, $dateRange);
            return $data;
        });

        // Convert the collection to array
        $data = $groupedData->values()->map(function ($record) {
            return $record; // Include all date columns directly
        });
        $totalRecords = count($data);
        // dd($data);
        // Return the data in JSON format
        return response()->json([
            "draw" => intval($params['draw']),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords), // This should be the filtered count
            "data" => $data
        ]);
    }

}
