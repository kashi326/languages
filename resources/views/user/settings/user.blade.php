<div class="card p-4">
    <div class="card-header"><h4>Delete</h4></div>
    <div class="card-body">
        <ul class="list-unstyled pl-4 pr-4">
            <li class="mb-2 d-flex">
                <i class="fa fa-check-circle text-success" style="vertical-align:sub"></i>
                <p>Your Account will be deleted permanantly.</p>
            </li>
            <li class="mb-2 d-flex">
                <i class="fa fa-check-circle text-success" style="vertical-align:sub"></i>
                <p> Other user can see or comment on your discussions</p>
            </li>
            <li class="mb-2 d-flex">
                <i class="fa fa-check-circle text-danger" style="vertical-align:sub"></i>
                <p>You would not be able to login or register with this <b>email</b> again</p>
            </li>
        </ul>
    <form action="{{route('setting.user.deactivate')}}" method="post" data-remote="true">
        @csrf
        <div class="form-group">
          <label for="">Current Password</label>
          <input type="text" class="form-control" name="currentPassword" id="currentPassword" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
