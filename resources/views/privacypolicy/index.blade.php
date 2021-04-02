@extends("layouts.app")
@section("content")
    <div class="cotainer">
        <div class="card mx-auto"  style="width: 90%">
            <div class="card-header d-flex justify-content-between">
                <h3 class="text-main">Privacy Policy</h3>
                @if (Auth::user() && Auth::user()->role == 'admin')
                    <a href="{{route('admin.privacy.edit')}}" class="btn btn-primary">Edit</a>
                @endif
            </div>
            <div class="card-body px-4">
                @foreach ($pp as $item)
                    <h4><strong>{{$item->heading??''}}</strong> </h4>
                    <div class="px-1 px-md-3">{!! $item->content??'' !!}</div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
