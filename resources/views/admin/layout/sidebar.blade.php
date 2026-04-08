<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('admin')}}" class="brand-link">
            @if (!empty($company->logo))
                <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="brand-image opacity-75 shadow" />
            @else
                <img src="{{asset('library/admin/AdminLTEFullLogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            @endif
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('list_slider')}}" class="nav-link">
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('introduce')}}" class="nav-link">
                        <p>Giới thiệu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_wedding')}}" class="nav-link">
                        <p>Ảnh cưới</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_video')}}" class="nav-link">
                        <p>Video</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_album')}}" class="nav-link">
                        <p>Album</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_blog')}}" class="nav-link">
                        <p>Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_contact')}}" class="nav-link">
                        <p>Liên hệ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('company')}}" class="nav-link">
                        <p>Thông tin công ty</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>