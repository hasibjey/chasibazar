<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $items = Category::with('SubCategories')->where('index_status', 1)->get();
        $products = Product::where('status', 1)->limit(10)->get();
        return view('frontend.welcome', compact('items', 'products'));
    }
}
