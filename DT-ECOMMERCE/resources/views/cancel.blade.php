@extends('layouts.app')
@section('content')
<h1>Payment Successful</h1>
        <div class="mb-4 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" style="color: #FF2222" width="75" height="75"
                fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <div class="text-center">
            <h1 style="color:#FF2222;">Opps! Payment Declined</h1>
            {{-- <h6 class="text-dark">Your order is confirmed</h6> --}}
            {{-- Your Order Id: <strong>{{ request('orderId') }}</strong> --}}
            <div class="p-5">
                <a href="{{ url('/checkout') }}" class="my-btn">Try Again</a>
                
            </div>
        </div>
@endsection