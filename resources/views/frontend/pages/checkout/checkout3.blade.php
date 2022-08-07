@extends('frontend.layouts.master')

@section('content')
    <div class="container">
            @include('frontend.layouts._step-payment')
        <table class="table pixel-corners">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::instance('shopping')->content() as $item)
                    <tr>
                        <th><img src="{{ $item->model->photo }}" alt="{{ $item->model->title }}"
                                style="height:50px; width:80px"> </th>
                        <th style="width:60%"><a
                                href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }} <i
                                    class='bx bx-link-external'></i></a></th>
                        <th>
                            {{ $item->qty }}
                        </th>
                        <th>${{ number_format($item->subtotal(), 2) }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total-area pixel-corners" style="float: left">
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
                <a href="{{ route('checkout.store') }}" class="btn buy  pixel-corners-sm">Pay @if (Session::has('coupon'))
                        @if (session('coupon')['value'] > number_format(Cart::subtotal()))
                            <td>$0</td>
                        @else
                            <td>${{ filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) - Session::get('coupon')['value'] }}
                            </td>
                        @endif
                    @else
                        <td>${{ Cart::subtotal() }}</td>
                    @endif
                </a>
            </div>
        </div>
    </div>
@endsection
