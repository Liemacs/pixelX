<div class="container visible">
    <nav>
        <a href="{{ route('home') }}">
            <h3 class="logo jinx-effect" data-label="Pixel" data-size-before="-3px, -3px">Pixel</h3>
        </a>
        <div class="menu-list">
            <ul>
                <li>
                    <a href="{{ route('shop') }}" class="{{ Request::is('shop') ? 'active' : '' }}"
                        data="Store">Store</a>
                </li>
                <li>
                    <a href="{{ route('shop.summer-sale') }}" class="{{ Request::is('shop/summer-sale') ? 'active' : '' }}" data="Summer Sale">Summer
                        Sale</a>
                </li>
                <li>
                    <a href="{{  route('shop.new')  }}" class="{{ Request::is('shop/new') ? 'active' : '' }}" data="New game">New game</a>
                </li>
            </ul>
        </div>
        <div class="header-btn">
            <form action="{{ route('search') }}" method="GET" class="search icon-bg pixel-corners"
                autocomplete="off">
                <input name="query" id="search_text" type="search" class="search-input" placeholder="Search..."
                    required />
                <button type="submit"><i class="bx bx-search icon-centre pixel-corners-sm"></i></button>
            </form>
            <div class="wishlist icon-bg pixel-corners">
                <a href="{{ route('wishlist') }}">
                    <i class="bx bx-heart icon-centre"></i>
                </a>
                @if (Cart::instance('wishlist')->count() > 0)
                    <span id="wishlist_counter" class="product-counter"
                        id="cart-counter">{{ Cart::instance('wishlist')->count() }}</span>
                @endif
            </div>
            <div class="cart icon-bg pixel-corners">
                <a href="{{ route('cart') }}" id="open-cart-popup"><i class="bx bx-cart-alt icon-centre"></i></a>
                @if (Cart::instance('shopping')->count() > 0)
                    <span id="cart-counter" class="product-counter">{{ Cart::instance('shopping')->count() }}</span>
                @endif
            </div>
            <div class="shopping-cart pixel-corners">
                <div class="shopping-cart-header">
                    <span class="lighter-text">Total:</span>
                    @if (session()->has('coupon'))
                        @if (session('coupon')['value'] > number_format(Cart::subtotal()))
                            <span>$0</span>
                        @else
                            <span
                                class="main-color-text">${{ filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) - session('coupon')['value'] }}</span>
                        @endif
                    @else
                        <span class="main-color-text">${{ number_format(Cart::subtotal(), 2) }}</span>
                    @endif
                </div>
                @if (Cart::instance('shopping')->count() > 0)
                    <ul class="shopping-cart-items no-wrap">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="clearfix">
                                <div class="img-box">
                                    <img src="{{ $item->model->photo }}" alt="{{ $item->model->title }}" />
                                </div>
                                <div>
                                    <span class="item-name"><a
                                            href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a></span>
                                    <span class="item-price-box">
                                        <span class="item-quantity">{{ $item->qty }}</span>
                                        <i class="bx bx-x"></i>
                                        <span class="item-price">${{ number_format($item->price, 2) }}</span>
                                    </span>
                                </div>
                                <a href="#" class="cart_delete" data-id="{{ $item->rowId }}">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                    <div class="cart-btn">
                        <a href="{{ route('cart') }}" class="cart-button pixel-corners">Cart</a>
                        {{-- <a href="{{ route('checkout1') }}" class="cart-button pixel-corners">Checkout</a> --}}
                    </div>
                @else
                    <p>Cart is empty <i class='bx bx-sad' style="font-size: 15px"></i></p>
                @endif

            </div>
            <div class="login-btn icon-bg pixel-corners lock">
                @auth
                    <a href="{{ route('user.dashbaord') }}" class="profile-img">

                        @if (auth()->user()->photo)
                            <div>
                                <img src="{{ auth()->user()->photo }}" alt="">
                            </div>
                        @else
                            <div>
                                <img src="{{ Helper::userDefaultImage() }}" alt="">
                            </div>
                        @endif
                    </a>
                @else
                    <a href="{{ route('user.auth') }}">
                        <i class="bx bx-user icon-centre icon-unlock"></i>
                        <i class="bx bx-log-in icon-centre icon-lock"></i>
                    </a>
                @endauth

            </div>
            @auth
                <div class="profile-popup pixel-corners">
                    <p>Hello, {{ auth()->user()->full_name }}</p>
                    <ul>
                        <li><a href="{{ route('user.dashbaord') }}"><i class='bx bx-user'></i>My account</a></li>
                        <li><a href=""><i class='bx bx-list-ul'></i>Orders List</a></li>
                        <li><a href="{{ route('wishlist') }}"><i class='bx bx-heart'></i>Wishlist</a></li>
                        <li><a href="{{ route('user.logout') }}"><i class='bx bx-log-out'></i>Logout</a></li>
                    </ul>
                </div>
            @endauth
        </div>
        <div class="menu-btn">
            <span class="menu-trigger">
                <i class="menu-trigger-bar top"></i>
                <i class="menu-trigger-bar middle"></i>
                <i class="menu-trigger-bar bottom"></i>
            </span>
            <span class="close-trigger">
                <i class="close-trigger-bar left"></i>
                <i class="close-trigger-bar right"></i>
            </span>
        </div>
    </nav>

    <div class="menu">
        <div class="menu-inner">
            <ul class="menu-nav">
                <li class="menu-nav-item">
                    <a class="menu-nav-link" data="Store" href="{{ route('shop') }}">
                        <span>
                            <div data="Store">Store</div>
                        </span>
                    </a>
                </li>
                <li class="menu-nav-item">
                    <a class="menu-nav-link" href="{{ route('shop.summer-sale') }}">
                        <span>
                            <div data="Summer Sale">Summer Sale</div>
                        </span>
                    </a>
                </li>
                <li class="menu-nav-item">
                    <a class="menu-nav-link" href="{{ route('shop.new') }}">
                        <span>
                            <div data="New game">New game</div>
                        </span>
                    </a>
                </li>
            </ul>
            @php
                $bestProducts = \App\Models\Product::where(['status' => 'active'])
                    ->having('discount', '>', 50)
                    ->orderBy('id', 'DESC')
                    ->limit('4')
                    ->get();
            @endphp
            <div class="gallery">
                <div>
                    <p class="title">Best Seller</p>
                </div>

                <div class="images ">
                    @foreach ($bestProducts as $product)
                        @php
                            $photo = explode(',', $product->photo);
                        @endphp
                        <a class="image-link pixel-corners" href="{{ route('product.detail', $product->slug) }}">
                            <div class="image" data-label="{{ $product->title }}">
                                <img src="{{ $photo[0] }}" alt="{{ $product->title }}" />
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
