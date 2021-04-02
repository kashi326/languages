@extends("layouts.admin")
@section("content")
    <div class="cotainer">
        <div class="card mx-auto"  style="width: 90%">
            <div class="card-header d-flex justify-content-between">
                <h3 class="text-main">Privacy Policy</h3>
                    <button class="btn btn-primary" id="addSection">Add Section</button>
            </div>
            <div class="card-body">
                @foreach ($pp as $item)
                    <form action="{{route('admin.privacy.update')}}" data-remote="true" method="post" data-type="json" >
                        @csrf
                    <input type="text" name="ID" value="{{$item->id}}" hidden>
                        <div class="form-group">
                            <label for="heading">Heading</label>
                        <input type="text" name="heading" class="form-control" value="{{$item->heading}}">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                        <textarea name="content" class="form-control content" cols="30" rows="10"> {{$item->content}}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-danger delete mx-1" href="{{route('admin.privacy.delete')}}" data-remote="true" data-method="post" data-params="ID={{$item->id}}">Delete</a>
                            <input type="submit" class="btn btn-success btn-sm" value="Update">
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    @section("scripts")
<script>
    $(document).ready(function() {
        $('.content').summernote({
            placeholder: 'Write Something',
            height: 200,
        });
        $('#addSection').click(function(){
            $('.card-body').append(`
                    <form action="{{route('admin.privacy.add')}}" data-remote="true" method="post" data-type="json" >
                        @csrf
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" name="heading" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control content" id="hello"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm btn-danger delete mx-1" href="#">Delete</a>
                            <input type="submit" class="btn btn-success btn-sm" value="Add">
                        </div>
                    </form>
                    <hr/>
            `)
            $('form').on('ajax:success', function(data, status, xhr,code) {
                $(this).prepend(`<div class="alert alert-success">${status.message}</div>`)
                setTimeout(() => {
                    $('.alert').remove()
                    location.reload();
                }, 5000);
            });
            $('.content').summernote({
                placeholder: 'Write Something',
                height: 200,
            });
            $('.delete').click(function(){
                console.log('heloo')
                $(this).closest('form').remove();
            })
        })

        $('.delete').bind('ajax:success', function(e, data, status, xhr){
            $(e.target).closest('form').remove();
        });
    });
</script>
    @endsection
@endsection
