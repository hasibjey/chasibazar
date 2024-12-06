<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CommonController extends Controller
{
    public function summernoteImageUpload(Request $request)
    {
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = '/images/gallery/';
            $imageName = $path . Date('YmdHms') . '.webp';

            $imageManager = new ImageManager(new Driver());
            $img = $imageManager->read($image->getRealPath());
            $img->toWebp(90)->save(public_path($imageName));

            return $imageName;
        }
    }

    public function summernoteImageDelete(Request $request) {
        if (file_exists(public_path($request->image))) {
            unlink(public_path($request->image));
            return 'success';
        }
    }
}
