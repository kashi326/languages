 <div class="card">
   <div class="card-header">
        Update Profile Picture
    </div>
    <div class="card-body">
        <div id="message-profile"></div>
        <div class="prfile-image d-flex justify-content-center" id="">
            <img src="{{asset(Auth::user()->avatar)}}" alt="" width="200" height="200" >
        </div>
        <div class="mt-3">
            <ul class="list-unstyled pl-4 pr-4">
                <li class="mb-2 d-flex">
                    <i class="fa fa-check-circle text-success" style="vertical-align:sub"></i>
                    <p> Make a strong first impression with a good profile picture</p>
                </li>
                <li class="mb-2 d-flex">
                    <i class="fa fa-check-circle text-success" style="vertical-align:sub"></i>
                    <p> Make sure your picture is clear, professional, and personal</p>
                </li>
                <li class="mb-2 d-flex">
                    <i class="fa fa-check-circle text-danger" style="vertical-align:sub"></i>
                    <p> Do not impersonate others</p>
                </li>
            </ul>
        </div>
        <form id="profileForm" enctype="multipart/form-data">
            <label for="profile" class="file-upload w-75 mx-auto btn btn-primary btn-block rounded-pill shadow">
                <i class="fa fa-upload mr-2 "></i>Browse for file ...
                <input id="profile" name="profilepic" type="file" accept="image/*" style="opacity: 0;" onchange="sendPostImageRequest('/setting/profilepicture')" />
            </label>
        <form>
    </div>
</div>
