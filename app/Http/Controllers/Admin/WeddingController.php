<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wedding;
use App\Models\WeddingPhoto;
use App\Services\AdminService;

class WeddingController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $weddings = Wedding::with('weddingPhotos')->orderBy('created_at','desc')->paginate(20);
        return view('admin.wedding.list',[
            'weddings' => $weddings,
            'infoSearch' => ""
        ]);
    }

    public function add(){
        $titlePage = "Thêm ảnh cưới";
        $action = "add";
        return view('admin.wedding.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa ảnh cưới";
        $action = "edit";
        $wedding = Wedding::with('weddingPhotos')->find($id);
        return view('admin.wedding.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'wedding' => $wedding
        ]);
    }

    public function save(Request $request){
        $nameVi = $request->nameVi;
        $contentVi = $request->contentVi;
        $nameEn = $request->nameEn;
        $contentEn = $request->contentEn;
        $slug = $this->adminService->generateSlug($nameVi);
        $imageWeddings = $request->file('imageWedding');
        $action = $request->action;

        if (empty($nameVi)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề ảnh cưới tiếng Việt không được để trống.'
            ]);
        }

        if (empty($nameEn)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề ảnh cưới tiếng Anh không được để trống.'
            ]);
        }

        if($action == "edit"){
            $weddingExist = Wedding::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $weddingExist = Wedding::where('slug',$slug)->first();
        }
        
        if (isset($weddingExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề ảnh cưới đã tồn tại.'
            ]);
        }

        if ($action != "edit" && empty($imageWeddings)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn tối thiểu 1 ảnh.'
            ]);
        }

        if($action == "edit"){
            $wedding = Wedding::find($request->id);
        }else{
            $wedding = new Wedding();
        }
        
        $wedding->name_vi = $nameVi;
        $wedding->content_vi = $contentVi;
        $wedding->slug = $slug;
        $wedding->name_en = $nameEn;
        $wedding->content_en = $contentEn;
        $wedding->save();

        if(!empty($imageWeddings)){
            foreach ($imageWeddings as $file) {
                if ($file->isValid()) {
                    $nameFile = $file->getClientOriginalName();
                    $typeFile = $file->getClientOriginalExtension();
                    $nameOnly = pathinfo($nameFile, PATHINFO_FILENAME);
                    $newNameFile = time() . '_' . $nameOnly . '.' . $typeFile;
                    $uploadDir = public_path('storage/weddings/');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $file->move($uploadDir, $newNameFile);
                    $fileWeddingPhoto = new WeddingPhoto();
                    $fileWeddingPhoto->image = $newNameFile;
                    $fileWeddingPhoto->wedding_id = $wedding->id;
                    $fileWeddingPhoto->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $wedding = Wedding::with('weddingPhotos')->find($request->id);
        foreach ($wedding->weddingPhotos as $weddingPhoto) {
            $imagePath = public_path('storage/weddings/' . $weddingPhoto->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $wedding->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function deleteWeddingPhoto(Request $request){
        $weddingPhoto = WeddingPhoto::find($request->id);
        $imagePath = public_path('storage/weddings/' . $weddingPhoto->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $weddingPhoto->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $weddings = Wedding::with('weddingPhotos')
        ->where('name_vi','LIKE','%'.$infoSearch.'%')
        ->orWhere('name_en','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('admin.wedding.list',[
            'infoSearch' => $infoSearch,
            'weddings' => $weddings
        ]);
    }
}
