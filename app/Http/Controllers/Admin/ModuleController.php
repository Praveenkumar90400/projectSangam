<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Role;
use App\Models\Permission;
use Session;


class ModuleController extends Controller
{
    public function module_index()
    {
       
        $module=Module::get();
        return view('backend.modules.index',compact('module'));

    }

    public function store_module(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'module_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $moduleData = new Module();
        $moduleData->module_name = $request->input('module_name');
        $moduleData->description = $request->input('description');
        $moduleData->save();

        Session()->flash('status','Module Added Successfully:');
        return redirect()->route('admin.module.index');
    }

    public function update_module(Request $request)
    {
        $id=$request->id;
        $request->validate([
            'module_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $moduleData = Module::findOrFail($id);
        // dd($moduleData);
        $moduleData->module_name = $request->input('module_name');
        $moduleData->description = $request->input('description');
        $moduleData->save();

        Session()->flash('status','Module Updated Successfully:');
        return redirect()->route('admin.module.index');
    }

    public function delete_module($id)
    {
        $moduleData = Module::findOrFail($id);
        // dd($moduleData);
        $moduleData->delete();
        Session()->flash('status','Module Deleted Successfully:');
        return redirect()->route('admin.module.index');
    }


    
}
