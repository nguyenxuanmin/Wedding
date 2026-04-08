@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    @if (count($videos))
        <section class="section-index section-video">
            <div class="container">
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3 mb-lg-4">
                            <div class="item-index">
                                <a href="{{route('video_detail',['slug' => $video->slug])}}">
                                    <div class="item-index-image">
                                        <div class="icon-hover"><i class="fa fa-mail-forward"></i></div>
                                        <img src="{{asset('storage/videos/' . basename($video->image))}}" alt="{{data_get($video,'name_'.$lang)}}" class="object-fit-cover w-100">
                                    </div>
                                    <div class="item-index-title">
                                        {{data_get($video,'name_'.$lang)}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$videos->links('client.layout.pagination')}}
            </div>
        </section>
    @endif
@endsection
