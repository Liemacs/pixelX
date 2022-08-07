<script type="text/javascript" src="{{ asset('https://kit.fontawesome.com/abd48c61b4.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('backend/plugins/editable-table/mindmup-editabletable.js') }}"></script> <!-- Editable Table Plugin Js -->
<script src="{{ asset('frontend/js/header.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/payment.js') }}"></script>
<script src="{{ asset('frontend/js/filters.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> 

@yield('scripts')

<script>
    setTimeout(() => {
        $('#alert').slideUp();
    }, 4000);
</script>


{{-- Add to cart --}}
<script>
    $(document).on('click', '.add_to_cart', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');

        var token = "{{ csrf_token() }}";
        var path = "{{ route('cart.store') }}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            success: function(data) {
                $('body #header-ajax').html(data['header']);
                $('body #cart-counter').html(data['cart_count']);
                if (data['status']) {
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

                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>

{{-- Add to wishlist --}}
<script>
    $(document).on('click', '.add_to_wishlist', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var product_qty = $(this).data('quantity');

        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlist.store') }}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            beforeSend: function() {
                $('#add_to_wishlist_' + product_id).html(
                    "<i class='bx bx-loader-circle bx-spin' ></i>");
            },
            complete: function() {
                $('#add_to_wishlist_' + product_id).html(
                    "<i class='bx bxs-heart' style='color: red;'></i>");
            },
            success: function(data) {
                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
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

                } else if (data['present']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
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
                        icon: 'info',
                        title: data['present'],
                        color: '#716add',
                        background: '#000',

                    })
                } else {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
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
                        title: "You can't add that product",
                        color: '#716add',
                        background: '#000',

                    })
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>
