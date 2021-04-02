@extends('layouts.app')
@section('content')

@include('layouts.dashboardNav')
<style>
    .form-check-input {
        opacity: 0;
    }
</style>
<div class="dashboard-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 d-flex">
                <div>
                    @if(Auth::user()->avatar)
                    <img src="{{ asset(Auth::user()->avatar) }}" alt="" width="60" height="60">
                    @else
                    <div id="profileImage"></div>
                    @endif
                </div>
                <div class="ml-2">
                    <h2 id="name">{{Auth::user()->name}}</h2>
                    <h3 id="timezone"></h3>
                </div>
            </div>
            <div class="col-md-4 col-12">
                @if(Auth::user()->role == 'user')
                <div class="float-right mt-3 ">
                    <a href="/findteacher" class="btn btn-default btn-lg addLesson">+Add Lesson</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 mt-2">
            <div class="card mb-2" style="font-size:16px">
                <div class="card-head d-flex ">
                    <h3 class="w-50">
                        Languages
                    </h3>
                    <a href="/setting" class="ml-auto mr-1 mt-1"><i class="fas fa-cog"></i></a>
                </div>
                <div class="card-body mb-3">
                    <div class="ml-2">Speaks <br>
                        <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#languagemodal">&nbsp <b>Add language</b> <i class="fas fa-pencil-alt"></i> </a>
                    </div>
                    <div class="ml-2">learning <br>&nbsp;
                        <div class="ml-2">
                            @foreach($other_langs as $lang)
                            <span>
                                <b>{{ucwords($lang->name)}}: </b>
                                {!! $languageLevel[$lang->level] !!} &nbsp;
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class='mt-2 d-flex'>
                        <div class="ml-aut">
                            <div class="text-center">{{$count['attended']}}</div>
                            <h5 for="">Attended</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="text-center">{{$count['past']}}</div>
                            <h5 for="">Past</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="text-center">{{$count['upcoming']}}</div>
                            <h5 for="">UpComing</h5>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role == 'user')
            <div class="card mb-2">
                <div class="card-head">
                    <h3>My Teachers</h3>
                </div>
                <div class="card-body">
                    @foreach($fav_teacher as $fteacher)
                    <a href="{{route('view.teacher',[$fteacher->teacher_id,$fteacher->teacher_name])}}"><img src="{{ $fteacher->avatar?asset($fteacher->avatar):asset('images/avatar.png') }}" width="60" height="60" class="rounded-circle" alt="{{$fteacher->teacher_name}}"></a>
                    @endforeach
                </div>
                @if(count($fav_teacher)>3)
                <div class="card-footer">
                    {{$fav_teacher->render()}}
                </div>
                @endif
            </div>
            @endif
        </div>
        <div id="section" class="col-12 col-md-8">
            <div id="errorMessage"></div>
            <!-- <div class="row">
                <div class="col-12">
                    <h1>Payments Received:</h1>
                    <span id="p-alert"></span>
                </div>
            </div> -->
            <div class="row">
                <div class="col-6">
                    <h1>Lessons</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-outline-primary form-check-label h-75">
                            <input class="form-check-input h-50" type="radio" name="list_calendar" id="list" autocomplete="off" checked value="list">
                            List
                        </label>
                        <label class="btn btn-outline-primary form-check-label h-75">
                            <input class="form-check-input h-50" type="radio" name="list_calendar" id="calendar" autocomplete="off" value="calendar"> Calendar
                        </label>
                    </div>
                </div>
            </div>
            <div id="list">
                <div class="row">
                    <div class="col-4">
                        <select name="status" id="status" class="form-control w-75">
                            <option value="all">All</option>
                            <option value="live">Live</option>
                            <option value="completed">Completed</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="incomplete">InComplete</option>
                        </select>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" id="searchbyteacher" placeholder="Search by Teacher name">
                        </div>
                    </div>
                </div>
                <div id="listContent">
                    {!! $list !!}
                </div>
            </div>
            <div id="calendarDisplay"></div>
        </div>
    </div>
</div>

<!-- Add language Modal -->
<div class="modal fade" id="languagemodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Languages</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @foreach($other_langs as $lang)
                <div class="card mb-2 lesson-card">
                    <div class="card-body">
                        <div class="row" id="{{$lang->id}}">
                            <div class="col-6 pt-0 d-flex">
                                <img src="/icons/flags/{{$lang->name}}.png" width="50" height="50" class="rounded-circle">
                                <p class="ml-2">{{$lang->name}}</p>
                            </div>
                            <div class="col-6 d-flex">
                                <a href="{{route('language.speaks.delete',$lang->speakID)}}" data-remote="true" data-method="get" class="btn btn-outline-danger btn-sm ml-auto h-75 delete" data-confirm="Are You sure you want to remove this language?">Remove</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 pt-0 pb-0 mb-1">
                                <input type="checkbox" name="currentlylearning" id="currentlylearning" {{ $lang->currently_learning?'checked':'' }}>
                                <label for="currentlylearning">Currently Learning</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 pt-0">
                                <!-- don't changes these values or change array in app/Http/providers/AppServiceProviders -->
                                <label for="" class="text-dark">Proficiency</label>
                                <?php echo Form::select(
                                    'level',
                                    array('totalbeginner' => 'Total Beginner', 'beginner' => 'Beginner', 'upperbeginner' => 'Upper Beginner', 'totalintermediate' => 'Total Intermediate', 'intermediate' => 'Intermediate', 'upperintermediate' => 'UpperIntermediate', 'totaladvanced' => 'Total Advanced', 'advanced' => 'Advanced', 'upperadvanced' => 'Upper Advanced'),
                                    $lang->level,
                                    ['class' => 'form-control browser-default custom-select', 'data-url' => route('language.speaks.level'), 'data-remote' => "true", 'data-method' => 'put', 'data-params' => 'id=' . $lang->speakID]
                                ); ?>

                            </div>
                            <div class="col-6 pt-0">
                                <label for="" class="text-dark">Motivation</label>
                                <?php echo Form::select(
                                    'motivation',
                                    array(
                                        'career' => 'Career',
                                        'education' => 'Education',
                                        'family' => 'Family',
                                        'hobby' => 'Hobby',
                                        'travel' => 'Travel',
                                        'other' => 'Other'
                                    ),
                                    $lang->motivation,
                                    ['class' => 'form-control browser-default custom-select', 'data-url' => route('language.speaks.motivation'), 'data-remote' => "true", 'data-method' => 'put', 'data-params' => 'id=' . $lang->speakID]
                                ); ?>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @php
                $languages = \App\Language::get();
                @endphp
                <form action="{{route('setting.language.speak.add')}}" method="post" id="NewLanguage" data-remote="true">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <select name="UserSpeak" id="UserSpeak" class="form-control custom-select browser-default">
                                @foreach ($languages as $lang)
                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            <?php echo Form::select(
                                'level',
                                array('totalbeginner' => 'Total Beginner', 'beginner' => 'Beginner', 'upperbeginner' => 'Upper Beginner', 'totalintermediate' => 'Total Intermediate', 'intermediate' => 'Intermediate', 'upperintermediate' => 'UpperIntermediate', 'totaladvanced' => 'Total Advanced', 'advanced' => 'Advanced', 'upperadvanced' => 'Upper Advanced'),
                                'totalbeginner',
                                ['class' => 'form-control browser-default custom-select']
                            ); ?>
                        </div>
                        <div class="col-sm-4 form-group">

                            <?php echo Form::select(
                                'motivation',
                                array(
                                    'career' => 'Career',
                                    'education' => 'Education',
                                    'family' => 'Family',
                                    'hobby' => 'Hobby',
                                    'travel' => 'Travel',
                                    'other' => 'Other'
                                ),
                                'other',
                                ['class' => 'form-control browser-default custom-select']
                            ); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mx-1" data-dismiss="modal">Close</button>
                        <input type="submit" value="Add" class="btn btn-primary w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $('.delete').bind('ajax:success', function(data, status, xhr, code) {

        if (code.status == 200) {
            $(this).closest('.card').before('<p class="deletedRecord text-success">Removed Language successfully</p>');
            $(this).closest('.card').remove();
            setTimeout(function() {
                $('.deletedRecord').remove();
            }, 3000);
        }
    });
    $('#NewLanguage').bind("ajax:success", function(data, status) {
        location.reload()
    })
    $(document).ready(function() {

        //profile pic if does not exist
        var intial = $('#name').text().charAt(0);
        var profileImage = $('#profileImage').text(intial);
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $('#timezone').text(timezone);
        //toggler list and calendar
        $('input:radio[name=list_calendar]').change(function() {
            if (this.value == 'list') {
                console.log(this.value);
                $('#calendar').addClass('show');
                $('#calendar').css('display', 'none');
                $('#section #list').css('display', 'block');
            } else if (this.value == 'calendar') {
                console.log(this.value);
                $('#calendar').addClass('show');
                $('#section #list').css('display', 'none');
                $('#calendar').css('display', 'block');
                console.log(<?php echo json_encode($classesTime) ?>)
                var calendarEl = document.getElementById('calendarDisplay');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'timeGridWeek,timeGridDay'
                    },
                    initialView: 'timeGridWeek',
                    themeSystem: 'bootstrap',
                    events: <?php echo json_encode($classesTime) ?>
                });
                calendar.render();
            }
        });

        $('#searchbyteacher').change(function() {
            var searchBy = $(this).val();
            console.log(searchBy);
            $.ajax({
                url: '/dashboard?search=' + searchBy,
                type: 'GET',
                success: function(response) {
                    $('#listContent').html(response);
                },
                error: function(error) {
                    $('#errorMessage').html('<h6 class="alert alert-danger">Oops! Something went wrong. Refresh page and try again</h6>')
                }
            })
        });
        $('#status').change(function() {
            var showBy = $(this).val();
            console.log(showBy);
            $.ajax({
                url: '/dashboard?showBy=' + showBy,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#listContent').html(response);
                },
                error: function(error) {
                    $('#errorMessage').html('<h6 class="alert alert-danger">Oops! Something went wrong. Refresh page and try again</h6>')
                }
            })
        });
    });
</script>
@endsection
@endsection