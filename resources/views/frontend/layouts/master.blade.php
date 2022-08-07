<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
</head>

<body>
    <div class="wrapper">
        <header id="header-ajax">
            @include('frontend.layouts.header')
        </header>
        <div class="main">
            <div>
                @include('backend.layouts.notification')
            </div>

            @yield('content')
        </div>
        @include('frontend.layouts.footer')
        @include('frontend.layouts.script')

    </div>

    {{-- <script>
        $(document).ready(function() {
            var path = "{{ route('autosearch') }}";
            $('#search_text').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path,
                        dataType: "JSON",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    })
                },
                minLength:1,
            })
        })
    </script> --}}

    <script>
        $(document).on('click', '.cart_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success: function(data) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);


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
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script>
</body>

</html>
