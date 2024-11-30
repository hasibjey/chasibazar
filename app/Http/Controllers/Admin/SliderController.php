<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminPermission;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SliderController extends Controller implements HasMiddleware
{
    protected $imageExtension = '.webp';
    protected $path = '/images/sliders/';
    protected $width = 1520;
    protected $height = 795;

    public static function middleware(): array
    {
        return [
            new Middleware(CheckAdminPermission::class . ':slider view', only: ['index']),
            new middleware(CheckAdminPermission::class . ':slider create', only: ['store']),
            new middleware(CheckAdminPermission::class . ':slider update', only: ['update']),
            new middleware(CheckAdminPermission::class . ':slider delete', only: ['trash']),
        ];
    }

    public function index(Request $request)
    {
        $update = null;

        $items = Slider::select('id', 'image', 'position', 'status')->orderBy('position', 'ASC')->get();

        if(isset($request->eid))
            $update = Slider::find($request->eid);

        return view('backend.pages.slider', compact('items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required'],
            'position' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = date('YmdHms');
            $imageUrl = $this->path . $imageName . $this->imageExtension;
            Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);
        }

        Slider::insert([
            'image' => $imageUrl,
            'position' => $request->position,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);


        flash()->success('Slider added successfully..');
        return redirect()->route('admin.slider.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Slider::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Slider status updated successfully');
        return redirect()->route('admin.slider.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'position' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
        ]);

        $item = Slider::find($request->id);
        $imageUrl = empty($item)? null : $item->image;
        if ($request->hasFile('image')) {
            if (file_exists(public_path($item->image))) {
                unlink(public_path($item->image));

                $image = $request->file('image');
                $imageName = date('YmdHms');
                $imageUrl = $this->path . $imageName . $this->imageExtension;
                Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);
            }
            else
            {
                flash()->success('Slider image not found...!');
                return redirect()->route('admin.slider.index');
            }
        }

        Slider::find($request->id)->update([
            'image' => $imageUrl,
            'position' => $request->position,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);


        flash()->success('Slider data updated successfully..');
        return redirect()->route('admin.slider.index');
    }

    public function trash($id)
    {
        $item = Slider::find($id);
        if (file_exists(public_path($item->image)))
            unlink(public_path($item->image));

        $item->delete();

        flash()->success('Slider data deleted successfully');
        return redirect()->route('admin.slider.index');
    }
}
