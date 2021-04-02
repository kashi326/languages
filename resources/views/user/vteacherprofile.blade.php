@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="card mb-3">
                @if($teacher->intro_link)
                <iframe width="100%" height="315" src="{{$teacher->intro_link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <img class="card-img-top teacher-avatar" src="{{asset($teacher->avatar)}}" alt="Teacher Avator" style="border-radius: 100%;" height="80" width="80">
                        </div>
                        <div class="col-md-12 col-lg-9">
                            <div class="row">
                                <div class="col-9 d-flex">
                                    <div class="p-2 bd-highlight font-3">
                                        <b><i> {{$teacher->name}}{{ $teacher->lastname}}</i></b>
                                    </div>
                                    <div class="p-2 bd-highlight"><?php echo $teacher->verified ?
                                                                        '<img src="/icons/welcome/verified-badge.png" alt="teacher icon">' : '' ?></div>
                                    <div class="p-2 bd-highlight">
                                        <img src="{{asset('/icons/star.svg')}}" alt="star" width="20" height="20">
                                        {{round($ratingCount,1)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title">About Me</h5>
                    <div class="card-text ml-3" id="more">{!!$teacher->about!!}</div>
                    <button class="more_less btn btn-primary btn-sm">Read More</button>
                    <p class="card-text"><small class="text-muted">Last updated {{ Carbon\Carbon::parse($teacher->updated_at)->diffForHumans()}}</small></p>
                </div>
            </div>
            <div class="card mb-3 d-flex">
                <div class="card-body justify-content-between teacher-performance">
                    <div class="row mb-3 ">
                        <div class="col-4">
                            <img src="/icons/welcome/clock.png" alt="clock">
                            <p class="text-muted">Response Time</p>
                            <p>Less than an hour</p>
                        </div>
                        <div class="col-4">
                            <img src="/icons/welcome/schedule.png" alt="Schedule">
                            <p class="text-muted">Joined Biling Talks</p>
                            <p>{{ Carbon\Carbon::parse($teacher->created_at)->diffForHumans()}}</p>
                        </div>
                        <div class="col-4">
                            <img src="/icons/welcome/attendance.png" alt="Attendance">
                            <p class="text-muted">Attendance</p>
                            <p>100%</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <img src="/icons/welcome/classroom.png" alt="Total Lessons">
                            <p class="text-muted">Total Lessons</p>
                            <p>150</p>
                        </div>
                        <div class="col-4">
                            <img src="/icons/welcome/classroom2.png" alt="Lessons per Student">
                            <p class="text-muted">Lessons per Student</p>
                            <p>15</p>
                        </div>
                        <div class="col-4">
                            <img src="/icons/welcome/star.png" alt="Attendance">
                            <p class="text-muted">Review</p>
                            <p>{{round($ratingCount,1)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div id="calendar" class="m-3"></div>
                </div>
            </div>
            @if(!$expertise->teaching_level->isEmpty()
            || !$expertise->other_langs->isEmpty()
            || !$expertise->lesson_include->isEmpty()
            || !$expertise->teaches_to->isEmpty()
            || !$expertise->teach_subjects->isEmpty()
            || !$expertise->teach_test_preparation->isEmpty())
            <div class="card mb-3">
                <div class="card-body mb-3 p-3">
                    <h4 class="card-title mb-2">Teaching Expertise</h4>
                    <!-- Teaching Level -->
                    @if(!$expertise->teaching_level->isEmpty())
                    <section id="teaches" class="mt-2  ml-1 p-2">
                        <h5 class="mb-2"><i>Teaches</i></h5>
                        <div class="row mr-2 ml-2 expertise-row">
                            @foreach($expertise->teaching_level as $level)
                            <div class="col-12 col-sm-6">
                                <div>
                                    <p class="mb-1">
                                        {{$level->level}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    <hr>
                    @endif
                    <!-- Accents -->
                    @if(!$expertise->other_langs->isEmpty())
                    <section id="accents" class="mt-3 ml-1 p-2">
                        <h5 class="mb-2">Accents</h5>
                        <div class="row mr-2 ml-2 expertise-row">
                            @foreach($expertise->other_langs as $accents)
                            <div class="col-6">{{$accents->name}}</div>
                            @endforeach
                        </div>
                    </section>
                    @endif
                    <!-- Lesson Includes -->
                    @if(!$expertise->lesson_include->isEmpty())
                    <section id="LessionIncludes" class="mt-3 ml-1 p-2">
                        <h5 class="mb-2">Lessons Includes</h5>
                        <div class="row mr-2 ml-2 expertise-row">
                            @foreach($expertise->lesson_include as $include)
                            <div class="col-12 col-sm-6">
                                <div>
                                    <p class="mb-1">
                                        {{$include->includes}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    <hr>
                    @endif
                    <!-- Ages -->
                    @if(!$expertise->teaches_to->isEmpty())
                    <section id="ages" class="mt-3 ml-1 p-2">
                        <h5 class="mb-1">Ages</h5>
                        <div class="row mr-2 ml-2 expertise-row">
                            @foreach($expertise->teaches_to as $to)
                            <div class="col-12 col-sm-6">
                                <div>
                                    <p class="mb-1">
                                        {{$to->teaches_to}}({{$to->from_age}}-{{$to->to_age}})
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    <hr>
                    @endif

                    <!-- Subjects -->
                    @if(!$expertise->teach_subjects->isEmpty())
                    <section id="subjects" class="mt-3 ml-1 p-2">
                        <h5 class="mb-1">Subjects</h5>
                        <div class="row mr-2 ml-2 expertise-row">
                            @foreach($expertise->teach_subjects as $subject)
                            <div class="col-12 col-sm-6">
                                <div>
                                    <p class="mb-1">
                                        {{$subject->subject}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    <hr>
                    @endif
                    <!-- Test Preparation -->
                    @if(!$expertise->teach_test_preparation->isEmpty())
                    <section id="testPreparation" class="mt-3 ml-1 p-2">
                        <h5 class="mb-1">Test Preparation</h5>
                        <div class="row mr-2 ml-2 expertise-row">
                            @foreach($expertise->teach_test_preparation as $test)
                            <div class="col-12 col-sm-6">
                                <div>
                                    <p class="mb-1">
                                        {{$test->test}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    <hr>
                    @endif
                </div>
            </div>
            @endif
            @if(!$resume->teacher_education->isEmpty() || !$resume->teacher_experience->isEmpty() || !$resume->teacher_certificates->isEmpty())
            <div class="card mb-3" id="resume">
                <div class="card-body p-3">
                    @if(!$resume->teacher_education->isEmpty())
                    <section id="Education" class="mt-2  ml-1 p-2">
                        <h5 class="mb-1">
                            <img src="{{asset('icons/school.svg')}}" alt="" width="30" height="30">
                            <b>Education </b>
                        </h5>
                        <div class="row mr-2 ml-2 resume-row">
                            @foreach($resume->teacher_education as $education)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        {{$education->from_year}}-{{$education->to_year}}
                                    </div>
                                    <div class="col-10">
                                        <div class="d-flex justify-content-between font-3">
                                            <strong>{{$education->title}}</strong>
                                        </div>
                                        <div class="text-success">@if($education->isVerified) <img src="{{asset('icons/welcome/verified-badge.png')}}" width="15" height="15"> Verified @endif</div>
                                        <div class="font-3"><i>{{$education->institute}}</i></div>
                                        <div class="font-3"><i>{{$education->description}}</i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    @if(!$resume->teacher_experience->isEmpty())
                    <section id="Experience" class="mt-2  ml-1 p-2">
                        <h5 class="mb-1">
                            <img src="{{asset('icons/work.svg')}}" alt="" width="30" height="30">
                            <b>Work Experience </b>
                        </h5>
                        <div class="row mr-2 ml-2 resume-row">
                            @foreach($resume->teacher_experience as $experience)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        {{$experience->from_year}}-{{$experience->to_year}}
                                    </div>
                                    <div class="col-10">
                                        <div class="d-flex justify-content-between font-3">
                                            <strong>{{$experience->title}}</strong>
                                        </div>
                                        <div class="text-success">@if($experience->isVerified) <img src="{{asset('icons/welcome/verified-badge.png')}}" width="15" height="15"> Verified @endif</div>
                                        <div class="font-3"><i>{{$experience->institute}}</i></div>
                                        <div class="font-3"><i>{{$experience->description}}</i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif
                    @if(!$resume->teacher_certificates->isEmpty())
                    <section id="Certification" class="mt-2  ml-1 p-2">
                        <h5 class="mb-1">
                            <img src="{{asset('icons/diploma.svg')}}" alt="" width="30" height="30">
                            <b>Certification </b>
                        </h5>
                        <div class="row mr-2 ml-2 resume-row">
                            @foreach($resume->teacher_certificates as $certificates)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        {{$certificates->from_year}}-{{$certificates->to_year}}
                                    </div>
                                    <div class="col-10">
                                        <div class="d-flex justify-content-between font-3">
                                            <strong>{{$certificates->title}}</strong>
                                        </div>
                                        <div class="text-success">@if($certificates->isVerified) <img src="{{asset('icons/welcome/verified-badge.png')}}" width="15" height="15"> Verified @endif</div>
                                        <div class="font-3"><i>{{$certificates->institute}}</i></div>
                                        <div class="font-3"><i>{{$certificates->description}}</i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif
                </div>
            </div>
            @endif
            @if(!$comments->isEmpty())
            <div class="card mb-3" id="resume">
                <div class="card-body">
                    <h3>Ratings</h3>
                    <section class="mt-3">
                        rating badges goes here
                    </section>
                    <hr>
                    <section class="pl-5">
                        {!!$rating!!}
                        <h5 class="ml-3"><b>{{round($ratingCount,1)}} Average</b></h5>
                    </section>
                    <hr>
                    <section class="mt-3">
                        @foreach ($comments as $comment)
                        <div class="comment-row mt-1" style="box-shadow: none;">
                            <div class="pt-1 row">
                                <div class="col-none col-md-2 d-flex justify-content-center">
                                    <img src="{{asset($comment->avatar)}}" alt="user profile" width="80" height="80">
                                </div>
                                <div class="col-12 col-md-10 comment">
                                    <span class="font-4 text-main"><b><i>{{ $comment->name }}</i></b></span>
                                    <p class="text-muted">{{ substr($comment->created_at,0,10) }}</p>
                                    <p style="font-size: 14px;">{{$comment->feedback}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>
                </div>
                <div class="card-footer">
                    <div class="pagination">
                        <div style="flex: 0 100%"></div>
                        {{ $comments->render() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="d-none d-lg-block col-lg-4 ">
            <div class="card mb-4">
                <div class="card-head p-2">
                    <p class="card-title mb-0">Trail Lesson</p>
                    <p class="text-muted">One Time, 30 minutes</p>
                </div>
                <div class="card-body row p-4">
                    <div class="col-8">
                        <h6 class="text-muted">Trail Lesson</h6>
                    </div>
                    <div class="col-4">
                        <p style="color:green"> Curreny {{$teacher->price/2}}</p>
                        <p class="text-muted">30 min</p>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <a href="/payments?teacher_id={{$teacher->id}}&start={{$classes&&$classes[0]?$classes[0]['start']:''}}&end={{$classes&&$classes[0]?$classes[0]['end']:''}}" class="btn btn-primary btn-block">Book Free Trail</a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-head p-2">
                    <p class="card-title mb-0">Private Lesson</p>
                    <p class="text-muted">60 minutes</p>
                </div>
                <div class="card-body p-4">
                    <div class="row mt-2">
                        <div class="col-8">
                            <h6 class="text-muted">1 Lesson</h6>
                        </div>
                        <div class="col-4">
                            <p style="color:green"> Curreny {{$teacher->price}}</p>
                            <p class="text-muted">60 min</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-8">
                            <h6 class="text-muted">5 Lessons</h6>
                        </div>
                        <div class="col-4">
                            <p style="color:green"> Curreny {{5*$teacher->price - (($teacher->price*5)*$teacher->discount)/100}}</p>
                            <p class="text-muted">5 x 60 min</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-8">
                            <h6 class="text-muted">10 Lessons</h6>
                        </div>
                        <div class="col-4">
                            <p style="color:green"> Curreny {{10*$teacher->price - (($teacher->price*10)*$teacher->discount)/100}}</p>
                            <p class="text-muted" style="justify-content: end;">10 x 60 min</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <a href="/payments?teacher_id={{$teacher->id}}&start={{$classes&&$classes[0]?$classes[0]['start']:''}}&end={{$classes&&$classes[0]?$classes[0]['end']:''}}" class="btn btn-primary btn-block">Book Lesson</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="bottomBookingCard col-12">
            <a class="btn btn-primary btn-block" href="/payments?teacher_id={{$teacher->id}}&start={{$classes&&$classes[0]?$classes[0]['start']:''}}&end={{$classes&&$classes[0]?$classes[0]['end']:''}}">Book Teacher</a>
        </div>
    </div>
</div>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js" defer></script>
<script>
    $(document).ready(function() {
        var text = $('#more').text();
        setTimeout(function() {
            $(".more_less").click();
        }, 1)
        $('.more_less').click(function() {
            var ctext = $('#more').text();
            if (text.length < 295) {
                $('.more_less').css('display', 'none');
            } else
            if (ctext.length > 300) {
                var lessText = text.substr(0, 290);
                $('#more').text(lessText + '....');
                $('.more_less').text('read more');
            } else {
                $('#more').text(text);
                $('.more_less').text('read less');
            }

        });

    });

    document.addEventListener('DOMContentLoaded', function() {

        var popover;
        var calendarEvents = <?php echo json_encode($classes) ?>;
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // headerToolbar: {
            //     left: 'prev,next today',
            //     center: 'title',
            //     right: 'timeGridWeek,timeGridDay'
            // },
            // defaultView: "timeGridWeek",
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridWeek',
            themeSystem: 'bootstrap',
            events: calendarEvents,
            eventClick: function(info) {
                var eventObj = info.event;

                if (eventObj.url) {
                    alert(
                        'Clicked ' + eventObj.title + '.\n' +
                        'Will open ' + eventObj.url + ' in a new tab'
                    );
                    console.log(eventObj);
                    window.open(eventObj.url);
                }
            },
            eventDidMount: function(info) {
                // console.log('hello')
                // var tooltip = new Tooltip(info.el, {
                //     content: 'hello',
                //     placement: 'top',
                //     trigger: 'hover',
                // });
            },
            eventMouseEnter: function(mouseEnterInfo) {
                var event = mouseEnterInfo.el;
                event = $(event).closest('.fc-timegrid-event-harness');

            },
            eventMouseLeave: function() {
                // popover.hide();
                // popover = null;
            }
        });
        calendar.render();
    });
</script>
@endsection
