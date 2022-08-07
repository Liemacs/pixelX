@extends('frontend.layouts.master')

@section('content')
    <div class="container">
            @include('frontend.layouts._step-payment')
        <form action="{{ route('checkout2.store') }}" method="post" autocomplete="off">
            @csrf
            <div class="payment">
                <div class="col1">
                    <div class="card  pixel-corners">
                        <div class="front">
                            <div class="type">
                                <img class="bankid" />
                            </div>
                            <span class="chip"></span>
                            <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF;
                                &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
                            <div class="date"><span class="date_value">MM / YYYY</span></div>
                            <span class="fullname">FULL NAME</span>
                        </div>
                    </div>
                </div>
                <div class="col2">
                    <label>Card Number</label>
                    <input class="number pixel-corners-sm" type="text" name="cart_number" ng-model="ncard" maxlength="19" placeholder="1234 1234 1234 1234"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' required />
                    <label>Cardholder name</label>
                    <input class="inputname pixel-corners-sm" name="cardholder_name" type="text" placeholder="{{ auth()->user()->full_name }}"
                        maxlength="25" required />
                    <label>Expiry date</label>
                    <input class="expire pixel-corners-sm" name="expire_date" type="text" placeholder="MM / YYYY"
                        required />
                    <label>Security Number</label>
                    <input class="ccv pixel-corners-sm" name="security_number" type="text" placeholder="CVC"
                        maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required />
                    <a href="{{ route('cart') }}" class="btn  pixel-corners-sm">Go back</a>
                    <button type="submit" class="btn buy pixel-corners-sm">Continue</button>
                </div>
            </div>


        </form>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
