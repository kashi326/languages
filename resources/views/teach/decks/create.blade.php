@extends('layouts.app')
@section('content')
@include('teach.layouts.DashboardNav')

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-light">
            <h3>Create new Deck</h3>
        </div>
        <div class="card-body">

            <form action="" class="w-75 m-auto" id="DeckForm">
                <div class="form-group">
                    <label for="name">Deck Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <div id="nameError"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description">
                    <div id="descriptionError"></div>
                </div>
                <div class="form-group">
                    <label for="level">Learning Level</label>
                    {{-- <input type="text" class="form-control" name="level" id="level"> --}}
                    <select name="level" id="level" class="form-control custom-select browser-default">
                        <option value="" disabled selected>Select Level</option>
                        @include('includes.language_level')
                    </select>
                    <div id="levelError"></div>
                </div>
                <div class="form-group">
                    <label for="">Language In</label>
                    <select class="form-control" name="language_in" id="language_in">
                        <option value="" disabled selected>Select Language</option>
                        @foreach ($langs as $lang)
                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                        @endforeach
                    </select>
                    <div id="language_inError"></div>
                </div>
                <div class="form-group">
                    <label for="">Translation to</label>
                    {{-- <input type="text" class="form-control" name="language_to" id="language_to"> --}}
                    <select name="language_to" id="language_to" class="form-control custom-select browser-default">
                        <option value="" disabled selected>Select Language</option>
                        @foreach ($langs as $lang)
                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                        @endforeach
                    </select>
                    <div id="language_toError"></div>
                </div>
                <div class="form-group">
                    <label for="fileUpload" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for Cover Image..
                        <input id="fileUpload" name="cover" type="file" accept="image/x-png,image/gif,image/jpeg" hidden>
                    </label>
                    <div id="coverError"></div>
                </div>
            </form>
            <div class="d-flex justify-content-end pt-3 pb-3 w-75 m-auto">
                <button class="btn btn-primary w-100" id="submit">Create</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $('#submit').click(function() {
            var formData = new FormData(document.getElementById("DeckForm"));
            $.ajax({
                type: 'POST',
                url: '{{route("decks.store")}}',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, status, xhr) {
                    console.log(data);
                    if (xhr.status == 201) {
                        $('input').addClass('is-valid')
                        $('form').prepend(`<div class="alert alert-success">${data.message}</div>`)
                        $('.alert-success').append(`\xa0<a href="/teacher/decksLesson/${data.id}" class="text-decoration-none">Click here</a>`)

                    }
                    if (xhr.status == 200) {
                        $('form').prepend(`<div class="alert alert-info">${data.message}</div>`)
                    }
                },
                error: function(error, xhr, status) {
                    var errors = JSON.parse(error.responseText)
                    Object.entries(errors.message).map(([index, value]) => {
                        console.log(index);
                        $('#' + index).addClass('is-invalid');
                        $('#' + index + 'Error').addClass('alert alert-danger');
                        $('#' + index + 'Error').text(value)
                    })
                }
            })
        });
    })
</script>

@endsection
