<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/9b4e0d0281.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/layouts/admin.css') }}" />
    <style>
        .not-found {
            width: 100%;
            text-align: center;
        }

        .not-found img {
            width: 10%;
            height: 10%;
            margin-bottom: 3%;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config("app.name", "Laravel") }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __("Login") }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __("Register") }}</a>
                        </li>
                        @endif @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __("Logout") }}
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
            <div class="container-fluid" id="layout">
                <div class="row">
                    <div class="col-md-3 col-lg-2 col-sm-4 shadow-sm" id="sidebar">
                        <ul class="list-group">
                            <a href="#">
                                <li class="list-item">
                                    <img src="{{ asset('icons/home.png') }}" alt="home image" width="35" />
                                    <span>{{ __("text.home") }}</span>
                                </li>
                            </a>
                            <a href="{{ route('admin.lang.index') }}">
                                <li class="list-item">
                                    <img src="{{
                                                asset('icons/language.svg')
                                            }}" alt="language image" width="35" />
                                    <span>{{ __("text.language") }}</span>
                                </li>
                            </a>
                            <a href="{{ route('admin.teacher.index') }}">
                                <li class="list-item">
                                    <img src="{{
                                                asset('icons/teacher.png')
                                            }}" alt="teacheer image" width="35" />
                                    <span>{{ __("text.teachers") }}</span>
                                </li>
                            </a>
                            <a href="{{ route('admin.user.index') }}">
                                <li class="list-item">
                                    <img src="{{ asset('icons/user.svg') }}" alt="user image" width="35" />
                                    <span>{{ __("text.users") }}</span>
                                </li>
                            </a>
                            <a href="{{ route('admin.lesson') }}">
                                <li class="list-item">
                                    <img src="{{ asset('icons/coaching.svg') }}" alt="user image" width="35" />
                                    <span>{{ __("text.lessons") }}</span>
                                </li>
                            </a>
                            <a href="{{ route('admin.lesson.homework') }}">
                                <li class="list-item">
                                    <img src="{{ asset('icons/homework.svg') }}" alt="user image" width="35" />
                                    <span>{{ __("text.homeworks") }}</span>
                                </li>
                            </a>
                            <!-- <a href="{{ route('admin.decks') }}">
                                <li class="list-item">
                                    <img src="{{ asset('icons/sheets.svg') }}" alt="home image" width="35" />
                                    <span>{{ __("text.decks") }}</span>
                                </li>
                            </a> -->
                            <a href="#" data-toggle="collapse" data-target="#collapse1">
                                <li class="list-item">
                                    <img src="{{ asset('icons/settings.svg') }}" alt="home image" width="35" />
                                    <span>{{ __("text.settings") }}</span>
                                </li>
                            </a>
                            <ul class="drop-down collapse w-75 m-auto mb-5" id="collapse1" aria-expanded="false" style="list-style: none">
                                {{-- <li class="nav-item active">--}}
                                {{-- <a href="{{route("admin.setting.subject")}}" class="nav-link">Subjects</a>--}}
                                {{-- </li>--}}
                                <li class="nav-item">
                                    <a href="{{route("admin.setting.testpreparation")}}" class="nav-link">Test Preparation</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route("admin.setting.to")}}" class="nav-link">Teach to Age</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route("admin.setting.level")}}" class="nav-link">TeachIng Levels</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route("admin.setting.include")}}" class="nav-link">Lesson Includes</a>
                                </li>
                            </ul>
                            <a href="{{ route('admin.feature.index') }}">
                                <li class="list-item">
                                    <img src="{{ asset('icons/idea.svg') }}" alt="Features" width="35" />
                                    <span>{{ __("text.features") }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>

                    <div class="col-md-9 col-lg-10  col-sm-8" id="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{asset('js/ajax-obstructive.js')}}"></script>
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script>
        $(".alert")
            .not(".alert-important")
            .delay(4000)
            .fadeOut(400);
    </script>

    @yield("scripts")
</body>

</html>
