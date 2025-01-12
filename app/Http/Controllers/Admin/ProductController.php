<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $paginate = isset($request->paginate)? $request->paginate : 20;

        $items = Product::with(['Category:id,name', 'SubCategory:id,name'])
        ->select('id', 'user_id', 'title', 'quantity', 'price', 'status', 'category_id', 'sub_category_id')
        ->orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        return view('backend.pages.products.product', compact('items', 'paginate'));
    }

    public function create()
    {
        $categories = Category::get();
        $subCategories = SubCategory::get();

        return view('backend.pages.products.product-create', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'unique:products,title'],
            'category' => ['required', 'numeric'],
            'sub_category' => ['required', 'numeric'],
            'description' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ]);

        Product::insert([
            'user_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'slug' => Backend::Slug($request->title),
            'code' => Str::lower(Str::random(5)),
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Product added successfully..');
        return redirect()->route('admin.product.index');
    }

    public function edit($id)
    {
        $categories = Category::get();
        $subCategories = SubCategory::get();
        $update = Product::find($id);

        return view('backend.pages.products.product-create', compact('update', 'categories', 'subCategories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'category' => ['required', 'numeric'],
            'sub_category' => ['required', 'numeric'],
            'description' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ]);

        Product::find($request->id)->update([
            'user_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'slug' => Backend::Slug($request->title),
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        flash()->success('Product updated successfully..');
        return redirect()->route('admin.product.index');
    }

    public function trash($id)
    {
        Product::find($id)->delete();
        flash()->success('Product deleted successfully');
        return redirect()->route('admin.product.index');
    }



}
