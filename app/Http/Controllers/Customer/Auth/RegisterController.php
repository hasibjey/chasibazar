<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('customer.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'max:255', Rule::unique('users')->where(function ($query) use ($request) {
                return $query->where('role', 3);
            })],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'type' => 3,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('customer')->login($user);

        return redirect(route('customer.dashboard', absolute: false));
    }
}
