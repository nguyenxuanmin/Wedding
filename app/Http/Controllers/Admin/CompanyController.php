<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Services\AdminService;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $company = Company::first();
        return view('admin.company.main',[
            'company' => $company
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $address = $request->address;
        $hotline = $request->hotline;
        $email = $request->email;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $youtube = $request->youtube;
        $fanpageId = $request->fanpageId;
        if (isset($_FILES["logo"])) {
            $logo = $_FILES["logo"]["name"];
        }else{
            $logo = "";
        }
        if (isset($_FILES["favicon"])) {
            $favicon = $_FILES["favicon"]["name"];
        }else{
            $favicon = "";
        }
        
        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên công ty không được để trống.'
            ]);
        }

        $company = Company::find($request->id);

        if (!empty($logo)) {
            $imagePath = 'company/logo/'.$company->logo;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $messageError = $this->adminService->generateImage($_FILES["logo"],'company/logo');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }else{
            $logo = $company->logo;
        }

        if (!empty($favicon)) {
            $imagePath = 'company/favicon/'.$company->favicon;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $messageError = $this->adminService->generateImage($_FILES["favicon"],'company/favicon');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }else{
            $favicon = $company->favicon;
        }
        
        $company->name = $name;
        $company->address = $address;
        $company->hotline = $hotline;
        $company->email = $email;
        $company->facebook = $facebook;
        $company->instagram = $instagram;
        $company->youtube = $youtube;
        $company->fanpage_id = $fanpageId;
        $company->logo = $logo;
        $company->favicon = $favicon;
        $company->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
