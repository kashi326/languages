@extends('layouts.app')
@section('content')

@include('layouts.dashboardNav')
<style>
    [class*='col-'] {
        /* contains col-lg in class name */
        padding-top: 2px !important;
        padding-bottom: 2px !important;
    }

    .form-check-input {
        opacity: 0;
    }
</style>
<div class="container pt-3">
    <div class="row">
        <div id="section" class="col-12 col-md-8">
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
                            <option value="missed">Missed</option>
                        </select>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            @if(auth()->user()->role == 'user')
                            <input type="text" class="form-control" id="searchbyteacher" placeholder="Search by Teacher name">
                            @else
                            <input type="text" class="form-control" id="searchbyteacher">
                            @endif
                        </div>
                    </div>
                </div>
                <div id="listContent">
                    {!! $list !!}
                </div>
            </div>
            <div id="calendarDisplay"></div>
        </div>
        <div class="col-md-4 d-none d-md-block">
            <div class="card mt-0">
                <div class="card-head mt-2 mb-2 ml-0 mr-0" style="background:#f2f2f2">
                    <h3 class="ml-2">Lessons Overview</h3>
                </div>
                <div class="card-boy m-2">
                    <div class='mt-2 d-flex'>
                        <div class="ml-aut">
                            <div class="text-center">
                                <h5>{{$count['attended']}}</h5>
                            </div>
                            <h5 for="">Attended</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="text-center">
                                <h5>{{$count['past']}}</h5>
                            </div>
                            <h5 for="">Past</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="text-center">
                                <h5>{{$count['upcoming']}}</h5>
                            </div>
                            <h5 for="">UpComing</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
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
            var showBy = $('#status').val();
            console.log(searchBy);
            $.ajax({
                url: '/dashboard/lessons?showBy=' + showBy + '&search=' + searchBy,
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
            var searchBy = $('#searchbyteacher').val();
            console.log(searchBy);
            $.ajax({
                url: '/dashboard/lessons?showBy=' + showBy + '&search=' + searchBy,
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
