@foreach ($products as $item)
    @php
        $photo = explode(',', $item->photo);
    @endphp
    <div>
        <a href="{{ route('product.detail', $item->slug) }}">
            <img src="{{ $photo[0] }}" alt="">
            <p>{{ \App\Models\Brand::where('id', $item->brand_id)->value('title') }}</p>
            <p>{{ \App\Models\Category::where('id', $item->cat_id)->value('title') }}</p>
            <h4>{{ $item->title }}</h4>
            <p>$ {{ number_format($item->offer_price, 2) }}
                <small><del>{{ number_format($item->price, 2) }}</del></small>
            </p>
            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1" data-id="{{ $item->id }}" id="add_to_wishlist_{{ $item->id }}"><i class='bx bxs-heart' style='color: white;' ></i></a>
            <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $item->id }}" class="add_to_cart"
                id="add_to_cart{{ $item->id }}">
                <i class='bx bx-cart-add'></i>
            </a>
        </a>
    </div>
@endforeach
