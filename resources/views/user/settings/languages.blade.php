
        @if(count($other_langs)>0)
        @foreach ($other_langs as $lang)
            <div class="card mb-2 lesson-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 pt-0 d-flex">
                    <img src="{{$lang->avatar}}" width="50" height="50" class="rounded-circle">
                        <p class="ml-2">{{$lang->name}}</p>
                    </div>
                    <div class="col-6 d-flex">
                    <a href="{{route('language.speaks.delete',$lang->speakID)}}" data-remote="true" data-method="get" class="btn btn-outline-danger btn-sm ml-auto h-75 delete">Remove</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 pt-0 pb-0 mb-1">
                        <input type="checkbox" name="currentlylearning" id="currentlylearning">
                        <label for="currentlylearning">Currently Learning</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 pt-0">
                        <label for="" class="text-dark">Proficiency</label>
                        <?php echo Form::select('level',
                        array('totalbeginner' => 'Total Beginner', 'beginner' => 'Beginner', 'upperbeginner' => 'Upper Beginner', 'totalintermediate' => 'Total Intermediate', 'intermediate' => 'Intermediate', 'upperintermediate' => 'UpperIntermediate','totaladvanced' => 'Total Advanced','advanced' => 'Advanced','upperadvanced'=>'Upper Advanced'), $lang->level,['class'=>'form-control browser-default custom-select', 'data-url'=>route('language.speaks.level'), 'data-remote'=>"true", 'data-method'=>'put','data-params'=>'id='.$lang->speakID]); ?>
                    </div>
                    <div class="col-6 pt-0">
                        <label for="" class="text-dark">Motivation</label>

                        <?php echo Form::select('motivation',
                        array(
                            'career' => 'Career',
                            'education' => 'Education',
                            'family' => 'Family',
                            'hobby' => 'Hobby',
                            'travel' => 'Travel',
                            'other' => 'Other',), $lang->motivation,['class'=>'form-control browser-default custom-select', 'data-url'=>route('language.speaks.motivation'), 'data-remote'=>"true", 'data-method'=>'put','data-params'=>'id='.$lang->speakID]); ?>
                    </div>
                </div>
            </div>
            </div>

        @endforeach
        @else
            @include("includes.notfound")
        @endif
<script>

    $('.delete').bind('ajax:success',function(data, status, xhr,code){
        $(this).closest('.lesson-card').remove();
    })
</script>
