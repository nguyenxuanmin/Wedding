@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
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
                                        <img src="{{asset('storage/weddings/' . basename($wedding->weddingPhotos[0]->image))}}" alt="{{data_get($wedding,'name_'.$lang)}}" class="object-fit-cover w-100">
                                    </div>
                                    <div class="item-index-title">
                                        {{data_get($wedding,'name_'.$lang)}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if (isset($infoSearch))
                    {{$weddings->appends(['search' => $infoSearch])->links('client.layout.pagination')}}
                @else
                    {{$weddings->links('client.layout.pagination')}}
                @endif
            </div>
        </section>
    @endif
@endsection
