@if (count($decks)>0)
<div class="swiper-container">
    <div class="swiper-wrapper">
        @foreach($decks as $deck)
        <div class="swiper-slide">
            <div class="card mb-2 m-3" style="min-height: 350px;">
                <img class="card-img-top" src="{{asset($deck->cover_image)??asset('/images/avatar.png')}}" alt="Card image cap" style="max-height: 230px;">
                <div class="card-body p-2">
                    <h4 class="card-title text-left text-capitalize"><b>{{$deck->name}}</b></h4>
                    <p class="card-text ">{{$deck->description}}</p>
                </div>
                <div class="card-footer">
                    <a href="{{route('decksLesson.show',$deck->id)}}" class="btn btn-primary d-block">Learn</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="swiper-button-next" style="margin-right:3%"></div>
<div class="swiper-button-prev" style="margin-left:3%"></div>
@else
    @include("includes.notfound")
@endif
