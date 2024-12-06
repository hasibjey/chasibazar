<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $paginate = isset($request->paginate)? $request->paginate : 20;

        $items = Product::select('id', 'user_id', 'title', 'quantity', 'price')->orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        return view();
    }
}
