@extends('backend.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Dashboard</h2>
            </div>

            <div class="row clearfix">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card mini-social">
                        <div class="body">
                            <div class="s-icon">
                                <i class='bx bx-category-alt' style="font-size: 35px;"></i>
                            </div>
                            <div class="s-detail">
                                <div class="like"><span class="number count-to" data-from="0"
                                        data-to="{{ \App\Models\Category::where('status', 'active')->count() }}"
                                        data-speed="2000"
                                        data-fresh-interval="20">{{ \App\Models\Category::where('status', 'active')->count() }}
                                    </span>
                                </div>
                                <span>Categories</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card mini-social">
                        <div class="body">
                            <div class="s-icon">
                                <i class='bx bx-heart' style="font-size: 35px;"></i>
                            </div>
                            <div class="s-detail">
                                <div class="like"><span class="number count-to"
                                        data-from="{{ \App\Models\Product::where('status', 'active')->count() - 10 }}"
                                        data-to="{{ \App\Models\Product::where('status', 'active')->count() }}"
                                        data-speed="2500"
                                        data-fresh-interval="20">{{ \App\Models\Product::where('status', 'active')->count() }}
                                    </span>
                                </div>
                                <span>Products</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card mini-social">
                        <div class="body">
                            <div class="s-icon">
                                <i class='bx bx-user-plus' style="font-size: 35px;"></i>
                            </div>
                            <div class="s-detail">
                                <div class="like"><span class="number count-to"
                                        data-from="{{ \App\Models\User::where('status', 'active')->count() - 10 }}"
                                        data-to="{{ \App\Models\User::where('status', 'active')->count() }}"
                                        data-speed="2800"
                                        data-fresh-interval="20">{{ \App\Models\User::where('status', 'active')->count() }}
                                    </span>
                                </div>
                                <span>New users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <div class="card new-list">
                        <div class="header">
                            <h2>Recent orders</h2>
                            <button class="btn  btn-raised bg-teal btn-xs waves-effect header-dropdown p-2">
                                view all
                            </button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover">
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
