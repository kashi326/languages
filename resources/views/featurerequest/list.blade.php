@if (count($features))
    @foreach ($features as $feature)
        <div class="card features mx-auto">
            <div class="card-body d-flex">
                <a class="post_up-votes text-decoration-none" href="{{route('feature.vote')}}" data-params="ID={{$feature->id}}" data-remote="true" data-method="post">
                    <div class="post_up-votes_icon"><i class="fa fa-chevron-circle-up"></i></div>
                    <div class="post_up-votes_number">{{$feature->votes}}</div>
                </a>
                <div class="post-content px-md-3 px-2">
                    <h3 class="font-weight-bold">{{$feature->title}}</h3>
                    <span class="badge badge-secondary font-2">{{$feature->status}}</span>
                    <p class="lead font-1">
                        {{$feature->information}}
                    </p>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
@else
    @include("includes.notfound")
@endif
