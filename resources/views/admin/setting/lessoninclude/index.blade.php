@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h3>Lesson Includes Panel</h3>
            <a href="#addInclude" data-toggle="modal" data-target="#addInclude" class="btn btn-primary">Add<img src="{{asset('icons/plus.svg')}}" width="20" height="20"></a>
        </div>
            <hr />
            @if(!$includes->isEmpty())
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>include</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($includes as $include)
                        <tr>
                            <td>{{$include->id}}</td>
                            <td>{{$include->include}}</td>
                            <td><a class="btn btn-danger btn-sm destroy-btn" href="{{route('admin.setting.include.destroy')}}" data-remote="true" data-method="put" data-confirm="Are You Sure You Want To Delete This subject" data-params="ID={{$include->id}}">Delete </a>
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
<div class="modal fade right" id="addInclude" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add to Deck</h4>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" data-type="json" action="{{route('admin.setting.include.create')}}" method="post" data-remote="true">
                    <input type="text" value="" name="deckID" hidden>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" placeholder="Homeworks, Assignments, pop quizes" id="include" name="include">
                        <div id="includeError" class="mt-1"></div>
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
        $('form').on('ajax:success', function(data, status, xhr,code) {
            if(code.status == 201){
                $(this).prepend(`<div class="alert alert-success">${status.message}</div>`)
                setTimeout(() => {
                    $('.alert').remove()
                    location.reload();
                }, 5000);
            }else if(code.status == 200){
                $(this).prepend(`<div class="alert alert-info">${status.message}</div>`)
                setTimeout(() => {
                    $('.alert').remove()
                }, 5000);
            }else{
                $(this).prepend(`<div class="alert alert-danger">Something Went Wrong!</div>`)
                setTimeout(() => {
                    $('.alert').remove()
                }, 5000);
            }
        });

        $('.destroy-btn').bind('ajax:success', function(e, data, status, xhr){
            $(e.target).closest('tr').remove();
        });
    })
</script>
@endsection
