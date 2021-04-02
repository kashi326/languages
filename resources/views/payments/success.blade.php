@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 m-auto mt-3">
            @if($success)
            <h3>Congratulation!</h3>
            <div class="alert alert-success">You have successful paid the course fee.</div>
            @else
            <h3>Error!</h3>
            <div class="alert alert-danger">Opps...Something went wrong.</div>
            @endif
        </div>
    </div>
</div>
@endsection
