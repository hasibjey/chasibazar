<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Labor;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function labor()
    {
        $item = Service::where('title', 'like', '%labor%')->with('Labor')->first();

        return view('frontend.pages.service', compact('item'));
    }

    public function laborCreate()
    {
        $item = Service::where('title', 'like', '%labor%')->first();
        return view('frontend.pages.labor_booking', compact('item'));
    }

    public function specialist()
    {
        $item = Service::where('title', 'like', '%specialist%')->with('Specialist')->first();

        return view('frontend.pages.specialist', compact('item'));
    }

    public function specialistCreate()
    {
        $item = Service::where('title', 'like', '%labor%')->first();
        return view('frontend.pages.labor_booking', compact('item'));
    }

    public function event()
    {
        $item = Service::where('title', 'like', '%event%')->with('Event')->first();

        return view('frontend.pages.event', compact('item'));
    }
}
