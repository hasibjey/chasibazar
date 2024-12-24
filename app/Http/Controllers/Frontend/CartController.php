<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $data['user_id'] = $request->user_id;
        $data['customer_id'] = $request->customer_id;
        $data['pid'] = $request->product_id;
        $data['title'] = $request->product_title;
        $data['quantity'] = $request->product_quantity;
        $data['unit'] = $request->product_unit;
        $data['price'] = $request->product_price;
        $data['total'] = $request->totalPrice;

        session()->push('cart.items', $data);
        $this->subTotal($request->totalPrice);

        $product = Product::find($request->product_id);
        $quantity = $product->quantity - $request->product_quantity;
        $product->update([
            'quantity' => $quantity
        ]);

        $count = Cart::Count();
        $htmlDom = $this->cartDom();
        $subTotal = Cart::SubTotal();

        $response = [
            'message' => 'success',
            'count' => $count,
            'cart' => $htmlDom,
            'subTotal' => $subTotal,
        ];

        return response()->json($response);
    }

    public function cartDom()
    {
        $items = Cart::Items();
        $htmlDom = '';
        foreach ($items as $key => $item) {
            $htmlDom .= '<li class="px-3 border-b py-2">
                        <h2 class="text-xl font-semibold capitalize">'. $item['title'] . '</h2>
                        <p class="text-xs text-primary font-semibold">' . $item['quantity'] . $item['unit'] . ' X ' . $item['price'] . ' = ' . $item['total'] . ' TK</p>
                    </li>';
        }

        return $htmlDom;
    }

    public function subTotal($amount)
    {
        if(session()->has('cart'))
        {
            $subTotal = session()->get('cart.subTotal');
            $subTotal += $amount;
            session()->put('cart.subTotal', $subTotal);
        }
    }

    public function cart()
    {
        return view('customer.page.cart');
    }
}
