<?php

namespace App\Helpers;

use App\Models\AffiliatePayment;
use App\Models\Order;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Cart
{
    public static function Items()
    {
        if (session()->has('cart')) {
            return session()->get('cart.items');
        }
    }

    public static function Count()
    {
        if(session()->has('cart'))
        {
            $cart = session()->get('cart.items');
            return count($cart);
        }

        return 0;
    }

    public static function SubTotal()
    {
        if (session()->has('cart'))
            return session()->get('cart.subTotal');

        return 0;
    }
}
