@extends('layouts.app')

@section('content')
<style>
    .top-tabs {
        cursor: pointer;
    }

    .nav-tabs {
        border: none !important;
    }

    .nav-link {
        border: none !important;
    }

    .active {
        border-bottom: 2px solid #0699cd !important;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-head">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <h3 class="ml-3 mt-2">All</h3>
                        </div>
                        <!-- <div class="col-12 col-md-4">
                            <div class="input-group search mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"> </i></span>
                                </div>
                                <input type="text" class="form-control" id="searchinput" placeholder="Search....">
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link top-tabs  active" id="trending" href="/discussion/sortby" data-remote="true" data-method="post" data-params="sort=trending">Trending</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link top-tabs" id="new" href="/discussion/sortby" data-remote="true" data-method="post" data-params="sort=new">New</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link top-tabs" id="myposts" href="/discussion/sortby" data-remote="true" data-method="post" data-params="sort=myposts">My Posts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="posts-list">
                        {!! $html !!}
                    </ul>
                </div>
                @if(count($posts)>0)
                <div id="pagination">
                    <div id="sub-pag">
                        {{ $posts->render() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="d-none d-md-block col-md-4 mt-4">
            <a href="/newdiscussion" class="btn btn-primary btn-lg btn-block pt-4 pb-4">New Discussion</a>
            <div class="discussion-language-card btn btn-light ">
                <img src="{{ asset('/icons/support.png') }}" width="50" height="50" class="ml-2 rounded-circle" alt="" srcset="">
                <a href="#" class="btn btn-default btn-lg ml-2 text-decoration-none">Support Community</a>
            </div>
            <h3 class="mb-3 mt-2">Other Languages</h3>
            @foreach($languages as $language)
            <div class="discussion-language-card btn btn-light ">
                <img src="/icons/flags/<?php echo $language->name . '.png' ?>" width="50" height="50" class="ml-2 rounded-circle" alt="" srcset="">
                <a href="#" class="btn btn-default btn-lg ml-2 text-decoration-none">{{ $language->name }}</a>
            </div>
            @endforeach

        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('a').bind('ajax:success', function(e, data, status, xhr){
            $('.active').removeClass('active')
            $(this).addClass('active');
            $('#posts-list').html(data);
        });

    });
</script>

@endsection
