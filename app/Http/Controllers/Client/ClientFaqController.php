<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Faq;
use App\Services\AdminService;

class ClientFaqController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $lang = App::getLocale();
        $titlePage = 'FAQ';
        $faq = Faq::first();
        $content = $this->adminService->convertOembedToIframe(data_get($faq,'content_'.$lang));
        return view('client.faq',[
            'titlePage' => $titlePage,
            'content' => $content
        ]);
    }
}
