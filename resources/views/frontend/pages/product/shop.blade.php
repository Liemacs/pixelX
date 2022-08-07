@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <form action="{{ route('shop.filter') }}" class="panel-group account-info bg-account pixel-corners" id="accordion"
            role="tablist" aria-multiselectable="true" method="post">
            @csrf

            <div class="panel-default">
                <div class="panel-heading active" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" onclick="myFunction()" data-toggle="collapse" data-parent="#accordion"
                            href="javascrit:void();" aria-expanded="true" aria-controls="collapseOne">
                            <i class='bx bx-filter'></i> Filters
                        </a>
                        <div class="select sort-container pixel-corners-sm">
                            <select name="sortBy" onchange="this.form.submit();">
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'default') selected @endif value="default">Default sort
                                </option>
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif value="priceAsc"
                                    {{ old('sortBy') == 'priceAsc' ? 'selected' : '' }}>Price -> Lower to
                                    Higher</option>
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif value="priceDesc">Price -> Higher
                                    to Lower
                                </option>
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc') selected @endif value="titleAsc">Alphabetical
                                    Ascending
                                </option>
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc') selected @endif value="titleDesc">Alphabetical
                                    Descending
                                </option>
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discountAsc') selected @endif value="discountAsc">Discount ->
                                    Lower to
                                    Higher
                                </option>
                                <option @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discountDesc') selected @endif value="discountDesc">Discount ->
                                    Higher to
                                    Lower
                                </option>
                            </select>
                        </div>
                        <a href="{{ route('shop') }}" id="clean-filter viewAll"
                            style="display: @if (empty($_GET)) none @endif"
                            class="viewAll pixel-corners-sm">Clear</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse active-filter" role="tabpanel" aria-labelledby="headingOne">
                    <div class="filters">
                        <div class="filter-sidebar">
                            <h4>Categories</h3>
                                @if (count($cats) > 0)
                                    <div class="categories-sidebar">
                                        @if (!empty($_GET['category']))
                                            @php
                                                $filter_cats = explode(',', $_GET['category']);
                                            @endphp
                                        @endif
                                        @foreach ($cats as $cat)
                                            <div class="category-sidebar">
                                                <input type="checkbox" @if (!empty($filter_cats) && in_array($cat->slug, $filter_cats)) checked @endif
                                                    name="category[]" class="input-sidebar" onchange="this.form.submit();"
                                                    value="{{ $cat->slug }}" id="{{ $cat->slug }}">
                                                <label
                                                    for="{{ $cat->slug }}">{{ ucfirst($cat->title) }}<span>({{ count($cat->products) }})<span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                        </div>

                        @if (!empty($_GET['price']))
                            @php
                                $price = explode('-', $_GET['price']);
                            @endphp
                        @endif


                        <div class="brand-filter">
                            <h4>Brands</h3>
                                @if (count($brands) > 0)
                                    @if (!empty($_GET['brand']))
                                        @php
                                            $filter_brands = explode(',', $_GET['brand']);
                                        @endphp
                                    @endif
                                    <div class="brands-sidebar">
                                        @foreach ($brands as $brand)
                                            <div>
                                                <input type="checkbox" @if (!empty($filter_brands) && in_array($brand->slug, $filter_brands)) checked @endif
                                                    name="brand[]" class="input-sidebar" onchange="this.form.submit();"
                                                    value="{{ $brand->slug }}" id="{{ $brand->slug }}">
                                                <label
                                                    for="{{ $brand->slug }}">{{ $brand->title }}<span>({{ count($brand->products) }})<span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                        </div>
                        <div class="multiplayer-filter">
                            <h4>Multiplayer</h3>
                                @if (count($brands) > 0)
                                    @if (!empty($_GET['multiplayer']))
                                        @php
                                            $filter_multiplayers = explode(',', $_GET['multiplayer']);
                                        @endphp
                                    @endif
                                    <div>
                                        <input type="radio" @if (!empty($filter_multiplayers) && $filter_multiplayers[0] === 'multiplayer') checked @endif
                                            name="multiplayer" class="input-sidebar" onchange="this.form.submit();"
                                            value="multiplayer" id="multiplayer">
                                        <label
                                            for="multiplayer">Multiplayer<span>({{ \App\Models\Product::where(['status' => 'active', 'multiplayer' => 'multiplayer'])->count() }})<span></label>
                                    </div>
                                    <div>
                                        <input type="radio" @if (!empty($filter_multiplayers) && $filter_multiplayers[0] === 'single') checked @endif
                                            name="multiplayer" class="input-sidebar" onchange="this.form.submit();"
                                            value="single" id="single">
                                        <label
                                            for="single">Single<span>({{ \App\Models\Product::where(['status' => 'active', 'multiplayer' => 'single'])->count() }})<span></label>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="range-slider">
                        <h4>Price: <span class="rangeValues"></span></h4>
                        <input id="slider-range" value="{{ !empty($_GET['price']) ? $price[0] : Helper::minPrice() }}"
                            min="{{ Helper::minPrice() }}" max="{{ Helper::maxPrice() }}" type="range">
                        <input value="{{ !empty($_GET['price']) ? $price[1] : Helper::maxPrice() }}"
                            min="{{ Helper::minPrice() }}" max="{{ Helper::maxPrice() }}" type="range">
                        <input type="hidden" name="price_range" id="amound"
                            value="{{ Helper::minPrice() }}-{{ Helper::maxPrice() }}">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        @if (count($products) > 0)
            <div class="grid-items">
                @foreach ($products as $product)
                    @php
                        $wishlist_array = [];
                        foreach (Cart::instance('wishlist')->content() as $item) {
                            $wishlist_array[] = $item->id;
                        }
                    @endphp

                    <div>
                        <a href="{{ route('product.detail', $product->slug) }}" class="item">
                            <picture class="pixel-corners">
                                <img src="{{ $product->photo }}" alt="{{ $product->title }}">
                            </picture>
                            <div class="action">
                                <span class="discount pixel-corners-sm">
                                    {{ $product->discount }}%
                                </span>
                                <div class="ajax-btn">
                                    <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                        data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}">
                                        @if (in_array($product->id, $wishlist_array))
                                            <i class='bx bxs-heart' style='color: red;'></i>
                                        @else
                                            <i class='bx bxs-heart' style='color: white;'></i>
                                        @endif
                                    </a>
                                    <button data-quantity="1" data-product-id="{{ $product->id }}"
                                        class="add_to_cart pixel-corners-sm" id="add_to_cart{{ $product->id }}">
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
                                <p>{{ $product->title }}</p>
                                <p>
                                    {{ number_format($product->offer_price, 2) }}<span>$</span>
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products found!</p>
        @endif
        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}
    </div>
@endsection

@section('scripts')
    <script>
        function myFunction() {
            $(".panel-collapse").toggle(".panel-collapse.active-filter");
        }
    </script>
@endsection
