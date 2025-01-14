@extends('backend.layouts.master')
@section('title')
Recharge 
@endsection

@section('content')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-header p-1 px-3"style="background-color:#ccc;">
            <h5 class="mb-0">Recharge</h5>
          </div>
          <div class="card-body">
            <form action="{{route('create.order',isset($id) ? $id : null)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input class="form-control" type="number" name="amount" id="amount">

                </div>
            <div><button type="submit" class="btn btn-sm btn-success w-100">Pay Now</button></div>
            </form>
          </div>

        </div>
    </div>
</div>
@isset($order_id)
    <script>
        const options = {
            key: '{{ env("RAZORPAY_KEY") }}', // Razorpay API Key
            amount: {{$amount}}, // Amount in paisa (make sure it's correctly passed)
            currency: 'INR',
            name: 'Your Company Name',
            description: 'Wallet Recharge',
            order_id: '{{ $order_id }}', // Razorpay order ID passed from backend
            handler: function (response) {
                // Send payment verification details to the backend
                verifyPayment(response);
            },
            prefill: {
                name: '{{ auth()->user()->name }}',
                email: '{{ auth()->user()->email }}',
                contact: '{{ auth()->user()->phone }}',
            },
            theme: {
                color: '#3399cc',
            },
        };

        const rzp = new Razorpay(options);
        rzp.open();


        function verifyPayment(response) {
        // Send the payment data (payment ID, order ID, and signature) to the backend
        fetch('/razorpay/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                payment_id: response.razorpay_payment_id,
                order_id: response.razorpay_order_id,
                signature: response.razorpay_signature,
            })
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
               
                window.location.href = '/dashboard';
               
            }
        })
        .catch((error) => {
            console.error('Error verifying payment:', error);
            alert('Error verifying payment!');
        });
    }

    </script>
@endisset


@endsection
