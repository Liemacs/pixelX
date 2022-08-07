@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><a href="{{ route('order.index') }}" class="btn btn-sm btn-raised bg-grey waves-effect"><i
                            class='bx bx-left-arrow-alt'></i> Back</a>
                </h2>
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
                                <div class="block-header">
                                    <h2>Created on
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('M/D(d)/Y - H:i:s') }}</h2>
                                </div>
                                <table class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Coupon</th>
                                            <th>Sub Total</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>${{ number_format($order->coupon, 2) }}</td>
                                            <td>${{ number_format($order->sub_total, 2) }}</td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td><span
                                                    class="label 
                                                        @if ($order->condition == 'pending') bg-info 
                                                        @elseif ($order->condition == 'processing') 
                                                        bg-primary
                                                        @elseif ($order->condition == 'complete')
                                                        bg-success
                                                         @else 
                                                        bg-danger @endif">
                                                    {{ $order->condition }}
                                                </span>
                                            </td>
                                            <td class="d-flex">
                                                <a href="#" data-toggle="tooltip"
                                                    title="view" data-placement="bottom"><i
                                                        class="bx bx-download"
                                                        style='color: #ff9600'></i>
                                                </a>

                                                <form class="ml-3"
                                                    action="{{ route('order.destroy', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" data-id={{ $order->id }} class="dltBtn"
                                                        data-toggle="tooltip" title="delete" data-placement="bottom"><i
                                                            class="bx bxs-trash"
                                                            style='color: #f83600'></i></a>
                                                </form>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $item->photo }}" alt=""
                                                        style="max-width: 50px;"></td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->pivot->quantity }}</td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form action="{{ route('order.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <strong>Status</strong>
                                <select name="condition" class="form-control">
                                    <option value="pending"
                                        {{ $order->condition == 'complete' || $order->condition == 'cancelled' ? 'disabled' : '' }}
                                        {{ $order->condition == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing"
                                        {{ $order->condition == 'complete' || $order->condition == 'cancelled' ? 'disabled' : '' }}
                                        {{ $order->condition == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="complete" {{ $order->condition == 'cancelled' ? 'disabled' : '' }}
                                        {{ $order->condition == 'complete' ? 'selected' : '' }}>Сomplete</option>
                                    <option value="cancelled" {{ $order->condition == 'complete' ? 'disabled' : '' }}
                                        {{ $order->condition == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-raised bg-success waves-effect">Update</button>
                            </form>
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
