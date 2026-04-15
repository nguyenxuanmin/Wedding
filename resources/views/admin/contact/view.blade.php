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
                        <li class="breadcrumb-item"><a href="{{route('list_contact')}}">Liên hệ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$titlePage}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <a href="{{route('list_contact')}}" class="btn btn-dark">Trở lại</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" value="{{$contact->name}}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày diễn ra sự kiện</label>
                                    <input type="text" class="form-control" name="email" value="{{date('d/m/Y', strtotime($contact->event_date))}}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Vị trí</label>
                                    <input type="text" class="form-control" name="email" value="{{$contact->event_location}}" readonly>
                                </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{$contact->phone}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dịch vụ</label>
                                <input type="text" class="form-control" name="email" value="{{$contact->event_service}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chi phí</label>
                                <input type="text" class="form-control" name="email" value="{{number_format($contact->event_cost)}}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Nội dung liên hệ</label>
                                <textarea class="form-control" name="message" rows="4" readonly>{{$contact->content}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
