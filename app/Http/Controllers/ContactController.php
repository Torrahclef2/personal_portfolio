<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   
    public function index()
    {
        $pagetitle = "Admin | Edit Contact";
        $contact = Contact::where('id', 1)->first();
        return view('admin.contact', compact('contact', 'pagetitle'));
    }

   
    public function update(Request $request)
    {
        $validatedData = $request->validate([
           'title' => 'required|string|max:255',
           'subtitle' => 'required|string|max:255',
           'description' => 'required|string',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
           'email' => 'required|email:rfc,dns',
           'phone_number' => 'required|string|max:255',
           'address' => 'required|string|max:255',
           'longitude' => 'required|numeric',
           'latitude' => 'required|numeric',
           'map_link' => 'required|string|max:255',
        ]);
       $contact = Contact::where('id', 1)->first();
        if ($request->hasFile('image')) {
            if ($contact->image) {
                $oldImagePath = public_path('uploads/contact/' . $contact->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image      = $request->file('image');
            $imageName  = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/contact'), $imageName);
            $validatedData['image'] = $imageName;
        }else {
            $validatedData['image'] = Contact::where('id', 1)->first()->image;
        }
        $contact->update($validatedData);

        return back()->with('success', 'Contact updated successfully');
    }

}
