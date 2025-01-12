<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Labor;
use App\Models\Page;
use App\Models\Service;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->paginate ?? 20;
        $src = $request->src ?? null;
        $update = null;
        $eid = $request->eid;
        $service = Service::where('title', 'like', '%labor%')->select('id', 'title')->first();

        $items = Labor::orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        if(isset($eid))
            $update = labor::find($eid);

        return view('backend.pages.labor', compact('items', 'update', 'service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'shift' => ['required'],
            'cost' => 'required',
            'description' => 'required',
        ]);

        Labor::insert([
            'service_id' => $request->service,
            'type' => $request->type,
            'shift' => $request->shift,
            'cost' => $request->cost,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        flash()->success('Labor added successfully..');
        return redirect()->route('admin.services.labors.index');
    }

    public function edit($id)
    {
        $item = Page::find($id);

        return view();
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Labor::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Labor status updated successfully');
        return redirect()->route('admin.services.labors.index');
    }


    public function update(Request $request)
    {
        Labor::find($request->id)->update([
            'type' => $request->type,
            'shift' => $request->shift,
            'cost' => $request->cost,
            'description' => $request->description,
        ]);

        flash()->success('Labor updated successfully..');
        return redirect()->route('admin.services.labors.index');
    }


    public function trash($id)
    {
        $item = Labor::find($id)->delete();

        flash()->success('Labor data deleted successfully...');
        return redirect()->route('admin.services.labors.index');
    }
}
