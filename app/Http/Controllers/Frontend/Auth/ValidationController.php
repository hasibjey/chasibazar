<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class ValidationController extends Controller
{
    public function index()
    {
        return view('frontend.auth.verified');
    }

    public function store(Request $request)
    {
        Frontend::OTPGenerator($request->email);

        $token = Crypt::encrypt($request->email);

        return redirect()->route('validation', [$token]);
    }

    public function validation($token)
    {
        $email = Crypt::decrypt($token);
        return view('frontend.auth.verification', compact('email'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $code = $request->code[0]. $request->code[1]. $request->code[2]. $request->code[3];

        if(!empty(otp::where('title', Auth::guard('web')->user()->email)->where('code', $code)->first()))
        {
            Otp::where('title', Auth::guard('web')->user()->email)->delete();
            User::find(Auth::guard('web')->user()->id)->update([
                'email_verified_at' => Carbon::now()
            ]);
            return redirect()->route('user.dashboard');
        }
        else
        {
            flash()->error('Verification code are not matching..!');
            return back();
        }


    }
}
