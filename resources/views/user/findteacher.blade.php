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

<div class="container-fluid">
    @if(count($teachers)>0)
    @foreach($teachers as $teacher)
    <div class="row">
        <div class="col-12 col-md-8 m-auto mt-3">
            <div class="card">
                <div class="card-horizontal">
                    <div class="img-square-wrapper p-2">
                        <img class="" src="{{$teacher->avatar?asset($teacher->avatar):asset('images/default.png')}}" alt="" width="150" height="150">
                    </div>
                    <div class="card-body p-2">
                        <div>
                            <span class="card-title font-size-18">{{$teacher->teachername}}</span>
                            @if($teacher->isVerified)
                            <img src="/icons/welcome/verified-badge.png" alt="teacher icon">
                            @endif
                            <a href="{{route('view.teacher',[$teacher->teacherid,$teacher->teachername])}}" class="btn btn-primary rounded-button float-right d-none d-md-block">Book Free Trail</a>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="ml-sm-2">
                                Teaches:
                                <h5>English</h5>
                            </div>
                            <div class="ml-sm-2">
                                From: <h5>{{$teacher->country}}</h5>
                            </div>
                            <div class="ml-sm-2">
                                Lessons: <h5>0</h5>
                            </div>
                        </div>
                        <p class="font-size-14 mb-1 mt-1">Speaks: </p>
                        <p class="card-text pr-2" style="word-break: break-word;">{!! substr($teacher->about,0,300) !!}</p>
                    </div>
                </div>
                <a href="{{route('view.teacher',[$teacher->teacherid,$teacher->teachername])}}" class="btn btn-primary rounded-button  d-block d-md-none">Book Free Trail</a>
            </div>
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
@endsection