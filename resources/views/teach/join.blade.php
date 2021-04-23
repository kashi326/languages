@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/teach/join.css')}}">
<link rel="stylesheet" href="{{asset('dist/jquery-filestyle.min.css')}}">
<script src="{{asset('dist/jquery-filestyle.min.js')}}" defer></script>

@endsection

@section('content')
<div class="container-fluid" id="main-container">
    <div class="background-image">
        <div class="image-Overlay"></div>
        <form @submit.prevent="handleSubmit" ref="myForm">
            <div class="content">
                <h2>Personal Information</h2>

                {{-- personal information --}}
                <div class="card each-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="enter name" name="name" readonly value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="enter lastname" name="lastname" readonly value="{{$user->lastname}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="enter email" value="{{$user->email}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone No</label>
                                <input type="number" class="form-control" placeholder="enter phone number" v-model="form.phone">
                                <div class="invalid-feedback d-block" v-if="errors['details.phone']">
                                    <strong>@{{errors['details.phone'][0]}}</strong>
                                </div>
                            </div>
{{--                            <div class="col-md-3 form-group">--}}
{{--                                <label for="gender">Gender</label><br>--}}
{{--                                <select name="gender" id="gender" class="form-control" v-model="form.gender" >--}}
{{--                                    <option value="">...</option>--}}
{{--                                    <option value="male">Male</option>--}}
{{--                                    <option value="female">Female</option>--}}
{{--                                    <option value="others">Others</option>--}}
{{--                                </select>--}}
{{--                                <div class="invalid-feedback d-block" v-if="errors['details.gender']">--}}
{{--                                    <strong>@{{errors['details.gender'][0]}}</strong>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3 form-group">--}}
{{--                                <label for="country">Country</label>--}}
{{--                                <select name="country" id="country" class="form-control" v-model="form.country">--}}
{{--                                    <option value="">...</option>--}}
{{--                                    @include('includes.countries_list')--}}
{{--                                </select>--}}
{{--                                <div class="invalid-feedback d-block" v-if="errors['details.country']">--}}
{{--                                    <strong>@{{errors['details.country'][0]}}</strong>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                        {{-- <div class="avatar">
                            <h5>Profile Image</h5>
                            <img src="{{asset('images/avatar.png')}}" alt="avatar image" v-if="avatarUrl == ''">
                        <img :src="avatarUrl" v-if="avatarUrl != ''" class="avatar" />
                        <input type="file" class="form-control jfilestyle" @change="handleAvatar">
                    </div> --}}
                </div>
            </div>

            {{-- languages --}}
            <h2 class="mt-4">Languages</h2>
            <div class="card each-card" style="text-align: start">
                <div class="card-body">
                    <div>
                        <label for="language"><strong>Primary Language</strong></label>
                        <v-select name="language" id="language" :options="primaryLangs" label="name" placeholder="Select language" v-model="form.primary_lang">
                        </v-select>
                        <span class="text-muted">You can select only those language which are currently available in
                            the system.</span>
                        <div class="invalid-feedback d-block" v-if="errors['details.primary_lang.name']">
                            <strong>@{{errors['details.primary_lang.name'][0]}}</strong>
                        </div>
                    </div>

                    <br>
                    <div id="other-langs">
                        <div class="row" v-for="lang in other_langs">
                            <div class="col-md-5">
                                <label for="language"><strong>Language You Speak</strong></label>
                                <v-select v-model="lang.language" :options="primaryLangs" label="name" placeholder="Select language">
                                </v-select>
                            </div>
                            <div class="col-md-5">
                                <label for="level"><strong>Level</strong></label>
                                <v-select v-model="lang.level" :options="levels" label="name" placeholder="set experience level">
                                    @include('includes.language_level')
                                </v-select>
                            </div>
                            <div class="col-md-2">
                                <p></p>
                                <button type="button" class="btn btn-danger" @click="removeLang(lang.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="invalid-feedback d-block" v-if="errors['other_langs']">
                            <strong>@{{errors['other_langs'][0]}}</strong>
                        </div>
                    </div>
                    <a @click="addLang" style="color: blue">Add New Language</a>
                </div>
            </div>

            {{-- introduction video --}}
            <h2 class="mt-4">Introduction Video</h2>
            <div class="card each-card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="intro_link">Link to introduction video</label>
                        <input type="url" name="intro_link" class="form-control" id="intro_link" placeholder="https://www.youtube.com/embed/kj21hjkjv" v-model="form.intro_link">
                    </div>

                    <iframe :src="form.intro_link" frameborder="0" v-if="form.intro_link != ''"></iframe>
                </div>
            </div>

            {{-- biography --}}
            <h2 class="mt-4">About Me</h2>
            <div class="card each-card" style="text-align: start">
                <div class="card-body">
                    <p class="text-muted">
                        Introduce yourself to the Bilingue Talks community. Include your qualifications and
                        experiences,
                        as well as your teaching style and approach to language learning
                    </p>
                    <div class="form-group">
                        <label for="about_me">About Me</label>
                        <textarea name="about_me" id="about_me" rows="6" class="form-control" placeholder="describe yourself" v-model="form.about"></textarea>
                        <div class="invalid-feedback d-block" v-if="errors['details.about']">
                            <strong>@{{errors['details.about'][0]}}</strong>
                        </div>
                    </div>
                </div>
            </div>

            {{-- availability --}}
            <h2 class="mt-4">Availability</h2>
            <div class="card each-card" style="text-align: start">
                <div class="card-body">
                    <p class="text-muted">
                        Click on below button to add availability schedule for your meets.
                    </p>
                    <div v-for="(day,index) in days">
                        <div v-if="day[0]['isOpen']">
                            @{{index}}
                            <p v-for="time in day" class="mx-5">
                                <span>@{{convert(time['open'])}}</span> <span v-if="time['open']">-</span> <span>@{{convert(time['close'])}}</span>
                            </p>
                            <hr>
                        </div>
                    </div>
                    <div class="invalid-feedback d-block" v-if="errors['days']">
                        <strong>@{{errors['days'][0]}}</strong>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add Availability
                    </button>
                </div>
            </div>

            {{-- agreement accept --}}
            <h2 class="mt-4">Agreement Accept</h2>
            <div class="card each-card" style="text-align: start">
                <div class="card-body">
                    <p class="text-muted">Please Read and accept the agreement.</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agreementModal">
                        View Agreement
                    </button>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" name="agreement" id="exampleCheck1" v-model="form.agree">
                        <label class="form-check-label" for="exampleCheck1">Accept
                            Agreement</label>
                        <div class="invalid-feedback d-block" v-if="errors['details.agree']">
                            <strong>@{{errors['details.agree'][0]}}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-lg mt-4 submit-button">Submit</button>
    </div>
    </form>

    {{-- agreement modal --}}
    <div class="modal fade" id="agreementModal" tabindex="-1" role="dialog" aria-labelledby="agreementModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agreementModal">Acceptance Agreement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Agreement Content</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close

                        <div class="spinner-border" role="status" v-if="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Availability</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <business-hours :days="days"></business-hours>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>

</script>
@endsection

@section('scripts')
@include("js.join")
@endsection
