<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Module;
use App\Models\Role;
use session;
use Illuminate\Support\Facades\Log;

use DB;

class PermissionController extends Controller
{
    public function module_permission_store(Request $request)
    {
        // dd($request->all());

        $permissionData = new Permission();
        $permissionData->name = $request->input('permission_name');
        $permissionData->description = $request->input('permission_description');
        $permissionData->module_name = $request->input('permission_module_name');
        $permissionData->module_id = $request->input('id');
        $permissionData->save();
        Session()->flash('status','Permission Added Successfully:');
        return redirect()->route('admin.module.index');

    }

    public function module_permission_view(Request $request)
    {
        // dd($request->all());
        $id=$request->id;
        $permissionData=Permission::where('module_id',$id)->get();
        $moduleData=Module::where('id',$id)->first();
        // dd($permissionData);

    
        return view('backend.modules.module_permission',compact('permissionData','moduleData'));

    
    }

    public function module_permission_switch(Request $request)
    {
        $permission = Permission::find($request->id);
        
        if ($permission) {
            $permission->status = $request->value;
            $permission->save();

            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false], 404);
    }


    public function module_permission_role(Request $request)
    {
        // dd($request->all());
        $role_id=$request->id;
        $roleData=Role::where('id',$role_id)->first();
        $moduleData = DB::table('modules')
        ->leftJoin('permissions', 'modules.id', '=', 'permissions.module_id')->where('status','1')
        ->select(
            'modules.id as module_id', 
            'modules.module_name', 
            'modules.description', 
            DB::raw('GROUP_CONCAT(permissions.id, ":", permissions.name, ":", permissions.status) as permissions')
        )
        ->groupBy('modules.id')
        ->get()
        ->map(function ($module) {
            // Transform concatenated permissions into an array of objects
            $module->permissions = $module->permissions ? collect(explode(',', $module->permissions))->map(function ($permission) {
                list($id, $name, $status) = explode(':', $permission);
                return (object)[
                    'id' => $id,
                    'name' => $name,
                    'status' => $status
                ];
            }) : collect();
            return $module;
        });
        

        $permissionData=DB::table('permission_role')->where('role_id',$role_id)->get();
        // dd($permissionData);



        return view('backend.role.permission_role', compact('moduleData','role_id', 'permissionData','roleData'));

    }

    

        public function module_permission_role_update(Request $request)
        {
            $role_id = $request->input('role_id');
            $permissions = $request->input('permissions', []);
            
            // Process each permission
            foreach ($permissions as $permission_id => $value) {
                // Check if the role_id and permission_id combination exists
                // dd($permission_id);
                $existingPermission = DB::table('permission_role')
                    ->where('role_id', $role_id)
                    ->where('permission_id', $permission_id)
                    ->first();

                // dd($existingPermission);
                // dd('dd');    

                if ($existingPermission) {
                    if($value == "false"){
                        DB::table('permission_role')
                        ->where('role_id', $role_id)
                        ->where('permission_id', $permission_id)
                        ->delete();

                    }
                } else {
                    
                    if($value == "true"){
                        DB::table('permission_role')->insert([
                            'role_id' => $role_id,
                            'permission_id' => $permission_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                    Log::info($role_id);
                    Log::info($permission_id);
                    Log::info($value);
                    }
                  
                }
            }

            return response()->json(['message' => 'Permissions updated successfully.']);
        }



}
