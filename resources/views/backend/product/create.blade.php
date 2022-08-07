@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="{{ route('category.index') }}" class="btn btn-sm btn-raised bg-grey waves-effect"><i
                    class='bx bx-left-arrow-alt'></i> Back</a>
                <h2>Add product</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add product</li>
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
                            <form action="{{ route('product.store') }}" id="form_advanced_validation" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="title" maxlength="30"
                                            minlength="3" value="{{ old('title') }}" required>
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea id="summary" type="text" class="form-control" name="summary" maxlength="500" minlength="3">{{ old('summary') }}</textarea>
                                        <label for="summary" class="form-label">Summary</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 500 characters</div>
                                </div>
                                {{-- Editor --}}
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea id="ckeditor" name="description" type="text" class="description">
                                            {{ old('description') }}
                                        </textarea>
                                    </div>
                                </div>
                                {{-- Editor --}}

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="stock" min="0"
                                            max="10000" value="{{ old('stock') }}" required>
                                        <label for="stock" class="form-label">Stock <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="price" min="0"
                                            max="1000" value="{{ old('price') }}" required>
                                        <label for="price" class="form-label">Price <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="discount" min="0"
                                            max="1000" value="{{ old('discount') }}" required>
                                        <label for="discount" class="form-label">Discount</label>
                                    </div>
                                </div>

                                <div>
                                    <label for="brand_id">Publisher</label>
                                    <select name="brand_id" class="js-animations form-control show-tick">
                                        <option value="">-- Select publisher --</option>
                                        @foreach (\App\Models\Brand::get() as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="category">Category</label>
                                    <select id="cat_id" name="cat_id" class="js-animations form-control show-tick">
                                        <option value="">-- Select category --</option>
                                        @foreach (\App\Models\Category::where('is_parent', 1)->get() as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-none" id="child_cat_div">
                                    <label for="chil_cat_id">Child category</label>
                                    <select id="chil_cat_id" name="child_cat_id"
                                        class="js-animations form-control show-tick">
                                    </select>
                                </div>
                                <div>
                                    <label for="vendor_id">Vendors</label>
                                    <select name="vendor_id" class="js-animations form-control show-tick">
                                        <option value="">-- Select vendors --</option>
                                        @foreach (\App\Models\User::where('role', 'vendor')->get() as $vendor)
                                            <option value="{{ $vendor->id }}"
                                                {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                                {{ $vendor->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- teh carateristics --}}
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="system" maxlength="30"
                                            minlength="3" value="{{ old('system') }}" required autocomplete="off">
                                        <label for="system" class="form-label">System <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="CPU" maxlength="30"
                                            minlength="3" value="{{ old('CPU') }}" required autocomplete="off">
                                        <label for="CPU" class="form-label">CPU <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="memory" min="0"
                                            max="1000" value="{{ old('memory') }}" required autocomplete="off">
                                        <label for="memory" class="form-label">Memory</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="graph" maxlength="30"
                                            minlength="3" value="{{ old('graph') }}" required autocomplete="off">
                                        <label for="graph" class="form-label">Graph <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="size" min="0"
                                            max="1000" value="{{ old('size') }}" required autocomplete="off">
                                        <label for="size" class="form-label">Size</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="release" type="date" class="datepicker form-control">
                                    </div>
                                </div>

                                {{-- teh carateristics --}}

                                {{-- choose img --}}
                                <div class="input-group">
                                    <span class="input-group-btn pl-0">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-raised bg-amber waves-effect">
                                            <i class="fa-solid fa-image"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo"
                                        autocomplete="off">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-btn pl-0">
                                        <a id="lfm-bg" data-input="thumbnail-bg" data-preview="holder-bg"
                                            class="btn btn-raised bg-amber waves-effect">
                                            <i class="fa-solid fa-image"></i> Choose background
                                        </a>
                                    </span>
                                    <input id="thumbnail-bg" class="form-control" type="text" name="photo_bg"
                                        autocomplete="off">
                                </div>
                                {{-- choose img --}}
                                <div class="d-flex">
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    <div id="holder-bg" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="status" value="active" id="active"
                                        class="with-gap">
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
    {{-- Editor CKEDITOR --}}
    <script type="text/javascript" src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/pages/forms/editors.js') }}"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm-bg').filemanager('image');
    </script>
    <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();

            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        var html_option = "<option value=''> -- Select child category --</option>";
                        if (response.status) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title +
                                    "</option>";
                            });
                        } else {
                            $('#child_cat_div').addClass('d-none')
                        }
                        $('#chil_cat_id').html(html_option);
                    }
                });
            }
        });
    </script>
@endsection
