<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Wedding;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->limit(4)->get();
        $weddings = Wedding::with('weddingPhotos')->orderBy('created_at','desc')->limit(12)->get();
        return view('client.index',[
            'sliders' => $sliders,
            'weddings' => $weddings
        ]);
    }
}
