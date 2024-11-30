<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('frontend.auth.password-reset');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        Frontend::OTPGenerator($request->email);

        $token = Crypt::encrypt($request->email);

        return redirect()->route('password.verify.code', [$token]);
    }

    public function verify($token)
    {
        $email = Crypt::decrypt($token);
        return view('frontend.auth.password-verification', compact('email'));
    }

    public function verification(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $code = $request->code[0] . $request->code[1] . $request->code[2] . $request->code[3];

        if (!empty(otp::where('title', $request->email)->where('code', $code)->first())) {
            Otp::where('title', $request->email)->delete();
            $token = Crypt::encrypt($request->email);
            return redirect()->route('new.password', [$token]);
        } else {
            flash()->error('Verification code are not matching..!');
            return back();
        }
    }


    public function passwordForm($token)
    {
        $email = Crypt::decrypt($token);
        return view('frontend.auth.password-chenge', compact('email'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::where('email', $request->email)->where('type', 2)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login');
    }
}
