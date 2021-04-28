<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/locales-all.min.js"></script>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="{{asset('css/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/layouts/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css">
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand primary-color" href="{{ url('/') }}">
                    <strong>{{ config('app.name', 'Laravel') }}</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::user())
                        <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle  dropdown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #1997fd !important;">
                                    Community
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- <a class="dropdown-item pl-2" href="{{Auth::user()->role!='teacher'?route('decks'):route('decks.index')}}"><img src="{{asset('icons/sheets.svg')}}" width="35"><span class="ml-2">Explore Decks</span></a> -->
                                    <!-- <a class="dropdown-item pl-2" href="{{route('discussion.index')}}"><img src="{{asset('icons/collaborationfemalemale.svg')}}" width="35"><span class="ml-2"> Discussion</span></a> -->
                                    <a class="dropdown-item pl-2" href="{{route('feature.index')}}"><img src="{{asset('icons/idea.svg')}}" width="35"><span class="ml-2"> Feature Suggestion</span></a>
                                </div>
                            </div>
                        </li>

                        @if(Auth::user()->role == 'user')
                        <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle dropdown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- <a class="dropdown-item" href="">Buy a gift</a> -->
                                    <a class="dropdown-item" href="{{ route('teach.join') }}">Apply To Teach</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'teacher')
                        <li class="nav-item" style="font-weight: 400;">
                            <a class="nav-link side-link" href="{{route('teach.lesson.record')}}" style="color: #1997fd !important;"> Teacher Dashboard</a>
                        </li>
                        @endif
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <button id="navbarDropdown" class="nav-link dropdown-toggle dropdown-button" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#1997fd !important">
                                {{__('text.language')}} <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/lang/en">English</a>
                                <a class="dropdown-item" href="/lang/fr">French</a>

                            </div>
                        </li>
                        @if(auth::check())
                        <li class="nav-item dropdown">
                            <button id="navbarDropdown" class="nav-link dropdown-toggle dropdown-button" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#1997fd !important">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper" style="max-height: 300px;" aria-labelledby="navbarDropdown" id="NotificationCard">
                                <!-- Notifications are placed here -->
                                <p class="m-3"><b>you have no new notifications</b></p>
                            </div>
                        </li>
                        @endif
                        @guest
                        <li class="nav-item">
                            <a class="nav-link primary-color" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link primary-color" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle primary-color" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role == 'admin')
                                <a href="{{route('admin.index')}}" class="dropdown-item">
                                    Admin Panel
                                </a>
                                @endif
                                @if(Auth::user()->role != 'admin')
                                <a class="dropdown-item" href="{{route('dashboard')}}"> Dashboard</a>
                                @endif
                                <a class="dropdown-item" href="{{route('setting.profile.get')}}"> Setting</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        @auth
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Languages</h3>
                        @if(Auth::check() && Auth::user()->role=='user')
                        <p><a href="{{route('teach.join')}}">Apply To Teach</a></p>
                        @endif
                        <!-- <p><a href="#">Articles</a></p> -->
                        <!-- <p><a href="#">Discussion</a></p> -->
                        <p><a href="{{route('privacy')}}">Privacy Policy</a></p>
                        <p><a href="#">Support</a></p>
                    </div>
                    <div class="col-md-4">
                        <h3>Languages</h3>
                        <p><a href="#">Learn English Language</a></p>
                        <p><a href="#">Learn Spanish Language</a></p>
                        <p><a href="#">Learn French Language</a></p>
                        <p><a href="#">Learn Italian Language</a></p>
                        <p><a href="#">All Languages</a></p>
                    </div>
                    <div class="col-md-4 social">
                        <h3>Social</h3>
                        <div>
                            <a href="#">
                                <img src="{{asset('icons/welcome/facebook.png')}}" alt="facebook" class="icon">
                                <h5>Facebook</h5>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{asset('icons/welcome/instagram-sketched.png')}}" alt="instagram" class="icon">
                                <h5>Instagram</h5>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{asset('icons/welcome/twitter.png')}}" alt="twitter" class="icon">
                                <h5>Twitter</h5>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{asset('icons/welcome/copyright.png')}}" alt="copyright" class="icon">
                                <h5>Leanguage Learner 2020</h5>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth
    @yield('scripts')
    <script src="{{asset('js/ajax-obstructive.js')}}"></script>
    <script src="{{asset('js/uikit.min.js')}}"></script>
    @if (Auth::check())
    <script>
        $(function() {
            var pusher = new Pusher('{{config()->get("broadcasting.connections.pusher.key")}}', {
                cluster: '{{config()->get("broadcasting.connections.pusher.options.cluster")}}'
            });
            var channel = pusher.subscribe('payment-channel');
            channel.bind('payment-received', function(data) {
                $('body').append(data.message.amount + ' recevied (Ref # ' + data.message.ref_id + ')<br>');
            });

            // new Echo.channel('payment-channel')
            //     .listen('.payment-received', (data) => {
            //         console.log(data);
            //         $('#p-alert').append(data.message.amount + ' recevied (Ref # ' + data.message.ref_id + ')<br>');
            //     });
        })
    </script>
    <script>
        var id = '<?php echo Auth::id() ?>';
        var role = '<?php echo Auth::user()->role ?>';
        $.ajax({
            url: '/api/notifications/' + id,
            cache: false,
            success: function(data) {
                var html = '';
                data.forEach((item) => {
                    var line = JSON.parse(item.data);
                    if (role == 'user')
                        html += `
                                <div class="notification-list notification-list--unread">
                                    <div class="notification-list_img">
                                        <img src="/<?php echo Auth::user()->avatar ?>" alt="user">
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo Auth::user()->name ?> you purchased a lesson for $ ${line.amount}</p>
                                    </div>
                                </div>`
                    else
                        html += `
                                 <div class="notification-list notification-list--unread">
                                    <div class="notification-list_img">
                                        <img src="/<?php echo Auth::user()->avatar ?>" alt="user">
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo Auth::user()->name ?> A student has purchased a lesson with you for $ ${line.amount}</p>
                                    </div>
                                </div>`

                })
                if (html == '') {
                    html = `<p class="m-3"><b>you have no new notifications</b></p>`
                }
                $('#NotificationCard').html(html);
            }
        });
    </script>
    @endif
</body>

</html>
