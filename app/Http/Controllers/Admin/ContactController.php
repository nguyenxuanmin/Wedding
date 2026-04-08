<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show(){
        $contacts = Contact::orderBy('created_at','desc')->paginate(20);
        return view('admin.contact.list',[
            'contacts' => $contacts,
            'infoSearch' => '',
        ]);
    }

    public function viewContact($id){
        $contact = Contact::find($id);
        if($contact && !$contact->is_read){
            $contact->is_read = true;
            $contact->save();
        }
        return view('admin.contact.view',[
            'contact' => $contact,
            'titlePage' => 'Chi tiết liên hệ'
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $contacts = Contact::where('name','LIKE','%'.$infoSearch.'%')
        ->orWhere('email','LIKE','%'.$infoSearch.'%')
        ->orWhere('phone','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('admin.contact.list',[
            'infoSearch' => $infoSearch,
            'contacts' => $contacts
        ]);
    }
}
