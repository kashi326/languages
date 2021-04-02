@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <h3>Features Panel</h3>
            <hr />
            @if(!$features->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Information</th>
                            <th>Votes</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $feature)
                        <tr>
                            <td>{{$feature->id}}</td>
                            <td>{{$feature->title}}</td>
                            <td>{{$feature->information}}</td>
                            <td>{{$feature->votes}}</td>
                            <td>
                               <?php echo Form::select('status', array('Open' => 'Open', 'UnderReview' => 'Under Review', 'Planned' => 'Planned', 'InProgress' => 'In Progress', 'Completed' => 'Completed', 'Closed' => 'Closed'), $feature->status,['class'=>'form-control browser-default custom-select', 'data-url'=>route('feature.update',$feature->id), 'data-remote'=>"true", 'data-method'=>'put']); ?>
                            </td>
                        <td><a href="{{route('feature.show',$feature->id)}}" class="badge badge-fill badge-success p-2">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{$features->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
