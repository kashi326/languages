@extends('layouts.admin')

@section('styles')
<style>
    #main-content #search-table,
    #progress {
        display: none;
    }

    /* #main-content .table {
    text-align: center;
} */
    #main-content .input-group {
        width: 30%;
    }
</style>
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="card" id="main-content">
        <div class="card-body">
            <h4 class="d-inline-block">Users</h4>
            <hr>
            @if(count($users) > 0)
            <form class="mt-3" onsubmit="formSubmit(event)">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="search for user" id="search">
                </div>
            </form>

            <div id="progress" class="text-center">
                <div class="spinner-border text-primary text-center" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="mt-3 mb-3">
                @include("flash::message")
            </div>
            <div class="mt-3 mb-3" id="message">
            </div>

            <h3 class="text-center" style="color: red;display: none;" id="not-found">No record found</h3>

            <div class="table-responsive" id="search-table">
                <table class="table mt-4">
                    <thead>
                        <th>NO #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="table-responsive" id='default-table'>
                <table class="table mt-4">
                    <thead>
                        <th>NO #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><b>{{$user->name}}{{ $user->lastname}}</b></td>
                            <td>{{$user->email}}</td>
                            <td class="d-flex">
                                @if ($user->deleted_at)
                                <a href="{{route('admin.user.restore')}}" class="btn btn-info btn-sm mx-1" data-remote="true" data-method="post" data-params="id={{$user->id}}">Restore</a>
                                @else
                                <form action="{{route('admin.user.destroy',$user)}}" method="POST" onsubmit="return confirm('Are you sure want to delete this user?')">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm hvr-shadow" type="submit">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end pr-3">
                <div class="d-flex justify-content-end align-items-center">
                    <select id="pageSize" class="form-control form-select" style="max-width:max-content">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    {{$users->links()}}
                </div>
            </div>

            @else
            <p>No user found.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')

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
<script>
    $("#search").on('keyup', function(e) {
        if (e.which == 13) {
            // formSubmit(e);
        } else {
            var input = $(this).val();
            if (input == "") {
                $('#default-table').css('display', 'block');
                $("#search-table").css('display', 'none');
            }
        }
    });
    $('a').bind('ajax:success', function(data, status, xhr, code) {
        $(this).remove()
        $('#message').html('<div class="alert alert-success">User restored successfully</div>')
        setTimeout(() => {
            location.reload()
        }, 2500);
    })

    function formSubmit(event) {
        event.preventDefault();
        var input = $("#search").val();
        $("#progress").css('display', "block");
        $.ajax({
            url: "{{route('admin.user.search')}}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'term': input
            },
            success: function(val) {
                console.log(val)
                $("#search-table").css('display', 'block');
                $("#default-table").css('display', 'none');
                $("#progress").css('display', "none");
                $('#search-table tbody').html(val);
            },
            error: function(error) {
                if (error.status == 404) {
                    $("#not-found").css('display', 'block');
                    $("#progress").css('display', "none");
                    setTimeout(() => {
                        $("#not-found").css('display', 'none');
                    }, 4000)
                }
            }
        });
    }
</script>
@endsection
