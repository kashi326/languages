@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if (count($decks))
            <div class="row">
                @foreach ($decks as $deck)
                <div class="col-6 col-md-3">
                    <div class="card mb-2 m-3" style="min-height: 350px;">
                        <img class="card-img-top" src="{{asset($deck->cover_image)??asset('/images/avatar.png')}}" alt="Card image cap" style="max-height: 230px;">
                        <div class="card-body p-2">
                            <h4 class="card-title text-left text-capitalize"><b>{{$deck->name}}</b></h4>
                            <p class="card-text ">{{$deck->description}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('decks.view',$deck->id)}}" class="btn btn-primary d-block">Learn</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end pr-3">
                {{$decks->links()}}
            </div>
            @else
                <h4 class="text-center">No Decks Added yet.</h4>
            @endif
        </div>
    </div>
</div>
@endsection
