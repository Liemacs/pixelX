@extends('frontend.layouts.master')

@section('content')
    <div class="main">
        {{-- banner secction --}}
        @if (count($banners) > 0)
            <section class="slider">
                @foreach ($banners as $banner)
                    <div style="background: #{{ $banner->background }};">
                        <!-- The slideshow -->
                        <div class="container-banner">
                            <img src="{{ $banner->photo }}" id="banner" alt="{{ $banner->title }}" />
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
        {{-- banner secction --}}

        {{-- Trending game --}}
        @php
            $new_products = \App\Models\Product::where(['status' => 'active'])
                ->having('discount', '>', 50)
                ->orderBy('id', 'DESC')
                ->limit('6')
                ->get();
        @endphp
        @if (count($new_products) > 0)
            <section>
                <div class="container">
                    <div class="header-block">
                        <h1 class="section-title jinx-effect" data-label="Summer Sale">Summer Sale</h1>
                        <a href="{{ route('shop.summer-sale') }}" class="viewAll pixel-corners-sm">View all</a>
                    </div>
                    <div class="grid-items listing-slider">
                        @foreach ($new_products as $nproduct)
                            @php
                                $photo = explode(',', $nproduct->photo);
                                $wishlist_array = [];
                                foreach (Cart::instance('wishlist')->content() as $item) {
                                    $wishlist_array[] = $item->id;
                                }
                            @endphp

                            <div>
                                <a href="{{ route('product.detail', $nproduct->slug) }}" class="item">
                                    <picture class="pixel-corners">
                                        <img src="{{ $photo[0] }}" alt="{{ $nproduct->title }}">
                                    </picture>
                                    <div class="action">
                                        <span class="discount pixel-corners-sm">
                                            {{ $nproduct->discount }}%
                                        </span>
                                        <div class="ajax-btn">

                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $nproduct->id }}" id="add_to_wishlist_{{ $nproduct->id }}">
                                                @if (in_array($nproduct->id, $wishlist_array))
                                                    <i class='bx bxs-heart' style='color: red;'></i>
                                                @else
                                                    <i class='bx bxs-heart' style='color: white;'></i>
                                                @endif
                                            </a>
                                            <button data-quantity="1" data-product-id="{{ $nproduct->id }}"
                                                class="add_to_cart pixel-corners-sm" id="add_to_cart{{ $nproduct->id }}">
                                                <span>Add to cart</span>
                                                <div class="cartAdd">
                                                    <svg viewBox="0 0 36 26">
                                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5">
                                                        </polyline>
                                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="information">
                                        <p>{{ $nproduct->title }}</p>
                                        <p>
                                            {{ number_format($nproduct->offer_price, 2) }}<span>$</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        {{-- Treding game --}}

        <section class="pros-section">
            <div class="container grid-items-pros">
                <div class="pros">
                    <i class='bx bx-cloud-download'></i>
                    <span>
                        <p>Super fast</p>
                        <small>Instant digital download</small>
                    </span>
                </div>
                <div class="pros">
                    <i class='bx bx-check-shield'></i>
                    <span>
                        <p>Reliable & safe</p>
                        <small>Over 10,000 games
                        </small>
                    </span>
                </div>
                <div class="pros">
                    <i class='bx bx-chat'></i>
                    <span>
                        <p>Customer support</p>
                        <small>Human support 24/7</small>
                    </span>
                </div>
            </div>
        </section>

        {{-- categories section --}}
        @if (count($categories) > 0)
            <section class="categories-section">
                <div class="container">
                    <div class="header-block">
                        <h1 class="section-title jinx-effect" data-label="Categories">Categories</h1>
                        <a href="javascript:void(0);" id="viewAll" class="viewAll pixel-corners-sm">View all</a>
                    </div>
                    <div class="categories grid-items">
                        @foreach ($categories as $category)
                            <a href="{{ route('product.category', $category->slug) }}"
                                class="category {{ $loop->index < 3 ? '' : 'inactive' }}">
                                <picture class="content">
                                    <h3>{{ $category->title }}</h3>
                                    <picture class="cover">
                                        <img src="{{ $category->character_bg }}" alt="{{ $category->title }}"
                                            class="character">

                                    </picture>
                                </picture>
                                <picture class="background pixel-corners">
                                    <img src="{{ $category->photo }}" alt="{{ $category->title }}" />
                                </picture>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        {{-- categories section --}}

        {{-- Partners --}}

        <section class="partners-container">
            <div class="container-bg" style="background-image: url('{{ asset('/images/partner-bg.jpg') }}');">
                <div class="content-container">
                    <picture>
                        <img src="{{ asset('images/partner.png') }}" alt="avatar">
                    </picture>
                    <div class="text">
                        <div class="stars">
                            @for ($i = 0; $i < 4; $i++)
                                <i class='bx bxs-star'></i>
                            @endfor
                        </div>
                        <p class="comment">
                            Instant Gaming is a great way towards cheaper games,
                            while still supporting the developers. It was quick,
                            I was able to pay whit PayPal and got the code
                            instantly after paymetn.
                        </p>
                    </div>
                </div>
            </div>

        </section>

        {{-- Partners --}}

        {{-- Best seller --}}

        @php
            $new_products = \App\Models\Product::where(['status' => 'active'])
                ->where(
                    'release',
                    '>',
                    now()
                        ->subDays(30)
                        ->endOfDay(),
                )
                ->orderBy('id', 'ASC')
                ->limit('6')
                ->get();
        @endphp
        @if (count($new_products) > 0)
            <section>
                <div class="container">
                    <div class="header-block">
                        <h1 class="section-title jinx-effect" data-label="New game">New game</h1>
                        <a href="{{ route('shop.new') }}" class="viewAll pixel-corners-sm">View all</a>
                    </div>
                    <div class="grid-items listing-slider">
                        @foreach ($new_products as $nproduct)
                            @php
                                $photo = explode(',', $nproduct->photo);
                            @endphp

                            <div>
                                <a href="{{ route('product.detail', $nproduct->slug) }}" class="item">
                                    <picture class="pixel-corners">
                                        <img src="{{ $photo[0] }}" alt="{{ $nproduct->title }}">
                                    </picture>
                                    <div class="action">
                                        <span class="discount pixel-corners-sm">
                                            {{ $nproduct->discount }}%
                                        </span>
                                        <div class="ajax-btn">
                                            @php
                                                $photo = explode(',', $nproduct->photo);
                                                $wishlist_array = [];
                                                foreach (Cart::instance('wishlist')->content() as $item) {
                                                    $wishlist_array[] = $item->id;
                                                }
                                            @endphp
                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $nproduct->id }}" id="add_to_wishlist_{{ $nproduct->id }}">
                                                @if (in_array($nproduct->id, $wishlist_array))
                                                    <i class='bx bxs-heart' style='color: red;'></i>
                                                @else
                                                    <i class='bx bxs-heart' style='color: white;'></i>
                                                @endif
                                            </a>
                                            <button data-quantity="1" data-product-id="{{ $nproduct->id }}"
                                                class="add_to_cart pixel-corners-sm" id="add_to_cart{{ $nproduct->id }}">
                                                <span>Add to cart</span>
                                                <div class="cartAdd">
                                                    <svg viewBox="0 0 36 26">
                                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5">
                                                        </polyline>
                                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="information">
                                        <p>{{ $nproduct->title }}</p>
                                        {{-- <h4>{{ \App\Models\Category::where('id', $nproduct->cat_id)->value('title') }}</h4> --}}
                                        <p>
                                            {{ number_format($nproduct->offer_price, 2) }}<span>$</span>
                                            {{-- <small><del>{{ number_format($nproduct->price, 2) }}</del></small> --}}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </section>
        @endif

        {{-- Best seller --}}

        {{-- Indei games --}}
        @php
            $new_products = \App\Models\Product::where(['status' => 'active', 'cat_id' => '1'])
                ->orderBy('id', 'DESC')
                ->limit('4')
                ->get();
        @endphp
        @if (count($new_products) > 0)
            <div class="indies-container"
                style="background-image: linear-gradient(80deg,rgba(50,50,50,.4),#323232 35%), url('{{ asset('/images/deadcells.jpg') }}');">
                <div class="character-indie" style="background-image: url('{{ asset('/images/indieCharacter.png') }}');">

                </div>
                <div class="games">
                    <h1 class="section-title jinx-effect" data-label="Top Indie games">Top Indie games</h1>
                    <div class="listing-slider indie-item">
                        @foreach ($new_products as $nproduct)
                            @php
                                $photo = explode(',', $nproduct->photo);
                            @endphp

                            <div class="indie-box">
                                <a href="{{ route('product.detail', $nproduct->slug) }}" class="item">
                                    <picture class="pixel-corners">
                                        <img src="{{ $photo[0] }}" alt="{{ $nproduct->title }}">
                                    </picture>
                                    <div class="action">
                                        <span class="discount pixel-corners-sm">
                                            {{ $nproduct->discount }}%
                                        </span>
                                        <div class="ajax-btn">

                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $nproduct->id }}" id="add_to_wishlist_{{ $nproduct->id }}">
                                                @if (in_array($nproduct->id, $wishlist_array))
                                                    <i class='bx bxs-heart' style='color: red;'></i>
                                                @else
                                                    <i class='bx bxs-heart' style='color: white;'></i>
                                                @endif
                                            </a>
                                            <button data-quantity="1" data-product-id="{{ $nproduct->id }}"
                                                class="add_to_cart pixel-corners-sm" id="add_to_cart{{ $nproduct->id }}">
                                                <span>Add to cart</span>
                                                <div class="cartAdd">
                                                    <svg viewBox="0 0 36 26">
                                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5">
                                                        </polyline>
                                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="information">
                                        <p>{{ $nproduct->title }}</p>
                                        <p>
                                            {{ number_format($nproduct->offer_price, 2) }}<span>$</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
    @endif

    {{-- Indei games --}}

    {{-- action footer --}}

    @include('frontend.layouts._subscribe')

    {{-- action footer --}}

@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                dots: false,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 3000,
            });
        });
    </script>
@endsection
