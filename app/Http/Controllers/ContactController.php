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
        return view('admin.contact.edit', compact('contact', 'pagetitle'));
    }

   
    public function update(Request $request)
    {
        $contact = Contact::where('id', 1)->first();
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/contact');
            $request->merge(['image' => basename($imagePath)]);
        }else{
            $request->merge(['image' => $contact->image]);
        }
        $contact->update($request->all());
        return back()->with('success', 'Contact updated successfully');
    }

}
