@extends('admin.layout.master-page')

@section('title')
    Giới thiệu
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Giới thiệu</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" data-url-submit="{{route('save_introduce')}}" data-url-complete="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <button class="btn btn-primary">Lưu</button>
                                </div>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Tiếng Việt
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nội dung</label>
                                                    <textarea name="contentVi" class="content-ckeditor">@if (isset($introduce)){{$introduce->content_vi}}@endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                Tiếng Anh
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nội dung</label>
                                                    <textarea name="contentEn" class="content-ckeditor">@if (isset($introduce)){{$introduce->content_en}}@endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
