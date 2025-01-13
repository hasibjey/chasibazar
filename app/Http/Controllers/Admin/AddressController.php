<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'division' => 'required',
            'district' => 'required',
            'address' => 'required',
        ]);

        Address::updateOrInsert(
            [
                'user_id' => Auth::guard('customer')->user()->id,
            ],
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'division_id' => $request->division,
                'district_id' => $request->district,
                'address' => $request->address,
                'note' => $request->note,
            ]
        );

        $division = DB::table('divisions')->find($request->division);
        $district = DB::table('districts')->find($request->district);

        $data['address_id'] = Address::where('user_id', Auth::guard('customer')->user()->id)->first()->id;
        $data['user_id'] = Auth::guard('customer')->user()->id;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['division'] = $division->name;
        $data['division_id'] = $request->division;
        $data['district'] = $district->name;
        $data['district_id'] = $request->district;
        $data['address'] = $request->address;
        $data['note'] = $request->note;

        session()->put('cart.address', $data);

        flash()->success('address added successfully..');
        return back();
    }
}
