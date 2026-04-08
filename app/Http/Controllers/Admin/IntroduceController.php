<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Introduce;

class IntroduceController extends Controller
{
    public function show(){
        $introduce = Introduce::first();
        return view('admin.introduce.main',[
            'introduce' => $introduce
        ]);
    }

    public function save(Request $request){
        $contentVi = $request->contentVi;
        $contentEn = $request->contentEn;

        $existIntroduce = Introduce::first();
        if (isset($existIntroduce)) {
            $introduce = Introduce::find($existIntroduce->id);
        } else {
            $introduce = new Introduce();
        }
        
        $introduce->content_vi = $contentVi;
        $introduce->content_en = $contentEn;
        $introduce->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
