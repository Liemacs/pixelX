@if (Cart::instance('shopping')->count() > 0)
    <table class="table pixel-corners">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th><i class='bx bx-trash' style="font-size: 1.2rem"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach (Cart::instance('shopping')->content() as $item)
                <tr>
                    <th><img src="{{ $item->model->photo }}" alt="{{ $item->model->title }}"
                            style="height:50px; width:80px"> </th>
                    <th><a href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }} <i
                                class='bx bx-link-external'></i></a></th>
                    <th>${{ number_format($item->price, 2) }}</th>
                    <th>
                        <div class="quantity">
                            <input type="number" data-id="{{ $item->rowId }}" class="qty-text" name="quantity"
                                id="qty-input-{{ $item->rowId }}" step="1" min="1" max="99"
                                value="{{ $item->qty }}">
                            <input type="hidden" data-id="{{ $item->rowId }}"
                                data-product-quantity="{{ $item->model->stock }}"
                                id="update-cart-{{ $item->rowId }}">
                        </div>
                    </th>
                    <th>${{ number_format($item->subtotal(), 2) }}</th>
                    <th>
                        <i class='bx bx-x cart_delete' data-id="{{ $item->rowId }}"></i>
                    </th>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3"><strong>Total</strong></th>
                <th>{{ Cart::instance('shopping')->count() }}</th>
                <th colspan="2">
                    @if (session()->has('coupon'))
                        @if (session('coupon')['value'] > number_format(Cart::subtotal()))
                            <span>$0</span>
                        @else
                            <span>${{ filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) - session('coupon')['value'] }}</span>
                        @endif
                    @else
                        <span>${{ number_format(Cart::subtotal(), 2) }}</span>
                    @endif
                </th>
            </tr>
        </tfoot>
    </table>
    <div class="cart-total-area">
        <div class="coupon-form pixel-corners">
            <picture>
                <img src="{{ asset('images/gift.png') }}" alt="gift">
            </picture>
            <p>&nbsp&nbspWere you given a Pixel gift card? Just enter the code in the field below to spend less money.
            </p>
            <form action="{{ route('coupon.add') }}" id="coupon-form" method="POST" autocomplete="off">
                @csrf
                <div class="coupon-input">
                    <input type="text" name="code" placeholder="Enter the coupon"
                        value="@if (Session::has('coupon')) {{ Session::get('coupon')['code'] }} @endif"
                        @if (Session::has('coupon')) readonly @endif>
                    <button type="submit" class="btn pixel-corners-sm coupon-btn"
                        @if (Session::has('coupon')) disabled @endif>Apply Coupon</button>
                </div>
            </form>
        </div>
        <div class="total-area pixel-corners">
            <h3>Cart total</h3>
            <table class="table pixel-corners-sm">
                <tbody>
                    <tr>
                        <td>Sub Total:</td>
                        <td>${{ Cart::subtotal(), 2 }}</td>
                    </tr>
                    <tr>
                        <td>Save Amount:</td>
                        <td>
                            @if (Session::has('coupon'))
                                ${{ number_format(Session::get('coupon')['value']) }}
                            @else
                                <span>$0</span>
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <td>Total:</td>
                        @if (Session::has('coupon'))
                            @if (session('coupon')['value'] > number_format(Cart::subtotal()))
                                <td>$0</td>
                            @else
                                <td>${{ filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) - Session::get('coupon')['value'] }}
                                </td>
                            @endif
                        @else
                            <td>${{ Cart::subtotal() }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            <div class="checkout_box">
                <a href="{{ route('checkout1') }}" class="btn  pixel-corners-sm">Proceed to Checkout</a>
            </div>
        </div>

    </div>
@else
    <div class="isEmpty">
        <h1>Your <span>cart list</span> is currently empty</h1>
        <p>Before proceed to checkout you must add some products to your shopping cart. You will find <br> a lot of interesting products on our "Shop" page.</p>
        <a href="{{ route('shop') }}" class="viewAll pixel-corners-sm">Shop</a>
    </div>
@endif
