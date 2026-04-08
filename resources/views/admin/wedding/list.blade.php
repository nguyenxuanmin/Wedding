@extends('admin.layout.master-page')

@section('title')
    Ảnh cưới
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Ảnh cưới</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Ảnh cưới</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="mb-3">
                <a class="btn btn-outline-primary" href="{{route('add_wedding')}}" title="Thêm">Thêm</a>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <form action="{{route('search_wedding')}}">
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
                        <th scope="col" width="200px">Ngày tạo</th>
                        <th scope="col" width="150px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($weddings) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="5">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($weddings as $key => $wedding)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">
                                @if (count($wedding->weddingPhotos))
                                    <img src="{{asset('storage/weddings/' . basename($wedding->weddingPhotos[0]->image))}}" alt="{{$wedding->name_vi}}" class="object-fit-cover w-100" style="max-height: 150px;">
                                @endif
                            </td>
                            <td valign="middle">{{$wedding->name_vi}}</td>
                            <td valign="middle">{{$wedding->created_at->format('d/m/Y');}}</td>
                            <td valign="middle" align="center">
                                <a href="{{route('edit_wedding',[$wedding->id])}}" class="btn btn-outline-info" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger" title="Xóa" onclick="deleteItem({{$wedding->id}},'ảnh cưới','{{route('delete_wedding')}}');"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$weddings->appends(['search' => $infoSearch])->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
