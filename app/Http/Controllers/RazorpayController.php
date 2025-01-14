<?php

namespace App\Http\Controllers;
use App\Models\WalletTransaction;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User; 
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    private $razorpayKey;
    private $razorpaySecret;

    public function __construct()
    {
        
        $this->razorpayKey = env('RAZORPAY_KEY');
        $this->razorpaySecret = env('RAZORPAY_SECRET');
    }

    public function createOrder(Request $request, $id = null)
    {
        if($id){
            // dd($id);
          
                $validated = $request->validate([
                    'amount' => 'required|numeric|min:1', 
                ]);
                  
              
                $api = new Api($this->razorpayKey, $this->razorpaySecret);
    
                $rs = $request->amount;
                $order = $api->order->create([
                    'receipt' => 'order_rcptid_11',
                    'amount' => $rs * 100, 
                    'currency' => 'INR',
                    
                ]);
                $adminid=$id;
                $order_id=$order['id'];
                $amount=$order['amount'];

                        
    
                $transaction = new WalletTransaction();
                $transaction->user_id = $id; 
                $transaction->amount =$rs;
                $transaction->reason ="Recharge by  super Admin";
                // $transaction->payment_id = null; 
                $transaction->order_id = $order['id'];
                $transaction->payment_status = 2; 
                // dd($transaction);
            
                $transaction->save();
               
                
    
                return view('backend.recharge.recharge_now',compact('amount','order_id', 'id'));
                
            
        }else{
    //  dd($id);
    
        try {
        
            $validated = $request->validate([
                'amount' => 'required|numeric|min:1', 
            ]);
              
        //   dd($validated);
            $api = new Api($this->razorpayKey, $this->razorpaySecret);
           
            $rs = $request->amount;
         
            $order = $api->order->create([
            
                'receipt' => 'order_rcptid_11',
                'amount' => $rs * 100, 
                'currency' => 'INR',
                
            ]);
           
            $adminid=auth()->user()->id;
            // dd($adminid);
            $order_id=$order['id'];
            $amount=$order['amount'];
           
      
            
            

            $transaction = new WalletTransaction();
            $transaction->user_id = auth()->id(); 
            $transaction->amount =$rs;
            $transaction->reason ='Recharge by Admin';
            
            $transaction->order_id = $order['id'];
            $transaction->payment_status = 2; 
            
            $transaction->save();
           
            

            return view('backend.recharge.recharge_now',compact('amount','order_id'));
            
            
        } catch (\Exception $e) {
            
            \Log::error("Error creating Razorpay order: " . $e->getMessage());

            
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    }

    public function verifyPayment(Request $request)
{
   
    $paymentId = $request->payment_id;
    $orderId = $request->order_id;
    $signature = $request->signature;

    
    $api = new Api($this->razorpayKey, $this->razorpaySecret);

    try {
       
        $attributes = [
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature
        ];

        $api->utility->verifyPaymentSignature($attributes);

        $transaction = WalletTransaction::where('order_id', $orderId)->first();

        if ($transaction) {
            
            $transaction->payment_status = 1;
            $transaction->payment_id = $paymentId;  
            
            
            $user = User::find($transaction->user_id);
            $user->increment('total_amount', $transaction->amount);  
            $transaction->balance = $user->total_amount;
            $user->save();
            $transaction->save();

            return response()->json(['success' => true, 'message' => 'Payment successful!']);
           
        } else {
            return response()->json(['error' => 'Transaction not found!'], 404);
        }

    } catch (\Exception $e) {



        $transaction = WalletTransaction::where('order_id', $orderId)->first();

        if ($transaction) {
            $transaction->payment_status = 0;  
            $transaction->save();

        }
        \Log::error("Error verifying Razorpay payment: " . $e->getMessage());
        return response()->json(['error' => 'Payment verification failed!'], 500);
    }
}

    public function showTransactionHistory()
    {
        $user = Auth::user();
        $userAmount = $user->total_amount; 
    
        
        $transactions = WalletTransaction::where('user_id', $user->id)->get();
    
       
        return view('backend.users.transaction_history', compact('transactions', 'userAmount'));



    }

           public function rechargeNow($id=null)
           {
            // dd($id);
            if($id)
            {
                return view('backend.recharge.recharge_now',compact('id'));   
            }else{
            return view('backend.recharge.recharge_now');
            }
           }

           public function myProfile(){ 
            //  dd(Auth::user());
            return view('backend.my_profile.profile_view');

        }

        

        public function updateProfile(Request $request)
        {
            // dd($request->all());
            $user = User::find(Auth::id()); 
        
            if (!$user) {
                abort(404, 'User not found.');
            }
        
        
            $data = $request->only(['name', 'email','phone']);
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }
            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $data['image'] = $avatar->store('images/staff', 'public');
            }
            // dd($data);
            $user->update($data);
        
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }
        
        


        








    
    
}
