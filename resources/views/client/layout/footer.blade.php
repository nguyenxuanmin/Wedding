<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-4">
                <div class="footer-title">
                    {{__('system.vechungtoi')}}
                </div>
                <ul class="list-contact">
                    <li><i class="fa-solid fa-location-dot"></i>{{$company->address}}</li>
                    <li><i class="fa-solid fa-phone"></i><a href="tel:{{$company->hotline}}">{{$company->hotline}}</a></li>
                    <li><i class="fa-solid fa-envelope"></i><a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                    @if (!empty($company->facebook))
                        <li><i class="fa-brands fa-facebook"></i><a href="{{$company->facebook}}">{{$company->facebook}}</a></li>
                    @endif
                    @if (!empty($company->instagram))
                        <li><i class="fa-brands fa-instagram"></i><a href="{{$company->instagram}}">{{$company->instagram}}</a></li>
                    @endif
                    @if (!empty($company->youtube))
                        <li><i class="fa-brands fa-youtube"></i><a href="{{$company->youtube}}">{{$company->youtube}}</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-4" id="contact">
                <div class="footer-title">
                    {{__('system.lienhevoichungtoi')}}
                </div>
            </div>
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-4">
                <div class="footer-title">
                    Fanpage
                </div>
                @if (!empty($company->facebook))
                    <div class="fb-page"
                        data-href="{{$company->facebook}}"
                        data-tabs="timeline"
                        data-width=""
                        data-height="300px"
                        data-small-header="false"
                        data-adapt-container-width="true"
                        data-hide-cover="false"
                        data-show-facepile="true">
                        <blockquote cite="{{$company->facebook}}" class="fb-xfbml-parse-ignore">
                            <a href="{{$company->facebook}}">{{$company->name}}</a>
                        </blockquote>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <span>Copyright {{$company->name}} All Rights Reserved © 2025</span>
    </div>
</footer>