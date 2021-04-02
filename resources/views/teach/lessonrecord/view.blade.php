@extends('layouts.app')
@section('content')

<div class="row mt-2">
    <div class=" ml-auto mr-auto col-12 col-md-10 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-main">View Lesson Detail</h4>
            </div>
            <div class="card-body p-2">
                <span class="font-5 text-muted">Student</span>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <img src="{{asset($lesson->user->avatar)}}" alt="" width="100">
                    </div>
                    <div class="col-6 col-md-8">
                        <p>Name: <strong>{{$lesson->user->name}}{{ $lesson->user->lastname}}</strong></p>
                        <p>mail: <a href="mailto:{{$lesson->user->email}}">{{$lesson->user->email}}</a></p>
                    </div>
                </div>
                <hr>
                <span class="font-5 text-muted">Teacher</span>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <img src="{{asset($lesson->teacher->user->avatar)}}" alt="" width="100">
                    </div>
                    <div class="col-6 col-md-8">
                        <p>Name: <strong>{{$lesson->teacher->user->name}}{{ $lesson->teacher->user->lastname}}</strong></p>
                        <p>mail: <a href="mailto:{{$lesson->teacher->user->email}}">{{$lesson->teacher->user->email}}</a></p>
                    </div>
                </div>
                <hr>
                <span class="font-5 text-muted">Timing</span>
                <div class="row">
                    <div class="col-6 col-md-4 pl-5">
                        <p class="font-2">Lesson Start at: <strong class="text-main">{{$lesson->timing->open}}</strong></p>
                        <p class="font-2">Lesson Ends at: <strong class="text-main">{{$lesson->timing->close}}</strong></p>
                        <p class="font-2">Date: <strong class="text-main">{{date('l', strtotime($lesson->scheduled_date))}}, {{date('jS F Y\ ', strtotime($lesson->scheduled_date))}}</strong></p>
                        <p class="font-2">Duration: <strong class="text-main">60 Min Lesson</strong></p>
                    </div>
                </div>
                <hr>
                <span class="font-5 text-muted">Platform</span>
                <div class="row">
                    <div class="col-12 col-md-8 m-auto">
                        <form class="w-75 m-auto" id="platformForm">
                            <div id="summaryError"></div>
                            <input type="text" name="id" value="{{$lesson->id}}" hidden>
                            <div class="form-group">
                                <label for="">Platform Name</label>
                                <input type="text" class="form-control" name="platformName" id="platformName" placeholder="Google Meet, Teams, Zoom ..." value="{{$lesson->platform}}" required>
                                <div id="platformNameError" class="mt-1"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Lesson Link</label>
                                <input type="text" class="form-control " name="lessonLink" id="lessonLink" placeholder="Link to class" value="{{$lesson->link}}" required>
                                <div id="lessonLinkError" class="mt-1"></div>
                            </div>
                            <div class="form-group"><a type="submit" class="btn btn-primary btn-sm float-right text-decoration-none text-light" id="updatePlatform">Update</a></div>
                        </form>
                    </div>
                </div>
                <hr>
                <span class="font-5 text-muted">Homework</span>
                @if (!$lesson->homework)
                <div class="row">
                    <div class="col-11 col-md-8 m-auto">
                        <form action="" enctype="multipart/form-data">
                            <input type="text" name="lessonID" value="{{$lesson->id}}" hidden>
                            <div class="form-group row">
                                <label for="fileUpload" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for file ...
                                    <input id="fileUpload" name="homeworkFile" style="opacity:0" type="file" accept="application/pdf">
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @if ($lesson->homework && $lesson->homework->response_path != null)
                <div class="mb-3 w-75 m-auto">
                    <span class="font-3">Response Submitted</span>
                    <form
                        action="{{ route('homework.download',$lesson->homework->id) }}"
                        method="get">
                        @csrf
                        <input type="submit" value="Download" class="btn btn-primary btn-block btn-sm" />
                    </form>
                </div>
                @else
                    <div class="alert alert-info">
                        Response Not Submitted yet
                    </div>
                @endif
                <hr>
                <span class="font-5 text-muted">FeedBack</span>
                <div class="row">
                    <div class="col-12 text-justify">
                        <div class="card p-0 m-auto w-75">
                            <div class="card-body p-2">
                                {{$lesson->stars}}
                                <hr>
                                <span>{{$lesson->feedback}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="javascript:history.back()" class="btn btn-danger btn-sm float-right">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#updatePlatform').click(function() {
                $.ajax({
                    url: "{{route('teach.lesson.platform.update')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#platformForm').serialize(),
                    success: function(response) {
                        $('#summaryError').addClass("alert alert-success");
                        $('#summaryError').text(response.message);

                    },
                    error: function(error) {
                        var errors = error.responseJSON.errors;
                        Object.entries(errors).map(([index, value]) => {
                            $('#' + index).addClass('is-invalid');
                            $('#' + index + 'Error').addClass('alert alert-danger');
                            $('#' + index + 'Error').text(value)
                        })

                    }
                })
            })
            $('#fileUpload').change(function() {
            var form = $(this).closest('form')[0];
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: '{{route("teach.homework.upload")}}',
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