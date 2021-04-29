@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('content')
    <style>
        .card-horizontal {
            display: flex;
            flex: 1 1 auto;
        }
    </style>

    <div uk-sticky class="card mt-0">
        <div class="d-flex justify-content-start py-3 mb-2 w-75 mx-auto">
            <button class="uk-button bg-light uk-button-default mx-2" type="button">I Want To Learn</button>
            <div uk-dropdown>
                <ul class="uk-nav uk-dropdown-nav">
                    @foreach($langs as $l)
                        <li><a href="/findteacher?lang={{$l->name}}">{{$l->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <button class="uk-button bg-light uk-button-default mx-2" type="button">From Country</button>
            <div uk-dropdown>
                <ul class="uk-nav uk-dropdown-nav">
                    @foreach($countries as $country)
                        <li><a href="/findteacher?from={{$country->country}}">{{$country->country}}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- <button class="uk-button bg-light uk-button-default mx-2" type="button">Speciality</button>
            <div uk-dropdown>
                <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="#">English</a></li>
                    <li><a href="#">French</a></li>
                    <li><a href="#">Spanish</a></li>
                    <li><a href="#">Arabic</a></li>
                </ul>
            </div> -->
            <form method="get" action="/findteacher" class="uk-search uk-search-default ml-auto"
                  style="min-width: 230px;">
                <button type="submit" class="uk-search-icon-flip" uk-search-icon></button>
                <input class="uk-search-input bg-light" name="search" type="search" placeholder="Search">
            </form>
        </div>
    </div>
    <div class="container-fluid">
        @if(count($teachers)>0)
            @foreach($teachers as $teacher)
                <div class="row">
                    <div class="col-12 col-md-7 offset-1 mt-3 teacher_card">
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="img-square-wrapper p-2">
                                    <img class=""
                                         src="{{$teacher->avatar?asset($teacher->avatar):asset('images/default.png')}}"
                                         alt="" width="150" height="150">
                                </div>
                                <div class="card-body p-2">
                                    <div>
                                        <span class="card-title font-size-18">{{$teacher->teachername}}</span>
                                        @if($teacher->isVerified)
                                            <img src="/icons/welcome/verified-badge.png" alt="teacher icon">
                                        @endif
                                        <a href="{{route('view.teacher',[$teacher->teacherid,$teacher->teachername])}}"
                                           class="btn btn-primary rounded-button float-right d-none d-md-block">Book
                                            Free Trail</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="ml-sm-2">
                                            <strong> Teaches:</strong>
                                            <h5 class="mt-1">{{$teacher->languagename}}</h5>
                                        </div>
                                        <div class="ml-sm-2">
                                            <strong> From:</strong> <h5 class="mt-1">{{$teacher->country}}</h5>
                                        </div>
                                        <div class="ml-sm-2">
                                            <strong>Total Lessons:</strong> <h5
                                                class="mt-1">{{$teacher->lessons_count}}</h5>
                                        </div>
                                    </div>
                                    <p class="font-size-14 mb-1 mt-1 font-weight-bold">Speaks: </p>
                                    <p class="card-text pr-2"
                                       style="word-break: break-word;">{!! substr($teacher->about,0,300) !!}</p>
                                </div>
                            </div>
                            <a href="{{route('view.teacher',[$teacher->teacherid,$teacher->teachername])}}"
                               class="btn btn-primary rounded-button  d-block d-md-none">Book Free Trail</a>
                        </div>
                    </div>
                    <div class="col-md-4 m-auto intro_card mt-3 d-none">
                        @if($teacher->intro)
                            <div class="card d-flex">
                                <div class="card-body">
                                    <iframe src="{{$teacher->intro}}" class="mx-auto w-100" height="250" frameborder="0"
                                            uk-video="autoplay:false"></iframe>
                                    <a href="{{route('view.teacher',[$teacher->teacherid,$teacher->teachername])}}"
                                       class=" mt-1 btn btn-primary d-block">Book Lesson</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="container mt-5">
                @include("includes.notfound")
            </div>
        @endif
        @if(count($teachers)>0)
            <div>
                <div class="pagination">
                    <div style="flex: 0 100%"></div>
                    {{ $teachers->render() }}
                </div>
            </div>
        @endif
    </div>
    <script async src="{{asset('js/countries.js')}}"></script>
    <script>
        $(function () {
            $('.teacher_card').hover(function () {
                $('.intro_card').addClass('d-none')
                $(this).next().removeClass('d-none')
            })
        })
    </script>
@endsection
