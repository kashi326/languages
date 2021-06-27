@extends("layouts.app")
@section('content')

@include('layouts.dashboardNav')
<style>
    .file-upload input[type="file"] {
        display: none;
    }
</style>
<div class="row mt-2">
    <div class=" ml-auto mr-auto col-12 col-md-10 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-main">View Lesson Detail</h4>
            </div>
            <div class="card-body p-3">
                <span class="font-5 text-muted">Student</span>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <img src="{{ asset($lesson->user->avatar) }}" alt="" width="100" />
                    </div>
                    <div class="col-6 col-md-8">
                        <p>
                            Name: <strong>{{ $lesson->user->name}}{{$lesson->user->lastname }}</strong>
                        </p>
                        <p>
                            Mail:
                            <a href="mailto:{{ $lesson->user->email }}">{{ $lesson->user->email }}</a>
                        </p>
                    </div>
                </div>
                <hr />
                <span class="font-5 text-muted">Teacher</span>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <img src="{{ asset($lesson->teacher->user->avatar) }}" alt="" width="100" />
                    </div>
                    <div class="col-6 col-md-8">
                        <p>
                            Name: <strong>{{ $lesson->teacher->name}}{{ $lesson->teacher->lastname }}</strong>
                        </p>
                        <p>
                            Mail:
                            <a href="mailto:{{ $lesson->teacher->user->email }}">{{ $lesson->teacher->user->email }}</a>
                        </p>
                    </div>
                </div>
                <hr />
                <span class="font-5 text-muted">Timing</span>
                <div class="row">
                    <div class="col-12 col-md-8 pl-5">
                        <p class="font-2">
                            Lesson Start at:
                            <strong class="text-main">{{ $lesson->timing->open }}</strong>
                        </p>
                        <p class="font-2">
                            Lesson Ends at:
                            <strong class="text-main">{{ $lesson->timing->close }}</strong>
                        </p>
                        <p class="font-2">
                            Date:
                            <strong class="text-main">{{date('l', strtotime($lesson->scheduled_date))
                                }},
                                {{ date('jS F Y\ ', strtotime($lesson->scheduled_date)) }}</strong>
                        </p>
                        <p class="font-2">
                            Duration:
                            <strong class="text-main">60 Min Lesson</strong>
                        </p>
                    </div>
                </div>
                <hr />
                <span class="font-5 text-muted">Platform</span>
                <div class="row">
                    <div class="col-12 col-md-12">
                        @if(!$lesson->isAttended)
                        <div class="d-flex justify-content-center">
                            <a href="{{route('meeting.student',[$lesson->id,$lesson->user_id])}}" target="_blank" class="btn btn-primary mx-auto">Start Meeting</a>
                        </div>
                        <p class="text-center"><b>OR</b></p>
                        @endif
                        @if($lesson->link != "")
                        <pre>{{ $lesson->platform }}</pre>
                        <pre>{{ $lesson->link }}</pre>
                        @else
                        <div class="row justify-content-content">
                            <img src="{{
                                    asset('/icons/collaborationfemalemale.svg')
                                }}" width="50" height="50" alt="img" style="margin-left:45%" />
                            <h4 class="text-center w-100">
                                No Platform has been added yet.
                            </h4>
                        </div>
                        @endif
                    </div>
                </div>
                <hr />
                @if($lesson->homework)
                <span class="font-5 text-muted">Homework</span>
                <div class="row">
                    <div class="col-11 col-md-8 m-auto">
                        <div class="mb-3">
                            <span class="font-3">Assigned Homework</span>
                            <form action="{{ route('homework.download',$lesson->homework->id) }}" method="get">
                                @csrf
                                <input type="submit" value="Download" class="btn btn-primary btn-block btn-sm" />
                            </form>
                        </div>
                        <div>
                            @if ($lesson->homework->isExpired == null || $lesson->homework->isExpired > date('Y-m-d H:i:s'))
                            <span class="text-danger">Submission can only be updated in 1 hour</span>
                            <form action="" id="homeworkResponse" enctype="multipart/form-data">
                                <input type="text" name="homeworkID" value="{{ $lesson->homework->id }}" hidden />
                                <div class="form-group row">
                                    <label for="fileUpload" class="file-upload btn btn-primary btn-block btn-sm rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for
                                        file ...
                                        <input id="fileUpload" name="responseFile" type="file" accept="application/pdf" />
                                    </label>
                                </div>
                            </form>
                            @else
                            <div class="alert alert-info">
                                Submission Cannot be updated
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <span class="font-5 text-muted">FeedBack</span>
                <div class="row">
                    <div class="col-12 col-md-10 m-auto">
                        <form id="feedbackForm">
                            <div id="summaryError"></div>
                            <input type="text" name="id" value="{{ $lesson->id }}" hidden />
                            @if($lesson->stars == 0)
                            <div class="form-group">
                                <label for="">Rating</label><br />
                                <input type="radio" name="star" id="star1" value="1" />
                                <input type="radio" name="star" id="star2" value="2" />
                                <input type="radio" name="star" id="star3" value="3" />
                                <input type="radio" name="star" id="star4" value="4" />
                                <input type="radio" name="star" id="star5" value="5" checked />
                            </div>
                            @else
                            <input type="text" name="star" value="{{ $lesson->stars }}" hidden />
                            @for ($i = 0; $i < $lesson->stars; $i++)
                                <img src="{{asset('/icons/star.svg')}}" alt="" width="25">
                                @endfor
                                @endif
                                <div class="form-group">
                                    <label for="feedback">FeedBack</label>
                                    <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="4">{{ $lesson->feedback }}</textarea>
                                    <div id="feedbackError" class="mt-1"></div>
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-primary btn-sm float-right text-decoration-none text-light" id="submitFeedback">Submit</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="javascript:history.back()" class="btn btn-danger btn-sm">Cancel</a>
                @if(!$lesson->isAttended)
                <a href="{{ route('lesson.reschedule',$lesson->id) }}" class="btn btn-success btn-sm">Reschedule</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div id="toastMessage"></div>
<script>
    $(function() {
        $("#submitFeedback").click(function() {
            $.ajax({
                url: "{{ route('lesson.feedback.submit') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: $("#feedbackForm").serialize(),
                success: function(response) {
                    $("#summaryError").addClass("alert alert-success");
                    $("#summaryError").text(response.message);
                },
                error: function(error) {
                    console.log(error);
                    var errors = error.responseJSON.errors;
                    Object.entries(errors).map(([index, value]) => {
                        $("#" + index).addClass("is-invalid");
                        $("#" + index + "Error").addClass("alert alert-danger");
                        $("#" + index + "Error").text(value);
                    });
                }
            });
        });
        $('#fileUpload').change(function() {
            var form = $(this).closest('form')[0];
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: '{{route("homework.response")}}',
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
    });
</script>
@endsection
