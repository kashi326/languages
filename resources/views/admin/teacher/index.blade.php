@extends("layouts.admin")

@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <h3>Teacher Panel</h3>
            <hr>
            @include("flash::message")
            @if(count($teachers) > 0)
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Primary Language</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($teachers as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->user->name}}{{ $item->user->lastname}}</td>
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->language->name}}</td>
                            <td>
                                @if($item->status == 1)
                                <div class="badge badge-fill badge-success p-2">
                                    Active
                                </div>
                                @else
                                <div class="badge badge-fill badge-danger p-2">
                                    Blocked
                                </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.teacher.show',$item)}}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{route('admin.teacher.destroy',$item)}}" class="d-inline-block"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure want to delete this teacher?')">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i> DELETE
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$teachers->links()}}
            </div>
            @else
            <p>No teacher found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
