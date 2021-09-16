@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"
          integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw=="
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"
            integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g=="
            crossorigin="anonymous"></script>
    <style>
        .list-group-horizontal {
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }

        .avatar-img {
            text-align: center;
        }

        .avatar-img img {
            width: 150px;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card my-5">
            <div class="list-group list-group-horizontal" id="myList" role="tablist">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#personal_details"
                   role="tab">Personal Details</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#lang_details" role="tab">Language
                    Details</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#timing_details" role="tab">Timing
                    Details</a>
            </div>

            {{-- teacher personal details --}}
            <form action="{{route('admin.teacher.update',$teacher)}}" method="POST">
                @csrf
                @method("PUT")
                <div class="tab-content">
                    <div class="card-body tab-pane active" id="personal_details" role="tabpanel">
                        <div class="avatar-img mb-3">
                            @if($teacher->user->avatar)
                                <?php $image = $teacher->user->avatar;$url = url("/") . "/" . $image ?: "images/avatar.png";  ?>
                                <div
                                    style="background-image: url('{{$url}}');background-repeat: no-repeat;background-size:cover;height: 200px;width:200px;border-radius:50%;margin: auto"></div>
                            @else
                                <img src="{{asset('images/avatar.png')}}" alt="avatar" class="">
                            @endif
                        </div>

                        @include("flash::message")
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" placeholder="tutor name"
                                       value="{{$teacher->name}}" name="name">
                                @error('name')
                                <div class="invalid-feedback d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control" placeholder="tutor lastname"
                                       value="{{$teacher->lastname}}" name="lastname">
                                @error('lastname')
                                <div class="invalid-feedback d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gender">
                                    Gender
                                </label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="" disabled selected> Select Gender</option>
                                    <option value="male" @if($teacher->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if($teacher->gender == 'female') selected @endif>Female
                                    </option>
                                    <option value="others" @if($teacher->gender == 'other') selected @endif>Others
                                    </option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="Email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="enter phone"
                                       value="{{$teacher->user->email}}" disabled>

                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" class="form-control" value="{{$teacher->phone}}"
                                       placeholder="teacher phone number">
                                @error('phone')
                                <div class="invalid-feedback d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="0" @if($teacher->status == 0) selected @endif>Blocked</option>
                                    <option value="1" @if($teacher->status == 1) selected @endif>Active</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3">Save</button>
                    </div>
                    <div class="card-body tab-pane" id="lang_details">
                        <input type="text" hidden name="teacher_id" value="{{$teacher->id}}">
                        @foreach($languages as $language)
                            <div>
                                <ul class="list-group">
                                    @if($language->id==$teacher->language_id)
                                        <li class="list-group-item">{{$language->name}}</li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="language_id">Primary Language</label>
                            <select name="language_id" id="language_id" placeholder="Select language"
                                    class="chosen form-control w-100">
                                @foreach($languages as $language)
                                    @if($teacher->language_id == $language->id)
                                        <option value="{{$language->id}}" selected>{{$language->name}}</option>
                                    @else
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-muted">You can select only those language which are currently available in
                            the system.</span>
                        </div>
                        <style>
                            .chosen-container {
                                width: 100%;
                            }
                        </style>
                        <div class="form-group row" v-for="lang in other_langs">
                            <div class="col-md-5 px-0">
                                <label for="other_language"><strong>Language You Speak</strong></label>
                                <select name="other_language[]" id="other_language" placeholder="Select language"
                                        class="chosen form-control w-100">
                                    @include('includes.languages')
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="level"><strong>Level</strong></label>
                                <select name="level[]" id="level" class="chosen form-control"
                                        placeholder="set experience level">
                                    @include('includes.language_level')
                                </select>
                            </div>

                            <div class="col-md-2">
                                <p></p>
                                <button type="button" class="btn btn-danger" @click="removeLang(lang.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                        </div>
                        <a @click="addLang" style="color: blue">Add New Language</a>
                    </div>
                    <div class="card-body tab-pane" id="timing_details">
                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Day</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opening Time</th>
                                <th scope="col">Closing Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teacher_timing as $key=>$time)
                                <input type="text" hidden name="id[]" value="{{$time->id}}">
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$time->name}}</td>
                                    <td>
                                        <select name="isOpen[]" id="isOpen" class="form-control">
                                            <option {{$time->isOpen == '1' ? 'selected': ''}} value="1">Open</option>
                                            <option {{$time->isOpen == '0' ? 'selected' : ''}} value="0">Closed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="time" id="open" name="open[]" class="form-control"
                                                   value="{{$time->open}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="time" id="close" name="close[]" class="form-control"
                                                   value="{{$time->close}}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>
    <script src="{{asset('js/languages.js')}}"></script>
    <script src="{{asset('js/levels.js')}}"></script>
    <script>
        let lang_details = new Vue({
            el: "#lang_details",
            data() {
                return {
                    primaryLangs: {
                !!$languages
                !!
            },
                languages: languages,
                    levels
            :
                levels,
                    other_langs
            :
                [],
                    form
            :
                {
                    primary_lang: "",
                }
            }
            },
            methods: {
                addLang() {
                    this.other_langs.push({
                        id: this.other_langs.length + 1,
                        language: {
                            name: "",
                            code: ""
                        },
                        level: {
                            name: ""
                        }
                    });
                },
                removeLang(id) {
                    this.other_langs = this.other_langs.filter((item) => {
                        return item.id != id;
                    })
                },
                onChange(event) {
                    console.log(event.target.value);
                },
            }
        });
    </script>
    <script type="text/javascript">
        $(".chosen").chosen();
        setTimeout(() => {
                $(".chosen-container").css('width', "100%")
            },250)
    </script>
@endsection
