<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function show(){
        $faq = Faq::first();
        return view('admin.faq.main',[
            'faq' => $faq
        ]);
    }

    public function save(Request $request){
        $contentVi = $request->contentVi;
        $contentEn = $request->contentEn;

        $existFaq = Faq::first();
        if (isset($existFaq)) {
            $faq = Faq::find($existFaq->id);
        } else {
            $faq = new Faq();
        }
        
        $faq->content_vi = $contentVi;
        $faq->content_en = $contentEn;
        $faq->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
