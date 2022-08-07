@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Users <a href="{{ route('user.create') }}" class="btn-sm btn-outline-secondary"><i
                            class="fa-solid fa-plus"></i> Craete user</a></h2>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">All users</li>
                    <p class="float-right">Total users: {{ \App\Models\User::count() }}</p>
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
                                            <th>Full name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>№</th>
                                            <th>Photo</th>
                                            <th>Full name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td style="width:5%">{{ $loop->iteration }}</td>
                                                <td><img src="{{ $item->photo }}" alt="user"
                                                        style="height:50px; width:50px"></td>
                                                <td style="width:60%">{{ $item->full_name }}</td>
                                                <td style="width:20%">{{ $item->email }}</td>
                                                <td style="width:10%">{{ $item->phone }}</td>
                                                <td>{{ $item->role }}</td>
                                                <td>
                                                    <div class="switch">
                                                        <label>
                                                            <input type="checkbox" name="toogle" value="{{ $item->id }}" {{ $item->status === 'active' ? 'checked' : '' }}>
                                                            <span class="lever"></span></label>
                                                    </div>
                                                    
                                                </td>
                                                <td class="d-flex justify-content-center align-self-center">
                                                    <a href="{{ route('user.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="edit" data-placement="bottom"><i
                                                            class="bx bxs-edit-alt"
                                                            style='color: #ff9600'></i>
                                                    </a>

                                                    <form class="ml-3"
                                                        action="{{ route('user.destroy', $item->id) }}" method="post">
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
                url: "{{ route('user.status') }}",
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
