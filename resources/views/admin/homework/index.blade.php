@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <h3>Homework Panel</h3>
            <hr />
            @if(!$homeworks->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Teacher Name</th>
                            <th>Student Name</th>
                            <th>Homework</th>
                            <th>Response</th>
                            <th>Checked</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($homeworks as $homework)
                        <tr>
                            <td>{{$homework->id}}</td>
                            <td>{{$homework->lesson->teacher->name}}{{ $homework->lesson->teacher->lastname}}</td>
                            <td>{{$homework->lesson->user->name}}{{ $homework->lesson->user->lastname}}</td>
                            <td>
                                <form action="{{route('admin.homework.download',['type'=>'homework','id'=>$homework->id])}}" method="get">
                                    @csrf
                                    <input type="submit" value="Download" class="btn btn-primary btn-sm">
                                </form>
                            </td>
                            <td> @if ($homework->response_path != '')
                                <form action="{{route('admin.homework.download',['type'=>'response','id'=>$homework->id])}}" method="get">
                                    @csrf
                                    <input type="submit" value="Download" class="btn btn-primary btn-sm">
                                </form>
                                @else
                                <div class="badge badge-fill badge-info p-2">
                                    No response
                                </div>
                                @endif
                            </td>
                            <td>
                                @if ($homework->isChecked)
                                <div class="badge badge-fill badge-success p-2">
                                    Scored
                                </div>
                                @else
                                <div class="badge badge-fill badge-warning p-2">
                                    Need Evaluation
                                </div>
                                @endif
                            </td>
                            <td>{{$homework->marks}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{$homeworks->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
