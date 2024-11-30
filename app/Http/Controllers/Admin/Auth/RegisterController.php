<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminPermission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(CheckAdminPermission::class . ':admins view', only: ['create']),
            new middleware(CheckAdminPermission::class . ':admins create', only: ['store']),
            new middleware(CheckAdminPermission::class . ':admins update', only: ['update']),
            new middleware(CheckAdminPermission::class . ':admins delete', only: ['trash']),
        ];
    }

    public function create(Request $request)
    {
        $update = null;

        $roles = Role::orderBy('name', 'ASC')->pluck('name')->all();
        $items = User::select('id', 'name', 'email')->get();

        if(isset($request->eid))
        {
            $update = User::with('roles')->find($request->eid);
        }

        return view('backend.pages.register', compact('items', 'roles', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users']
        ]);

        $password = Hash::make('12345678');

        $user = User::create([
            'name' => $request->name,
            'email' => str::lower($request->email),
            'password' => $password,
            'type' => 1,
            'created_at' => Carbon::now()
        ]);

        $user->assignRole($request->role);

        flash()->success('Admin data added successfully..');
        return redirect()->route('admin.setting.admin');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255']
        ]);

        $user = User::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->assignRole($request->role);

        flash()->success('Admin data updated successfully...');
        return redirect()->route('admin.setting.admin');
    }

    public function trash($id)
    {
        User::find($id)->delete();
        flash()->success('Admin data deleted successfully...');
        return back();
    }
}
