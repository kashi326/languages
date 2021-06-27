@extends('layouts.app')
@section('content')

@include('layouts.dashboardNav')
<div class="container">

    <div class="w-100 card">
        <div class="card-header mb-3">
            <h4>Rescedule Class</h4>
        </div>
        <div class="card-body">
            <div id="message"></div>
            <div id="calendar"></div>
        </div>
    </div>
</div>
<script>
    var calendarEvents = <?php echo json_encode($classes) ?>;
    console.log("calendar events", calendarEvents)
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
        },
        initialView: 'timeGridWeek',
        themeSystem: 'bootstrap',
        slotDuration: '00:30',
        events: calendarEvents,
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        },
        eventClick: function(info) {
            var eventObj = info.event;
            console.log(eventObj)
            if (eventObj.extendedProps.link) {
                alert('this will rescedule your class at ' + eventObj.start);
                $.ajax({
                    url: eventObj.extendedProps.link,
                    method: 'post',
                    success: (res) => {
                        $('message').html(`
                            <div class="alert alert-success">${res.message}</div>
                        `)
                        setTimeout(() => {
                            window.location.href = "/dashboard"
                        }, 2000);
                    },
                    error: (error) => {
                        $('message').html(`
                            <div class="alert alert-danger">${error.response.error}</div>
                        `)
                    }
                })
            }
        },

        eventMouseEnter: function(mouseEnterInfo) {
            var event = mouseEnterInfo.el;
            event = $(event).closest('.fc-timegrid-event-harness');

        },
    });
    calendar.render();
</script>
@endsection
