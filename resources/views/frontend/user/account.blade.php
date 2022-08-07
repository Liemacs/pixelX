@extends('frontend.layouts.master')

@section('content')
    <div class="container account-position">
        @include('frontend.user.sidebar')
        <div class="account-info bg-account pixel-corners">
            <h1>Acount detail</h1>

            <form action="{{ route('update.account', $user->id) }}" method="POST" class="account-form">
                @csrf
                <div class="account-box-img">
                    <div id="holder" class="account-img pixel-corners-sm">
                        <img src="{{ $user->photo }}" alt="{{ $user->photo }}">
                    </div>
                </div>
                <div class="input-group">
                    <span>
                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                            class="btn pixel-corners-sm">
                            <i class="fa-solid fa-image"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" type="hidden" name="photo" autocomplete="off" value="{{ $user->photo }}">
                </div>
                
                <div class="update-info">
                    <div>
                        <label for="full_name">Full name:</label>
                        <input type="text" name="full_name" value="{{ $user->full_name }}" placeholder="Full name">
                        @error('full_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="{{ $user->username }}">
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ $user->email }}" disabled>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone">Phone number:</label>
                        <input type="text" name="phone" value="{{ $user->phone }}">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="oldPassword">Old password:</label>
                        <input type="password" name="oldPassword" placeholder="Old password">
                        @error('oldPassword')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="newPassword">New password:</label>
                        <input type="password" name="newPassword" placeholder="New password">
                        @error('newPassword')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn pixel-corners-sm">Save changes</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
