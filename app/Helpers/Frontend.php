<?php

namespace App\Helpers;

use App\Mail\passwordVerifyCode;
use App\Mail\verifyEmailCode;
use App\Models\Affiliate;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\Navigation;
use App\Models\otp;
use App\Models\SocialMedia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Frontend
{
    public static function Navigation()
    {
        return Category::with('SubCategories')->where('nav_status', 1)->get();
    }

    public static function Contact()
    {
        return Contact::first();
    }

    public static function Branch()
    {
        return Branch::select('name', 'email', 'phone', 'address')->limit(3)->get();
    }

    public static function OTPGenerator($email)
    {
        $otp = rand(1000, 9999);
        otp::updateOrInsert(
            ['title' => $email],
            [
                'code' => $otp,
                'created_at' => Carbon::now(),
            ]
        );
    }

    public static function currentUrl()
    {
        $host = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host .= "://" . $_SERVER['HTTP_HOST'];
        $path = strtok($_SERVER['REQUEST_URI'], '?');
        $currentUrl = $host . $path;
        return $currentUrl;
    }
}
