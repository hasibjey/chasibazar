<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminPermission;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SubCategoryController extends Controller implements HasMiddleware
{
    protected $imageExtension = '.webp';
    protected $path = '/images/sub-categories/';
    protected $width = 488;
    protected $height = 580;

    public static function middleware(): array
    {
        return [
            new Middleware(CheckAdminPermission::class . ':sub-categories view', only: ['index']),
            new middleware(CheckAdminPermission::class . ':sub-categories create', only: ['store']),
            new middleware(CheckAdminPermission::class . ':sub-categories update', only: ['update']),
            new middleware(CheckAdminPermission::class . ':sub-categories delete', only: ['trash']),
        ];
    }

    public function index(Request $request)
    {
        $update = null;
        $src = $request->src;

        $items = SubCategory::with('Category')->select('id', 'image', 'name', 'category_id', 'status');

        if(isset($request->eid))
            $update = SubCategory::find($request->eid);

        if(isset($src))
            $items = $items->where('name', 'like', '.$src.');

        $items = $items->get();

        $categories = Category::select('id', 'name')->get();

        return view('backend.pages.categories.sub-category', compact('items', 'update', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:sub_categories,name'],
            'category' => ['required', 'nullable'],
            'description' => ['required', 'string', 'min:5'],
            'status' => ['required', 'numeric']
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = date('YmdHms');
            $imageUrl = $this->path . $imageName . $this->imageExtension;
            Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);
        }

        SubCategory::insert([
            'name' => $request->name,
            'slug' => Backend::Slug($request->name),
            'category_id' => $request->category,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imageUrl,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Sub category added successfully..');
        return redirect()->route('admin.category.sub.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        SubCategory::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Sub category status updated successfully');
        return redirect()->route('admin.category.sub.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'category' => ['required'],
            'description' => ['required', 'string', 'min:5'],
            'status' => ['required', 'numeric']
        ]);

        $item = SubCategory::find($request->id);
        $imageUrl = empty($item)? null : $item->image;

        if ($request->hasFile('image')) {
            if (file_exists(public_path($item->image))) {
                unlink(public_path($item->image));

                $image = $request->file('image');
                $imageName = date('YmdHms');
                $imageUrl = $this->path . $imageName . $this->imageExtension;
                Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);
            } else {
                flash()->success('Sub category image not found...!');
                return redirect()->route('admin.category.sub.index');
            }
        }

        SubCategory::find($request->id)->update([
            'name' => $request->name,
            'slug' => Backend::Slug($request->name),
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $imageUrl,
            'status' => $request->status,
        ]);

        flash()->success('Sub category updated successfully..');
        return redirect()->route('admin.category.sub.index');
    }

    public function trash($id)
    {
        $item = SubCategory::find($id);
        if (file_exists(public_path($item->image)))
            unlink(public_path($item->image));

        $item->delete();

        flash()->success('Sub category data deleted successfully...');
        return redirect()->route('admin.category.sub.index');
    }

}
