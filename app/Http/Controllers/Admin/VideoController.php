<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Services\AdminService;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $videos = Video::orderBy('created_at','desc')->paginate(20);
        return view('admin.video.list',[
            'videos' => $videos,
            'infoSearch' => ""
        ]);
    }

    public function add(){
        $titlePage = "Thêm video";
        $action = "add";
        return view('admin.video.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa video";
        $action = "edit";
        $video = Video::find($id);
        return view('admin.video.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'video' => $video
        ]);
    }

    public function save(Request $request){
        $nameVi = $request->nameVi;
        $contentVi = $request->contentVi;
        $nameEn = $request->nameEn;
        $contentEn = $request->contentEn;
        $slug = $this->adminService->generateSlug($nameVi);
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
        $action = $request->action;

        if (empty($nameVi)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề video tiếng Việt không được để trống.'
            ]);
        }

        if (empty($nameEn)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề video tiếng Anh không được để trống.'
            ]);
        }

        if($action == "edit"){
            $videoExist = Video::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $videoExist = Video::where('slug',$slug)->first();
        }
        
        if (isset($videoExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề video đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $video = Video::find($request->id);
        }else{
            $video = new Video();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = public_path('storage/videos/' . $video->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'videos');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if($action == "edit"){
            if (!$request->hasFile('image')) {
                $image = $video->image;
            }
        }
        
        $video->name_vi = $nameVi;
        $video->content_vi = $contentVi;
        $video->slug = $slug;
        $video->name_en = $nameEn;
        $video->content_en = $contentEn;
        $video->image = $image;
        $video->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $video = Video::find($request->id);
        $imagePath = public_path('storage/videos/' . $video->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $video->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $videos = Video::where('name_vi','LIKE','%'.$infoSearch.'%')
        ->orWhere('name_en','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('admin.video.list',[
            'infoSearch' => $infoSearch,
            'videos' => $videos
        ]);
    }
}
