<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Blog;
use App\Services\AdminService;

class ClientBlogController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $titlePage = "Blog";
        $blogs = Blog::orderBy('created_at','desc')->paginate(20);
        return view('client.blog',[
            'titlePage' => $titlePage,
            'blogs' => $blogs
        ]);
    }

    public function detail($slug){
        $lang = App::getLocale();
        $blog = Blog::where('slug',$slug)->firstOrFail();
        $titlePage = data_get($blog,'name_'.$lang);
        $content = $this->adminService->convertOembedToIframe(data_get($blog,'content_'.$lang));
        $imageShare = "";
        if (!empty($blog->image)){
            $imageShare = asset('storage/blogs/' . basename($blog->image));
        }
        return view('client.blog-detail',[
            'titlePage' => $titlePage,
            'content' => $content,
            'imageShare' => $imageShare
        ]);
    }
}
