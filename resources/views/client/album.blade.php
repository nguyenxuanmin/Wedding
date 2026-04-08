@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    @if (count($albums))
        <section class="section-index section-album">
            <div class="container">
                <div class="row">
                    @foreach ($albums as $album)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3 mb-lg-4">
                            <div class="item-index">
                                <a href="{{route('album_detail',['slug' => $album->slug])}}">
                                    <div class="item-index-image">
                                        <div class="icon-hover"><i class="fa fa-mail-forward"></i></div>
                                        <img src="{{asset('storage/albums/' . basename($album->albumPhotos[0]->image))}}" alt="{{data_get($album,'name_'.$lang)}}" class="object-fit-cover w-100">
                                    </div>
                                    <div class="item-index-title">
                                        {{data_get($album,'name_'.$lang)}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$albums->links('client.layout.pagination')}}
            </div>
        </section>
    @endif
@endsection
