<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $item = Contact::first();
        return view('backend.pages.contacts.contact', compact('item'));
    }

    public function update(Request $request)
    {
        Contact::find($request->id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'alterPhone' => $request->alter_phone,
            'whatsapp' => $request->whatsapp_number,
            'calling_hours' => $request->calling_hours,
        ]);

        flash()->success('Contact information successfully...');
        return back();
    }
}
