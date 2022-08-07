@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        @include('frontend.layouts._step-payment')
        <form action="{{ route('checkout1.store') }}" method="post" autocomplete="off">
            @csrf
            <div class="contain_billing">
                <h4>Check credentials</h4>
                @php
                    $name = explode(' ', $user->full_name);
                @endphp
                <input type="hidden" name="sub_total" value="{{ Cart::instance('shopping')->subtotal(),2 }}">
                <input type="hidden" name="total_amount" value="{{ Cart::instance('shopping')->subtotal(),2 }}">
                <div>
                    <label for="first_name"></label>
                    <input type="text" name="first_name" id="first_name" value="{{ $name[0] }}" placeholder="First name" required>
                </div>
                <div>
                    <label for="last_name"></label>
                    <input type="text" name="last_name" id="last_name" value="{{ $name[1] }}" placeholder="Last name" required>
                </div>
                <div>
                    <label for="email"></label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="Email" readonly>
                </div>
                <div>
                    <label for="phone"></label>
                    <input type="text" required name="phone" id="phone" value="{{ $user->phone }}" placeholder="Phone" >
                </div>
            </div>
            <a href="{{ route('cart') }}" class="btn pixel-corners-sm">Go back</a>
            <button type="submit" class="btn buy pixel-corners-sm">Continue</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        
    </script>
@endsection
