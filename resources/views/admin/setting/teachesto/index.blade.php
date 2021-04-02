@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
            <h3>Teaches To Panel</h3>
            <a href="#addSubject" data-toggle="modal" data-target="#addSubject" class="btn btn-primary">Add<img src="{{asset('icons/plus.svg')}}" width="20" height="20"></a>
        </div>
            <hr />
            @if(!$tos->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>From Age</th>
                            <th>To Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tos as $to)
                        <tr>
                            <td>{{$to->id}}</td>
                            <td>{{$to->age}}</td>
                            <td>{{$to->from}}</td>
                            <td>{{$to->to}}</td>
                            <td><a class="btn btn-danger btn-sm destroy-btn" href="{{route('admin.setting.to.destroy')}}" data-remote="true" data-method="put" data-confirm="Are You Sure You Want To Delete This subject" data-params="ID={{$to->id}}">Delete </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade right" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add to Deck</h4>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" data-type="json" action="{{route('admin.setting.to.create')}}" method="post" data-remote="true">
                    <input type="text" value="" name="deckID" hidden>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" placeholder="Adult" id="age" name="age">
                        <div id="ageError" class="mt-1"></div>
                    </div>
                    <div class="form-group">
                        <label for="">From Age</label>
                        <input type="number" class="form-control" id="fromAge" name="fromAge">
                        <div id="fromError" class="mt-1"></div>
                    </div>
                    <div class="form-group">
                        <label for="">To Age</label>
                        <input type="number" class="form-control" name="toAge" id="to">
                        <div id="toError" class="mt-1"></div>
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
            if (xhr.status == 401) {
                var errors = JSON.parse(xhr.responseText);
                Object.entries(errors.message).map(([index, value]) => {
                    $("#" + index).addClass("is-invalid");
                    $("#" + index + "Error").addClass("alert alert-danger");
                    $("#" + index + "Error").text(value);
                });
            } else {
                $("form").prepend(
                    `<div class="alert alert-info">Hmm, something went wrong. Please try again.</div>`
                );
            }
        });
        $('form').on('ajax:success', function(data, status, xhr) {
            $(this).prepend(`<div class="alert alert-success">${status.message}</div>`)
            setTimeout(() => {
                $('.alert').remove()
            }, 10000);
            location.reload();
        });

        $('.destroy-btn').bind('ajax:success', function(e, data, status, xhr){
console.log('hello')
            $(e.target).closest('tr').remove();
        });
    })
</script>
@endsection
