<?php

namespace App\Http\Controllers\Admin\Factory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factory;
use Session;
use DB;
use Auth;

class FactoryController extends Controller
{
    public function index()
    {
        $factory_id = Auth::user()->factory_id;
        $role_id = Auth::user()->role_id;
        // dd($factory_id);
        if (Auth::user()->role_id == 1)
        {
        $factory = Factory::get();
        }
        else {
            $factory = Factory::where('id',$factory_id)->get();
        }
        // dd($factory);
        return view('backend.factories.index', compact('factory'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'gates' => 'required',
            'phone' => 'required|string|max:20',
        ]);

        // Create a new factory instance and save the data
        $factory = new Factory();
        $factory->name = $request->input('name');
        $factory->latitude = $request->input('latitude');
        $factory->longitude = $request->input('longitude');
        $factory->address = $request->input('address');
        $factory->number_of_gates = $request->input('gates');
        $factory->phone = $request->input('phone');
        $factory->save();

        // Redirect with a success message
        Session()->flash('status', 'Factory Added Successfully:');
        return redirect()->route('admin.factory.index');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'gates' => 'required|integer',
            'phone' => 'required|string|max:20',
        ]);

        // Find the factory by ID and update the data
        $factory = Factory::findOrFail($id);
        // dd($factory);
        $factory->name = $request->input('name');
        $factory->latitude = $request->input('latitude');
        $factory->longitude = $request->input('longitude');
        $factory->address = $request->input('address');
        $factory->number_of_gates = $request->input('gates');
        $factory->phone = $request->input('phone');
        $factory->save();

        // Redirect with a success message
        Session()->flash('status', 'Factory Updated Successfully:');
        return redirect()->route('admin.factory.index');
    }


    public function delete($id)
    {
        // Find the factory by ID and delete the record
        $factory = Factory::findOrFail($id);
        $factory->delete();
        // Redirect with a success message
        Session()->flash('status', 'Factory Deleted Successfully:');
        return redirect()->route('admin.factory.index');
    }
}
