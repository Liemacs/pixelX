<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;

use function GuzzleHttp\Promise\all;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout1', compact('user'));
    }

    public function checkout1Store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'string|required|exists:users,email',
            'phone' => 'string|required',
            'sub_total' => 'numeric|required',
            'total_amount' => 'numeric|required',
        ]);

        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sub_total' => $request->sub_total,
            'total_amount' => $request->total_amount,
        ]);

        return view('frontend.pages.checkout.checkout2');
    }

    public function checkout2Store(Request $request)
    {

        $this->validate($request, [
            'payment_status' => 'string|in:paid, unpaid',
        ]);

        Session::push('checkout', [
            'payment_status' => 'paid'
        ]);


        return view('frontend.pages.checkout.checkout3');
    }

    public function checkoutStore()
    {

        // return Session::get('checkout');
        $order = new Order();
        $order['user_id'] = auth()->user()->id;
        $order['order_number'] = Str::upper('ORD-' . Str::random(6));
        $order['sub_total'] = Session::get('checkout')['sub_total'];
        if (Session::has('coupon')) {
            $order['coupon'] = Session::get('coupon')['value'];
        } else {
            $order['coupon'] = 0;
        }
        $order['total_amount'] = Session::get('checkout')['sub_total'] - $order['coupon'];
        $order['payment_status'] = Session::get('checkout')[0]['payment_status'];
        $order['condition'] = 'pending';
        $order['first_name'] = Session::get('checkout')['first_name'];
        $order['last_name'] = Session::get('checkout')['last_name'];
        $order['email'] = Session::get('checkout')['email'];
        $order['phone'] = Session::get('checkout')['phone'];
        // return $order;


        $status = $order->save();
        foreach(Cart::instance('shopping')->content() as $item){
            $product_id[] = $item->id;
            $product = Product::find($item->id);
            $quantity=$item->qty;
            $order->products()->attach($product, ['quantity' => $quantity]);
        }
        if ($status) {
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('complete', $order['order_number']);
        } else return redirect()->route('checkout1')->with('error', 'Please try again');
    }

    public function complete($order)
    {
        $order = $order;
        return view('frontend.pages.checkout.complete', compact('order'));
    }
}
