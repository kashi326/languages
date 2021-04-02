
<div class="card">
    <div class="card-header pl-2">
        <h3>Password</h3>
        <h5 class="pl-1 text-muted">Change Your Password</h5>
    </div>
    <div class="card-body">
    <form action="{{route('setting.password.post')}}" method="POST" class="p-2" data-remote="true" data-method="post" >
            <div class="form-group">
                <label for="">Current Password</label>
                <input type="password" class="form-control" name="currentPassword" id="currentPassword">
                <span id="currentPasswordError" ></span>
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="newPassword">
                <span id="newPasswordError" ></span>
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                <span id="confirmPasswordError" ></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
</div>
