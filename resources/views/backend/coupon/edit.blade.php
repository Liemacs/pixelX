@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit coupon</h2>
                <a href="{{ route('coupon.index') }}" class="btn btn-sm btn-raised bg-grey waves-effect"><i
                    class='bx bx-left-arrow-alt'></i> Back</a>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit coupon</li>
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
                            <form action="{{ route('coupon.update', $coupon->id) }}" id="form_advanced_validation" method="POST"
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('patch')
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="code" maxlength="30" minlength="3"
                                            value="{{ $coupon->code }}" required>
                                        <label class="form-label">Coupon code</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="value" min="0" max="90"
                                            value="{{ $coupon->value }}" required>
                                        <label class="form-label">Coupon Value</label>
                                    </div>
                                </div>
                                <div >
                                    <label for="type">Coupon Type</label>
                                    <select name="type" class="js-animations form-control show-tick">
                                        <option value="">-- Select coupon --</option>
                                            <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                            <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                </div>
                                
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                
                                <button class="btn btn-raised btn-primary waves-effect" type="submit">Update</button>
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
