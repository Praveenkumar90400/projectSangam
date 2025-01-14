<?php

namespace App\Http\Controllers\ApiFactoryGateLog;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ValidationTrait;
// use DB;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\FactoryGateLog;
use App\Models\StaffAttendance;
use App\Models\FactoryGate;
use App\Models\User;
use App\Models\RcDetail;
use App\Models\DrivingLicense;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Log;

class FactoryGateLogController extends Controller
{
    use ValidationTrait;
    use NotificationTrait;


    public function vehicleEntry(Request $request)
    {
        // dd($request->all());
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            $gate_data = StaffAttendance::where('user_id', $user)->first();
            $gate_id = $gate_data->gate_id;
            $factory_data = FactoryGate::where('id', $gate_id)->first();
            $gate_nu = $factory_data->gate_nu;
            $factory_id = $factory_data->factory_id;
            
            $date = now();

            $existing_entry = DB::table('factory_gate_logs')
                ->where('vehicle_id', $request->input('vehicle_id'))
                ->whereNull('out_time')
                ->first();

            if ($existing_entry) {
                return response()->json(['status' => 'failed', 'message' => 'Vehicle entry already exists'], 400);
            }

            $vehicle_entry = [
                'factory_id' => $factory_id,
                'gate_id' => $gate_id,
                'vehicle_id' => $request->input('vehicle_id'),
                'driver_id' => $request->input('driver_id'),
                'user_id' => $user,
                'in_time' => $date,
                'entry_remark' => $request->input('entry_remark'),
                'entry_weight' => $request->input('entry_weight', 0),
                'created_at' => $date,
                'updated_at' => $date,
            ];

            $vehicle_entry_inserted = DB::table('factory_gate_logs')->insertGetId($vehicle_entry);


            //new scan
            
            $logData=DB::table('factory_gate_logs')->where('id', $vehicle_entry_inserted)->first();
            $userId= $logData->user_id;
            $user_data=User::where('id', $userId)->first();
            $admin_id= $user_data->admin_id;
            $walletAmountData=WalletTransaction::where('user_id',$admin_id)->first();
            if ($walletAmountData) {
                // Deduct ₹4 from the current amount
                $newAmount = $walletAmountData->amount - 4;
    
                if ($newAmount >= 0) { // Ensure the new amount is not negative
                    $walletAmountData->update(['amount' => $newAmount]);
                } else { $walletAmountData->update(['amount'=> $newAmount]);
            }
        }


            if ($vehicle_entry_inserted) {
                // notification logic
                $vehicle_detail = RcDetail::where('id', $request->input('vehicle_id'))->first();

                // $vehicle_nu = $vehicle_detail->state_code . $vehicle_detail->district_code . $vehicle_detail->serial_code . $vehicle_detail->unique_code;
                $vehicle_nu = $vehicle_detail->rc_number;
                $driverData = DrivingLicense::where('id', $request->input('driver_id'))->first();
                $driver_name = $driverData->license_holder;
                $notification_data = $this->dumpNotificationData(
                    'New Vehicle Entry',
                    'Vehicle Number ' . $vehicle_nu . ' Entered from gate number ' . $gate_nu,
                    $gate_nu,
                    $user
                );


                $notification_data_second = $this->dumpNotificationData(
                    'Driver Entry', // New title
                    'Driver' . $driver_name . ' With Vehicle Number ' . $vehicle_nu . ' has entered from gate number ' . $gate_nu,
                    $gate_nu,
                    $user
                );
                // notification logic

                $vehicle_entry_data = FactoryGateLog::where('id', $vehicle_entry_inserted)->first();
                $in_time = Carbon::parse($vehicle_entry_data->in_time);
                $vehicle_entry_details = [
                    'id' => $vehicle_entry_data->id,
                    'factory_id' => $vehicle_entry_data->factory_id,
                    'gate_id' => $vehicle_entry_data->gate_id,
                    'vehicle_id' => $vehicle_entry_data->vehicle_id,
                    'driver_id' => $vehicle_entry_data->driver_id,
                    'user_id' => $vehicle_entry_data->user_id,
                    'in_date' => $in_time->format('Y-m-d'),
                    'in_time' => $in_time->format('H:i:s'),
                    'entry_remark' => $vehicle_entry_data->entry_remark,
                    'entry_weight' => $vehicle_entry_data->entry_weight,
                    'created_at' => $vehicle_entry_data->created_at,
                    'updated_at' => $vehicle_entry_data->updated_at,
                ];
                return response()->json(
                    ['status' => 'success', 'message' => 'Vehicle entry successful', 'vehicle_entry_details' => $vehicle_entry_details],
                    200
                );
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Vehicle entry failed'], 500);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
        }
    }


    public function vehicleExist(Request $request)
    {
        // dd($request->all());
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            $rcNumber = $request->input('rc_number');
            if (strlen($rcNumber) < 8) {
                return response()->json(['status' => 'error', 'message' => 'Invalid RC number'], 400);
            }

            // Extract components from the RC number
            // $data = str_split($rcNumber);
            // $state_code = $data[0] . $data[1];
            // // $district_code = $data[2] . $data[3];
            // $district_code = (int) ($data[2] . $data[3]);
            // // $district_code = (int) ($rcNumber[2] . $rcNumber[3]);
            // // dd($district_code);
            // $serial_code = $data[4] . $data[5];
            // $unique_code = $data[6] . $data[7] . $data[8] . $data[9];




            // Query to check if there is an entry with in_time not null
            $vehicleEntryDetails = DB::table('rc_details')
                ->leftJoin('owner_details', 'rc_details.id', '=', 'owner_details.rc_details_id')
                ->leftJoin('kyc_rc_vehicle_details', 'rc_details.id', '=', 'kyc_rc_vehicle_details.rc_details_id')
                ->leftJoin('factory_gate_logs', 'rc_details.id', '=', 'factory_gate_logs.vehicle_id')
                ->leftJoin('factories', 'factories.id', '=', 'factory_gate_logs.factory_id')
                ->leftJoin('factory_gates', 'factory_gates.id', '=', 'factory_gate_logs.gate_id')
                ->leftJoin('driving_license_details', 'driving_license_details.id', '=', 'factory_gate_logs.driver_id')
                ->leftJoin('driver_kyc_details', 'driving_license_details.id', '=', 'driver_kyc_details.driver_id')
                ->leftJoin('users', 'users.id', '=', 'factory_gate_logs.user_id')
                // ->where('state_code', $state_code)
                // ->where('district_code', $district_code)
                // ->where('serial_code', $serial_code)
                // ->where('rc_details.unique_code', '=', $unique_code)
                ->where('rc_details.rc_number', '=', $rcNumber)
                ->whereNotNull('factory_gate_logs.in_time')
                ->whereNull('factory_gate_logs.out_time')
                ->select(
                    DB::raw("DATE(factory_gate_logs.created_at) as entry_date"),
                    DB::raw("TIME(factory_gate_logs.in_time) as in_time"),
                    'factory_gates.gate_nu',
                    'factory_gate_logs.out_time',
                    // DB::raw("CONCAT(rc_details.state_code, rc_details.district_code, rc_details.serial_code, rc_details.unique_code) as rc_number"),
                    'rc_details.rc_number',
                    'rc_details.id as vehicle_id',
                    'rc_details.vehicle_image',
                    'owner_details.owner_name',
                    'rc_details.rc_issue_date',
                    'kyc_rc_vehicle_details.category_description',
                    'kyc_rc_vehicle_details.chassis_number',
                    'kyc_rc_vehicle_details.engine_number',
                    'kyc_rc_vehicle_details.maker_description',
                    'kyc_rc_vehicle_details.maker_model',
                    'kyc_rc_vehicle_details.body_type',
                    'kyc_rc_vehicle_details.fuel_type',
                    'kyc_rc_vehicle_details.color',
                    'driving_license_details.license_number',
                    'driving_license_details.license_holder',
                    'driving_license_details.image',
                    'driving_license_details.date_of_birth',
                    'driver_kyc_details.state',
                    'driving_license_details.id as driver_id',
                    'driving_license_details.issue_date',
                    'driving_license_details.hazardous_valid_till',
                    'driving_license_details.initial_issuing_office',
                    'driving_license_details.address',
                    'driving_license_details.blood_group',
                    'driving_license_details.dependent_name'
                )
                ->first();
            // dd($vehicleEntryDetails);


            if ($vehicleEntryDetails) {
                $vehicleEntryInfo = [
                    'vehicle_id' => $vehicleEntryDetails->vehicle_id,
                    'rc_number' => $vehicleEntryDetails->rc_number,
                    'vehicle_image' => $vehicleEntryDetails->vehicle_image,
                    'owner_name' => $vehicleEntryDetails->owner_name,
                    'rc_issue_date' => $vehicleEntryDetails->rc_issue_date,
                    'category_description' => $vehicleEntryDetails->category_description,
                    'chassis_number' => $vehicleEntryDetails->chassis_number,
                    'engine_number' => $vehicleEntryDetails->engine_number,
                    'maker_description' => $vehicleEntryDetails->maker_description,
                    'maker_model' => $vehicleEntryDetails->maker_model,
                    'body_type' => $vehicleEntryDetails->body_type,
                    'fuel_type' => $vehicleEntryDetails->fuel_type,
                    'color' => $vehicleEntryDetails->color,
                ];
                $driverEntryInfo = [
                    'id' => $vehicleEntryDetails->driver_id,
                    'license_number' => $vehicleEntryDetails->license_number,
                    'license_holder' => $vehicleEntryDetails->license_holder,
                    'image' => $vehicleEntryDetails->image,
                    'date_of_birth' => $vehicleEntryDetails->date_of_birth,
                    'state' => $vehicleEntryDetails->state,
                    'issue_date' => $vehicleEntryDetails->issue_date,
                    'hazardous_valid_till' => $vehicleEntryDetails->hazardous_valid_till,
                    'initial_issuing_office' => $vehicleEntryDetails->initial_issuing_office,
                    'address' => $vehicleEntryDetails->address,
                    'blood_group' => $vehicleEntryDetails->blood_group,
                    'dependent_name' => $vehicleEntryDetails->dependent_name,
                ];
                // dd($driverEntryInfo,$vehicleEntryInfo);
                // Return the details if in_time is not null
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vehicle entry details',
                    'entry_date' => $vehicleEntryDetails->entry_date,
                    'in_time' => $vehicleEntryDetails->in_time,
                    'gate_nu' => $vehicleEntryDetails->gate_nu,
                    'out_time' => $vehicleEntryDetails->out_time,
                    'vehicle_data' => $vehicleEntryInfo,
                    'driver_data' => $driverEntryInfo
                ], 200);
            } else {
                // Check if vehicle exists without an entry
                $vehicleSystemDetails = DB::table('rc_details')
                    ->leftJoin('owner_details', 'rc_details.id', '=', 'owner_details.rc_details_id')
                    ->leftJoin('kyc_rc_vehicle_details', 'rc_details.id', '=', 'kyc_rc_vehicle_details.rc_details_id')
                    // ->where('state_code', $state_code)
                    // ->where('district_code', $district_code)
                    // ->where('serial_code', $serial_code)
                    // ->where('rc_details.unique_code', '=', $unique_code)
                    ->where('rc_details.rc_number', '=', $rcNumber)
                    ->select(
                        'rc_details.id as vehicle_id',
                        // DB::raw("CONCAT(rc_details.state_code, rc_details.district_code, rc_details.serial_code, rc_details.unique_code) as rc_number"),
                        'rc_details.rc_number',
                        'rc_details.vehicle_image',
                        'rc_details.rc_issue_date',
                        'owner_details.owner_name',
                        'kyc_rc_vehicle_details.category_description',
                        'kyc_rc_vehicle_details.chassis_number',
                        'kyc_rc_vehicle_details.engine_number',
                        'kyc_rc_vehicle_details.maker_description',
                        'kyc_rc_vehicle_details.maker_model',
                        'kyc_rc_vehicle_details.body_type',
                        'kyc_rc_vehicle_details.fuel_type',
                        'kyc_rc_vehicle_details.color'
                    )
                    ->first();
                        // dd($vehicleSystemDetails);
                if ($vehicleSystemDetails) {
                    // Return vehicle system details if no entry found
                    return response()->json(['status' => 'error', 'message' => 'Vehicle system details', 'vehicle_data' => $vehicleSystemDetails], 200);
                } else {
                    // Vehicle does not exist in the system
                    return response()->json(['status' => 'failed', 'message' => 'Vehicle register first'], 200);
                }
            }
        } else {
            // User validation failed
            return response()->json(['status' => 'error', 'message' => 'User not found'], 401);
        }
    }


    public function vehicleExit(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            $gate_data = StaffAttendance::where('user_id', $user)->first();
            if (!$gate_data) {
                return response()->json(['status' => 'failed', 'message' => 'Gate data not found'], 404);
            }
            $gate_id = $gate_data->gate_id;
            $factory_data = FactoryGate::where('id', $gate_id)->first();
            $gate_nu = $factory_data->gate_nu;
            if (!$factory_data) {
                return response()->json(['status' => 'failed', 'message' => 'Factory data not found'], 404);
            }
            $factory_id = $factory_data->factory_id;
            $date = date('Y-m-d H:i:s');

            $vehicle_id = $request->input('vehicle_id');
            $vehicleExist = FactoryGateLog::where('vehicle_id', $vehicle_id)->whereNull('out_time')->first();

            if ($vehicleExist) {
                $vehicleExist->out_time = $date;
                $vehicleExist->exit_gate = $gate_id;
                $vehicleExist->exit_driver_id = $request->input('exit_driver_id');
                $vehicleExist->exit_user_id = $user;
                $vehicleExist->exit_remark = $request->input('exit_remark');
                $vehicleExist->exit_weight = $request->input('exit_weight', 0);
                $vehicleExist->updated_at = now();
                $vehicleExist->save();

                // notification logic
                $vehicle_detail = RcDetail::where('id', $request->input('vehicle_id'))->first();
                // dd($vehicle_detail);
                // $vehicle_nu = $vehicle_detail->state_code . $vehicle_detail->district_code . $vehicle_detail->serial_code . $vehicle_detail->unique_code;
                $vehicle_nu = $vehicle_detail->rc_number;
                // Log::info($vehicle_detail);
                $notification_data = $this->dumpNotificationData(
                    'Vehicle Exit',
                    'Vehicle Number ' . $vehicle_nu . ' Exit from gate number ' . $gate_nu,
                    $gate_nu,
                    $user
                );

                // notification logic

                $out_time = Carbon::parse($vehicleExist->out_time);
                $vehicleExitDetails = [
                    'id' => $vehicleExist->id,
                    'factory_id' => $vehicleExist->factory_id,
                    'gate_id' => $vehicleExist->gate_id,
                    'vehicle_id' => $vehicleExist->vehicle_id,
                    'driver_id' => $vehicleExist->driver_id,
                    'user_id' => $vehicleExist->user_id,
                    'in_time' => $vehicleExist->in_time,
                    'out_time' => $out_time->format('H:i:s'),
                    'exit_gate' => $vehicleExist->exit_gate,
                    'exit_driver_id' => $vehicleExist->exit_driver_id,
                    'exit_user_id' => $vehicleExist->exit_user_id,
                    'entry_remark' => $vehicleExist->entry_remark,
                    'exit_remark' => $vehicleExist->exit_remark,
                    'entry_weight' => $vehicleExist->entry_weight,
                    'exit_weight' => $vehicleExist->exit_weight,
                ];

                return response()->json(['status' => 'success', 'message' => 'Vehicle exit successful', 'vehicle_exit_details' => $vehicleExitDetails], 200);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Vehicle not found or already exited'], 404);
            }

        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
        }
    }

    // public function factoryGateLogs(Request $request)
    // {
    //     $user = $this->validate_user($request->connection_id, $request->auth_code);
    //     if ($user) {
    //         if ($request->vehicle_no) {
    //             $data = str_split($request->vehicle_no);
    //             $state_code = $data[0] . $data[1];
    //             $district_code = $data[2] . $data[3];
    //             $serial_no = $data[4] . $data[5];
    //             $unique_number = $data[6] . $data[7] . $data[8] . $data[9];
    //             // dd($state_code,$district_code,$serial_no,$unique_number);
    //             $factory_gate_logs = DB::table('factory_gate_logs')
    //                 ->where('rc_details.state_code', $state_code)->where('rc_details.district_code', $district_code)->
    //                 where('rc_details.serial_code', $serial_no)->where('rc_details.unique_code', $unique_number)->join('rc_details', 'factory_gate_logs.vehicle_id', '=', 'rc_details.id')
    //                 ->join('factory_gates', 'factory_gate_logs.gate_id', '=', 'factory_gates.id')
    //                 ->select(
    //                     DB::raw("CONCAT(rc_details.state_code, rc_details.district_code, rc_details.serial_code, rc_details.unique_code) as vehicle_number"),
    //                     'factory_gates.gate_nu as gate_number',
    //                     DB::raw("DATE(factory_gate_logs.in_time) as entry_date"),
    //                     DB::raw("TIME(factory_gate_logs.in_time) as in_time"),
    //                     DB::raw("TIME(factory_gate_logs.out_time) as out_time")
    //                 )
    //                 ->get();
    //             // dd($factory_gate_logs);
    //             if ($factory_gate_logs->count()) {
    //                 return response()->json(['status' => 'success', 'message' => 'Factory Gate Logs Detail successfully', 'factory_gate_logs_details' => $factory_gate_logs]);
    //             } else {
    //                 return response()->json(['status' => 'failed', 'message' => 'Factory Gate Logs not found']);
    //             }
    //         }
    //         $factory_gate_logs = DB::table('factory_gate_logs')
    //             ->join('rc_details', 'factory_gate_logs.vehicle_id', '=', 'rc_details.id')
    //             ->join('factory_gates', 'factory_gate_logs.gate_id', '=', 'factory_gates.id')
    //             ->select(
    //                 DB::raw("CONCAT(rc_details.state_code, rc_details.district_code, rc_details.serial_code, rc_details.unique_code) as vehicle_number"),
    //                 'factory_gates.gate_nu as gate_number',
    //                 DB::raw("DATE(factory_gate_logs.in_time) as entry_date"),
    //                 DB::raw("TIME(factory_gate_logs.in_time) as in_time"),
    //                 DB::raw("TIME(factory_gate_logs.out_time) as out_time")
    //             )
    //             ->get();

    //         if ($factory_gate_logs) {
    //             return response()->json(['status' => 'success', 'message' => 'Factory Gate Logs listing successfully', 'factory_gate_logs_details' => $factory_gate_logs]);
    //         } else {
    //             return response()->json(['status' => 'failed', 'message' => 'Factory Gate Logs not found']);
    //         }
    //     } else {
    //         return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
    //     }



    // }



    public function factoryGateLogs(Request $request)
    {
        // dd($request->all());
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            // dd($user);
            $query = DB::table('factory_gate_logs')
                ->join('rc_details', 'factory_gate_logs.vehicle_id', '=', 'rc_details.id')
                ->join('factory_gates', 'factory_gate_logs.gate_id', '=', 'factory_gates.id')
                ->where('factory_gate_logs.user_id', $user)
                ->select(
                    // DB::raw("CONCAT(rc_details.state_code, rc_details.district_code, rc_details.serial_code, rc_details.unique_code) as vehicle_number"),
                    'rc_details.rc_number as vehicle_number',
                    'factory_gates.gate_nu as gate_number',
                    DB::raw("DATE(factory_gate_logs.in_time) as entry_date"),
                    DB::raw("TIME(factory_gate_logs.in_time) as in_time"),
                    DB::raw("TIME(factory_gate_logs.out_time) as out_time")
                );

            // Filter by vehicle number if provided
            if ($request->vehicle_no) {
                $rcNumber = $request->vehicle_no;
                // $data = str_split($request->vehicle_no);
                // $state_code = $data[0] . $data[1];
                // $district_code = $data[2] . $data[3];
                // $serial_no = $data[4] . $data[5];
                // $unique_number = $data[6] . $data[7] . $data[8] . $data[9];

                // $query->where('rc_details.state_code', $state_code)
                //     ->where('rc_details.district_code', $district_code)
                //     ->where('rc_details.serial_code', $serial_no)
                //     ->where('rc_details.unique_code', $unique_number);
                   $query->where('rc_details.rc_number',$rcNumber);
            }

            // Filter by a single date if provided
            if ($request->entry_date) {
                $query->whereDate(DB::raw('DATE(factory_gate_logs.in_time)'), '=', $request->entry_date);
            }

            $factory_gate_logs = $query->get();
            // dd($factory_gate_logs);

            if ($factory_gate_logs->count()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Factory Gate Logs listing successfully',
                    'factory_gate_logs_details' => $factory_gate_logs
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Factory Gate Logs not found'
                ]);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
        }
    }


    public function scanned_logs_today_data(Request $request)
    {

        $user = $this->validate_user($request->connection_id, $request->auth_code);
        // dd($user);
        if ($user) {
            //Vehicle Scanned Today
            $scanned_today = FactoryGateLog::where('user_id', '=', $user)->whereDate('created_at', '=', Carbon::today())->get()->count();

            // dd($scanned_today);
            if ($scanned_today > 0) {
                return response()->json(['status' => 'success', 'Total Number of Vehicle Scanned Today' => $scanned_today, 'Total Number of Driver Scanned Today' => $scanned_today]);
            } else {
                return response()->json(['status' => 'Failed', 'message' => 'Not any Vehicle Scanned Today']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
        }


    }

    public function scanned_logs_monthly_data(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) {
            $scanned_logs_monthly = FactoryGateLog::where('user_id', '=', $user)->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)->count();
            // dd($scanned_logs_monthly);
            if ($scanned_logs_monthly > 0) {
                return response()->json(['status' => 'success', 'Monthly Scanned Vehicle' => $scanned_logs_monthly, 'Monthly Scanned Driver' => $scanned_logs_monthly]);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Neither a driver nor vehicle scanned in this month']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found']);
        }
    }


    public function factoryGateLogsDetail(Request $request)
    {
        // Validate the user
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 401);
        }

        // Build the query
        $query = FactoryGateLog::join('factories', 'factories.id', '=', 'factory_gate_logs.factory_id')
            ->join('driving_license_details as driver_details', 'driver_details.id', '=', 'factory_gate_logs.driver_id')
            ->leftJoin('driving_license_details as exit_driver_details', 'exit_driver_details.id', '=', 'factory_gate_logs.exit_driver_id')
            ->join('rc_details', 'rc_details.id', '=', 'factory_gate_logs.vehicle_id')
            ->join('owner_details', 'rc_details.id', '=', 'owner_details.rc_details_id')
            ->join('kyc_rc_vehicle_details', 'rc_details.id', '=', 'kyc_rc_vehicle_details.rc_details_id')
            ->join('factory_gates as entry_gate', 'entry_gate.id', '=', 'factory_gate_logs.gate_id')
            ->leftJoin('factory_gates as exit_gate', 'exit_gate.id', '=', 'factory_gate_logs.exit_gate')
            ->join('users as entry_user', 'entry_user.id', '=', 'factory_gate_logs.user_id')
            ->leftJoin('users as exit_user', 'exit_user.id', '=', 'factory_gate_logs.exit_user_id')
            ->select(
                'factory_gate_logs.*',
                'entry_gate.gate_nu as entry_gate_number',
                'exit_gate.gate_nu as exit_gate_number',
                'factories.name as factory_name',
                'owner_details.owner_name as owner_name',
                'kyc_rc_vehicle_details.category_description as category_description',
                'kyc_rc_vehicle_details.chassis_number as chassis_number',
                'kyc_rc_vehicle_details.engine_number as engine_number',
                'kyc_rc_vehicle_details.maker_description as maker_description',
                'kyc_rc_vehicle_details.maker_model as maker_model',
                'kyc_rc_vehicle_details.body_type as body_type',
                'kyc_rc_vehicle_details.fuel_type as fuel_type',
                'kyc_rc_vehicle_details.color as color',
                DB::raw("DATE(factory_gate_logs.created_at) as entry_date"),
                DB::raw("TIME(factory_gate_logs.in_time) as in_time"),
                DB::raw("TIME(factory_gate_logs.out_time) as out_time"),
                // DB::raw("CONCAT(rc_details.state_code, rc_details.district_code, rc_details.serial_code, rc_details.unique_code) as rc_number"),
                'rc_details.rc_number',
                // Aliasing driver details
                'driver_details.license_number as entry_license_number',
                'driver_details.license_holder as entry_license_holder',
                'driver_details.image as entry_driver_image',
                'driver_details.date_of_birth as entry_date_of_birth',
                'driver_details.state as entry_driver_state',
                'driver_details.issue_date as entry_issue_date',

                'driver_details.rto_name as entry_rto_name',
                'driver_details.status as entry_status',
                'driver_details.transport_from as entry_transport_from',
                'driver_details.hill_valid_till as entry_hill_valid_till',
                'driver_details.transport_to as entry_transport_to',
                'driver_details.last_endorsed_date as entry_last_endorsed_date',
                'driver_details.non_transport_from as entry_non_transport_from',
                'driver_details.non_transport_to as entry_non_transport_to',
                'driver_details.source as entry_source',
                'driver_details.old_new_di_number as entry_old_new_di_number',
                'driver_details.pincode as entry_pincode',
                'driver_details.last_transaction as entry_last_transaction',

                'driver_details.hazardous_valid_till as entry_hazardous_valid_till',
                'driver_details.initial_issuing_office as entry_initial_issuing_office',
                'driver_details.address as entry_driver_address',
                'driver_details.blood_group as entry_blood_group',
                'driver_details.dependent_name as entry_dependent_name',

                // Aliasing exit driver details
                'exit_driver_details.license_number as exit_license_number',
                'exit_driver_details.license_holder as exit_license_holder',
                'exit_driver_details.image as exit_driver_image',
                'exit_driver_details.date_of_birth as exit_date_of_birth',
                'exit_driver_details.state as exit_driver_state',
                'exit_driver_details.issue_date as exit_issue_date',

                'exit_driver_details.rto_name as exit_rto_name',
                'exit_driver_details.status as exit_status',
                'exit_driver_details.transport_from as exit_transport_from',
                'exit_driver_details.hill_valid_till as exit_hill_valid_till',
                'exit_driver_details.transport_to as exit_transport_to',
                'exit_driver_details.last_endorsed_date as exit_last_endorsed_date',
                'exit_driver_details.non_transport_from as exit_non_transport_from',
                'exit_driver_details.non_transport_to as exit_non_transport_to',
                'exit_driver_details.source as exit_source',
                'exit_driver_details.old_new_di_number as exit_old_new_di_number',
                'exit_driver_details.pincode as exit_pincode',
                'exit_driver_details.last_transaction as exit_last_transaction',

                'exit_driver_details.hazardous_valid_till as exit_hazardous_valid_till',
                'exit_driver_details.initial_issuing_office as exit_initial_issuing_office',
                'exit_driver_details.address as exit_driver_address',
                'exit_driver_details.blood_group as exit_blood_group',
                'exit_driver_details.dependent_name as exit_dependent_name',

                // User info
                'entry_user.name as entry_user_name',
                'exit_user.name as exit_user_name',
                'rc_details.*'
            );

        // Filter by RC number if provided
        if ($request->rc_number) {
            $rc_number = $request->rc_number;
            // $data = str_split($request->rc_number);
            // $state_code = $data[0] . $data[1];
            // $district_code = $data[2] . $data[3];
            // $serial_no = $data[4] . $data[5];
            // $unique_number = $data[6] . $data[7] . $data[8] . $data[9];

            $query->where('factory_gate_logs.in_time', $request->in_time)
                // ->where('rc_details.state_code', $state_code)
                // ->where('rc_details.district_code', $district_code)
                // ->where('rc_details.serial_code', $serial_no)
                // ->where('rc_details.unique_code', $unique_number);
                ->where('rc_details.rc_number',$rc_number);
        }

        // Fetch the first record
        $factory_gate_logs_detail = $query->first();
        // dd($factory_gate_logs_detail);

        // Check if entry is found
        if (!$factory_gate_logs_detail) {
            return response()->json(['status' => 'failed', 'message' => 'No entry found'], 404);
        }

        // Build vehicle entry info
        $vehicleEntryInfo = [
            'vehicle_id' => $factory_gate_logs_detail->vehicle_id,
            'entry_date' => $factory_gate_logs_detail->entry_date,
            'rc_number' => $factory_gate_logs_detail->rc_number,
            'vehicle_image' => $factory_gate_logs_detail->vehicle_image,
            'owner_name' => $factory_gate_logs_detail->owner_name,
            'category_description' => $factory_gate_logs_detail->category_description,
            'chassis_number' => $factory_gate_logs_detail->chassis_number,
            'engine_number' => $factory_gate_logs_detail->engine_number,
            'maker_description' => $factory_gate_logs_detail->maker_description,
            'maker_model' => $factory_gate_logs_detail->maker_model,
            'body_type' => $factory_gate_logs_detail->body_type,
            'fuel_type' => $factory_gate_logs_detail->fuel_type,
            'color' => $factory_gate_logs_detail->color,
            'rc_issue_date' => $factory_gate_logs_detail->rc_issue_date,
            'rc_category' => $factory_gate_logs_detail->rc_category
        ];

        // Build driver entry info
        $driverEntryInfo = [
            'id' => $factory_gate_logs_detail->driver_id,
            'entry_gate_nu' => $factory_gate_logs_detail->entry_gate_number,
            'entry_user_name' => $factory_gate_logs_detail->entry_user_name,
            'license_number' => $factory_gate_logs_detail->entry_license_number,
            'license_holder' => $factory_gate_logs_detail->entry_license_holder,
            'image' => $factory_gate_logs_detail->entry_driver_image,
            'date_of_birth' => $factory_gate_logs_detail->entry_date_of_birth,
            'state' => $factory_gate_logs_detail->entry_driver_state,
            'issue_date' => $factory_gate_logs_detail->entry_issue_date,
            'rto_name' => $factory_gate_logs_detail->entry_rto_name,
            'status' => $factory_gate_logs_detail->entry_status,
            'transport_from' => $factory_gate_logs_detail->entry_transport_from,
            'hill_valid_till' => $factory_gate_logs_detail->entry_hill_valid_till,
            'transport_to' => $factory_gate_logs_detail->entry_transport_to,
            'last_endorsed_date' => $factory_gate_logs_detail->entry_last_endorsed_date,
            'non_transport_from' => $factory_gate_logs_detail->entry_non_transport_from,
            'non_transport_to' => $factory_gate_logs_detail->entry_non_transport_to,
            'source' => $factory_gate_logs_detail->entry_source,
            'old_new_di_number' => $factory_gate_logs_detail->entry_old_new_di_number,
            'pincode' => $factory_gate_logs_detail->entry_pincode,
            'last_transaction' => $factory_gate_logs_detail->entry_last_transaction,
            'hazardous_valid_till' => $factory_gate_logs_detail->entry_hazardous_valid_till,
            'initial_issuing_office' => $factory_gate_logs_detail->entry_initial_issuing_office,
            'address' => $factory_gate_logs_detail->entry_driver_address,
            'blood_group' => $factory_gate_logs_detail->entry_blood_group,
            'dependent_name' => $factory_gate_logs_detail->entry_dependent_name
        ];

        // Build driver exit info if available
        $driverExitInfo = !empty($factory_gate_logs_detail->exit_driver_id) ? [
            'id' => $factory_gate_logs_detail->exit_driver_id,
            'exit_gate_nu' => $factory_gate_logs_detail->exit_gate_number,
            'exit_user_name' => $factory_gate_logs_detail->exit_user_name,
            'license_number' => $factory_gate_logs_detail->exit_license_number,
            'license_holder' => $factory_gate_logs_detail->exit_license_holder,
            'image' => $factory_gate_logs_detail->exit_driver_image,
            'date_of_birth' => $factory_gate_logs_detail->exit_date_of_birth,
            'state' => $factory_gate_logs_detail->exit_driver_state,
            'issue_date' => $factory_gate_logs_detail->exit_issue_date,

            'rto_name' => $factory_gate_logs_detail->exit_rto_name,
            'status' => $factory_gate_logs_detail->exit_status,
            'transport_from' => $factory_gate_logs_detail->exit_transport_from,
            'hill_valid_till' => $factory_gate_logs_detail->exit_hill_valid_till,
            'transport_to' => $factory_gate_logs_detail->exit_transport_to,
            'last_endorsed_date' => $factory_gate_logs_detail->exit_last_endorsed_date,
            'non_transport_from' => $factory_gate_logs_detail->exit_non_transport_from,
            'non_transport_to' => $factory_gate_logs_detail->exit_non_transport_to,
            'source' => $factory_gate_logs_detail->exit_source,
            'old_new_di_number' => $factory_gate_logs_detail->exit_old_new_di_number,
            'pincode' => $factory_gate_logs_detail->exit_pincode,
            'last_transaction' => $factory_gate_logs_detail->exit_last_transaction,

            'hazardous_valid_till' => $factory_gate_logs_detail->exit_hazardous_valid_till,
            'initial_issuing_office' => $factory_gate_logs_detail->exit_initial_issuing_office,
            'address' => $factory_gate_logs_detail->exit_driver_address,
            'blood_group' => $factory_gate_logs_detail->exit_blood_group,
            'dependent_name' => $factory_gate_logs_detail->exit_dependent_name
        ] : null;
        // dd($driverEntryInfo,$driverExitInfo);

        // if($driverExitInfo['id']  == $driverEntryInfo['id'])
        if(isset($driverExitInfo['id']) && $driverExitInfo['id'] == $driverEntryInfo['id'])
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle entry details',
                'entry_date' => $factory_gate_logs_detail->entry_date,
                'in_time' => $factory_gate_logs_detail->in_time,
                'out_time' => $factory_gate_logs_detail->out_time,
                'vehicle_data' => $vehicleEntryInfo,
                'driver_entry_data' => $driverEntryInfo
                // 'driver_exit_data' => $driverExitInfo
            ], 200);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle entry details',
                'entry_date' => $factory_gate_logs_detail->entry_date,
                'in_time' => $factory_gate_logs_detail->in_time,
                'out_time' => $factory_gate_logs_detail->out_time,
                'vehicle_data' => $vehicleEntryInfo,
                'driver_entry_data' => $driverEntryInfo,
                'driver_exit_data' => $driverExitInfo
            ], 200);
        }
        // Return the response

    }



}
