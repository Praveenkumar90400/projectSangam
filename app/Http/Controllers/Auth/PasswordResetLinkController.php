<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    //     // dd($request->all());
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //     ]);

    //     // We will send the password reset link to this user. Once we have attempted
    //     // to send the link, we will examine the response then see the message we
    //     // need to show to the user. Finally, we'll send out a proper response.
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status == Password::RESET_LINK_SENT
    //                 ? back()->with('status', __($status))
    //                 : back()->withInput($request->only('email'))
    //                         ->withErrors(['email' => __($status)]);


  
        // Redirect back with an error message
      $user=User::where('phone', $request->mobile)->first();
      if(!$user) return redirect()->back()->withErrors(['user not registered']);
      $user->otp=123456;
      $user->save();
      return view('email.otp-verify')->with('user', $user);
    
}

    public function otpverify(Request $request)
    {   
        $user=User::where('phone', $request->mobile)->where('otp',$request->otp)->first();
        if(!$user) return redirect()->back()->withErrors(['Invalid otp or otp expired']);
        $user->password=Hash::make($request->new_password);
        $user->save();
        return redirect()->route('login')->with('status','Password reset successfully');

    }



        

        public function passswordRest(Request $request)
        {
            // Validate the request
            $request->validate([
                'otp' => 'required',
                'new_password' => 'required|min:8|confirmed', // Use 'new_password_confirmation' for confirmation
            ]);
        
            // Find the user by OTP and check if it's still valid
            $user = User::where('otp', $request->otp)
                        ->where('otp_expires_at', '>', now()) // Ensure the OTP has not expired
                        ->first();
        
            if (!$user) {
                return redirect()->back()->withErrors(['status' => 'Invalid or expired OTP.']);
            }
        
            // Update the user's password and clear the OTP
            $user->update([
                'password' => Hash::make($request->new_password),
                'otp' => null, // Clear OTP after successful reset
                'otp_expires_at' => null, // Clear OTP expiry time
            ]);
        
            // Redirect with success message
            return redirect()->route('login')->with('status', 'Password reset successfully. You can now log in.');
        }
        
    
}
