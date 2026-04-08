@extends('admin.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{$titlePage}}</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('list_album')}}">Ảnh cưới</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <form id="submitForm" enctype="multipart/form-data" data-url-submit="{{route('save_album')}}" data-url-complete="{{route('list_album')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="mb-3">
                                    @if ($action == 'add')
                                        <button class="btn btn-primary">Thêm</button>
                                    @else
                                        <button class="btn btn-info">Cập nhật</button>
                                    @endif
                                    <a href="{{route('list_album')}}" class="btn btn-dark">Trở lại</a>
                                </div>
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" name="imageAlbum[]" id="imageUploads" class="form-control mb-3" multiple accept="image/*">
                                <div id="previewImageUploads"></div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
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
                                                    <label class="form-label">Tiêu đề</label>
                                                    <input type="text" class="form-control" name="nameVi" value="@if (isset($album)){{$album->name_vi}}@endif">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nội dung</label>
                                                    <textarea name="contentVi" class="content-ckeditor">@if (isset($album)){{$album->content_vi}}@endif</textarea>
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
                                                    <label class="form-label">Tiêu đề</label>
                                                    <input type="text" class="form-control" name="nameEn" value="@if (isset($album)){{$album->name_en}}@endif">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nội dung</label>
                                                    <textarea name="contentEn" class="content-ckeditor">@if (isset($album)){{$album->content_en}}@endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                @if (isset($album))
                                    <p><label class="form-label">Danh sách hình ảnh</label></p>
                                    <div class="d-flex flex-wrap justify-content-start align-items-start gap-2">
                                        @foreach ($album->albumPhotos as $item)
                                            <div class="list-image">
                                                <img src="{{asset('storage/albums/' . basename($item->image))}}" alt="{{$album->name_vi}}">
                                                <i class="fa-solid fa-xmark" onclick="deletePhoto({{$item->id}},'{{route('delete_album_photo')}}')"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="{{$action}}">
                    <input type="hidden" name="id" value="@if (isset($album)){{$album->id}}@endif">
                </form>
            </div>
        </div>
    </div>
@endsection
