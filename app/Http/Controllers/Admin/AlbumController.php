<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumPhoto;
use App\Services\AdminService;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $albums = Album::with('albumPhotos')->orderBy('created_at','desc')->paginate(20);
        return view('admin.album.list',[
            'albums' => $albums,
            'infoSearch' => ""
        ]);
    }

    public function add(){
        $titlePage = "Thêm album";
        $action = "add";
        return view('admin.album.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa album";
        $action = "edit";
        $album = Album::with('albumPhotos')->find($id);
        return view('admin.album.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'album' => $album
        ]);
    }

    public function save(Request $request){
        $nameVi = $request->nameVi;
        $contentVi = $request->contentVi;
        $nameEn = $request->nameEn;
        $contentEn = $request->contentEn;
        $slug = $this->adminService->generateSlug($nameVi);
        $imageAlbums = $request->file('imageAlbum');
        $action = $request->action;

        if (empty($nameVi)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề album tiếng Việt không được để trống.'
            ]);
        }

        if (empty($nameEn)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề album tiếng Anh không được để trống.'
            ]);
        }

        if($action == "edit"){
            $albumExist = Album::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $albumExist = Album::where('slug',$slug)->first();
        }
        
        if (isset($albumExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề album đã tồn tại.'
            ]);
        }

        if ($action != "edit" && empty($imageAlbums)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn tối thiểu 1 ảnh.'
            ]);
        }

        if($action == "edit"){
            $album = Album::find($request->id);
        }else{
            $album = new Album();
        }
        
        $album->name_vi = $nameVi;
        $album->content_vi = $contentVi;
        $album->slug = $slug;
        $album->name_en = $nameEn;
        $album->content_en = $contentEn;
        $album->save();

        if(!empty($imageAlbums)){
            foreach ($imageAlbums as $file) {
                if ($file->isValid()) {
                    $nameFile = $file->getClientOriginalName();
                    $typeFile = $file->getClientOriginalExtension();
                    $nameOnly = pathinfo($nameFile, PATHINFO_FILENAME);
                    $newNameFile = time() . '_' . $nameOnly . '.' . $typeFile;
                    if (app()->environment('local')) {
                        $uploadDir = public_path('storage/albums/');
                    } else {
                        $uploadDir = base_path('../public_html/storage/albums/');
                    }
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $file->move($uploadDir, $newNameFile);
                    $fileAlbumPhoto = new AlbumPhoto();
                    $fileAlbumPhoto->image = $newNameFile;
                    $fileAlbumPhoto->album_id = $album->id;
                    $fileAlbumPhoto->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $album = Album::with('albumPhotos')->find($request->id);
        foreach ($album->albumPhotos as $albumPhoto) {
            if (app()->environment('local')) {
                $imagePath = public_path('storage/albums/' . $albumPhoto->image);
            } else {
                $imagePath = base_path('../public_html/storage/albums/' . $albumPhoto->image);
            }
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $album->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function deleteAlbumPhoto(Request $request){
        $albumPhoto = AlbumPhoto::find($request->id);
        
        if (app()->environment('local')) {
            $imagePath = public_path('storage/albums/' . $albumPhoto->image);
        } else {
            $imagePath = base_path('../public_html/storage/albums/' . $albumPhoto->image);
        }
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $albumPhoto->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $albums = Album::with('albumPhotos')
        ->where('name_vi','LIKE','%'.$infoSearch.'%')
        ->orWhere('name_en','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('admin.album.list',[
            'infoSearch' => $infoSearch,
            'albums' => $albums
        ]);
    }
}
