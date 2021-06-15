@extends('layouts.app')
@section('content')
    {{-- @include('layouts.settingNav') --}}
    <style>
        .side-links {
            cursor: pointer;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" hidden>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="card">
                    <ul class="list-group side-links">
                        <li class="list-group-item"><a class="text-decoration-none profile-link"
                                                       href="{{route('setting.profile.get')}}" data-remote="true"
                                                       data-method="get"> <img src="{{asset('icons/gears.svg')}}" alt=""
                                                                               width="25" height="25"> General</a></li>
                        <li class="list-group-item"><a class="text-decoration-none profile-link"
                                                       href="{{route('setting.profile.picture.get')}}"
                                                       data-remote="true" data-method="get"> <img
                                    src="{{asset('icons/camera.svg')}}" alt="" width="25" height="25"> Profile Photo</a>
                        </li>
                        <li class="list-group-item"><a class="text-decoration-none profile-link"
                                                       href="{{route('setting.language.get')}}" data-remote="true"
                                                       data-method="get"> <img src="{{asset('icons/tlanguage.svg')}}"
                                                                               alt="" width="25" height="25"> Languages</a>
                        </li>
                        <li class="list-group-item"><a class="text-decoration-none profile-link"
                                                       href="{{route('setting.password.get')}}" data-remote="true"
                                                       data-method="get"> <img src="{{asset('icons/lock.svg')}}" alt=""
                                                                               width="25" height="25"> Password</a></li>
{{--                        <li class="list-group-item"><a class="text-decoration-none profile-link"--}}
{{--                                                       href="{{route('setting.notification.get')}}" data-remote="true"--}}
{{--                                                       data-method="get"> <img--}}
{{--                                    src="{{asset('icons/appointment_reminders.svg')}}" alt="" width="25" height="25">--}}
{{--                                Notifications</a></li>--}}
                        <li class="list-group-item"><a class="text-decoration-none profile-link"
                                                       href="{{route('setting.payments.get')}}" data-remote="true"
                                                       data-method="get"> <img src="{{asset('icons/card_in_use.svg')}}"
                                                                               alt="" width="25" height="25">
                                Payments</a></li>
                        @if(Auth::user()->role != 'admin')
                            <li class="list-group-item"><a class="text-decoration-none profile-link"
                                                           href="{{route('setting.user.get')}}" data-remote="true"
                                                           data-method="get"> <img src="{{asset('icons/minus.svg')}}"
                                                                                   alt="" width="25" height="25">
                                    Deactivate</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div id="message"></div>
                <div id="main_content" class="mainContent">
                    {!! $html !!}
                </div>
            </div>
        </div>
    </div>


    <script>
        $('.profile-link').bind('ajax:success', function (data, status, xhr, code) {
            $('.mainContent').html(status);
        })
        $('.profile-link').bind('ajax:beforeSend', function () {
            $('.card-body').prepend("<div class='alert alert-info'>Please wait while we process your request</div>")
        })
        $(document).bind('ajax:success', '#main_content form', function (data, status, xhr, code) {
            if (xhr.status == 202) {
                location.reload();
            }
            if (status.message) {
                $('#main_content form').prepend(`<div class="alert alert-success">${status.message}</div>`)
            }
        })
        $(document).bind('ajax:error', 'form', function (event, xhr, status, error) {
            if (xhr.status == 401||xhr.status == 400) {
                var errors = JSON.parse(xhr.responseText);
                Object.entries(errors.message).map(([index, value]) => {
                    $("#" + index).addClass("is-invalid");
                    $("#" + index + "Error").addClass("text-danger");
                    $("#" + index + "Error").text(value);
                });
            } else if (xhr.status == 500) {

                $("form").prepend(
                    `<div class="alert alert-danger">${xhr.responseJSON.message}</div>`
                );
            } else {
                $("form").prepend(
                    `<div class="alert alert-info">Hmm, something went wrong. Please try again.</div>`
                );
            }
            setTimeout(() => {
                $('.alert').remove()
            }, 2500)
        });

        function sendPostRequest(urlPath) {
            $.ajax({
                url: urlPath,
                type: "POST",
                enctype: 'multipart/form-data',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('form').serialize(),
                success: function (response) {
                    console.log(response);
                    $('#message').html('<div class="valid-feedback" style="display:block"><span class="alert alert-success d-block">' + response.message + '</span></div>');

                    setTimeout(() => {
                        $('.alert').remove()
                    }, 2500)
                },
                error: function (error) {
                    console.log(error);
                    if (error.message)
                        $('#message').html('<div class="invalid-feedback" style="display:block"><span class="alert alert-danger d-block">' + error.message + '</span></div>')
                    else {
                        $('#message').html('<div class="invalid-feedback" style="display:block"><span class="alert alert-danger d-block">' + error.responseJSON.message + '</span></div>')
                        var errors = error.responseJSON.errors;
                        if (errors) {
                            for (const [key, value] of Object.entries(errors)) {
                                console.log(key);
                                $('#' + key + 'Error').html(value);
                                $('#' + key + 'Error').css('display', 'block');
                            }
                        }
                        setTimeout(function () {
                            $('.alert').css('display', 'none')
                            $('.invalid-feedback').css('display', 'none')
                        }, 3000)
                    }
                }
            });
        }

        function sendPostImageRequest(urlPath) {
            var formData = new FormData(document.getElementById("profileForm"));

            $.ajax({
                type: 'POST',
                url: urlPath,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data)
                    $('#message-profile').html('<div class="valid-feedback" style="display:block"><span class="alert alert-success d-block">' + data.message + '</span></div>')
                    $('#profile').html(data.profilePicture);
                    setTimeout(() => {
                        $('#message-profile').html("")
                    }, 2500)
                },
                error: function (data) {
                    let errors = data.responseJSON;
                    Object.keys(errors).map(err=>{
                        $('#message-profile').append(`<div class="alert alert-danger">${errors[err]}</div>`);
                    })
                    setTimeout(() => {
                        $('#message-profile').html("")
                    }, 3000)
                }
            });
        }

        // $('.list-group-item').click(function (){
        //     var value = $(this).find('a').attr('href')
        //     var searchParams = new URLSearchParams(window.location.search);
        //     searchParams.set('current', value)
        //     var newParams = searchParams.toString();
        //     const newUrl = window.location.origin + window.location.pathname + "?" + newParams;
        //     location.replace(newUrl);
        // })
    </script>
@endsection
