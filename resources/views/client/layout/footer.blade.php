<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-4">
                <div class="footer-title">
                    {{__('system.vechungtoi')}}
                </div>
                <ul class="list-contact">
                    <li><i class="fa-solid fa-location-dot"></i>{{$company->address}}</li>
                    <li><i class="fa-solid fa-phone"></i><a href="tel:{{$company->hotline}}" target="_blank">{{$company->hotline}}</a></li>
                    <li><i class="fa-solid fa-envelope"></i><a href="mailto:{{$company->email}}" target="_blank">{{$company->email}}</a></li>
                    @if (!empty($company->facebook))
                        <li><i class="fa-brands fa-facebook"></i><a href="{{$company->facebook}}" target="_blank">Sunset HoiAn Studio</a></li>
                    @endif
                    @if (!empty($company->instagram))
                        <li><i class="fa-brands fa-instagram"></i><a href="{{$company->instagram}}" target="_blank">Sunset HoiAn Studio</a></li>
                    @endif
                    @if (!empty($company->youtube))
                        <li><i class="fa-brands fa-tiktok"></i><a href="{{$company->youtube}}" target="_blank">Sunset HoiAn Studio</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-4" id="contact">
                <div class="footer-title">
                    {{__('system.lienhevoichungtoi')}}
                </div>
                <form id="submitFormContact" data-url-submit="{{route('send_contact')}}" data-url-complete="{{route('index')}}">
                    <div class="mb-2">
                        <label>{{__('system.name')}}</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>{{__('system.phone')}}</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>{{__('system.event_date')}}</label>
                        <input type="type" id="event_date" name="event_date" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>{{__('system.event_service')}}</label>
                        <input type="text" name="event_service" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>{{__('system.event_location')}}</label>
                        <input type="text" name="event_location" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>{{__('system.event_cost')}} (VND)</label>
                        <input type="text" id="event_cost_display" name="event_cost_dispay" class="form-control">
                        <input type="hidden" name="event_cost" id="event_cost">
                    </div>
                    <div class="mb-3">
                        <label>{{__('system.content')}}</label>
                        <textarea name="content" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit">{{__('system.submit')}}</button>
                    </div>
                </form>
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
        <span>Copyright {{$company->name}} All Rights Reserved © 2026</span>
    </div>
</footer>