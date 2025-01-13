<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    public function pending()
    {
        $items = Order::with(['Address.User'])->get();
        return view('backend.pages.orders.pending', compact('items'));
    }
}
