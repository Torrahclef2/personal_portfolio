<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   
    public function index()
    {
        $contact = Contact::where('id', 1)->first();
        return response()->json($contact);
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
        return response()->json(['message' => 'Contact updated successfully', 'contact' => $contact], 200);
    }

}
