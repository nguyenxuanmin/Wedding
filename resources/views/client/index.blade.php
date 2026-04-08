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
    @if (count($weddings))
        <section class="section-index section-wedding">
            <div class="container">
                <div class="row">
                    @foreach ($weddings as $wedding)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3 mb-lg-4">
                            <div class="item-index">
                                <a href="{{route('wedding_detail',['slug' => $wedding->slug])}}">
                                    <div class="item-index-image">
                                        <div class="icon-hover"><i class="fa fa-mail-forward"></i></div>
                                        @if (count($wedding->weddingPhotos))
                                            <img src="{{asset('storage/weddings/' . basename($wedding->weddingPhotos[0]->image))}}" alt="{{data_get($wedding,'name_'.$lang)}}" class="object-fit-cover w-100">
                                        @endif
                                    </div>
                                    <div class="item-index-title">
                                        {{data_get($wedding,'name_'.$lang)}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a class="btn btn-read-more" href="{{route('wedding')}}"><span><i class="fa fa-camera-retro"></i> {{__('system.xemthem')}}</span></a>
                </div>
            </div>
        </section>
    @endif
@endsection
