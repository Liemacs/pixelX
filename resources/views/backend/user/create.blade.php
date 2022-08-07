@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-raised bg-grey waves-effect"><i
                    class='bx bx-left-arrow-alt'></i> Back</a>
                
                <h2>Add user</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add user</li>
                </ul>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('user.store') }}" id="form_advanced_validation" method="POST" 
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="form-group form-float" >
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="full_name" maxlength="30" minlength="3"
                                            value="{{ old('full_name') }}" required autocomplete="off">
                                        <label class="form-label">Full name</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username" maxlength="30" minlength="3"
                                            value="{{ old('username') }}" autocomplete="off">
                                        <label class="form-label">Username</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" maxlength="30" minlength="3"
                                            value="{{ old('email') }}" autocomplete="new-password">
                                        <label class="form-label">Email</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" maxlength="30" minlength="3"
                                            value="{{ old('password') }}" autocomplete="new-password">
                                        <label class="form-label">Password</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="phone" maxlength="30" minlength="3"
                                            value="{{ old('phone') }}" >
                                        <label class="form-label">Phone</label>
                                    </div>
                                </div>
                                <div>
                                    <label for="role">Role</label>
                                    <select name="role" class="js-animations form-control show-tick">
                                        <option value="">-- Select role --</option>                                
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                            <option value="vendor" {{ old('role') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-btn pl-0">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-raised bg-amber waves-effect">
                                            <i class="fa-solid fa-image"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo" autocomplete="off">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                <div class="form-group">
                                    <input type="checkbox" name="status" value="active" id="active" class="with-gap">
                                    <label for="active">Active</label>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
