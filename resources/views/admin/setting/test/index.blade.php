@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h3>Test Preparation Panel</h3>
            <a href="#addTest" data-toggle="modal" data-target="#addTest" class="btn btn-primary">Add<img src="{{asset('icons/plus.svg')}}" width="20" height="20"></a>
        </div>
            <hr />
            @if(!$tests->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                        <tr>
                            <td>{{$test->id}}</td>
                            <td>{{$test->test}}</td>
                            <td><a class="btn btn-danger btn-sm destroy-btn" href="{{route('admin.setting.testpreparation.destroy')}}" data-remote="true" data-method="put" data-confirm="Are You Sure You Want To Delete This test" data-params="ID={{$test->id}}">Delete </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade right" id="addTest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add to Deck</h4>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" data-type="json" action="{{route('admin.setting.testpreparation.create')}}" method="post" data-remote="true">
                    <input type="text" value="" name="deckID" hidden>
                    <div class="form-group">
                        <label for="">Test Name</label>
                        <input type="text" class="form-control" placeholder="Test Name" name="test">
                        <div id="subjectError" class="mt-1"></div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary m-1" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('form').on('ajax:error', function(event, xhr, status, error) {
        console.log(xhr.responseText);
        $(this).prepend(`<div class="alert alert-danger">${status.message}</div>`)
        setTimeout(() => {
            $('.alert').remove()
        }, 3000);
    });
    $('form').on('ajax:success', function(data, status, xhr) {
        $(this).prepend(`<div class="alert alert-success">${status.message}</div>`)
        setTimeout(() => {
            $('.alert').remove()
        }, 10000);
        location.reload();
    });
    $('.destroy-btn').bind('ajax:success', function(e, data, status, xhr){
        $(e.target).closest('tr').remove();
        });
    })
</script>
@endsection
