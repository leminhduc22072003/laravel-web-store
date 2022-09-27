<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-admin-writer-permission');
    }

    public function index() {
        $orders = Order::with('orderProduct', 'orderProduct.product', 'customer')->get();
        return view('admin.order.list')->with(compact('orders'));
    }
}
