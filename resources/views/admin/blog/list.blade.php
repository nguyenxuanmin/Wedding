@extends('admin.layout.master-page')

@section('title')
    Blog
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Blog</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_blog')}}" title="Thêm">Thêm</a>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <form action="{{route('search_blog')}}">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control form-control" placeholder="Tìm kiếm" value="{{$infoSearch}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8"></div>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="100px" class="text-center">STT</th>
                        <th scope="col" style="width:250px;">Hình ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col" width="250px" class="text-center">Ngày tạo</th>
                        <th scope="col" width="150px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($blogs) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="5">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($blogs as $key => $blog)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">
                                <img src="@if (!empty($blog->image)){{asset('storage/blogs/' . basename($blog->image))}}@else{{asset('library/admin/default-image.png')}}@endif" alt="{{$blog->name_vi}}" class="object-fit-cover w-100" style="max-height: 250px;">
                            </td>
                            <td valign="middle">{{$blog->name_vi}}</td>
                            <td valign="middle" align="center">{{$blog->created_at->format('d/m/Y')}}</td>
                            <td valign="middle" align="center">
                                <a href="{{route('edit_blog',[$blog->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$blog->id}},'blog','{{route('delete_blog')}}');"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$blogs->appends(['search' => $infoSearch])->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
