<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $imageExtension = '.webp';
    protected $path = '/images/services/';
    protected $width = 488;
    protected $height = 580;
    protected $heroPath = '/images/hero/';
    protected $heroWidth = 1550;
    protected $heroHeight = 250;

    public function index(Request $request)
    {
        $update = null;
        $paginate = $request->paginate ?? 20;
        $src = $request->src ?? null;
        $eid = $request->eid ?? null;

        $items = Service::select()->orderBy('created_at', 'DESC');
        $items = $items->paginate($paginate);

        if(isset($eid))
            $update = Service::find($eid);

        return view('backend.pages.service', compact('items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:services,title'],
            'image' => ['required'],
            'hero_image' => ['required'],
            'description' => ['required']
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Backend::Slug($request->title);
            $imageUrl = $this->path . $imageName . $this->imageExtension;
            Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);
        }
        $heroImageUrl = null;
        if ($request->hasFile('hero_image')) {
            $HeroImage = $request->file('hero_image');
            $imageName = Backend::Slug($request->title);
            $heroImageUrl = $this->heroPath . $imageName . $this->imageExtension;
            Backend::ImageUpload($HeroImage, $this->heroWidth, $this->heroHeight, $heroImageUrl);
        }

        Service::insert([
            'title' => $request->title,
            'slug' => Backend::Slug($request->title),
            'image' => $imageUrl,
            'description' => $request->description,
            'hero_image' => $heroImageUrl,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Service added successfully..');
        return redirect()->route('admin.services.index');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Service::find($request->id)->update([
            'status' => !$request->status
        ]);

        flash()->success('Service status updated successfully');
        return redirect()->route('admin.services.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $item = Service::find($request->id);
        $imageUrl = empty($item) ? null : $item->image;
        if ($request->hasFile('image')) {
            if (file_exists(public_path($item->image)))
                unlink(public_path($item->image));

            $image = $request->file('image');
            $imageName = Backend::Slug($request->title);
            $imageUrl = $this->path . $imageName . $this->imageExtension;
            Backend::ImageUpload($image, $this->width, $this->height, $imageUrl);
        }

        $heroImageUrl = empty($item) ? null : $item->hero_image;
        if ($request->hasFile('hero_image')) {
            if (file_exists(public_path($item->hero_image)))
                unlink(public_path($item->hero_image));

            $HeroImage = $request->file('hero_image');
            $imageName = Backend::Slug($request->title);
            $heroImageUrl = $this->heroPath . $imageName . $this->imageExtension;
            Backend::ImageUpload($HeroImage, $this->heroWidth, $this->heroHeight, $heroImageUrl);
        }

        Service::find($request->id)->update([
            'title' => $request->title,
            'slug' => Backend::Slug($request->title),
            'image' => $imageUrl,
            'description' => $request->description,
            'hero_image' => $heroImageUrl,
            'created_at' => Carbon::now(),
        ]);

        flash()->success('Service updated successfully..');
        return redirect()->route('admin.services.index');
    }

    public function trash($id)
    {
        $item = Service::find($id);
        if (file_exists(public_path($item->image)))
            unlink(public_path($item->image));

        if (file_exists(public_path($item->hero_image)))
            unlink(public_path($item->hero_image));

        $item->delete();

        flash()->success('Service data deleted successfully...');
        return redirect()->route('admin.services.index');
    }
}
