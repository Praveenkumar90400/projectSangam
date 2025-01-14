<?php

namespace App\Http\Controllers\Admin\Factory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FactoryGate;
use App\Models\Factory;

class FactoryGatesController extends Controller
{
    public function factory_gates_index($id)
    {
        // dd($id);
        $factoryGate=FactoryGate::where('factory_id',$id)->get();
        // dd($factoryGate);
        // $factoryId=$id;
        $factory=Factory::where('id',$id)->first();
        // dd($factory);
        return view('backend.factory_gate.index',compact('factoryGate','factory'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'gate_no' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'factory_id' => 'required',
            'factory_name' => 'required',
        ]);

        $factoryGate = new FactoryGate();
        $factoryGate->gate_nu = $request->input('gate_no');
        $factoryGate->latitude = $request->input('latitude');
        $factoryGate->longitude = $request->input('longitude');
        $factoryGate->factory_id = $request->input('factory_id');
        $factoryGate->factory_name = $request->input('factory_name');
        $factoryGate->save();

        // Redirect with a success message
        Session()->flash('status','Factory Gate Added Successfully:');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $id=$request->id;
        $request->validate([
            'gate_nu' => 'required|string|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $factoryGate = FactoryGate::findOrFail($id);
        // dd($factoryGate);
        $factoryGate->gate_nu = $request->input('gate_nu');
        $factoryGate->latitude = $request->input('latitude');
        $factoryGate->longitude = $request->input('longitude');

        $factoryGate->save();

        // Redirect with a success message
        Session()->flash('status','Factory Gate Updated Successfully:');
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $factoryGate = FactoryGate::findOrFail($id);
        // dd($factoryGate);
        $factoryGate->delete();
        Session()->flash('status','Factory Gate Deleted Successfully:');
        return redirect()->back();
    }
}
