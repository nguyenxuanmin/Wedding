<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientFacebookServiceController extends Controller
{
    public function privacyPolicy(){
        $titlePage = 'Privacy Policy';
        return view('client.facebook.privacy-policy',[
            'titlePage' => $titlePage
        ]);
    }

    public function dataDeletion(){
        $titlePage = 'Data Deletion';
        return view('client.facebook.data-deletion',[
            'titlePage' => $titlePage
        ]);
    }
}
