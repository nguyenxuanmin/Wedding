<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Album;
use App\Services\AdminService;

class ClientAlbumController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $titlePage = "Album";
        $albums = Album::with('albumPhotos')->orderBy('created_at','desc')->paginate(20);
        return view('client.album',[
            'titlePage' => $titlePage,
            'albums' => $albums
        ]);
    }

    public function detail($slug){
        $lang = App::getLocale();
        $album = Album::with('albumPhotos')->where('slug',$slug)->firstOrFail();
        $titlePage = data_get($album,'name_'.$lang);
        $content = $this->adminService->convertOembedToIframe(data_get($album,'content_'.$lang));
        $imageShare = "";
        if (count($album->albumPhotos)){
            $imageShare = asset('storage/albums/' . basename($album->albumPhotos[0]->image));
        }
        return view('client.album-detail',[
            'titlePage' => $titlePage,
            'album' => $album,
            'content' => $content,
            'imageShare' => $imageShare
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $titlePage = __('system.ketquatimkiem') . ': ' . $infoSearch;
        $albums = Album::with('albumPhotos')
        ->where('name_vi','LIKE','%'.$infoSearch.'%')
        ->orWhere('name_en','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('client.album',[
            'titlePage' => $titlePage,
            'albums' => $albums,
            'infoSearch' => $infoSearch
        ]);
    }
}
