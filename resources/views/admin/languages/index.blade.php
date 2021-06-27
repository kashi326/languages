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
                                <a href="{{$item->avatar?asset($item->avatar):asset('/icons/translate.png')}}" data-fancybox="gallery">
                                    <img src='{{$item->avatar?asset($item->avatar):asset("/icons/translate.png")}}' width="50" height="50" alt="language image" class="img-thumbnail">
                                </a>
                            </td>
                            <td style="width: 20%">
                                <a href="{{route('admin.lang.edit',$item)}}" class="btn btn-primary btn-sm hvr-shadow">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{route('admin.lang.destroy',$item)}}" class="d-inline-block mt-1" onsubmit="return confirm('Are you sure want to delete this item?');" method="POST">
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
                </TABLE>
            </div>
            <div class="d-flex justify-content-end pr-3">
                <div class="d-flex justify-content-end align-items-center">
                    <select id="pageSize" class="form-control form-select" style="max-width:max-content">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    {{$langs->links()}}
                </div>
            </div>
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
<script>
    function currentPageSize() {
        var searchParams = new URLSearchParams(window.location.search);
        var size = searchParams.get('pageSize')
        $('#pageSize').val(size ? size : 10)
    }
    currentPageSize()
    $(function() {
        $('#pageSize').change(function() {
            var value = $(this).val()
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set('pageSize', value)
            var newParams = searchParams.toString();
            const newUrl = window.location.origin + window.location.pathname + "?" + newParams;
            location.replace(newUrl);
        })
    })
</script>
@endsection
