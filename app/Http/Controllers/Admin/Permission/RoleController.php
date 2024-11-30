<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(CheckAdminPermission::class . ':roles view', only: ['index']),
            new middleware(CheckAdminPermission::class . ':roles create', only: ['store']),
            new middleware(CheckAdminPermission::class . ':roles update', only: ['update']),
            new middleware(CheckAdminPermission::class . ':roles delete', only: ['trash']),
        ];
    }

    public function index(Request $request)
    {
        $update = null;
        $updatePermissions = null;

        $permissions = Permission::orderBy('name', 'ASC')->get();
        $items = Role::all();

        if(isset($request->eid))
        {
            $update = Role::findOrFail($request->eid);
            $updatePermissions = $update->permissions->pluck('name')->toArray();
        }

        return view('backend.pages.permissions.role', compact('permissions', 'items', 'update', 'updatePermissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
        ]);

        $role = Role::create([
            'name' => Str::lower($request->name),
            'created_at' => Carbon::now(),
        ]);

        if(isset($request->permission))
        {
            foreach ($request->permission as $name) {
                $role->givePermissionTo($name);
            }
        }

        flash()->success('Role added successfully..');
        return redirect()->route('admin.setting.role');
    }

    public function update(Request $request)
    {
        $role = Role::findOrFail($request->id);

        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,'.$request->id.',id'],
        ]);

        $role->name = Str::lower($request->name);
        $role->save();

        if (isset($request->permission)) {
            $role->syncPermissions($request->permission);
        }
        else {
            $role->syncPermissions([]);
        }

        flash()->success('Role updated successfully..');
        return redirect()->route('admin.setting.role');
    }

    public function trash($id)
    {
        Role::find($id)->delete();
        flash()->success('Role deleted successfully');
        return redirect()->route('admin.setting.role');
    }
}
