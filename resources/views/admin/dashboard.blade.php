@extends('admin.layout.master-page')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row g-4 mb-4">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liên hệ mới</h3>
                            <div class="card-tools">
                                <span class="badge text-bg-danger"> {{$countContacts}} liên hệ chưa đọc </span>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row text-center m-1">
                                @foreach ($contacts as $contact)
                                    <div class="col-3 p-2">
                                        <img class="img-fluid rounded-circle h-50" src="{{asset('library/admin/user-default.jpg')}}" alt="{{ $contact->name }}"/>
                                        <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="{{route('edit_slider',[$slider->id])}}">
                                            {{ $contact->name }}
                                        </a>
                                        <div class="fs-8">{{ $contact->created_at->format('d/m/Y') }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('list_contact') }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                Xem tất cả liên hệ
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lịch tháng {{ now()->month }} năm {{ now()->year }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="calendar"  style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">Bảng liên hệ cho năm {{now()->format('Y')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4"><div id="revenue-chart"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>
    <script>
        const revenue_chart_options = {
            series: [
                {
                    name: 'Lượt liên hệ',
                    data: @json($contactsByMonth),
                },
            ],
            chart: {
                type: 'bar',
                height: 300,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '20%',
                    endingShape: 'rounded',
                },
            },
            legend: {
                show: true,
            },
            colors: ['#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent'],
            },
            xaxis: {
                categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'decimal'
                        }).format(val);
                    },
                },
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'decimal'
                        }).format(val);
                    }
                }
            },
        };

        const revenue_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            revenue_chart_options,
        );

        revenue_chart.render();
        
        const calendar = new tui.Calendar('#calendar', {
            defaultView: 'month'
        });
    </script>
@endsection
