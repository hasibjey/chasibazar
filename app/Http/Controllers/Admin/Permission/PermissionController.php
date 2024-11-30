<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware(CheckAdminPermission::class.':permissions view', only:['index']),
            new middleware(CheckAdminPermission::class.':permissions create', only:['store']),
            new middleware(CheckAdminPermission::class.':permissions update', only:['update']),
            new middleware(CheckAdminPermission::class.':permissions delete', only:['trash']),
        ];
    }

    public function index(Request $request)
    {
        $update = null;

        $items = Permission::orderBy('name', 'ASC')->get();

        if (isset($request->eid))
            $update = Permission::find($request->eid);

        return view('backend.pages.permissions.permission', compact('items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name'],
        ]);

        Permission::insert([
            'name' => Str::lower($request->name),
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Permission added successfully..');
        return redirect()->route('admin.setting.permission');
    }

    public function update(Request $request)
    {
        Permission::find($request->id)->update([
            'name' => Str::lower($request->name),
        ]);

        flash()->success('Permission updated successfully..');
        return redirect()->route('admin.setting.permission');
    }

    public function trash($id)
    {
        Permission::find($id)->delete();
        flash()->success('Permission deleted successfully');
        return redirect()->route('admin.setting.permission');
    }
}
