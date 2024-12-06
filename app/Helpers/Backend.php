<?php

namespace App\Helpers;

use App\Models\AffiliatePayment;
use App\Models\Order;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Backend
{
    public static function GetAdmin()
    {
        return Auth::guard('admin')->user();
    }

    public static function Slug($string)
    {
        $string = preg_replace('/[!@#$%^&*()_.\-+=?><|":;\,\'\/~`}{\][\\\]/', '_', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = str_replace(' ', '_', $string);
        $string = preg_replace('/_{2,}/', '_', $string);
        $string = rtrim($string, '_');
        $string = ltrim($string, '_');
        return Str::lower($string);
    }

    public static function ImageUpload($image, $width, $height, $imageUrl)
    {
        $imageManager = new ImageManager(new Driver());
        $img = $imageManager->read($image->getRealPath());
        $img->resize($width, $height, function ($constraints) {
            $constraints->aspectRatio();
        })->toWebp(90)->save(public_path($imageUrl));
    }

    public static function summernoteImageDelete($description)
    {
        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $imgSrc = $img->getAttribute('src');
            if (file_exists(public_path($imgSrc))) {
                unlink(public_path($imgSrc));
            }
        }
    }
}
