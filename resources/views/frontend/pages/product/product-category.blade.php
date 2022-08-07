@extends('frontend.layouts.master')

@section('content')
    <h2><a href="{{ route('home') }}">Home</a>/{{ $categories->title }}</h2>
    <select id="sortBy">
        <option selected>Default sort</option>
        <option value="priceAsc" {{ old('sortBy') == 'priceAsc' ? 'selected' : '' }}>Price -> Lower to Higher</option>
        <option value="priceDesc">Price -> Higher to Lower</option>
        <option value="titleAsc">Alphabetical Ascending</option>
        <option value="titleDesc">Alphabetical Descending</option>
        <option value="discountAsc">Discount -> Lower to Higher
        </option>
        <option value="discountDesc">Discount -> Higher to Lower
        </option>
    </select>

    <div id="product-data">
        @include('frontend.layouts._single-product')
    </div>

    {{-- <div class="ajax-load" style="display: none">
        <div class="loader">
            <svg>
                <defs>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="2" result="blur" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2"
                            result="gooey" />
                        <feComposite in="SourceGraphic" in2="gooey" operator="atop" />
                    </filter>
                </defs>
            </svg>
        </div>

    </div> --}}
@endsection

@section('scripts')
    <script>
        $('#sortBy').change(function() {
            var sort = $('#sortBy').val();
            window.location = "{{ url('' . $route . '') }}/{{ $categories->slug }}?sort=" + sort;
        });
    </script>

    {{-- <script>
        function loadmoreData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: 'get',
                    datatype:"html",
                    beforeSend: function() {
                        $('.ajax-load').show();
                    },
                })
                .done(function(data) {
                    if (data.length == 0) {
                    //     $('.ajax-load').html('No more products avaible');
                    //     $('.ajax-load').hide();
                        return
                    }
                    $('#product-data').append(data.html);
                    $('.ajax-load').hide();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server')
                });
        }

        var page = 1;
        loadmoreData(page);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadmoreData(page);
            };
        });
    </script> --}}
@endsection


@section('styles')
    {{-- <style>
        .ajax-load {
            background: #1b2832;
            position: relative;
            overflow: hidden;
            height: 100px;
            width: 100%;
            left: 0;
            top: 0;
        }

        @-webkit-keyframes loader-spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loader {
            position: absolute;
            margin: -18px 0 0 -18px;
            border: 3.6px solid #ff974d;
            box-sizing: border-box;
            overflow: hidden;
            width: 36px;
            height: 36px;
            left: 50%;
            top: 50%;
            animation: loader-spin 2s linear infinite reverse;
            filter: url(#goo);
            box-shadow: 0 0 0 1px #ff974d inset;
        }

        .loader:before {
            content: "";
            position: absolute;
            -webkit-animation: loader-spin 2s cubic-bezier(0.59, 0.25, 0.4, 0.69) infinite;
            animation: loader-spin 2s cubic-bezier(0.59, 0.25, 0.4, 0.69) infinite;
            background: #ff974d;
            transform-origin: top center;
            border-radius: 50%;
            width: 150%;
            height: 150%;
            top: 50%;
            left: -12.5%;
        }
    </style> --}}
@endsection
