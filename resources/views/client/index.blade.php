@extends('client.layout.master-page')

@section('title')
    Trang chủ
@endsection

@section('content')
    @if (count($sliders))
        <section class="section-slider">
            <div class="my-slider">
                @foreach ($sliders as $slider)
                    <div class="item-slider">
                        <img src="{{asset('storage/sliders/'.$slider->image)}}" alt="{{$company->name}}" class="w-100 h-100 object-fit-cover">
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    @if (count($albums))
        <section class="section-index section-wedding">
            <div class="container">
                <div class="row">
                    @foreach ($albums as $album)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3 mb-lg-4">
                            <div class="item-index">
                                <a href="{{route('album_detail',['slug' => $album->slug])}}">
                                    <div class="item-index-image">
                                        <div class="icon-hover"><i class="fa fa-mail-forward"></i></div>
                                        @if (count($album->albumPhotos))
                                            <img src="{{asset('storage/albums/' . basename($album->albumPhotos[0]->image))}}" alt="{{data_get($album,'name_'.$lang)}}" class="object-fit-cover w-100">
                                        @endif
                                    </div>
                                    <div class="item-index-title">
                                        {{data_get($album,'name_'.$lang)}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a class="btn btn-read-more" href="{{route('album')}}"><span><i class="fa fa-camera-retro"></i> {{__('system.xemthem')}}</span></a>
                </div>
            </div>
        </section>
    @endif
@endsection
