@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('css/admin/index.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/style.min.css')}}">
@endsection

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">

            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Teachers</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$teachers}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Students</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$students}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$latest_registration}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Lessons</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$lessons_count}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-chart-bar-32"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0">Recent Lessons</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Meeting Platform</th>
                                <th scope="col">Meeting Link</th>
                                <th scope="col">Open</th>
                                <th scope="col">Close</th>
                                <th scope="col">Attended</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($lessons as $lesson)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$lesson->id}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="budget">
                                    {{$lesson->teacher? $lesson->teacher->name." ".$lesson->teacher->lastname:''}}
                                </td>
                                <td class="budget">
                                    {{$lesson->user?$lesson->user->name ." ". $lesson->user->lastname:''}}
                                </td>
                                <td>{{$lesson->platform}}</td>
                                <td>{{$lesson->link}}</td>
                                <td>{{$lesson->timing?$lesson->timing->open:''}}</td>
                                <td>{{$lesson->timing?$lesson->timing->close:''}}</td>
                                <td>
                                    @if ($lesson->scheduled_date > date('Y:m:d H:i:s'))
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-info"></i>
                                        <span class="status">Upcoming</span>
                                    </span>
                                    @elseif($lesson->isAttended == 1)
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-success"></i>
                                        <span class="status">Attended</span>
                                    </span>
                                    @elseif($lesson->isAttended == 0)
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-danger"></i>
                                        <span class="status">Missed</span>
                                    </span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light uk-button uk-button-text text-decoration-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
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
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
