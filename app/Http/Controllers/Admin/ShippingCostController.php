<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipmentCost;
use App\Models\ShippingCost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingCostController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $eid = $request->eid;

        $items = ShippingCost::get();

        if(isset($eid))
            $update = ShippingCost::find($eid);

        return view('backend.pages.shipping', compact('update', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cost' => 'required'
        ]);

        ShippingCost::insert([
            'title' => $request->title,
            'cost' => $request->cost,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Shipping cost added successfully..');
        return redirect()->route('admin.setting.shipping.index');
    }

    public function update(Request $request)
    {
        ShippingCost::find($request->id)->update([
            'title' => $request->title,
            'cost' => $request->cost,
        ]);

        flash()->success('Shipping cost updated successfully..');
        return redirect()->route('admin.setting.shipping.index');
    }

    public function trash($id)
    {
        ShippingCost::find($id)->delete();
        flash()->success('Shipping cost deleted successfully');
        return redirect()->route('admin.setting.shipping.index');
    }
}
