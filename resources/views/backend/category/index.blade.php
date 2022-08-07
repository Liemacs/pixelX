@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Categories <a href="{{ route('category.create') }}" class="btn-sm btn-outline-secondary"><i
                            class="fa-solid fa-plus"></i> Craete category</a></h2>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">All categories</li>
                    <p class="float-right">Total categories: {{ \App\Models\Category::count() }}</p>
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
                                            <th>Character</th>
                                            <th>Title</th>
                                            <th>Summary</th>
                                            <th>Is parent</th>
                                            <th>Parent</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>№</th>
                                            <th>Photo</th>
                                            <th>Character</th>
                                            <th>Title</th>
                                            <th>Summary</th>
                                            <th>Is parent</th>
                                            <th>Parent</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td style="width:5%">{{ $loop->iteration }}</td>
                                                <td><img src="{{ $item->photo }}" alt="{{ $item->title }}"
                                                        style="max-height:50px; max-width:70px"></td>
                                                <td><img src="{{ $item->character_bg }}" alt="{{ $item->title }}"
                                                        style="max-height:50px; max-width:70px"></td>
                                                <td>{{ $item->title }}</td>
                                                <td style="width:60%">{{ html_entity_decode($item->summary) }}</td>
                                                <td>{{ $item->is_parent === 1 ? 'Yes' : 'No' }}</td>
                                                <td>{{ \App\Models\Category::where ('id', $item->parent_id )->value('title')}}</td>
                                                <td>
                                                    <div class="switch">
                                                        <label>
                                                            <input type="checkbox" name="toogle" value="{{ $item->id }}" {{ $item->status === 'active' ? 'checked' : '' }}>
                                                            <span class="lever"></span></label>
                                                    </div>
                                                <td class="d-flex justify-content-center align-self-center">
                                                    <a href="{{ route('category.edit', $item->id) }}"
                                                        data-toggle="tooltip" title="edit" data-placement="bottom"><i
                                                            class="bx bxs-edit-alt"
                                                            style='color: #ff9600'></i>
                                                    </a>

                                                    <form class="ml-3"
                                                        action="{{ route('category.destroy', $item->id) }}"
                                                        method="post">
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
                url: "{{ route('category.status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.msg);
                    } else {
                        aler('Please try again!');
                    }
                }
            })
        })
    </script>
@endsection
