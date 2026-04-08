<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Introduce;
use App\Services\AdminService;

class ClientIntroduceController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $lang = App::getLocale();
        $titlePage = __('system.gioithieu');
        $introduce = Introduce::first();
        $content = $this->adminService->convertOembedToIframe(data_get($introduce,'content_'.$lang));
        return view('client.introduce',[
            'titlePage' => $titlePage,
            'content' => $content
        ]);
    }
}
