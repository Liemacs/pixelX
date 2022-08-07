<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $orders=Order::orderBy('id', 'DESC')->get();
        return view('backend.index', compact('orders'));
    }
}
