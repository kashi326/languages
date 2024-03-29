@extends("layouts.admin")
@section('content')
<style>
    .dots::after {
        content: '\2807';
        font-size: 100px;
    }
</style>
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <h3>Lesson Panel</h3>
            <hr />
            @if(!$lessons->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Teacher Name</th>
                            <th>Student Name</th>
                            <th>Meeting Platform</th>
                            <th>Meeting Link</th>
                            <th>Open</th>
                            <th>Close</th>
                            <th>Attended</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{$lesson->id}}</td>
                            <td>{{$lesson->teacher? $lesson->teacher->name." ".$lesson->teacher->lastname:''}}</td>
                            <td>{{$lesson->user?$lesson->user->name ." ". $lesson->user->lastname:''}}</td>
                            <td>{{$lesson->platform}}</td>
                            <td>{{$lesson->link}}</td>
                            <td>{{$lesson->timing?$lesson->timing->open:''}}</td>
                            <td>{{$lesson->timing?$lesson->timing->close:''}}</td>
                            <td>@if ($lesson->scheduled_date > date('Y:m:d H:i:s'))
                                <div class="badge badge-fill badge-info p-2">
                                    Upcoming
                                </div>
                                @elseif($lesson->isAttended == 1)
                                <div class="badge badge-fill badge-success p-2">
                                    Attended
                                </div>
                                @elseif($lesson->isAttended == 0)
                                <div class="badge badge-fill badge-danger p-2">
                                    Missed
                                </div>
                                @endif
                            </td>
                            <td>
                                <button class="uk-button uk-button-text text-decoration-none" type="button">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div uk-dropdown="mode: click" class="py-1">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li class="my-2">
                                            <a href="{{route('admin.lesson.view',$lesson)}}" class="text-dark">View</a>
                                        </li>
                                        @if($lesson->session_id)
                                        <li class="my-2">
                                            <a href="{{route('admin.messages.show',[$lesson->session_id])}}" class="text-dark">Messages</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{$lessons->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
