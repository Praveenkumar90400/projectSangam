<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
Use Session;

class RoleController extends Controller
{
    public function role_index()
    {
        $role=Role::get();
        // dd($role);
        return view('backend.role.index',compact('role'));
    }

    public function store_role(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $roleData = new Role();
        $roleData->role = $request->input('role');
        $roleData->save();

        Session()->flash('status','Role Added Successfully:');
        return redirect()->route('admin.role.index');
    }

    public function update_role(Request $request)
    {
        $id=$request->id;
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $roleData = Role::findOrFail($id);
        // dd($roleData);
        $roleData->role = $request->input('role');
        $roleData->save();

        Session()->flash('status','Role Updated Successfully:');
        return redirect()->route('admin.role.index');
    }

    Public function delete(Request $request, $id)
    {
        $roleData = Role::findOrFail($id);
        // dd($roleData);
        $roleData->delete();
        // Redirect with a success message
        Session()->flash('status','Role Deleted Successfully:');
        return redirect()->route('admin.role.index');
    }
    
}
