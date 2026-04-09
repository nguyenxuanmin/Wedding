<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Services\AdminService;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $sliders = Slider::orderBy('created_at','desc')->paginate(20);
        return view('admin.slider.list',[
            'sliders' => $sliders
        ]);
    }

    public function add(){
        $titlePage = "Thêm slider";
        $action = "add";
        return view('admin.slider.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa slider";
        $action = "edit";
        $slider = Slider::find($id);
        return view('admin.slider.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'slider' => $slider
        ]);
    }

    public function save(Request $request){
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
        $action = $request->action;

        if($action == "edit"){
            $slider = Slider::find($request->id);
        }else{
            if (empty($image)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hình ảnh slider không được để trống.'
                ]);
            }

            $slider = new Slider();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = base_path('../public_html/storage/sliders/' . $slider->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'sliders');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if (!$request->hasFile('image')) {
            $image = $slider->image;
        }
        
        $slider->image = $image;
        $slider->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $slider = Slider::find($request->id);
        $imagePath = base_path('../public_html/storage/sliders/' . $slider->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $slider->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
