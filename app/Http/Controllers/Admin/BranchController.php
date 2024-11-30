<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $src = $request->src;

        $items = Branch::select('id', 'name', 'phone', 'email', 'address');

        if(isset($request->eid))
            $update =  Branch::find($request->eid);

        if(isset($src))
            $items = $items->where('name', 'like', '.$src.');

        $items = $items->get();

        return view('backend.pages.contacts.branch', compact('items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
        ]);

        Branch::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Branch added successfully');
        return redirect()->route('admin.contact.branch.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
        ]);

        Branch::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Branch updated successfully');
        return redirect()->route('admin.contact.branch.index');
    }

    public function trash($id)
    {
        Branch::find($id)->delete();

        flash()->success('Branch data deleted successfully');
        return redirect()->route('admin.contact.branch.index');
    }
}
