<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Album;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->limit(4)->get();
        $albums = Album::with('albumPhotos')->orderBy('created_at','desc')->limit(16)->get();
        return view('client.index',[
            'sliders' => $sliders,
            'albums' => $albums
        ]);
    }

    public function sendContact(Request $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $content = $request->content;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => __('system.name') . ' ' . __('system.not_empty')
            ]);
        }

        if (empty($email)) {
            return response()->json([
                'success' => false,
                'message' => __('system.email') . ' ' . __('system.not_empty')
            ]);
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'success' => false,
                    'message' => $email. ' ' . __('system.email') . ' ' . __('system.invalid')
                ]);
            }
        }

        $contactExist = Contact::where('email', $email)->first();
        if ($contactExist) {
            return response()->json([
                'success' => false,
                'message' => __('system.email') . ' ' . __('system.exist')
            ]);
        }

        if (empty($phone)) {
            return response()->json([
                'success' => false,
                'message' => __('system.phone') . ' ' . __('system.not_empty')
            ]);
        }else{
            if (!preg_match('/^(0|\+84)[0-9]{9}$/', $phone)) {
                return response()->json([
                    'success' => false,
                    'message' => __('system.phone') . ' ' . __('system.invalid')
                ]);
            }
        }

        $contact = new Contact();
        $contact->name = $name;
        $contact->email = $email;
        $contact->phone = $phone;
        $contact->content = $content;
        $contact->save();

        return response()->json([
            'success' => true,
            'message' => __('system.success')
        ]);
    }
}
