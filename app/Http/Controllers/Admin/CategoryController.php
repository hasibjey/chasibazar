<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminPermission;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(CheckAdminPermission::class . ':categories view', only: ['index']),
            new middleware(CheckAdminPermission::class . ':categories create', only: ['store']),
            new middleware(CheckAdminPermission::class . ':categories update', only: ['update']),
            new middleware(CheckAdminPermission::class . ':categories delete', only: ['trash']),
        ];
    }

    public function index(Request $request)
    {
        $update = null;
        $src = $request->src;

        $items = Category::select('id', 'name', 'status');

        if (isset($request->eid))
            $update = Category::find($request->eid);

        if (isset($src))
            $items = $items->where('name', 'like', '.$src.');

        $items = $items->get();

        return view('backend.pages.categories.category', compact('items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:categories,name'],
            'description' => ['required', 'string', 'min:5'],
            'status' => ['required', 'numeric']
        ]);

        Category::insert([
            'name' => $request->name,
            'slug' => Backend::Slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Category added successfully..');
        return redirect()->route('admin.category.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Category::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Category status updated successfully');
        return redirect()->route('admin.category.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:5'],
            'status' => ['required', 'numeric']
        ]);

        Category::find($request->id)->update([
            'name' => $request->name,
            'slug' => Backend::Slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Category updated successfully');
        return redirect()->route('admin.category.index');
    }

    public function trash($id)
    {
        Category::find($id)->delete();

        flash()->success('Category data deleted successfully');
        return redirect()->route('admin.category.index');
    }


    public function create(Request $request)
    {
        $update = null;
        $items = Category::where('status', 1)->get();

        if(isset($request->eid))
            $update =  Category::find($request->eid);

        return view('backend.pages.categories.navigation-setting', compact('items', 'update'));
    }

    public function navigationUpdate(Request $request)
    {
        $request->validate([
            'position' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
        ]);

        Category::find($request->id)->update([
            'nav_status' => $request->status,
            'nav_position' => $request->position,
        ]);

        flash()->success('Navigation setting updated successfully...');
        return redirect()->route('admin.setting.navigation.create');
    }

    public function indexCreate(Request $request)
    {
        $update = null;
        $items = Category::where('status', 1)->get();

        if (isset($request->eid))
            $update =  Category::find($request->eid);

        return view('backend.pages.categories.index-setting', compact('items', 'update'));
    }

    public function indexUpdate(Request $request)
    {
        $request->validate([
            'position' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
        ]);

        Category::find($request->id)->update([
            'index_status' => $request->status,
            'index_position' => $request->position,
        ]);

        flash()->success('Index setting updated successfully...');
        return redirect()->route('admin.setting.index.create');
    }
}
