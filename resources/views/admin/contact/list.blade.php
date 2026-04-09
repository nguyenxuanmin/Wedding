@extends('admin.layout.master-page')

@section('title')
    Liên hệ
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Liên hệ</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                    </ol>
                  </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <form action="{{route('search_contact')}}" method="GET">
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
                        <th scope="col">Tên</th>
                        <th scope="col" width="350px" class="text-center">Email</th>
                        <th scope="col" width="250px" class="text-center">Số điện thoại</th>
                        <th scope="col" width="250px" class="text-center">Ngày gửi</th>
                        <th scope="col" width="150px" class="text-center">Trạng thái</th>
                        <th scope="col" width="150px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($contacts) == 0)
                        <tr>
                            <td valign="middle" align="center" colspan="7">Không có dữ liệu</td>
                        </tr>
                    @endif
                    @foreach ($contacts as $key => $contact)
                        <tr>
                            <td valign="middle" align="center">{{$key+1}}</td>
                            <td valign="middle">{{$contact->name}}</td>
                            <td valign="middle" align="center">{{$contact->email}}</td>
                            <td valign="middle" align="center">{{$contact->phone}}</td>
                            <td valign="middle" align="center">{{$contact->created_at->format('d/m/Y')}}</td>
                            <td valign="middle" align="center">
                                <span class="badge bg-{{ $contact->is_read ? 'success' : 'secondary' }}">
                                    {{ $contact->is_read ? 'Đã đọc' : 'Chưa đọc' }}
                                </span>
                            </td>
                            <td valign="middle" align="center">
                                <a href="{{route('view_contact', $contact->id)}}" class="btn btn-outline-info" title="Xem"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$contacts->appends(['search' => $infoSearch])->links('admin.layout.pagination')}}
        </div>
    </div>
@endsection
