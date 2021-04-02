@extends('layouts.app')
@section('content')
@include('teach.layouts.DashboardNav')
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
            <img src="{{asset($deck->cover_image)}}" alt="" height="150" class="d-flex align-items-center align-items-md-start m-auto">
            <h4 class="text-main"><b>{{$deck->name}}</b></h4>
            <p class="text-left">
                {{$deck->description}}
            </p>
            <p class="text-center"> <b>{{$lang_in->name}} <span class="right-arrow"> </span>{{$lang_to->name}}</b></p>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="text-main">Decks</h4>
                    <a href="#addLesson" data-toggle="modal" data-target="#addLesson" class="btn btn-primary">Add<img src="{{asset('icons/plus.svg')}}" width="20" height="20"></a>
                </div>
                <div class="card-body decks-lessons">
                    @if(count($deck->deck_lessons)>0)
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
                                    <a href="{{route('decksLesson.destroy',$lesson->id)}}" data-remote="true" data-method="delete" data-type="json" style="float: right;"><img src="{{asset('icons/delete-x.svg')}}" alt="" width="30" height="30"> </a>
                                </h4>
                                <h6><i>{{$lesson->translation}}</i></h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    @include("includes.notfound")
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade right" id="addLesson" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add to Deck</h4>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" id="deckLessonForm" enctype="multipart/form-data">
                    <input type="text" value="{{$deck->id}}" name="deckID" hidden>
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" placeholder="Word" name="title" id="title">
                        <div id="titleError" class="mt-1"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Translation</label>
                        <input type="text" class="form-control" name="translation" placeholder="Word Translation" id="translation">
                    </div>
                    <div class="form-group">
                        <label for="fileUpload" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for Cover Image..
                            <input id="fileUpload" name="cover" type="file" accept="image/x-png,image/gif,image/jpeg" hidden>
                        </label>
                        <div id="coverError" class="mt-1"></div>
                    </div>
                    <div class="form-group">
                        <label for="audioUpload" class="file-upload1 btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-music mr-2"></i>Browse for Audio file ...
                            <input id="audioUpload" name="audio" type="file" accept="audio/*" hidden>
                        </label>
                        <div id="audioError" class="mt-1"></div>
                    </div>
                </form>
                <div class="form-group d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                    <button id="submit" class="btn btn-primary m-1">Save</button>
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
        $('#submit').click(function() {
            var formData = new FormData(document.getElementById("deckLessonForm"));
            $.ajax({
                type: 'POST',
                url: '{{route("decksLesson.store")}}',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, status, xhr) {
                    if (xhr.status == 201) {
                        $('input').addClass('is-valid')
                        $('form').prepend(`<div class="alert alert-success">${data.message}</div>`)
                    }
                    if (xhr.status == 200) {
                        $('form').prepend(`<div class="alert alert-info">${data.message}</div>`)
                    }
                },
                error: function(error, xhr, status) {
                    if (error.status == 401) {
                        var errors = JSON.parse(error.responseText)
                        Object.entries(errors.message).map(([index, value]) => {
                            console.log(index);
                            $('#' + index).addClass('is-invalid');
                            $('#' + index + 'Error').addClass('alert alert-danger');
                            $('#' + index + 'Error').text(value)
                        })
                    } else {
                        $('form').prepend(`<div class="alert alert-info">Hmm, something went wrong. Please try again.</div>`)
                    }
                }
            })
        });
    })
</script>

@endsection
