@if (Cart::instance('wishlist')->count() > 0)
<table class="table pixel-corners">


        <thead>
            <tr>
                <th>Photo</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>
                    <i class='bx bx-trash' style="font-size: 1.2rem"></i>
                </th>
                <th>Move to cart</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Cart::instance('wishlist')->content() as $item)
                <tr>
                    <th><img src="{{ $item->model->photo }}" alt="{{ $item->model->title }}"
                            style="height:50px; width:80px"></th>
                    <th><a href="{{ route('product.detail', $item->model->slug) }}">{{ $item->model->title }} <i
                                class='bx bx-link-external'></i></a>
                    </th>
                    <th>${{ number_format($item->price, 2) }}</th>

                    <th>
                        <i class='bx bx-x delete_wishlist' data-id="{{ $item->rowId }}"></i>
                    </th>
                    <th><a href="javascript:void(0);" data-id="{{ $item->rowId }}" class="move-to-cart">ADD TO
                            CART</a></th>
                </tr>
            @endforeach
        </tbody>
        
        
    </table>
    @else
        <div class="isEmpty">
            <h1>Your <span >wishlist</span> is currently empty</h1>
            <p>You will find a lot of interesting products on our "Shop" page.</p>
            <a href="{{ route('shop') }}" class="viewAll pixel-corners-sm">Shop</a>
        </div>
    @endif
