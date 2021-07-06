<?php

use Carbon\Carbon;
?>

@if(count($lessons)>0)
@foreach($lessons as $key => $lesson)
<h5 class="mb-2 mt-2 text-muted">{{substr($key,0,11)}}</h5>
@foreach($lesson as $row)
<?php
$start = Carbon::parse($row->open);
$close = Carbon::parse($row->close);
$timeDiff = $close->diffInMinutes($start)
?>
<div class="card mb-2 lesson-card">
    <div class="card-body d-flex">
        <img src="{{asset(Auth::user()->avatar)??asset('images/avatar.png')}}" alt="" width="150" height="150" style="border-radius: 100%;">
        <div class="ml-2 mr-2 mr-md-4">
            @if(date('Y-m-d') <= $row->scheduled_date)
                <p style="color: #00aaf4;">UpComing</p>
                @elseif($row->isAttended)
                <p style="color: #00aaf4;">Attended</p>
                @else
                <p style="color: #d84315;">Missed</p>
                @endif
                <p>Start At: {{$row->open}}</p>
                <p>Day: {{date('l', strtotime($row->scheduled_date))}}</p>
                <p>Date: {{date('F Y\, jS', strtotime($row->scheduled_date))}}</p>
        </div>
        <div class="ml-2 ml-md-4">
            <h6 class=text-muted>Details</h6>
            <p>Duration: {{$timeDiff}} Min Lesson</p>
            <p>Teacher: {{$row->name}}</p>
        </div>
        <div class="btn-group h-25 ml-auto">
            @if(auth()->user()->role!='teacher')
            <a href="/lessons/view/{{$row->id}}" class="btn btn-primary h-25">View</a>
            @else
            <a href="/teacher/lesson/{{$row->id}}" class="btn btn-primary h-25">View</a>
            @endif
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                    @if(!$row->isAttended)<li class="dropdown-item"><a href="{{ route('lesson.reschedule',$row->id) }}" class="text-decoration-none text-dark">Reschedule</a></li>@endif
                </ul>
            </div>

        </div>
    </div>
</div>
@endforeach
@endforeach
@else
<div class="row">
    <img src="{{ asset('/icons/collaborationfemalemale.svg') }}" width="100" height="100" alt="img" style="margin-left:45%">
    <h4 class="text-center w-100">No Lessons found
        @if(Auth::user()->role == 'user')
        <a href="/findteacher" class="text-decoration-none">Find Teacher</a>
        @endif
        .
    </h4>
</div>
@endif
