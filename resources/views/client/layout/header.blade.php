<header id="header">
    <div class="wrapper-search">
        <form class="form-search" action="{{route('search')}}">
            <input class="form-control" type="search" placeholder="{{__('system.timkiem')}}..." name="search" value="">
            <button class="btn btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <button class="btn btn-close-search" type="button"><i class="fa fa-times"></i></button>
    </div>
    <div class="container-fluid">
        <div class="item-header">
            <div class="item-header-left">
                <div class="item-logo">
                    <a href="{{route('index')}}">
                        @if ($company->logo != "")
                            <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="object-fit-cover">
                        @else
                            LOGO
                        @endif
                    </a>
                </div>
                <ul class="item-nav">
                    <li>
                        <a href="{{route('introduce_detail')}}" @if (request()->is('gioi-thieu')) class="active" @endif>{{__('system.gioithieu')}}</a>
                    </li>
                    <li>
                        <a href="{{route('wedding')}}" @if (request()->is('wedding')) class="active" @endif>{{__('system.anhcuoi')}}</a>
                    </li>
                    <li>
                        <a href="{{route('video')}}" @if (request()->is('video')) class="active" @endif>Video</a>
                    </li>
                    <li>
                        <a href="{{route('album')}}" @if (request()->is('album')) class="active" @endif>Album</a>
                    </li>
                    <li>
                        <a href="{{route('blog')}}" @if (request()->is('blog')) class="active" @endif>Blog</a>
                    </li>
                    <li>
                        <a href="#contact">{{__('system.lienhe')}}</a>
                    </li>
                </ul>
            </div>
            <div class="item-header-right gap-2">
                <a href="{{ route('change.language', ['lang' => 'vi']) }}" title="Tiếng Việt (vi)" @if ($lang == 'en') class="image-lang" @endif>
                    <img src="{{asset('library/client/vn.png')}}" alt="VI" >
                </a>
                <a href="{{ route('change.language', ['lang' => 'en']) }}" title="English (en)" @if ($lang == 'vi') class="image-lang" @endif>
                    <img src="{{asset('library/client/en.png')}}" alt="EN" >
                </a>
                <a class="item-show-search" href="javascript:void(0)" title="{{__('system.timkiem')}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
                <a class="item-show-menu" href="javascript:void(0)">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="menu-mobile">
        <a class="item-hide-menu" href="javascript:void(0)"><i class="fa-solid fa-xmark"></i></a>
        <div class="item-logo-mobile">
            <a href="{{route('index')}}">
                @if ($company->logo != "")
                    <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="object-fit-cover">
                @else
                    LOGO
                @endif
            </a>
        </div>
        <ul>
            <li>
                <a href="{{route('introduce_detail')}}">{{__('system.gioithieu')}}</a>
            </li>
            <li>
                <a href="{{route('wedding')}}">{{__('system.anhcuoi')}}</a>
            </li>
            <li>
                <a href="{{route('video')}}">Video</a>
            </li>
            <li>
                <a href="{{route('album')}}">Album</a>
            </li>
            <li>
                <a href="{{route('blog')}}">Blog</a>
            </li>
            <li>
                <a href="#contact">{{__('system.lienhe')}}</a>
            </li>
        </ul>
    </div>
</header>
