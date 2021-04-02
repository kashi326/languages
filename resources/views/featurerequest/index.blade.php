@extends("layouts.app")
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-between">
                <div class="col-sm-6 col-md-3 d-flex align-items-center">
                <button type="button" data-toggle="modal" data-target="#AddFeature" class="btn btn-primary">Add <img src="{{asset('icons/plus.svg')}}" alt="" width="20" height="20"></button>
                </div>
                <div class="col-sm-6 col-md-3 d-flex align-items-center">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control browser-default custom-select mx-1" data-url="{{route('feature.index')}}" data-remote="true" data-method="get">
                        <option value="Open">Open</option>
                        <option value="UnderReview">Under Review</option>
                        <option value="Planned">Planned</option>
                        <option value="InProgress">In Progress</option>
                        <option value="Completed">Completed</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
            </div>
            <div class="post-container">
                {!! $view !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade right" id="AddFeature" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Add to Deck</h4>
            </div>
            <div class="modal-body">
                <form class="w-75 m-auto" id="FeatureForm" data-type="json" action="{{route('feature.store')}}" method="post" data-remote="true">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Title" id="title" name="title">
                        <div id="titleError" class="mt-1"></div>
                    </div>
                    <div class="form-group">
                        <label for="Information">Information</label>
                        <textarea name="Information" id="Information" cols="30" rows="10" class="form-control" placeholder="Provide Some extra information"></textarea>
                        <div id="InformationError" class="mt-1"></div>
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
@endsection
@section("scripts")
<script>
    $('#FeatureForm').on('ajax:error', function(event, xhr, status, error) {
        if (xhr.status == 401) {
            var errors = JSON.parse(xhr.responseText);
            Object.entries(errors.message).map(([index, value]) => {
                $("#" + index).addClass("is-invalid");
                $("#" + index + "Error").addClass("alert alert-danger font-1");
                $("#" + index + "Error").text(value);
            });
        } else {
            $("#FeatureForm").prepend(
                `<div class="alert alert-info">Hmm, something went wrong. Please try again.</div>`
            );
        }
    });
    $('#FeatureForm').on('ajax:success', function(data, status, xhr, code) {
        $(this).prepend(`<div class="alert alert-success">${status.message}</div>`)
        setTimeout(() => {
            $('.alert').remove()
            location.reload();
        }, 5000);
    });
    $('#status').bind('ajax:success', function(e, data, status, xhr) {
        $('.post-container').html(data);
    });
    $('#status').bind('ajax:beforeSend', function() {
        $('.post-container').prepend('<div class="alert alert-info">Please Wait While we retrieve data</div>');
    });
</script>
@endsection
