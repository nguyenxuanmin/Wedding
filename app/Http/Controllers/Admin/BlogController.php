<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Services\AdminService;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $blogs = Blog::orderBy('created_at','desc')->paginate(20);
        return view('admin.blog.list',[
            'blogs' => $blogs,
            'infoSearch' => ""
        ]);
    }

    public function add(){
        $titlePage = "Thêm blog";
        $action = "add";
        return view('admin.blog.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa blog";
        $action = "edit";
        $blog = Blog::find($id);
        return view('admin.blog.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'blog' => $blog
        ]);
    }

    public function save(Request $request){
        $nameVi = $request->nameVi;
        $descriptionVi = $request->descriptionVi;
        $contentVi = $request->contentVi;
        $nameEn = $request->nameEn;
        $descriptionEn = $request->descriptionEn;
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
                'message' => 'Tiêu đề blog tiếng Việt không được để trống.'
            ]);
        }

        if (empty($nameEn)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề blog tiếng Anh không được để trống.'
            ]);
        }

        if($action == "edit"){
            $blogExist = Blog::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $blogExist = Blog::where('slug',$slug)->first();
        }
        
        if (isset($blogExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề blog đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $blog = Blog::find($request->id);
        }else{
            $blog = new Blog();
        }

        if (!empty($image)) {
            if($action == "edit"){
                if (app()->environment('local')) {
                    $imagePath = public_path('storage/blogs/' . $blog->image);
                } else {
                    $imagePath = base_path('../public_html/storage/blogs/' . $blog->image);
                }
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'blogs');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if($action == "edit"){
            if (!$request->hasFile('image')) {
                $image = $blog->image;
            }
        }
        
        $blog->name_vi = $nameVi;
        $blog->description_vi = $descriptionVi;
        $blog->content_vi = $contentVi;
        $blog->slug = $slug;
        $blog->name_en = $nameEn;
        $blog->description_en = $descriptionEn;
        $blog->content_en = $contentEn;
        $blog->image = $image;
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $blog = Blog::find($request->id);
        if (app()->environment('local')) {
            $imagePath = public_path('storage/blogs/' . $blog->image);
        } else {
            $imagePath = base_path('../public_html/storage/blogs/' . $blog->image);
        }
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $blog->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $blogs = Blog::where('name_vi','LIKE','%'.$infoSearch.'%')
        ->orWhere('name_en','LIKE','%'.$infoSearch.'%')
        ->orderBy('created_at','desc')->paginate(20);
        return view('admin.blog.list',[
            'infoSearch' => $infoSearch,
            'blogs' => $blogs
        ]);
    }
}
