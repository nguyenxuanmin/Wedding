@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    @if (!empty($content))
        <div class="mb-lg-4 mb-3">
            <div class="container">
                <div class="item-content mb-3 mb-lg-4">
                    {!! $content !!}
                </div>
            </div>
        </div>
    @endif
@endsection