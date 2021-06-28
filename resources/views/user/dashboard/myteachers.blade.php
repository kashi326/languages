@extends('layouts.app')
@section('content')

@include('layouts.dashboardNav')
<style>
    [class*='col-'] {

        padding-top: 2px !important;
        padding-bottom: 2px !important;

    }
</style>
<div class="container">
    @if(count($myteachers)>0)
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Teachers<br>Quick Overview</div>
                <div class="card-body">
                    @foreach($myteachers as $myteacher)
                    <div class="hoverCardWrapper ml-2">
                        <a href="/view/{{$myteacher->teacher_id}}/{{$myteacher->teacher_name}}">
                            <h6><i></i>{{$myteacher->teacher_name}}</h6>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @foreach($myteachers as $myteacher)
            <div class="card mb-2 lesson-card">
                <div class="card-body d-flex">
                    <!-- <img src="{{asset('images/profile/$myteacher->teacher_avatar')??asset('images/avatar.png')}}" alt="" width="80" height="80" style="border-radius: 100%;"> -->
                    <img src="{{asset($myteacher->teacher_avatar)??asset('images/avatar.png')}}" alt="" width="80" height="80" style="border-radius: 100%;">
                    <div class="ml-2 mr-2 mr-md-4">
                        <span>{{$myteacher->teacher_name}}</span>
                        <div>
                            <span>{{$myteacher->teacher_country}}</span>
                            <span>{{$myteacher->teacher_country}}</span>
                        </div>
                        <div>
                            <span>Last Online: 5min ago</span>
                        </div>
                    </div>
                    <div class="btn-group h-25 ml-auto">
                        <a href="#" class="btn btn-primary btn-sm h-25">Buy Lesson</a>
                    </div>
                </div>
                <div class="footer pl-3 d-flex justify-content-between">
                    <span><b>Teaches</b> <br>{{$myteacher->language_name}}</span>
                    <span><b>Upcoming</b> <br>0</span>
                    <span><b>Past</b> <br>0</span>
                    <span><b>Needs rescheduling</b> <br>0</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="row">
        <img src="{{ asset('/icons/collaborationfemalemale.svg') }}" width="100" height="100" alt="img" style="margin-left:45%">
        <h4 class="text-center w-100">No Teachers Found. <a href="/findteacher">Find Teacher</a></h4>
    </div>
    @endif
</div>


@endsection
