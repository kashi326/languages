@extends('layouts.app')
@section('content')
@include('teach.layouts.DashboardNav')
<link rel="stylesheet" href="{{asset('css/teach/profile.css')}}">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="card mb-3">
                @if($teacher->intro_link)
                <iframe width="100%" height="315" src="{{$teacher->intro_link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                <div class="alert alert-danger">Please Upload Intro Link.</div>
                @endif
                <form class="w-75 m-auto pt-2" data-type="json" action="{{route('teach.profile.test','introLink')}}" method="post" data-remote="true">
                    <div class="form-group">
                        <label for="">Update Intro Link</label>
                        <input type="text" class="form-control" name="intro_link" value="{{$teacher->intro_link??''}}">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success btn-sm float-right" type="submit" value="Update" />
                    </div>
                </form>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <img class="card-img-top teacher-avatar" src="{{asset(Auth::user()->avatar)}}" alt="" style="border-radius: 100%;" height="80" width="80">
                        </div>
                        <div class="col-md-12 col-lg-9">
                            <div class="row">
                                <div class="col-9 d-flex">
                                    <div class="p-2 bd-highlight">
                                        {{$teacher->name}} {{ $teacher->lastname}}
                                    </div>
                                    <div class="p-2 bd-highlight"><?php echo $teacher->verified ?
                                                                        '<img src="/icons/welcome/verified-badge.png" alt="teacher icon">' : '' ?></div>
                                    <div class="p-2 bd-highlight"><?php echo 'average rating' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title">About Me</h5>
                    <form class="w-75 m-auto" id="AboutMeForm" data-type="json" action="{{route('teach.profile.test','AboutMe')}}" method="post" data-remote="true">
                        @csrf
                        <div class="form-group">
                            <textarea id="aboutMe" name="aboutMe"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-sm float-right" type="submit" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div id="calendar" class="m-3"></div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body mb-3 p-3">
                    <h4 class="card-title mb-2">Teaching Expertise</h4>
                    <!-- Teaching Level -->
                    <section id="teaches" class="mt-2  ml-1 p-2">
                        <h5 class="mb-2"><i>Teaches</i></h5>
                        @if(!$teacher->teaching_level->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->teaching_level as $level)
                            <div class="col-12 col-sm-6">
                                <div class="teacher-expertise-row">
                                    <p class="mb-1">
                                        {{$level->level}}
                                    </p>
                                    <a href="{{route('teach.profile.test','teachesDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="level={{$level->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','teachesAdd')}}" method="post" data-remote="true">
                            <div class="form-group">
                                <select class="form-control browser-select custom-select" name="level">
                                    @foreach ($setting_level as $level)
                                    <option value="{{$level->level}}">{{$level->level}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-sm float-right" type="submit" value="Add +" />
                            </div>
                        </form>
                    </section>
                    <br>
                    <hr>
                    <!-- Accents -->
                    <section id="accents" class="mt-3 ml-1 p-2">
                        <h5 class="mb-2">Accents</h5>
                        <div class="row mr-2 ml-2">
                            @foreach ($teacher->other_langs as $lang)
                            <div class="col-6">{{$lang->name}}</div>
                            @endforeach
                        </div>
                    </section>
                    <br>
                    <hr>
                    <!-- Lesson Includes -->
                    <section id="LessionIncludes" class="mt-3 ml-1 p-2">
                        <h5 class="mb-2">Lessons Includes</h5>
                        @if(!$teacher->lesson_include->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->lesson_include as $include)
                            <div class="col-12 col-sm-6">
                                <div class="teacher-expertise-row">
                                    <p class="mb-1">
                                        {{$include->includes}}
                                    </p>
                                    <a href="{{route('teach.profile.test','includeDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="include={{$include->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','includeAdd')}}" method="post" data-remote="true">
                            <div class="form-group">
                                <select class="form-control browser-select custom-select" name="includes">
                                    @foreach ($setting_lessson_include as $include)
                                    <option value="{{$include->include}}">{{$include->include}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-sm float-right" type="submit" value="Add +" />
                            </div>
                        </form>
                    </section>
                    <br>
                    <hr>
                    <!-- Ages -->
                    <section id="ages" class="mt-3 ml-1 p-2">
                        <h5 class="mb-1">Ages</h5>
                        @if(!$teacher->teaches_to->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->teaches_to as $to)
                            <div class="col-12 col-sm-6">
                                <div class="teacher-expertise-row">
                                    <p class="mb-1">
                                        {{$to->teaches_to}}({{$to->from_age}}-{{$to->to_age}})
                                    </p>
                                    <a href="{{route('teach.profile.test','teachesToDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="teachesTo={{$to->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','teachesToAdd')}}" method="post" data-remote="true">
                            <div class="form-group">
                                <select class="form-control browser-select custom-select" name="teachesTo">
                                    @foreach ($setting_teach_to as $to)
                                    <option value="{{$to->id}}">{{$to->age}} ({{$to->from}} - {{$to->to}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-sm float-right" type="submit" value="Add +" />
                            </div>
                        </form>
                    </section>

                    <!-- Subjects -->
                    {{-- <section id="subjects" class="mt-3 ml-1 p-2">--}}
                    {{-- <h5 class="mb-1">Subjects</h5>--}}
                    {{-- @if(!$teacher->teach_subjects->isEmpty())--}}
                    {{-- <div class="row mr-2 ml-2">--}}
                    {{-- @foreach($teacher->teach_subjects as $subject)--}}
                    {{-- <div class="col-12 col-sm-6">--}}
                    {{-- <div class="teacher-expertise-row">--}}
                    {{-- <p class="mb-1">--}}
                    {{-- {{$subject->subject}}--}}
                    {{-- </p>--}}
                    {{-- <a href="{{route('teach.profile.test','subjectDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="subject={{$subject->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>--}}
                    {{-- </div>--}}
                    {{-- </div>--}}
                    {{-- @endforeach--}}
                    {{-- </div>--}}
                    {{-- @endif--}}
                    {{-- <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','subjectAdd')}}" method="post" data-remote="true">--}}
                    {{-- <div class="form-group">--}}
                    {{-- <select class="form-control browser-select custom-select" name="subject">--}}
                    {{-- @foreach ($setting_subjects as $subject)--}}
                    {{-- <option value="{{$subject->subject}}">{{$subject->subject}}</option>--}}
                    {{-- @endforeach--}}
                    {{-- </select>--}}
                    {{-- </div>--}}
                    {{-- <div class="form-group">--}}
                    {{-- <input class="btn btn-success btn-sm float-right" type="submit" value="Add +" />--}}
                    {{-- </div>--}}
                    {{-- </form>--}}
                    {{-- </section>--}}
                    {{-- <!-- Test Preparation -->--}}
                    <section id="testPreparation" class="mt-3 ml-1 p-2">
                        <h5 class="mb-1">Test Preparation</h5>
                        @if(!$teacher->teach_test_preparation->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->teach_test_preparation as $test)
                            <div class="col-12 col-sm-6">
                                <div class="teacher-expertise-row">
                                    <p class="mb-1">
                                        {{$test->test}}
                                    </p>
                                    <a href="{{route('teach.profile.test','testPreparationDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="test={{$test->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','testPreparationAdd')}}" method="post" data-remote="true">
                            <div class="form-group">
                                <select class="form-control browser-select custom-select" name="test">
                                    @foreach ($setting_test_preparation as $test)
                                    <option value="{{$test->test}}">{{$test->test}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-sm float-right" type="submit" value="Add +" />
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="card mb-3" id="resume">
                <div class="card-body mb-3 p-3">
                    <h4 class="card-title mb-2">Résumé</h4>
                    <!-- Education -->
                    <section id="Education" class="mt-2  ml-1 p-2">
                        <h5 class="mb-1">
                            <img src="{{asset('icons/school.svg')}}" alt="" width="30" height="30">
                            <b>Education </b>
                            <a href="#EducationModal" data-toggle="modal" data-target="#EducationModal"> <img src="{{asset('icons/plus.svg')}}" alt="" width="20" height="20">Add</a>
                        </h5>
                        @if(!$teacher->teacher_education->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->teacher_education as $education)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        {{$education->from_year}}-{{$education->to_year}}
                                    </div>
                                    <div class="col-10">
                                        <div class="d-flex justify-content-between font-3">
                                            <strong>{{$education->title}}</strong>
                                            <a href="{{route('teach.profile.test','educationDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="educationID={{$education->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                        </div>
                                        <div class="text-success">@if($education->isVerified) <img src="{{asset('icons/welcome/verified-badge.png')}}" width="15" height="15"> Verified @endif</div>
                                        <div class="font-3"><i>{{$education->institute}}</i></div>
                                        <div class="font-3"><i>{{$education->description}}</i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </section>
                    <!-- Experience -->
                    <section id="Experience" class="mt-2  ml-1 p-2">
                        <h5 class="mb-1">
                            <img src="{{asset('icons/work.svg')}}" alt="" width="30" height="30">
                            <b>Work Experience </b>
                            <a href="#ExperienceModal" data-toggle="modal" data-target="#ExperienceModal"> <img src="{{asset('icons/plus.svg')}}" alt="" width="20" height="20">Add</a>
                        </h5>
                        @if(!$teacher->teacher_experience->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->teacher_experience as $experience)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        {{$experience->from_year}}-{{$experience->to_year}}
                                    </div>
                                    <div class="col-10">
                                        <div class="d-flex justify-content-between font-3">
                                            <strong>{{$experience->title}}</strong>
                                            <a href="{{route('teach.profile.test','experienceDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="experienceID={{$experience->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                        </div>
                                        <div class="text-success">@if($experience->isVerified) <img src="{{asset('icons/welcome/verified-badge.png')}}" width="15" height="15"> Verified @endif</div>
                                        <div class="font-3"><i>{{$experience->institute}}</i></div>
                                        <div class="font-3"><i>{{$experience->description}}</i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </section>
                    <!-- Certification -->
                    <section id="Certification" class="mt-2  ml-1 p-2">
                        <h5 class="mb-1">
                            <img src="{{asset('icons/diploma.svg')}}" alt="" width="30" height="30">
                            <b>Certification </b>
                            <a href="#CertificatesModal" data-toggle="modal" data-target="#CertificatesModal"> <img src="{{asset('icons/plus.svg')}}" alt="" width="20" height="20">Add</a>
                        </h5>
                        @if(!$teacher->teacher_certificates->isEmpty())
                        <div class="row mr-2 ml-2">
                            @foreach($teacher->teacher_certificates as $certificates)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        {{$certificates->from_year}}-{{$certificates->to_year}}
                                    </div>
                                    <div class="col-10">
                                        <div class="d-flex justify-content-between font-3">
                                            <strong>{{$certificates->title}}</strong>
                                            <a href="{{route('teach.profile.test','certificatesDelete')}}" data-remote="true" data-method="post" data-confirm="Are You Sure You Want To Delete This Record" data-params="certificatesID={{$certificates->id}}"><img src="{{asset('icons/delete-x.svg')}}" alt=""> </a>
                                        </div>
                                        <div class="text-success">@if($certificates->isVerified) <img src="{{asset('icons/welcome/verified-badge.png')}}" width="15" height="15"> Verified @endif</div>
                                        <div class="font-3"><i>{{$certificates->institute}}</i></div>
                                        <div class="font-3"><i>{{$certificates->description}}</i></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 ">
            <div class="card mb-4">
                <div class="card-body p-2">
                    <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','price')}}" method="post" data-remote="true">
                        <p class="card-title mb-0">Private Lesson</p>
                        <p class="text-muted">60 minutes</p>
                        <div class="form-group">
                            <label for="">Lesson Price</label>
                            <input type="number" name="lessonPrice" class="form-control" value="{{$teacher->price}}">
                        </div>
                        <div class="form-group">
                            <label for="">Discount</label>
                            <input type="number" name="discount" class="form-control" value="{{$teacher->discount}}">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="trail" <?php echo $teacher->trail ? "checked" : ""; ?>>
                            <label for="">Free Trail for students</label>
                        </div>
                        <div class="form-group">
                            <label for="">Trail class price</label>
                            <input type="number" name="trail_price" class="form-control" value="{{$teacher->trail_price}}">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-sm float-right" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Education Modal -->
<div class="modal fade right" id="EducationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add Education</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','educationAdd')}}" method="post" data-remote="true">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" placeholder="Degree Name" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Institute</label>
                        <input type="text" class="form-control" name="institute" placeholder="Institute Name">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Short Description About your degree">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="from_year">From</label>
                                <input type="month" name="from_year" id="" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="to_year">To</label>
                                <input type="month" name="to_year" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                        <input type="submit" value="Save" class="btn btn-primary m-1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Work Experience -->
<div class="modal fade right" id="ExperienceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add Experience</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','experienceAdd')}}" method="post" data-remote="true">
                    <div class="form-group">
                        <label for="">Job Position</label>
                        <input type="text" class="form-control" placeholder="Position" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Institute/Company</label>
                        <input type="text" class="form-control" name="institute" placeholder="Institute/Company Name">
                    </div>
                    <div class="form-group">
                        <label for="">Job Description</label>
                        <textarea type="text" class="form-control w-100" maxlength="100" rows="5" name="description" placeholder="Short Description About your job position"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="from_year">From</label>
                                <input type="month" name="from_year" id="" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="to_year">To</label>
                                <input type="month" name="to_year" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                        <input type="submit" value="Save" class="btn btn-primary m-1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Certificates -->
<div class="modal fade right" id="CertificatesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add Certification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" data-type="json" action="{{route('teach.profile.test','certificatesAdd')}}" method="post" data-remote="true">
                    <div class="form-group">
                        <label for="">Certificate Title</label>
                        <input type="text" class="form-control" placeholder="Certificate Title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Institute</label>
                        <input type="text" class="form-control" name="institute" placeholder="Institute Name">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Short Description About your Certificate">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="from_year">From</label>
                                <input type="month" name="from_year" id="" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="to_year">To</label>
                                <input type="month" name="to_year" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                        <input type="submit" value="Save" class="btn btn-primary m-1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#aboutMe').summernote({
            placeholder: 'Write something about yourself, so your student can know you better',
            code: `{{$teacher->about}}`,
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

    });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEvents = <?php echo json_encode($classes) ?>;
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridWeek',
            themeSystem: 'bootstrap',
            events: calendarEvents,
            selectable: true,
            editable: true,
            eventClick: function(info) {
                var event = info.event;
                $.ajax({
                    type: 'POST',
                    url: '{{route("teach.profile.timing.delete")}}',
                    data: {
                        start: event.startStr,
                        end: event.endStr,
                        teacher_id: <?php echo $teacher->id; ?>
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        return confirm("Are you want to delete this timing to your timetable?")
                    },
                    success: function(response) {
                        console.log(`sucess: ${response}`)
                        $('#toastMessage').html(response);
                        $('#success').toast('show')
                        location.reload();
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

            },
            select: function(info) {
                $.ajax({
                    type: 'POST',
                    url: '{{route("teach.profile.timing.add")}}',
                    data: {
                        start: info.startStr,
                        end: info.endStr,
                        teacher_id: <?php echo $teacher->id; ?>
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        return confirm("Are you want to add this timing to your timetable?")
                    },
                    success: function(response) {
                        $('#toastMessage').html(response);
                        $('#success').toast('show')
                        location.reload();
                    },
                    error: function(error) {
                        if (error.toast) {
                            $('#toastMessage').html(error.toast);
                            $('#success').toast('show')
                        } else
                            alert('Something went wrong');
                    }
                });

            }
        });
        calendar.render();
    });
    $('form').on('ajax:error', function(event, xhr, status, error) {
        console.log(xhr.responseText);
        $(this).prepend(`<div class="alert alert-danger">${status.message}</div>`)
        setTimeout(() => {
            $('.alert').remove()
        }, 3000);
        // location.reload();
    });
    $('form').on('ajax:success', function(data, status, xhr) {
        $(this).prepend(`<div class="alert alert-success">${status.message}</div>`)
        setTimeout(() => {
            $('.alert').remove()
        }, 3000);
        location.reload();
    });
</script>
@endsection
