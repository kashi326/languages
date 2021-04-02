@extends("layouts.admin")
@section('content')
<div class="container">
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
                    <p>Mail: <a href="mailto:{{$lesson->user->email}}" class="text-decoration-none"> {{$lesson->user->email}}</a></p>
                </div>
            </div>
            <hr>
            <span class="font-5 text-muted">Teacher</span>
            <div class="row">
                <div class="col-6 col-md-4">
                    <img src="{{asset($lesson->user->avatar)}}" alt="" width="100">
                </div>
                <div class="col-6 col-md-8">
                    <p>Name: <strong>{{$lesson->teacher->name}}{{ $lesson->teacher->lastname}}</strong></p>
                    <p>Mail: <a href="mailto:{{$lesson->teacher->user->email}}" class="text-decoration-none">{{$lesson->teacher->user->email}}</a></p>
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
                <div class="col-12 col-md-12">
                    @if($lesson->link != "")
                    <pre>{{$lesson->platform}}</pre>
                    <pre>{{$lesson->link}}</pre>
                    @else
                    <div class="row justify-content-content">
                            <img src="{{ asset('/icons/collaborationfemalemale.svg') }}" width="50" height="50" alt="img" style="margin-left:45%">
                            <h4 class="text-center w-100">No Platform has been added yet.</h4>
                        </div>
                    @endif
                </div>
            </div>
            <hr>
            <span class="font-5 text-muted">FeedBack</span>
            <div class="row">
                <div class="col-12 text-justify">
                    @if($lesson->stars>0 && !empty($lesson->feedback))
                    <div class="card p-0 m-auto w-75">
                        <div class="card-body p-2">
                            {{$lesson->stars}}
                            <hr>
                            <span>{{$lesson->feedback}}</span>
                        </div>
                    </div>

                    @else
                    <div class="row justify-content-content">
                            <img src="{{ asset('/icons/collaborationfemalemale.svg') }}" width="50" height="50" alt="img" style="margin-left:45%">
                            <h4 class="text-center w-100">No Feedback has been given yet.</h4>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <a href="javascript:history.back()" class="btn btn-danger btn-sm float-right">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
