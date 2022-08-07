@extends('frontend.layouts.master')

@section('content')
    <div class="header-product"></div>
    <div class="container">
        <div class="data-product">
            <div class="presentation pixel-corners-sm">
                <picture class="banner-product ">
                    <img src="{{ $product->photo }}" alt="{{ $product->title }}">
                </picture>
            </div>
            <div class="panel item-product pixel-corners-sm">
                <div class="name">{{ $product->title }}</div>
                <div class="amount">
                    <div class="discounts">{{ $product->price }}$</div>
                    <div class="discounted">{{ $product->discount }}%</div>
                    <div class="total">{{ $product->offer_price }}$</div>
                </div>
                <div class="priced">
                    @php
                        $wishlist_array = [];
                        foreach (Cart::instance('wishlist')->content() as $item) {
                            $wishlist_array[] = $item->id;
                        }
                    @endphp
                    <a href="javascript:void(0);" class="add_to_wishlist pixel-corners-sm" data-quantity="1"
                        data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}" title="Add to wishlist">
                        @if (in_array($product->id, $wishlist_array))
                            <i class='bx bxs-heart' style='color: red;'></i>
                        @else
                            <i class='bx bxs-heart' style='color: white;'></i>
                        @endif
                    </a>
                    <button data-quantity="1" data-product-id="{{ $product->id }}" class="add_to_cart pixel-corners-sm"
                        id="add_to_cart{{ $product->id }}">
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
        </div>
        <div class="about-product">
            <h3>
                About the game
            </h3>
            <div class="contain-description-product">
                <p class="description-product">
                    {{ strip_tags($product->description) }}
                </p>
                <div class="aditional-info">
                    <table>
                        <tr>
                            <td>Publisher:</td>
                            <td>{{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</td>
                        </tr>
                        <tr>
                            <td>Release date:</td>
                            <td>{{ $product->release }}</td>
                        </tr>
                        <tr>
                            <td>Genre:</td>
                            <td>{{ \App\Models\Category::where('id', $product->cat_id)->value('title') }}</td>
                        </tr>
                        <tr>
                            <td>Multiplayer:</td>
                            <td>{{ $product->multiplayer }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="about-product specification">
            <h3>
                Configurations
            </h3>
            <span>
                minimum*
            </span>
            <table>
                <tr>
                    <td>OS:</td>
                    <td>{{ $product->system }}</td>
                </tr>
                <tr>
                    <td>Processor:</td>
                    <td>{{ $product->CPU }}</td>
                </tr>
                <tr>
                    <td>Memory:</td>
                    <td>{{ $product->memory }} GB RAM</td>
                </tr>
                <tr>
                    <td>Graphics:</td>
                    <td>{{ $product->graph }}</td>
                </tr>
                <tr>
                    <td>Storage:</td>
                    <td>{{ $product->size }} GB available space</td>
                </tr>
            </table>
        </div>
        <div class="about-product">
            <h3>Relate games</h3>
            @if (count($product->rel_prods) > 0)
                <div class="grid-items">
                    @foreach ($product->rel_prods as $item)
                        @php
                            $photo = explode(',', $item->photo);
                            $wishlist_array = [];
                            foreach (Cart::instance('wishlist')->content() as $item_list) {
                                $wishlist_array[] = $item_list->id;
                            }
                        @endphp
                        <div>
                            <a href="{{ route('product.detail', $item->slug) }}" class="item">
                                <picture class="pixel-corners">
                                    <img src="{{ $item->photo }}" alt="{{ $item->title }}">
                                </picture>
                                <div class="action">
                                    <span class="discount pixel-corners-sm">
                                        {{ $item->discount }}%
                                    </span>
                                    <div class="ajax-btn">
                                        <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                            data-id="{{ $item->id }}" id="add_to_wishlist_{{ $item->id }}">
                                            @if (in_array($item->id, $wishlist_array))
                                                <i class='bx bxs-heart' style='color: red;'></i>
                                            @else
                                                <i class='bx bxs-heart' style='color: white;'></i>
                                            @endif
                                        </a>
                                        <button data-quantity="1" data-product-id="{{ $item->id }}"
                                            class="add_to_cart pixel-corners-sm" id="add_to_cart{{ $item->id }}">
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
                                    <p>{{ $item->title }}</p>
                                    <p>
                                        {{ number_format($item->offer_price, 2) }}<span>$</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
            @endif
        </div>
    </div>
    <div class="about-product">
        <h3>
            Reviews
        </h3>
        <div class="review-contain account-info bg-account pixel-corners">
            <span>Reviews <small>({{ App\Models\ProductReview::where('product_id', $product->id)->count() }})</small>
            </span>
            <div class="review-area">
                @php
                    $reviews = App\Models\ProductReview::where('product_id', $product->id)
                        ->latest()
                        ->paginate(7);
                @endphp
                <ul>
                    @if (count($reviews) > 0)
                        @foreach ($reviews as $review)
                            <li>
                                <div class="review-rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($review->rate > $i)
                                            <i class='bx bxs-star rate-star'></i>
                                        @else
                                            <i class='bx bxs-star'></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="review-details delimiter">

                                    <p>by
                                        <span>{{ App\Models\User::where('id', $review->user_id)->value('full_name') }}</span>
                                        on
                                        <small>{{ \Carbon\Carbon::parse($review->created_at)->format('M/D(d)/Y') }}</small>
                                    </p>
                                    <p>{{ $review->review }}</p>
                                </div>
                            </li>
                        @endforeach
                        {{ $reviews->links('vendor.pagination.custom') }}
                    @else
                        <p class="no-review">
                            <a href="javascript:void(0);" id="review" class="viewAll pixel-corners-sm">Be the
                                first!</a>
                        </p>
                    @endif
                </ul>
            </div>
        </div>
        <div class="about-product review-submit @if (count($reviews) > 0) active-review @endif">
            <h3>Submit review</h3>
            @auth
                <form action="{{ route('product.review', $product->slug) }}" method="POST">
                    @csrf
                    <div class="rating-box">
                        <h5>Your Rating</h5>
                        <div class="rating">
                            <input type="radio" name="rate" id="rating-5" value="5">
                            <label for="rating-5"></label>
                            <input type="radio" name="rate" id="rating-4" value="4">
                            <label for="rating-4"></label>
                            <input type="radio" name="rate" id="rating-3" value="3">
                            <label for="rating-3"></label>
                            <input type="radio" name="rate" id="rating-2" value="2">
                            <label for="rating-2"></label>
                            <input type="radio" name="rate" id="rating-1" value="1">
                            <label for="rating-1"></label>
                        </div>
                        @error('rate')
                            <p class="text-danger pixel-corners-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="nickname" value="{{ auth()->user()->full_name }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="comments-box">
                        <h5>Comments</h5>
                        <textarea class="add-review" oninput="auto_grow(this)" placeholder="Add comment" name="review" id=""
                            cols="30"></textarea>
                    </div>
                    <button class="btn pixel-corners-sm">Submit</button>
                </form>
            @else
                <p>You need to login for writing a review <br><a href="{{ route('user.auth') }}"><strong>Click
                            here!</strong> to
                        login</a></p>
            @endauth
        </div>
    </div>
    @include('frontend.layouts._subscribe')
    </div>
@endsection

@section('scripts')
    <script>
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }
    </script>
    <script>
        $("#review").click(function() {
            $('.review-submit').toggleClass("active-review");
        });
    </script>
@endsection

@section('styles')
    <style>
        .header-product {
            background-image: url("{{ $product->photo_bg }}");
            background-position: 50% calc(50% + 0px);
        }
    </style>
@endsection
