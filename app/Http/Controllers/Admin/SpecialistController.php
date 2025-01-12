<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Specialist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $paginate = $paginate->paginate ?? 20;
        $src = $request->src ?? null;
        $eid = $request->eid ?? null;
        $service = Service::where('title', 'like', '%specialist%')->select('id', 'title')->first();

        $items = Specialist::select()->orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        if(isset($request->eid))
            $update = Specialist::find($eid);

        return view('backend.pages.specialist', compact('items', 'service', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        Specialist::insert([
            'service_id' => $request->service,
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Specialist added successfully..');
        return redirect()->route('admin.services.specialist.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Specialist::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Specialist status updated successfully');
        return redirect()->route('admin.services.specialist.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Specialist::find($request->id)->update([
            'service_id' => $request->service,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        flash()->success('Specialist updated successfully..');
        return redirect()->route('admin.services.specialist.index');
    }

    public function trash($id)
    {
        $item = Specialist::find($id)->delete();

        flash()->success('Specialist data deleted successfully...');
        return redirect()->route('admin.services.specialist.index');
    }
}
