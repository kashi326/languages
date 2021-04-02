@extends('layouts.app')
@section('content')
@include('teach.layouts.DashboardNav')
@section('styles')
<link rel="stylesheet" href="{{asset('css/teach/homework.css')}}">
@stop
@foreach($homeworks as $key => $homework)
@if($key%2 == 0)
<div class="card">
    <div class="post">
        <img class="post-image-left d-none d-md-block" src="{{asset(Auth::user()->avatar)}}" />
        <div class="post-content mt-2">
            @if(empty($homework->homework_path))
            <div class="alert alert-danger w-75 m-auto">
                No Homework Uploaded. click Browse to upload Homework.
            </div>
            @elseif(empty($homework->response_path))
            <div class="alert alert-danger w-75 m-auto">
                Homework reponse not submitted yet.
            </div>
            @elseif(!empty($homework->response_path)&&$homework->isChecked ==0)
            <div class="alert alert-info w-75 m-auto">
                Homework reponse Submitted. Please Check it and submit response to help your student understand better.
            </div>
            @endif
            <div class="post-text w-50 ml-auto mr-auto mt-3">
                @if(!$homework->homework_path)
                <form enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="homeworkID" value="{{$homework->homeworkID}}" hidden>
                    <div class="form-group row">
                        <label for="fileUpload" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for file ...
                            <input id="fileUpload" name="homeworkFile" style="opacity:0" type="file" accept="application/pdf" >
                        </label>
                    </div>
                </form>
                @endif
                <a href="{{route('teach.lesson.view',$homework->lesson_id)}}" class="btn btn-primary btn-block rounded-pill shadow">View Lesson</a>
            </div>
            <div class="author">
                <div class="author-content">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <p class="author-name">Student: <b> {{$homework->name}}</b></p>
                            <p class="date">Email: <b><a href="mailto:{{$homework->email}}">{{$homework->email}}</a></b></p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <p class="author-name">Lesson Platform: <b> {{$homework->platform}}</b></p>
                            <p class="date">Link: <b><a href="https://{{$homework->link}}" target="_blank">{{$homework->link}}</a></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@else

<div class="card">
    <div class="post">
        <img style="float:right; margin-right: 15px;" class="post-image-right d-none d-md-block" src="{{asset(Auth::user()->avatar)}}" />

        <div class="post-content mt-2">
            @if(empty($homework->homework_path))
            <div class="alert alert-danger w-75 m-auto">
                No Homework Upload. click Browse to upload Homework.
            </div>
            @elseif(empty($homework->response_path))
            <div class="alert alert-danger w-75 m-auto">
                Homework reponse not submitted yet.
            </div>
            @elseif(!empty($homework->response_path)&&$homework->isChecked ==0)
            <div class="alert alert-info w-75 m-auto">
                Homework reponse Submitted. Please Check it and submit response to help your student understand better.
            </div>
            @endif
            <div class="post-text w-50 ml-auto mr-auto mt-3">
                @if(!$homework->homework_path)
                <form action="" enctype="multipart/form-data">
                    <input type="text" name="homeworkID" value="{{$homework->homeworkID}}" hidden>
                    <div class="form-group row">
                        <label for="fileUpload" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for file ...
                            <input id="fileUpload" name="homeworkFile" style="opacity:0" type="file" accept="application/pdf">
                        </label>
                    </div>
                </form>
                @endif
                <a href="{{route('teach.lesson.view',$homework->lesson_id)}}" class="btn btn-primary btn-block rounded-pill shadow">View Lesson</a>
                <div class="author">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <p class="author-name">Student: <b> {{$homework->name}}</b></p>
                            <p class="date">Email: <b><a href="mailto:{{$homework->email}}">{{$homework->email}}</a></b></p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <p class="author-name">Lesson Platform: <b> {{$homework->platform}}</b></p>
                            <p class="date">Link: <b><a href="https://{{$homework->link}}" target="_blank">{{$homework->link}}</a></b></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif
@endforeach
<div id="toastMessage"></div>
<script>
    $(function() {
        $('#fileUpload').change(function() {
            var form = $(this).closest('form')[0];
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '{{route("teach.homework.index")}}',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log(`sucess: ${response}`)
                    $('#toastMessage').html(response);
                    $('#success').toast('show')

                },
                error: function(error) {
                    console.log(`error:${error}`)
                    if (error.toast) {
                        $('#toastMessage').html(error.toast);
                        $('#success').toast('show')
                    } else
                        alert('Something went wrong');
                }
            });
        })
    })
</script>


@endsection
