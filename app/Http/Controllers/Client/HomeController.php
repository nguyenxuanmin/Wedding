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
        $phone = $request->phone;
        $event_date = $request->event_date;
        $event_service = $request->event_service;
        $event_location = $request->event_location;
        $event_cost = $request->event_cost;
        $content = $request->content;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => __('system.name') . ' ' . __('system.not_empty')
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

        if (empty($event_date)) {
            return response()->json([
                'success' => false,
                'message' => __('system.event_date') . ' ' . __('system.not_empty')
            ]);
        }

        if (empty($event_cost)) {
            $event_cost = 0;
        }

        $contact = new Contact();
        $contact->name = $name;
        $contact->phone = $phone;
        $contact->event_date = $event_date;
        $contact->event_service = $event_service;
        $contact->event_location = $event_location;
        $contact->event_cost = $event_cost;
        $contact->content = $content;
        $contact->save();

        return response()->json([
            'success' => true,
            'message' => __('system.success')
        ]);
    }
}
