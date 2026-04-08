<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Video;
use App\Services\AdminService;

class ClientVideoController extends Controller
{   
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $titlePage = "Video";
        $videos = Video::orderBy('created_at','desc')->paginate(20);
        return view('client.video',[
            'titlePage' => $titlePage,
            'videos' => $videos
        ]);
    }

    public function detail($slug){
        $lang = App::getLocale();
        $video = Video::where('slug',$slug)->firstOrFail();
        $titlePage = data_get($video,'name_'.$lang);
        $content = $this->adminService->convertOembedToIframe(data_get($video,'content_'.$lang));
        return view('client.video-detail',[
            'titlePage' => $titlePage,
            'content' => $content
        ]);
    }
}
