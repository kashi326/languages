@if(count($lessons)>0)
@foreach($lessons as $key => $lesson)
<h5 class="mb-2 mt-2 text-muted">{{substr($key,0,11)}}</h5>
@foreach($lesson as $row)
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
                <p>{{$row->open}}</p>
                <p>{{date('l', strtotime($row->scheduled_date))}}</p>
                <p>{{date('F Y\, jS', strtotime($row->scheduled_date))}}</p>
        </div>
        <div class="ml-2 ml-md-4">
            <h6 class=text-muted>Details</h6>
            <p>Pakistan</p>
            <p>60 Min Lesson</p>
            <p>{{$row->name}}</p>
        </div>
        <div class="h-25 ml-auto">
            <a href="{{ route('teach.lesson.view',$row->id) }}" class="btn btn-primary h-25">View</a>
        </div>
    </div>
</div>
@endforeach
@endforeach
@else
<div class="row">
    <img src="{{ asset('/icons/collaborationfemalemale.svg') }}" width="100" height="100" alt="img" style="margin-left:45%">
    <h4 class="text-center w-100 ml-5">No Record Found.</h4>
</div>
@endif
