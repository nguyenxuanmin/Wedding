@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    @include('client.layout.social-share')
    <div class="mb-lg-4 mb-3">
        @if (!empty($content))
            <div class="container">
                <div class="item-content mb-3 mb-lg-4">
                    {!! $content !!}
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div id="uniteGallery" style="display:none;">
                @foreach ($album->albumPhotos as $albumPhoto)
                    <a href="">
                        <img alt="{{ data_get($album, 'name_' . $lang) }}" src="{{ asset('storage/albums/' . basename($albumPhoto->image)) }}"
                            data-image="{{ asset('storage/albums/' . basename($albumPhoto->image)) }}" data-description="{{ data_get($album, 'name_' . $lang) }}"
                            style="display:none">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
