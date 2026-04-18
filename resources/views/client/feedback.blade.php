@extends('client.layout.master-page')

@section('title')
    {{$titlePage}}
@endsection

@section('content')
    @include('client.layout.breadcrumb')
    <div class="mb-lg-4 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8 mb-3">
                    <p>{{__('system.content_feedback')}}</p>
                    <div class="select_feedback">{{__('system.select_feedback1')}} <a href="">{{__('system.select_feedback2')}}</a> {{__('system.select_feedback3')}}.</div>
                    <form id="submitFormFeedback" data-url-submit="{{route('send_feedback')}}" data-url-complete="{{route('index')}}">
                        <div class="mb-2">
                            <label>{{__('system.name')}}</label>
                            <input type="text" name="name_feedback" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>{{__('system.title')}}</label>
                            <input type="text" name="title_feedback" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{__('system.feel')}}</label>
                            <textarea name="feedback" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Rate</label>
                            <div class="rating">
                                <input type="radio" name="rating" id="star1" value="1">
                                <label for="star1"><i class="fa-regular fa-star"></i></label>
                                <input type="radio" name="rating" id="star2" value="2">
                                <label for="star2"><i class="fa-regular fa-star"></i></label>
                                <input type="radio" name="rating" id="star3" value="3">
                                <label for="star3"><i class="fa-regular fa-star"></i></label>
                                <input type="radio" name="rating" id="star4" value="4">
                                <label for="star4"><i class="fa-regular fa-star"></i></label>
                                <input type="radio" name="rating" id="star5" value="5" checked>
                                <label for="star5"><i class="fa-regular fa-star"></i></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>{{__('system.image_feedback')}}</label>
                            <input type="file" name="image_feedback[]" id="imageFeedbacks" class="form-control mb-3" multiple accept="image/*">
                            <div id="previewImageFeedbacks"></div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-submit">{{__('system.feedback')}}</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 mb-3">
                    <div class="rating-summary">
                        <div class="rating-bars">
                            @for ($i = 5; $i >= 1; $i--)
                                @php
                                    $count = $stats[$i] ?? 0;
                                    $percent = $totalFeedback ? ($count / $totalFeedback) * 100 : 0;
                                @endphp
                                <div class="bar-item">
                                    <span>{{$i}}</span>
                                    <div class="bar"><div class="fill" style="width: {{ $percent }}%"></div></div>
                                </div>
                            @endfor
                        </div>
                        <div class="rating-info">
                            @php
                                $fullStars = round($avgFeedback);
                            @endphp
                            <div class="avg">{{ number_format($avgFeedback, 1) }}</div>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-star text-secondary"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="reviews">{{$totalFeedback}} {{__('system.feedbacks')}}</div>
                        </div>
                    </div>
                </div>
                @if (count($feedbacks))
                    @include('client.list-feedbacks')
                @endif
            </div>
        </div>
    </div>
@endsection