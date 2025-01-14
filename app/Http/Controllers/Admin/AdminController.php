<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    //
    public function show(){
        $users = User::all();
      
        return view ('backend.admin.admin_list',compact('users'));
      }

      public function store(Request $request)
      {
        //  dd($request->all());
        //   $role_id=Auth::user()->role_id;
        
          $validated= $request->validate([
              'name' => 'required|max:255',  
              'email' => 'required|email|unique:users,email|max:255',  
            //   'role_id' => 'required', 
              'pincode' => 'required', 
              'password' => 'required|min:8',
          ]);
  
          if (!$validated) {
              return redirect()->back()->withErrors($validated)->withInput();
          }
  
        
          $user_id=Auth::user()->id;
          // dd($request->all());
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              $imageName = time() . '.' . $image->getClientOriginalExtension();
              $image->move(public_path('images/staff'), $imageName);
              $imagePath = '/images/staff/' . $imageName;
          } else {
              $imagePath = null;
          }
          // dd($imagePath);
          $staff = [
              'name' => $request->input('name'),
              'email' => $request->input('email'),
              'image' => $imagePath,
              'gender' => $request->input('gender'),
              'phone' => $request->input('phone'),
              'pincode' => $request->input('pincode'),
              
              'district' => $request->input('district'),
              'city' => $request->input('city'),
              'state' => $request->input('state'),
              'address' => $request->input('address'),
             
            //   'admin_id' => $user_id,
            
              'password' => bcrypt($request->input('password')),
              'created_at' => now(),
              'updated_at' => now(),
          ];
          $insertGetId = DB::table('users')->insertGetId($staff);
          $admindata = User::find($insertGetId); 
          $admindata->save();
  
        
  
          Session()->flash('status', 'User Added Successfully');
          return redirect()->back();
      }


      public function view($id)
      {
          $user = User::findOrFail($id);
          return redirect()->back();
      }

      public function edit(Request $request)
{
    // dd($request->all());
    $user = User::findOrFail($request->id);
    $user->name = $request->name ?? $user->name;
    $user->email = $request->email ?? $user->email;
    $user->gender = $request->gender ?? $user->gender;
    $user->phone = $request->phone ?? $user->phone;
    $user->pincode = $request->pincode ?? $user->pincode;
    $user->district = $request->district ?? $user->district;
    $user->state = $request->state ?? $user->state;
    $user->address = $request->address ?? $user->address;
    $user->role_id = $request->role_id ?? $user->role_id;
    $user->factory_id = $request->factory_id ?? $user->factory_id;
    $user->password = hash::make($request->password )?? $user->password;
    

    // dd($user);
    $user->save();
    

    
    return redirect()->back();
}

public function destroy($id)
{   
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with('status', 'User deleted successfully!');
}

}
