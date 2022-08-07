@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Banners <a href="{{ route('banner.create') }}" class="btn-sm btn-outline-secondary"><i
                            class="fa-solid fa-plus"></i> Craete banner</a></h2>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">All banners</li>
                    <p class="float-right">Total banners: {{ \App\Models\Banner::count() }}</p>
                </ul>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Background</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>№</th>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Background</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($banners as $item)
                                            <tr>
                                                <td style="width:5%; vertical-align: middle;">{{ $loop->iteration }}</td>
                                                <td><img src="{{ $item->photo }}" alt="banner"
                                                        style="max-height:40px; max-width:60px; vertical-align: middle;">
                                                </td>
                                                <td style="width:60%; vertical-align: middle;">{{ $item->title }}</td>
                                                <td style="vertical-align: middle;">
                                                    <span
                                                        style="background-color: #{{ $item->background }}; height: 15px; width: 15px; display: inline-block;"></span>
                                                    <p style='margin: 0 0 0 5px;     display: inline-block;'>#{{ $item->background }}</p>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div class="switch">
                                                        <label>
                                                            <input type="checkbox" name="toogle"
                                                                value="{{ $item->id }}"
                                                                {{ $item->status === 'active' ? 'checked' : '' }}>
                                                            <span class="lever"></span></label>
                                                    </div>

                                                </td>
                                                <td style="vertical-align: middle; height: 100%;" class="d-flex justify-content-between">
                                                    <a href="{{ route('banner.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="edit" data-placement="bottom">
                                                        <i class="bx bxs-edit-alt" style='color: #ff9600'></i>
                                                    </a>

                                                    <form 
                                                        action="{{ route('banner.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" data-id={{ $item->id }} class="dltBtn"
                                                            data-toggle="tooltip" title="delete" data-placement="bottom"><i
                                                                class="bx bx-trash"
                                                                style='color: #f83600'></i></a>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>
    <script>
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url: "{{ route('banner.status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        console.log(response.msg);
                    } else {
                        aler('Please try again!');
                    }
                }
            })
        })
    </script>
@endsection
