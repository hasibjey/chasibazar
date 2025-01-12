<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $paginate = $paginate->paginate ?? 20;
        $src = $request->src ?? null;
        $eid = $request->eid ?? null;
        $service = Service::where('title', 'like', '%event%')->select('id', 'title')->first();

        $items = Event::select('id', 'title', 'type', 'timestamp', 'description')->orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        if (isset($request->eid))
            $update = Event::find($eid);

        return view('backend.pages.event', compact('items', 'service', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'title' => 'required',
            'type' => 'required',
            'time' => 'required',
            'description' => 'required',
        ]);

        Event::insert([
            'service_id' => $request->service,
            'title' => $request->title,
            'type' => $request->type,
            'timestamp' => $request->time,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Event added successfully..');
        return redirect()->route('admin.services.events.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Event::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Event status updated successfully');
        return redirect()->route('admin.services.events.index');
    }

    public function update(Request $request)
    {
        Event::find($request->id)->update([
            'service_id' => $request->service,
            'title' => $request->title,
            'type' => $request->type,
            'timestamp' => $request->time,
            'description' => $request->description,
        ]);

        flash()->success('Event updated successfully..');
        return redirect()->route('admin.services.events.index');
    }

    public function trash($id)
    {
        $item = event::find($id)->delete();

        flash()->success('Event data deleted successfully...');
        return redirect()->route('admin.services.events.index');
    }
}
