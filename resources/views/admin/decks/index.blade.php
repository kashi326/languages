@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <h3>Decks Panel</h3>
            <hr />
            @if(!$decks->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Teacher Name</th>
                            <th>Title</th>
                            <th>Langauge In </th>
                            <th>Translate to</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($decks as $deck)
                        <tr>
                            <td>{{$deck->id}}</td>
                            <td>{{$deck->teacher->name}}{{ $deck->teacher->lastname }}</td>
                            <td>{{$deck->title}}</td>
                            <td>{{$deck->language_in->name}}</td>
                            <td>{{$deck->language_to->name}} </td>
                         <td><a href="{{route('admin.deck.view',$deck->id)}}">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{$decks->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
