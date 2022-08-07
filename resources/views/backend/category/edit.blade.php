@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="{{ route('category.index') }}" class="btn btn-sm btn-raised bg-grey waves-effect"><i
                    class='bx bx-left-arrow-alt'></i> Back</a>
                <h2>Edit category</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit category</li>
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
                            <form action="{{ route('category.update', $category->id) }}" id="form_advanced_validation"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="title" maxlength="30" minlength="3"
                                            value="{{ $category->title }}" required>
                                        <label class="form-label">Title<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $category->summary != '' ? 'focused' : '' }}">
                                        <textarea type="text" class="form-control" name="summary" maxlength="500"
                                            minlength="3">{{ $category->summary }}</textarea>
                                        <label class="form-label">Summary</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 500 characters</div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-btn pl-0">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-raised bg-amber waves-effect">
                                            <i class="fa-solid fa-image"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo"
                                        value="{{ $category->photo }}" autocomplete="off">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-btn pl-0">
                                        <a id="lfm-bg" data-input="thumbnail-bg" data-preview="holder-bg"
                                            class="btn btn-raised bg-amber waves-effect">
                                            <i class="fa-solid fa-image"></i> Choose character
                                        </a>
                                    </span>
                                    <input value="{{ $category->character_bg}}" id="thumbnail-bg" class="form-control" type="text" name="character_bg" autocomplete="off">
                                </div>

                                <div class="d-flex">
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    <div id="holder-bg" style="margin-top:15px;max-height:100px;"></div>
                                </div>


                                <div class="form-group">
                                    <input id="is_parent" type="checkbox" name="is_parent"
                                        value="{{ $category->is_parent }}"
                                        {{ $category->is_parent == 1 ? 'checked' : '' }} class="with-gap ">
                                    <label for="is_parent">Is parent </label>
                                </div>
                                <div id="parent_cat_div" class="{{ $category->is_parent == 1 ? 'd-none' : '' }}">
                                    <label for="parent_id">Parent category</label>
                                    <select name="parent_id" class="js-animations form-control show-tick">
                                        <option value="">-- Select parent category --</option>
                                        @foreach ($parent_cats as $pcats)
                                            <option value="{{ $pcats->id }}"
                                                {{ $pcats->id == $category->parent_id ? 'selected' : '' }}>
                                                {{ $pcats->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-raised btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm-bg').filemanager('image');
    </script>
    <script>
        $('#is_parent').change(function(e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            if (is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
                $("#is_parent").val(is_checked == true ? '1': '0');
            } else {
                $('#parent_cat_div').removeClass('d-none');
                $("#is_parent").val(is_checked == true ? '1': '0');
            }
            
            
        })
    </script>
@endsection
