@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="{{ route('category.index') }}" class="btn btn-sm btn-raised bg-grey waves-effect"><i
                    class='bx bx-left-arrow-alt'></i> Back</a>
                <h2>Edit product</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit product</li>
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
                            <form action="{{ route('product.update', $product->id) }}" id="form_advanced_validation"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="title" maxlength="30"
                                            minlength="3" value="{{ $product->title }}" required>
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->summary != '' ? 'focused' : '' }}">
                                        <textarea id="summary" type="text" class="form-control" name="summary" maxlength="500" minlength="3">{{ $product->summary }}</textarea>
                                        <label for="summary" class="form-label">Summary</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 500 characters</div>
                                </div>
                                {{-- Editor --}}
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea id="ckeditor" name="description" type="text" class="description">
                                            {{ $product->description }}
                                        </textarea>
                                    </div>
                                </div>
                                {{-- Editor --}}

                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->stock >= 0 ? 'focused' : '' }}">
                                        <input type="number" class="form-control" name="stock" min="0"
                                            max="10000" value="{{ $product->stock }}" required>
                                        <label for="stock" class="form-label">Stock <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->price >= 0 ? 'focused' : '' }}">
                                        <input type="number" class="form-control" name="price" min="0"
                                            max="1000" value="{{ $product->price }}" required>
                                        <label for="price" class="form-label">Price <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->discount >= 0 ? 'focused' : '' }}">
                                        <input type="number" class="form-control" name="discount" min="0"
                                            max="1000" value="{{ $product->discount }}" required>
                                        <label for="discount" class="form-label">Discount</label>
                                    </div>
                                </div>

                                <div>
                                    <label for="brand_id">Publisher</label>
                                    <select name="brand_id" class="js-animations form-control show-tick">
                                        <option value="">-- Select publisher --</option>
                                        @foreach (\App\Models\Brand::get() as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
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
                                                {{ $category->id == $product->cat_id ? 'selected' : '' }}>
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
                                                {{ $vendor->id == $product->vendor_id ? 'selected' : '' }}>
                                                {{ $vendor->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- teh carateristics --}}
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->system != '' ? 'focused' : '' }}">
                                        <input type="text" class="form-control" name="system" maxlength="30"
                                            minlength="3" value="{{ $product->system }}" required autocomplete="off">
                                        <label for="system" class="form-label">System <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->CPU != '' ? 'focused' : '' }}">
                                        <input type="text" class="form-control" name="CPU" maxlength="30"
                                            minlength="3" value="{{ $product->CPU }}" required autocomplete="off">
                                        <label for="CPU" class="form-label">CPU<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->memory != '' ? 'focused' : '' }}">
                                        <input type="number" class="form-control" name="memory" min="0"
                                            max="1000" value="{{ $product->memory }}" required autocomplete="off">
                                        <label for="memory" class="form-label">Memory</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->graph != '' ? 'focused' : '' }}">
                                        <input type="text" class="form-control" name="graph" maxlength="30"
                                            minlength="3" value="{{ $product->graph }}" required autocomplete="off">
                                        <label for="graph" class="form-label">Graph <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $product->size != '' ? 'focused' : '' }}">
                                        <input type="number" class="form-control" name="size" min="0"
                                            max="1000" value="{{ $product->size }}" required autocomplete="off">
                                        <label for="size" class="form-label">Size</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="release" type="date" class="datepicker form-control"
                                            value="{{ $product->release }}">
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
                                        autocomplete="off" value="{{ $product->photo }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-btn pl-0">
                                        <a id="lfm-bg" data-input="thumbnail-bg" data-preview="holder-bg"
                                            class="btn btn-raised bg-amber waves-effect">
                                            <i class="fa-solid fa-image"></i> Choose background
                                        </a>
                                    </span>
                                    <input value="{{ $product->photo_bg}}" id="thumbnail-bg" class="form-control" type="text" name="photo_bg" autocomplete="off">
                                </div>
                                {{-- choose img --}}
                                <div class="d-flex">
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    <div id="holder-bg" style="margin-top:15px;max-height:100px;"></div>
                                </div>

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
    {{-- Editor CKEDITOR --}}
    <script type="text/javascript" src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/pages/forms/editors.js') }}"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm-bg').filemanager('image');
    </script>
    <script>
        var child_cat_id = {{ $product->child_cat_id }};

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
                                html_option += "<option value='" + id + "' " + (child_cat_id ==
                                        id ? 'selected' : '') + ">" + title +
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

        if (child_cat_id != null) {
            $('#cat_id').change();
        }
    </script>
@endsection
