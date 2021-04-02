@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<style>
    .lang-image {
        width: 20%;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
        <h3 class="d-inline-block">{{__('text.language')}}</h3>
            <a href="{{route('admin.lang.create')}}" class="btn btn-primary float-right hvr-shadow">
                <i class="fas fa-plus"></i>
                Create
            </a>
            <hr>

            @include("flash::message")

            @if(count($langs) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($langs as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td style="width: 40%"><strong>{{$item->name}}</strong></td>
                            <td>
                                <a href="{{asset($item->avatar)}}" data-fancybox="gallery">
                                    <img src='{{asset($item->avatar)}}' alt="language image"
                                        class="img-thumbnail lang-image">
                                </a>
                            </td>
                            <td style="width: 20%">
                                <a href="{{route('admin.lang.edit',$item)}}" class="btn btn-primary btn-sm hvr-shadow">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{route('admin.lang.destroy',$item)}}" class="d-inline-block mt-1"
                                    onsubmit="return confirm('Are you sure want to delete this item?');" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm hvr-shadow">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$langs->links()}}
            @else
            <div class="container-fluid">
                @include("includes.notfound")
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
