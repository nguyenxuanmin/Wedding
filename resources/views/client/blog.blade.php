@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    @if (count($blogs))
        <section class="section-index section-blog">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3 mb-lg-4">
                            <div class="item-index">
                                    <div class="item-index-image">
                                        <a href="{{route('blog_detail',['slug' => $blog->slug])}}">
                                            <div class="icon-hover"><i class="fa fa-mail-forward"></i></div>
                                        </a>
                                        <img src="{{asset('storage/blogs/' . basename($blog->image))}}" alt="{{data_get($blog,'name_'.$lang)}}" class="object-fit-cover w-100">
                                    </div>
                                    <div class="item-index-content">
                                        <span class="tag-blog">Blog</span>
                                        <p class="title-blog">
                                            <a href="{{route('blog_detail',['slug' => $blog->slug])}}">{{data_get($blog,'name_'.$lang)}}</a>
                                        </p>
                                        <hr class="title_break">
                                        @if (!empty(data_get($blog,'description_'.$lang)))
                                            <div class="desc-blog">
                                                {{data_get($blog,'description_'.$lang)}}
                                            </div>
                                        @endif
                                    </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$blogs->links('client.layout.pagination')}}
            </div>
        </section>
    @endif
@endsection

