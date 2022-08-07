@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="complete isEmpty">
        <picture>
            <img src="{{ asset('images/complete.png') }}" alt="gift">
        </picture>
        <h1>Complete</h1>
        <h3>Your Order id #{{ $order }}</h3>
        <a href="{{ route('home') }}" class="btn  pixel-corners-sm">Go at home</a>
    </div>
</div>
@endsection

