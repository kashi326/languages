@if(count($posts) >0 )
@foreach($posts as $post)
<li class="list-group-item post-no-border">
    <div class="row">
        <div class="col-2" style="max-width: 40px;display:inline-grid">
            <a href="/vote" data-remote="true" data-method="post" data-params="vote= 1&id={{$post->id}}"><i class="fa fa-arrow-up"></i>
            </a>
            {{ $post->upvote - $post->downvote }}
            <a href="/vote" data-remote="true" data-method="post" data-params="vote= -1&id={{$post->id}}"> <i class="fa fa-arrow-down"></i>
            </a>
        </div>
        <div class="col-2"><img src="{{ asset($post->media_link) }}" width="60" height="60" style="border-radius: 50%; border:3px solid #fd4444"></div>
        <div class="col-8"><span class=" font-weight-bold">{{ $post->heading }}</span>
        </div>
    </div>
</li>
@endforeach
@else
<li class="list-group-item post-no-border">
    <div class="row">
        <img src="{{ asset('/icons/collaborationfemalemale.svg') }}" width="50" height="50" alt="img" style="margin-left:45%">
        <h4 class="text-center w-100">No discussions match the search critera.</h4>
    </div>
</li>
@endif
