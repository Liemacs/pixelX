@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Orders
                </h2>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Order list</li>
                    <p class="float-right">Total orders: {{ \App\Models\Order::count() }}</p>
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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>№</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                               
                                                <td><span
                                                        class="label 
                                                        @if ($order->condition == 'pending') bg-info 
                                                        @elseif ($order->condition == 'processing') 
                                                        bg-primary
                                                        @elseif ($order->condition == 'complete')
                                                        bg-success
                                                         @else 
                                                        bg-danger @endif">{{ $order->condition }}
                                                    </span>
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('order.show', $order->id) }}" data-toggle="tooltip"
                                                        title="view" data-placement="bottom"><i
                                                            class="bx bx-show"
                                                            style='color: #ff9600'></i>
                                                    </a>

                                                    <form class="ml-3"
                                                        action="{{ route('order.destroy', $order->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" data-id={{ $order->id }} class="dltBtn"
                                                            data-toggle="tooltip" title="delete" data-placement="bottom"><i
                                                                class="bx bx-trash"
                                                                style='color: #f83600'></i></a>
                                                    </form>

                                                </td>
                                            </tr>
                                            @empty
                                            <td>No orders</td>
                                        @endforelse
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

@endsection
