<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.auth.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5']
        ]);

        $auth = Auth::guard('admin')->user();

        User::find($auth->id)->update([
            'name' => $request->name
        ]);

        flash()->success('Your information updated successfully');
        return redirect()->route('admin.profile.create');
    }

    public function change(Request $request)
    {
        $request->validate([
            'current_password' => ['required']
        ]);

        $auth = Auth::guard('admin')->user();

        if(!password_verify($request->current_password, $auth->password))
        {
            flash()->error('Current password are not matching..!');
            return redirect()->route('admin.profile.create');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::find($auth->id)->update([
            'password' => Hash::make($request->password)
        ]);

        flash()->success('Change your password successfully');

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
