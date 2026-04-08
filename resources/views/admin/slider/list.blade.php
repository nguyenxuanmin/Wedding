@extends('admin.layout.master-page')

@section('title')
    Slider
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Slider</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Slider</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_slider')}}" title="Thêm">Thêm</a>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="100px" class="text-center">STT</th>
                        <th scope="col" width="350px">Hình ảnh</th>
                        <th scope="col"></th>
                        <th scope="col" width="150px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($sliders) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="3">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($sliders as $key => $slider)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">
                                <img src="@if (!empty($slider->image)){{asset('storage/sliders/' . basename($slider->image))}}@else{{asset('library/admin/default-image.png')}}@endif" alt="{{$slider->name}}" class="w-100 object-fit-cover" style="max-height: 250px;">
                            </td>
                            <td valign="middle"></td>
                            <td valign="middle" align="center">
                                <a href="{{route('edit_slider',[$slider->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$slider->id}},'slider','{{route('delete_slider')}}');"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$sliders->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
