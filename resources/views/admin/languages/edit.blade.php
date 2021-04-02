@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="d-inline-block">Edit Language</h3>
            <a href="{{route('admin.lang.index')}}" class="btn btn-primary float-right hvr-shadow">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <hr>

            <form action="{{route('admin.lang.update',$lang)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="enter language name" value="{{$lang->name}}">
                    @error('name')
                    <span class="invalid-feedback d-inline-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="7" class="form-control @error('description') is-invalid @enderror"
                        placeholder=" enter language details">{{$lang->description}}</textarea>
                    @error('description')
                    <span class="invalid-feedback d-inline-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="code">Langauge Code</label>
                    <input type="text" name="code" id="code" class="form-control @error('name') is-invalid @enderror" placeholder="Enter language code e.g en for english" value="{{$lang->name}}">
                    @error('code')
                    <span class="invalid-feedback d-inline-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="avatar">Picture</label>
                    <input type="file" name="avatar" id="avatar" class="jfilestyle @error('avatar') is-invalid @enderror" accept=" image/*"> @error('avatar') <span class="invalid-feedback d-inline-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary hvr-shadow">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('dist/jquery-filestyle.min.js')}}" defer></script>
@endsection
