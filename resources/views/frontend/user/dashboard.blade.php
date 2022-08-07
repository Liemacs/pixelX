@extends('frontend.layouts.master')

@section('content')
<div class="container account-position">
    @include('frontend.user.sidebar')
    <div class="account-info bg-account pixel-corners">
    <h1>User dashboard</h1>
    <p>Hello <strong>{{ auth()->user()->full_name }}!</strong></p>
    </div>
</div>
@endsection
