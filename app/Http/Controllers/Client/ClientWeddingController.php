<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Wedding;
use App\Services\AdminService;

class ClientWeddingController extends Controller
{   
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $titlePage = __('system.anhcuoi');
        $weddings = Wedding::with('weddingPhotos')->orderBy('created_at','desc')->paginate(20);
        return view('client.wedding',[
            'titlePage' => $titlePage,
            'weddings' => $weddings
        ]);
    }

    public function detail($slug){
        $lang = App::getLocale();
        $wedding = Wedding::with('weddingPhotos')->where('slug',$slug)->firstOrFail();
        $titlePage = data_get($wedding,'name_'.$lang);
        $content = $this->adminService->convertOembedToIframe(data_get($wedding,'content_'.$lang));
        return view('client.wedding-detail',[
            'titlePage' => $titlePage,
            'wedding' => $wedding,
            'content' => $content
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $titlePage = __('system.ketquatimkiem') . ': ' . $infoSearch;
        $weddings = Wedding::with('weddingPhotos')
        ->where('name_vi','LIKE','%'.$infoSearch.'%')
        ->orWhere('name_en','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('client.wedding',[
            'titlePage' => $titlePage,
            'weddings' => $weddings,
            'infoSearch' => $infoSearch
        ]);
    }
}
