@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <div id="wishlist_list">
            <h2 class="list_title">My wishlist</h2>
            
            @include('frontend.layouts._wishlist')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.move-to-cart', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.move.cart') }}"

            $.ajax({
                url: path,
                type: "POST",
                data: {
                    _token: token,
                    rowId: rowId,
                },
                beforeSend: function() {
                    $(this).html("<i class='bx bx-loader-circle bx-spin' ></i> Moving to cart")
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);

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
                            title: data['message'],
                            color: '#716add',
                            background: '#000',

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
                            icon: 'warning',
                            title: 'Something went wrong',
                            color: '#716add',
                            background: '#000',

                        });
                    }
                },
                error: function(err) {
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
                        title: "Some error",
                        color: '#716add',
                        background: '#000',

                    });

                }

            })
        })
    </script>

    <script>
        $(document).on('click', '.delete_wishlist', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.delete') }}"

            $.ajax({
                url: path,
                type: "POST",
                data: {
                    _token: token,
                    rowId: rowId,
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);

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
                            title: data['message'],
                            color: '#716add',
                            background: '#000',

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
                            icon: 'warning',
                            title: 'Something went wrong',
                            color: '#716add',
                            background: '#000',

                        });
                    }
                },
                error: function(err) {
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
                        title: "Some error",
                        color: '#716add',
                        background: '#000',

                    });

                }

            });
        });
    </script>
@endsection
