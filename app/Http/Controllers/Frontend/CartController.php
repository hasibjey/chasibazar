<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Backend;
use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $data['user_id'] = $request->user_id;
        $data['customer_id'] = $request->customer_id;
        $data['pid'] = $request->product_id;
        $data['title'] = $request->product_title;
        $data['maxQuantity'] = $request->maxQuantity;
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

    public function update(Request $request)
    {
        $items = Cart::Items();
        foreach ($items as $key => &$item) {
            if($item['pid'] === $request->id)
            {
                $oldPrice = $item['price'];
                $oldItemTotal = $item['total'];
                $quantity = $request->quantity;
                $item["maxQuantity"] = ($item["maxQuantity"] + $item["quantity"]) - $quantity;
                $item["quantity"] = $quantity;
                $newItemTotal = $item['price'] * $quantity;
                $item['total'] = $newItemTotal;

                $product = Product::find($request->id);
                $product->update([
                    'quantity' => $item["maxQuantity"]
                ]);

                $subTotal = (session()->get('cart.subTotal') - $oldItemTotal) + $newItemTotal;
                break;
            }
        }

        session()->forget('cart.items');
        session()->put('cart.items', $items);
        session()->put('cart.subTotal', $subTotal);

        $response = [
            'items' => Cart::Items(),
            'subTotal' => Cart::SubTotal(),
            'other' => $items
        ];

        return response()->json($response);
    }

    public function checkout()
    {
        $divisions = DB::table('divisions')->get();
        $address = Address::where('user_id', Auth::guard('customer')->user()->id)->with(['Division', 'District'])->first();
        if(!empty($address))
            session()->put('cart.address.address_id', $address->id);

        return view('customer.page.checkout', compact('divisions', 'address'));
    }

    public function districts(Request $request)
    {
        $districts = DB::table('districts')->where('division_id', $request->division)->get();
        return response()->json($districts);
    }

    public function order()
    {
        $items = Cart::Items();
        $address = Cart::Address()['address_id'];

        $invoice = Order::latest()->first()->invoice ?? 1;

        $order = Order::insertGetId([
            'invoice' => $invoice + 1,
            'address_id' => $address,
            'discount' => 0,
            'shipping_cost' => 0,
            'grant_total' => Cart::SubTotal(),
            'created_at' => Carbon::now(),
        ]);

        foreach ($items as $key => $item) {
            OrderProduct::insert([
                'order_id' => $order,
                'product_id' => $item['pid'],
                'quantity' => $item['quantity'],
                'rate' => $item['price'],
                'line_total' => $item['total'],
                'created_at' => Carbon::now(),
            ]);
        }


        flash()->success('Your order successfully..');
        return redirect()->route('home');


    }
}
