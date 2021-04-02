@extends('layouts.app')

@section('content')
@include('teach.layouts.DashboardNav')
<style>
    .side-links li a {
        cursor: pointer;
    }
</style>
<div class="container">
    <div id="errorMessage"></div>
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card">
                <ul class="list-group side-links">
                    <li class="list-group-item"><a class="text-decoration-none" onclick="sendGetRequest('all')"> All Classes</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" onclick="sendGetRequest('scheduled')"> Upcoming Classes</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" onclick="sendGetRequest('incomplete')">Missed Classes</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" onclick="sendGetRequest('completed')"> Completed Classes</a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div id="message" class="d-none alert alert-info">
                Please wait while we fetch your data
            </div>
            <div id="content">
                {!! $html !!}
            </div>
        </div>
    </div>
    <script>
        function sendGetRequest(showBy) {
            $('#message').removeClass("d-none");
            $.ajax({
                url: '/teacher/lesson/record?showBy=' + showBy,
                type: 'GET',
                success: function(response) {
                    $('#message').addClass("d-none");
                    $('#content').html(response);
                },
                error: function(error) {
                    $('#message').addClass("d-none");
                    $('errorMessage').html('<span class="text-danger">Something went wrong<span>')
                }

            })
        }
    </script>
</div>

@endsection
