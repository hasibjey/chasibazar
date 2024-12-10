<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product($slug, $code)
    {
        $product = Product::with(['User:id,name,phone', 'Images'])->where('code', $code)->first();
        return view('frontend.pages.product', compact('product'));
    }

    public function products($slug)
    {
        $category = SubCategory::where('slug', $slug)->first();
        $products = Product::where('sub_category_id', $category->id)->where('status', 1)->get();
        return view('frontend.pages.products', compact('products'));
    }

}
