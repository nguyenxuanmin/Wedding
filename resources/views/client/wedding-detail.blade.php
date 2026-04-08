@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
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
                @foreach ($wedding->weddingPhotos as $weddingPhoto)
                    <a href="">
                        <img alt="{{ data_get($wedding, 'name_' . $lang) }}" src="{{ asset('storage/weddings/' . basename($weddingPhoto->image)) }}"
                            data-image="{{ asset('storage/weddings/' . basename($weddingPhoto->image)) }}" data-description="{{ data_get($wedding, 'name_' . $lang) }}"
                            style="display:none">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
