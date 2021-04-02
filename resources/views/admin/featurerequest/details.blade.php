@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="font-4">Features</h1>
            <p class="lead">{{$feature->title}}</p>
            <hr class="my-2">
            <p>{{$feature->information}}</p>
            <div class="row px-2">
                <p class="lead">
                    <label for="">Status</label>
                    <?php echo Form::select('status', array('Open' => 'Open', 'UnderReview' => 'Under Review', 'Planned' => 'Planned', 'InProgress' => 'In Progress', 'Completed' => 'Completed', 'Closed' => 'Closed'), $feature->status,['class'=>'form-control browser-default custom-select', 'data-url'=>route('feature.update',$feature->id), 'data-remote'=>"true", 'data-method'=>'put']); ?>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
