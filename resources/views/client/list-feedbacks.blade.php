<div class="mt-4 mb-3">
        @foreach ($feedbacks as $feedback)
                <div class="feedback-card mb-4">
                        <div class="name-feedback">{{$feedback->name}}</div>
                        <div class="star-feedback mb-2">
                                @for ($i = 1; $i <= $feedback->rating; $i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                @endfor
                        </div>
                        @if (count($feedback->feedbackPhotos))
                                <div class="image-feedback">
                                        @foreach ($feedback->feedbackPhotos as $feedbackPhoto)
                                                <img src="{{asset('storage/feedbacks/' . basename($feedbackPhoto->image))}}" alt="{{$feedback->name}}" class="object-fit-cover">
                                        @endforeach
                                </div>
                         @endif
                        <div class="title-feedback">
                                {{__('system.title')}}: {{$feedback->title}}
                        </div>
                        <label>{{__('system.feel')}}:</label>
                        <div class="content-feedback">
                                {{$feedback->content}}
                        </div>
                </div>
        @endforeach
        {{$feedbacks->links('client.layout.pagination')}}
</div>
