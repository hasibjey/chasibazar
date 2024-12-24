<?php

namespace App\Http\Controllers\Frontend\profile;

use App\Models\Product;
use App\Helpers\Backend;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $path = '/images/products/';
    protected $thumbnailWidth = 208;
    protected $thumbnailHeight = 230;
    protected $width = 180;
    protected $height = 200;

    public function index(Request $request)
    {
        // return Auth::guard('web')->user()->id;
        $paginate = isset($request->paginate) ? $request->paginate : 20;

        $items = Product::with(['Category:id,name', 'SubCategory:id,name'])
        ->where('user_id', Auth::user()->id)
        ->select('id', 'category_id', 'sub_category_id', 'user_id', 'title', 'quantity', 'price', 'status')
        ->orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        return view('frontend.pages.profile.products.product', compact('items', 'paginate'));
    }

    public function create()
    {
        $categories = Category::get();
        $subCategories = SubCategory::get();

        return view('frontend.pages.profile.products.product-create', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'unique:products,title'],
            'category' => ['required'],
            'sub_category' => ['required'],
            'description' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ]);

        $thumbnailUrl = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailImageName = date('YmdHms');
            $thumbnailUrl = $this->path . $thumbnailImageName . '.webp';
            Backend::ImageUpload($thumbnailImage, $this->thumbnailWidth, $this->thumbnailHeight, $thumbnailUrl);
        }

        $product_id = Product::insertGetId([
            'user_id' => Auth::guard('web')->user()->id,
            'title' => $request->title,
            'slug' => Backend::Slug($request->title),
            'code' => Str::lower(Str::random(5)),
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'thumbnail' => $thumbnailUrl,
            'created_at' => Carbon::now(),
        ]);

        if($request->hasFile('images'))
        {
            foreach ($request->images as $key => $image) {
                $imageUrl = $this->path . date('YmdHms') . '_' . rand(1, 100) . '.webp';
                Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);

                ProductImage::insert([
                    'product_id' => $product_id,
                    'image' => $imageUrl,
                    'created_at' => Carbon::now()
                ]);
            }

        }

        flash()->success('Product added successfully..');
        return redirect()->route('user.product.index');
    }

    public function edit($id)
    {
        $categories = Category::get();
        $subCategories = SubCategory::get();
        $update = Product::with('images')->find($id);

        return view('frontend.pages.profile.products.product-create', compact('update', 'categories', 'subCategories'));
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Product::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Product status updated successfully');
        return redirect()->route('user.product.index');
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

        $item = Product::find($request->id);
        $thumbnailUrl = $item->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if (file_exists(public_path($item->thumbnail)))
            {
                unlink(public_path($item->thumbnail));
            }
                $thumbnailImage = $request->file('thumbnail');
                $thumbnailImageName = date('YmdHms');
                $thumbnailUrl = $this->path . $thumbnailImageName . '.webp';
                Backend::ImageUpload($thumbnailImage, $this->thumbnailWidth, $this->thumbnailHeight, $thumbnailUrl);
        }

        Product::find($request->id)->update([
            'user_id' => Auth::guard('web')->user()->id,
            'title' => $request->title,
            'slug' => Backend::Slug($request->title),
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'thumbnail' => $thumbnailUrl,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->images as $key => $image) {
                $imageUrl = $this->path . date('YmdHms') . '_' . rand(1, 100) . '.webp';
                Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);

                ProductImage::insert([
                    'product_id' => $request->id,
                    'image' => $imageUrl,
                    'created_at' => Carbon::now()
                ]);
            }

        }

        flash()->success('Product updated successfully..');
        return redirect()->route('user.product.index');
    }

    public function imageTrash($id)
    {
        $item = ProductImage::find($id);
        $items = ProductImage::where('product_id', $item->product_id)->count();
        if (file_exists(public_path($item->image))) {
            if ($items > 1) {
                unlink(public_path($item->image));
                $item->delete();
                flash()->success('Product image deleted successfully');
                return redirect()->back();
            }
            else {
                flash()->success('Image are not deleted');
                return redirect()->back();
            }
        }
    }

    public function trash($id)
    {
        $item = Product::find($id);
        if (file_exists(public_path($item->thumbnail)))
            unlink(public_path($item->thumbnail));


        $images = ProductImage::where('product_id', $item->id)->get();
        foreach ($images as $key => $image) {
            if (file_exists(public_path($image->image)))
                unlink(public_path($image->image));
        }
        ProductImage::where('product_id', $item->id)->delete();
        $item->delete();

        flash()->success('Product deleted successfully');
        return redirect()->route('user.product.index');
    }
}
