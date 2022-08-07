{{-- @extends('backend.layouts.master') --}}

@if ( session('success') )
    <div class=" alert-success container pixel-corners-sm" id="alert" role="alert">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class=" alert-danger container pixel-corners-sm" id="alert" role="alert">
        {{ session('error') }}
    </div>
@endif
