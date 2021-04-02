@extends('layouts.app')

<?php
$Countries = array(
    "" => "Select Country",
    "Afganistan" => "Afghanistan",
    "Albania" => "Albania",
    "Algeria" => "Algeria",
    "American Samoa" => "American Samoa",
    "Andorra" => "Andorra",
    "Angola" => "Angola",
    "Anguilla" => "Anguilla",
    "Antigua & Barbuda" => "Antigua & Barbuda",
    "Argentina" => "Argentina",
    "Armenia" => "Armenia",
    "Aruba" => "Aruba",
    "Australia" => "Australia",
    "Austria" => "Austria",
    "Azerbaijan" => "Azerbaijan",
    "Bahamas" => "Bahamas",
    "Bahrain" => "Bahrain",
    "Bangladesh" => "Bangladesh",
    "Barbados" => "Barbados",
    "Belarus" => "Belarus",
    "Belgium" => "Belgium",
    "Belize" => "Belize",
    "Benin" => "Benin",
    "Bermuda" => "Bermuda",
    "Bhutan" => "Bhutan",
    "Bolivia" => "Bolivia",
    "Bonaire" => "Bonaire",
    "Bosnia & Herzegovina" => "Bosnia & Herzegovina",
    "Botswana" => "Botswana",
    "Brazil" => "Brazil",
    "British Indian Ocean Ter" => "British Indian Ocean Ter",
    "Brunei" => "Brunei",
    "Bulgaria" => "Bulgaria",
    "Burkina Faso" => "Burkina Faso",
    "Burundi" => "Burundi",
    "Cambodia" => "Cambodia",
    "Cameroon" => "Cameroon",
    "Canada" => "Canada",
    "Canary Islands" => "Canary Islands",
    "Cape Verde" => "Cape Verde",
    "Cayman Islands" => "Cayman Islands",
    "Central African Republic" => "Central African Republic",
    "Chad" => "Chad",
    "Channel Islands" => "Channel Islands",
    "Chile" => "Chile",
    "China" => "China",
    "Christmas Island" => "Christmas Island",
    "Cocos Island" => "Cocos Island",
    "Colombia" => "Colombia",
    "Comoros" => "Comoros",
    "Congo" => "Congo",
    "Cook Islands" => "Cook Islands",
    "Costa Rica" => "Costa Rica",
    "Cote DIvoire" => "Cote DIvoire",
    "Croatia" => "Croatia",
    "Cuba" => "Cuba",
    "Curaco" => "Curacao",
    "Cyprus" => "Cyprus",
    "Czech Republic" => "Czech Republic",
    "Denmark" => "Denmark",
    "Djibouti" => "Djibouti",
    "Dominica" => "Dominica",
    "Dominican Republic" => "Dominican Republic",
    "East Timor" => "East Timor",
    "Ecuador" => "Ecuador",
    "Egypt" => "Egypt",
    "El Salvador" => "El Salvador",
    "Equatorial Guinea" => "Equatorial Guinea",
    "Eritrea" => "Eritrea",
    "Estonia" => "Estonia",
    "Ethiopia" => "Ethiopia",
    "Falkland Islands" => "Falkland Islands",
    "Faroe Islands" => "Faroe Islands",
    "Fiji" => "Fiji",
    "Finland" => "Finland",
    "France" => "France",
    "French Guiana" => "French Guiana",
    "French Polynesia" => "French Polynesia",
    "French Southern Ter" => "French Southern Ter",
    "Gabon" => "Gabon",
    "Gambia" => "Gambia",
    "Georgia" => "Georgia",
    "Germany" => "Germany",
    "Ghana" => "Ghana",
    "Gibraltar" => "Gibraltar",
    "Great Britain" => "Great Britain",
    "Greece" => "Greece",
    "Greenland" => "Greenland",
    "Grenada" => "Grenada",
    "Guadeloupe" => "Guadeloupe",
    "Guam" => "Guam",
    "Guatemala" => "Guatemala",
    "Guinea" => "Guinea",
    "Guyana" => "Guyana",
    "Haiti" => "Haiti",
    "Hawaii" => "Hawaii",
    "Honduras" => "Honduras",
    "Hong Kong" => "Hong Kong",
    "Hungary" => "Hungary",
    "Iceland" => "Iceland",
    "Indonesia" => "Indonesia",
    "India" => "India",
    "Iran" => "Iran",
    "Iraq" => "Iraq",
    "Ireland" => "Ireland",
    "Isle of Man" => "Isle of Man",
    "Israel" => "Israel",
    "Italy" => "Italy",
    "Jamaica" => "Jamaica",
    "Japan" => "Japan",
    "Jordan" => "Jordan",
    "Kazakhstan" => "Kazakhstan",
    "Kenya" => "Kenya",
    "Kiribati" => "Kiribati",
    "Korea North" => "Korea North",
    "Korea Sout" => "Korea South",
    "Kuwait" => "Kuwait",
    "Kyrgyzstan" => "Kyrgyzstan",
    "Laos" => "Laos",
    "Latvia" => "Latvia",
    "Lebanon" => "Lebanon",
    "Lesotho" => "Lesotho",
    "Liberia" => "Liberia",
    "Libya" => "Libya",
    "Liechtenstein" => "Liechtenstein",
    "Lithuania" => "Lithuania",
    "Luxembourg" => "Luxembourg",
    "Macau" => "Macau",
    "Macedonia" => "Macedonia",
    "Madagascar" => "Madagascar",
    "Malaysia" => "Malaysia",
    "Malawi" => "Malawi",
    "Maldives" => "Maldives",
    "Mali" => "Mali",
    "Malta" => "Malta",
    "Marshall Islands" => "Marshall Islands",
    "Martinique" => "Martinique",
    "Mauritania" => "Mauritania",
    "Mauritius" => "Mauritius",
    "Mayotte" => "Mayotte",
    "Mexico" => "Mexico",
    "Midway Islands" => "Midway Islands",
    "Moldova" => "Moldova",
    "Monaco" => "Monaco",
    "Mongolia" => "Mongolia",
    "Montserrat" => "Montserrat",
    "Morocco" => "Morocco",
    "Mozambique" => "Mozambique",
    "Myanmar" => "Myanmar",
    "Nambia" => "Nambia",
    "Nauru" => "Nauru",
    "Nepal" => "Nepal",
    "Netherland Antilles" => "Netherland Antilles",
    "Netherlands" => "Netherlands (Holland, Europe)",
    "Nevis" => "Nevis",
    "New Caledonia" => "New Caledonia",
    "New Zealand" => "New Zealand",
    "Nicaragua" => "Nicaragua",
    "Niger" => "Niger",
    "Nigeria" => "Nigeria",
    "Niue" => "Niue",
    "Norfolk Island" => "Norfolk Island",
    "Norway" => "Norway",
    "Oman" => "Oman",
    "Pakistan" => "Pakistan",
    "Palau Island" => "Palau Island",
    "Palestine" => "Palestine",
    "Panama" => "Panama",
    "Papua New Guinea" => "Papua New Guinea",
    "Paraguay" => "Paraguay",
    "Peru" => "Peru",
    "Phillipines" => "Philippines",
    "Pitcairn Island" => "Pitcairn Island",
    "Poland" => "Poland",
    "Portugal" => "Portugal",
    "Puerto Rico" => "Puerto Rico",
    "Qatar" => "Qatar",
    "Republic of Montenegro" => "Republic of Montenegro",
    "Republic of Serbia" => "Republic of Serbia",
    "Reunion" => "Reunion",
    "Romania" => "Romania",
    "Russia" => "Russia",
    "Rwanda" => "Rwanda",
    "St Barthelemy" => "St Barthelemy",
    "St Eustatius" => "St Eustatius",
    "St Helena" => "St Helena",
    "St Kitts-Nevis" => "St Kitts-Nevis",
    "St Lucia" => "St Lucia",
    "St Maarten" => "St Maarten",
    "St Pierre & Miquelon" => "St Pierre & Miquelon",
    "St Vincent & Grenadines" => "St Vincent & Grenadines",
    "Saipan" => "Saipan",
    "Samoa" => "Samoa",
    "Samoa American" => "Samoa American",
    "San Marino" => "San Marino",
    "Sao Tome & Principe" => "Sao Tome & Principe",
    "Saudi Arabia" => "Saudi Arabia",
    "Senegal" => "Senegal",
    "Seychelles" => "Seychelles",
    "Sierra Leone" => "Sierra Leone",
    "Singapore" => "Singapore",
    "Slovakia" => "Slovakia",
    "Slovenia" => "Slovenia",
    "Solomon Islands" => "Solomon Islands",
    "Somalia" => "Somalia",
    "South Africa" => "South Africa",
    "Spain" => "Spain",
    "Sri Lanka" => "Sri Lanka",
    "Sudan" => "Sudan",
    "Suriname" => "Suriname",
    "Swaziland" => "Swaziland",
    "Sweden" => "Sweden",
    "Switzerland" => "Switzerland",
    "Syria" => "Syria",
    "Tahiti" => "Tahiti",
    "Taiwan" => "Taiwan",
    "Tajikistan" => "Tajikistan",
    "Tanzania" => "Tanzania",
    "Thailand" => "Thailand",
    "Togo" => "Togo",
    "Tokelau" => "Tokelau",
    "Tonga" => "Tonga",
    "Trinidad & Tobago" => "Trinidad & Tobago",
    "Tunisia" => "Tunisia",
    "Turkey" => "Turkey",
    "Turkmenistan" => "Turkmenistan",
    "Turks & Caicos Is" => "Turks & Caicos Is",
    "Tuvalu" => "Tuvalu",
    "Uganda" => "Uganda",
    "United Kingdom" => "United Kingdom",
    "Ukraine" => "Ukraine",
    "United Arab Erimates" => "United Arab Emirates",
    "United States of America" => "United States of America",
    "Uraguay" => "Uruguay",
    "Uzbekistan" => "Uzbekistan",
    "Vanuatu" => "Vanuatu",
    "Vatican City State" => "Vatican City State",
    "Venezuela" => "Venezuela",
    "Vietnam" => "Vietnam",
    "Virgin Islands (Brit)" => "Virgin Islands (Brit)",
    "Virgin Islands (USA)" => "Virgin Islands (USA)",
    "Wake Island" => "Wake Island",
    "Wallis & Futana Is" => "Wallis & Futana Is",
    "Yemen" => "Yemen",
    "Zaire" => "Zaire",
    "Zambia" => "Zambia",
    "Zimbabwe" => "Zimbabwe",
);
?>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }} </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }} " required autocomplete="lastname" autofocus>

                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                {{Form::select('country',$Countries,'',['class'=>'form-control browser-default custom-select'])}}

                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                {{Form::select('gender',array(''=>'Select Option','male'=>'Male','female'=>'Female','other'=>'Other'),'',['class'=>'form-control browser-default custom-select'])}}

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>





                        <!-- <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <label for="profile" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for file ...
                                    <input id="profile" name="profile" type="file" accept="image/*" class="d-none">
                                </label>

                                @error('profile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="row py-4">
                            <div class="col-lg-12">
                                <!-- Upload image input-->
                                <div class="input-group w-50 border border-rounded  mx-auto mb-3 px-2 py-2 bg-white shadow-sm">
                                    <input id="upload" type="file" name="profile" onchange="readURL(this);" class="form-control border-0">
                                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                    <div class="input-group-append">
                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                    </div>
                                    @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Uploaded image area-->
                            </div>
                            <div class="col-lg-12">
                                <div class="image-area"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" style="max-height: 300px;"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-4 mx-auto">
                                <label for=""><input type="checkbox" name="is_teacher" id=""> Register as a teacher</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $('#upload').on('change', function() {
            readURL(input);
        });
    });

    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById('upload');
    var infoArea = document.getElementById('upload-label');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>

@endsection
