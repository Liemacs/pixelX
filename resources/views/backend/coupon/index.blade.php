@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Coupons <a href="{{ route('coupon.create') }}" class="btn-sm btn-outline-secondary"><i
                            class="fa-solid fa-plus"></i> Craete coupon</a></h2>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">All coupons</li>
                    <p class="float-right">Total coupons: {{ \App\Models\Coupon::count() }}</p>
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
                                            <th>Code</th>
                                            <th>Value</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>№</th>
                                            <th>Code</th>
                                            <th>Value</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($coupons as $item)
                                            <tr>
                                                <td style="width:5%">{{ $loop->iteration }}</td>

                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->value }}
                                                    @if ($item->type == 'fixed')
                                                        <small>$</small>
                                                    @else
                                                        <span>%</span>
                                                    @endif
                                                </td>
                                                </td>
                                                <td>
                                                    @if ($item->type == 'fixed')
                                                        <span>{{ $item->type }}</span>
                                                    @else
                                                        <span>{{ $item->type }}</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="switch">
                                                        <label>
                                                            <input type="checkbox" name="toogle"
                                                                value="{{ $item->id }}"
                                                                {{ $item->status === 'active' ? 'checked' : '' }}>
                                                            <span class="lever"></span></label>
                                                    </div>

                                                </td>
                                                <td class="d-flex justify-content-center align-self-center">
                                                    <a href="{{ route('coupon.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="edit" data-placement="bottom"><i
                                                            class="bx bxs-edit-alt"
                                                            style='color: #ff9600'></i>
                                                    </a>
                                                    <form class="ml-3"
                                                        action="{{ route('coupon.destroy', $item->id) }}" method="post">
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
                url: "{{ route('coupon.status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.msg
                        })

                    } else {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong!'
                        })
                    }
                }
            })
        })
    </script>
@endsection
