@extends('layouts.app')

@section('content')

<div class="container" style="min-height: 600px;">
    <div class="row">
        <div class="mx-auto col-md-8 col-12">
            <div class="card">

                <div class="card-head mt-1">
                    <h3 class="text-center">New Discussion</h3>
                </div>
                <div class="card-body">
                    @error('success')
                    <div role="alert" class="text-center rounded-corners alert alert-success">
                        {{$message}}
                    </div>
                    @enderror
                    @if(!Auth::user()->email_verified_at)
                    <div role="alert" class="text-center rounded-corners alert alert-danger email-not-verified">
                        You need to confirm your email to post.
                        <a href="{{route('setting.profile.get')}}" class="text-light text-decoration-none">Go to settings</a>
                    </div>
                    @endif
                    <form action="/discussion" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group selectdiv">
                            <label class="text-muted">Posted in</label>
                            <span>
                                <select name="language" id="language" class="form-control">
                                    <option value="0" class="p-3" disabled>Support Community</option>
                                    @foreach($languages as $language)
                                    <option value="{{$language->id}}" class="p-3">{{$language->name }}</option>
                                    @endforeach
                                </select>
                            </span>
                            @error('language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Picture</label>
                                <div class="form-group w-75 m-auto">
                                    <label for="fileUpload" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for file ...
                                        <input id="fileUpload" name="disscussionImage" type="file" accept="images/*" style="opacity: 0">
                                    </label>
                                </div>
                                @error('disscussionImage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                            @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea id="summernote" name="discussionbody" placeholder="Write Something"></textarea>
                            @error('discussionbody')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/discussion" class="btn btn-outline-primary btn-md">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-md" <?php echo Auth::user()->email_verified_at ? '' : 'disabled'; ?>>Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write Something',
            height: 200,
        });
    });
</script>

@endsection
