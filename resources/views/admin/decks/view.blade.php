@extends("layouts.admin")
@section("content")
<style>
    .right-arrow::after {
        content: ' \2192';
        color: #3490dc;
        font-size: 24px;
        margin-left: 3px;
        margin-right: 3px;
        font-weight: 500;
    }

    .row {
        margin: 0px;
    }

    .decks-lessons .deck-card {
        width: 90%;
        margin: auto;
        border-radius: 5px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-3">
            <img src="{{asset($deck->cover_image)}}" alt="" height="200" class="img-responsive w-100">
        <h4 class="text-main"><b>{{$deck->name}} </b></h4>
            <p class="text-left">
                {{$deck->description}}
            </p>
            <p class="text-center"> <b>{{$lang_in->name}} <span class="right-arrow"> </span>{{$lang_to->name}}</b></p>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="text-main">Decks</h4>
                </div>
                <div class="card-body decks-lessons">
                    @if(count($deck->deck_lessons))
                    @foreach($deck->deck_lessons as $lesson)
                    <div class="card deck-card mb-2">
                        <div class="row">
                            <div class="col-3 col-md-2 p-3">
                                <img src="{{asset($lesson->cover)}}" alt="{{$lesson->name}}" width="80" height="80">
                            </div>
                            <div class="col-3 col-md-1 p-1 d-flex align-items-center justify-content-center">
                                <audio id="audio-{{$lesson->id}}" src="{{asset($lesson->audio)}}"></audio>
                                <div class="playSound" data-id="audio-{{$lesson->id}}">
                                    <img src="{{asset('icons/play.svg')}}" width="50" height="50" class="play" />
                                </div>
                            </div>
                            <div class="col-6 col-md-9">
                                <h4>
                                    <b><i>{{$lesson->name}}</i></b>
                                </h4>
                                <h6><i>{{$lesson->translation}}</i></h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="d-flex justify-content-center">
                        @include("includes.notfound")
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var prev;
    $(function() {
        $('.playSound').click(function() {

            var ele = document.getElementById($(this).attr('data-id'));
            if(ele == prev){
                prev.pause()
                prev=undefined;
                return
            }
            if(prev != undefined){
                prev.pause();
            }
            prev = ele;
            ele.play();

        })
    });
</script>

@endsection
