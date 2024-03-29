<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <title>Languages</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            color: #9d97a9;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Alata', sans-serif;
            color: #453e6e;
        }

        .banner-bg {
            background-image: url(img/9-SCENE.svg);
            background-repeat: no-repeat;
            background-position: right;
            background-size: contain;
        }

        .btn {
            padding: 13.5px 36px;
            font-weight: 700;
            border-radius: 30px;
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .btn-success {
            background-color: #15b28b;
            border-color: #15b28b;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #453e6e;
            font-weight: 500;
        }

        .bb li {
            margin-bottom: 5px;
        }

        .bb li a {
            font-size: 13px;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .bb li a:hover {
            color: #fba94b;
        }

        .social-icons a {
            margin-right: 15px;
            color: #999;
        }

        .social-icons a:hover {
            color: #333;
        }

        .hero-shape {
            position: absolute;
            left: auto;
            top: -88%;
            right: -26%;
            bottom: auto;
            display: block;
            width: 90%;
            height: 150%;
            border-radius: 94px;
            background-color: #f2faff;
            -webkit-transform: rotate(-23deg);
            -ms-transform: rotate(-23deg);
            transform: rotate(-23deg);
        }

        .bg-light {
            background-color: #f2faff !important;
        }

        .bg-tutor {
            background-color: #f2faff;
            transition: all 0.3s ease;
        }

        .bg-tutor:hover {
            cursor: pointer;
            background-color: #15b28b;
            color: #FFF;
        }

        .bg-tutor:hover h6 {
            color: #FFF;
        }

        .bg-tutor i {
            font-size: 36px;
            color: #15b28b;
        }

        .bg-tutor:hover i {
            color: #FFF;
        }

        .nb i {
            font-size: 30px;
            color: #fff;
        }

        .right-shape.home {
            top: -18%;
        }

        .right-shape {
            position: absolute;
            left: 57%;
            top: 31%;
            width: 80%;
            height: 90%;
            border-radius: 94px;
            background-color: #fff5e8;
            -webkit-transform: rotate(-21deg);
            -ms-transform: rotate(-21deg);
            transform: rotate(-21deg);
        }
        .btn.dropdown-toggle.dropdown-button {
            padding: 11px 36px !important;
        }
        .shape-four {
            position: absolute;
            top: 16%;
            right: 75%;
            width: 80%;
            height: 122%;
            border-radius: 94px;
            background-color: #f2faff;
            -webkit-transform: rotate(-22deg);
            -ms-transform: rotate(-22deg);
            transform: rotate(-22deg);
        }

        .img-radius img {
            border-top-right-radius: 50px;
            border-bottom-left-radius: 50px;
            width: 150px;
            height: 150px;
        }

        .page-wrape {
            overflow: hidden;
        }

        .owl-carousel .owl-item img {
            display: inline-block !important;
            width: auto;
        }

        @media (max-width: 1368px) {
            .banner-bg {
                background-position: center right -300px;
                background-size: cover;
            }
        }

        @media (max-width: 1168px) {
            .banner-bg {
                background-position: center right -380px;
            }
        }

        @media (max-width: 768px) {
            .banner-bg {
                background-position: bottom -300px right -290px;
            }
        }

        @media (max-width: 568px) {
            .banner-bg {
                background-position: bottom -330px right -310px;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrape">
        <div class="position-relative">
            <div class="hero-shape"></div>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid py-2"><a class="navbar-brand font-weight-bold" href="#">Languages</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{route('main')}}">Home <span class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('findteacher.index')}}">Find Teacher</a>
                            </li>
                            @if(Auth::user())
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle  dropdown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Community
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- <a class="dropdown-item pl-2" href="{{Auth::user()->role!='teacher'?route('decks'):route('decks.index')}}"><img src="{{asset('icons/sheets.svg')}}" width="35"><span class="ml-2">Explore Decks</span></a> -->
                                        <!-- <a class="dropdown-item pl-2" href="{{route('discussion.index')}}"><img
                                                src="{{asset('icons/collaborationfemalemale.svg')}}" width="35"><span
                                                class="ml-2"> Discussion</span></a> -->
                                        <a class="dropdown-item pl-2" href="{{route('feature.index')}}"><img src="{{asset('icons/idea.svg')}}" width="35"><span class="ml-2"> Feature Suggestion</span></a>
                                    </div>
                                </div>
                            </li>

                            @if(Auth::user()->role == 'user')
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle dropdown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        More
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- <a class="dropdown-item" href="">Buy a gift</a> -->
                                        <a class="dropdown-item" href="{{ route('teach.join') }}">Apply To Teach</a>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @if(Auth::user()->role == 'teacher')
                            <li class="nav-item" style="font-weight: 400;">
                                <a class="nav-link side-link" href="{{route('teach.lesson.record')}}" style="color: #1997fd !important;"> Teacher Dashboard</a>
                            </li>
                            @endif
                            @endif


                            @guest
                            <li class="nav-item">
                                <div class="ml-lg-1"><a class="btn btn-success" href="{{route('login')}}">Login</a>
                                </div>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <div class="ml-lg-1"><a class="btn btn-success" href="{{route('register')}}">Register</a>
                                </div>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle primary-color" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role == 'admin')
                                    <a href="{{route('admin.index')}}" class="dropdown-item">
                                        Admin Panel
                                    </a>
                                    @endif


                                    @if(Auth::user()->role != 'admin')
                                    <a class="dropdown-item" href="{{route('dashboard')}}"> Profile</a>
                                    @endif
                                    <a class="dropdown-item" href="{{route('setting.profile.get')}}"> Setting</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>

                    </div>
                </div>
            </nav>
            <div class="banner-bg pb-5 pt-md-5 position-relative">
                <div class="container pb-5 pt-md-5">
                    <div class="row py-5 justify-content-between align-items-center">
                        <div class="col-lg-6 col-md-7 py-5">
                            <h1 class="font-weight-bold display-4 mb-4">Our tutors offers face-to-face and online
                                tuition. </h1>
                            <p class="lead mb-5">Our focus - modular training programs from leading practice lectors.</p>
                            <a href="{{route('findteacher.index')}}" class="btn btn-success">Find Teacher &rarr; </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative" style="z-index:1;">
            <div class="container py-5">
                <div class="row pt-5 justify-content-between text-center">
                    <div class="col-12">
                        <h6 class="text-warning mb-3">01. Tutors</h6>
                        <h2 class="font-weight-bold mb-5 pb-3">Choose our tutors by languages.</h2>
                    </div>
                    @foreach($langs as $l)
                    <div class="col-md-4 col-lg-3 pb-4">
                        <a href="/findteacher?lang={{$l->name}}" class="text-decoration-none">
                            <div class="p-4 bg-tutor rounded"><img src="{{$l->avatar}}" alt="" width="35" height="35" /></i>
                                <h6 class="font-weight-bold mb-0 pt-3">{{$l->name}}</h6>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="position-relative">
            <div class="container pt-5 position-relative" style="z-index:1;">
                <div class="row pt-5">
                    <div class="col-lg-6 mb-5">
                        <h6 class="text-warning mb-3">02. Why us?</h6>
                        <h2 class="font-weight-bold mb-5">Find out why you choose us?</h2>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam
                            vulputate congue vitae et neque. Pellentesque non justo velit. Donec quis tempus mi.</p>
                        <a href="" class="btn btn-success">More Details &rarr; </a>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <div class="mb-5 nb"><i class="lni lni-invention rounded-circle bg-warning d-inline p-3"></i></div>
                                <h5 class="font-weight-bold mb-5">Individual approaches</h5>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac
                                    quam vulputate congue vitae et neque.</p>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5 nb"><i class="lni lni-consulting rounded-circle bg-warning d-inline p-3"></i></div>
                                <h5 class="font-weight-bold mb-5">Wide tutoring offer</h5>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac
                                    quam vulputate congue vitae et neque.</p>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5 nb"><i class="lni lni-users rounded-circle bg-warning d-inline p-3"></i>
                                </div>
                                <h5 class="font-weight-bold mb-5">Qualified staff</h5>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac
                                    quam vulputate congue vitae et neque.</p>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5 nb"><i class="lni lni-graph rounded-circle bg-warning d-inline p-3"></i>
                                </div>
                                <h5 class="font-weight-bold mb-5">E-learning</h5>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac
                                    quam vulputate congue vitae et neque.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-shape home"></div>
        </div>
        <div class="container py-5">
            <div class="row justify-content-between py-5">
                <div class="col-12 text-center">
                    <h6 class="text-warning mb-3">03. Our Process</h6>
                    <h2 class="font-weight-bold mb-5 pb-3">Choose our tutors by subjects.</h2>
                </div>
                <div class="col-12 d-lg-flex ">
                    <div class="text-center"><img src="{{asset('img/img-three.png')}}" class="img-fluid mb-2">
                        <h5 class="font-weight-bold mb-4">Find a tutor in select category</h5>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam
                            vulputate congue</p>
                    </div>
                    <div class="text-center d-none d-lg-block"><img src="{{asset('img/arrow.png')}}"></div>
                    <div class="text-center"><img src="{{asset('img/img-two.png')}}" class="img-fluid mb-2">
                        <h5 class="font-weight-bold mb-4">Choose an online lesson or meeting</h5>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam
                            vulputate congue.</p>
                    </div>
                    <div class="text-center d-none d-lg-block"><img src="{{asset('img/arrow.png')}}"></div>
                    <div class="text-center"><img src="{{asset('img/img-one.png')}}" class="img-fluid mb-2">
                        <h5 class="font-weight-bold mb-4">Get knowledge together with the tutor</h5>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam
                            vulputate congue.</p>
                    </div>
                </div>
                <div class="col-12 text-center"><a href="" class="btn btn-success">More Details &rarr; </a></div>
            </div>
        </div>
        <div class="position-relative">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="text-warning mb-3">04. Our happy Students</h6>
                        <h2 class="font-weight-bold mb-5 pb-3">Don't just take it from us. </h2>
                    </div>
                </div>
                <div class="row testimonials owl-theme owl-carousel">
                    <div class="p-5">
                        <div class="d-flex align-items-end mb-5">
                            <div class="img-radius"><img src="https://annedece.sirv.com/Images/pexels-andrea-piacquadio-762020%20(1).jpg"></div>
                            <div class="ml-3"><img src="https://annedece.sirv.com/Images/5e5fd7c602ca7c29a9feb660_quote-icon.svg"></div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam vulputate congue
                            vitae et neque. Pellentesque non justo velit. Donec quis tempus mi.</p>
                        <h5 class="font-weight-bold">Jennifer</h5>
                        <p>Student</p>
                    </div>
                    <div class="p-5">
                        <div class="d-flex align-items-end mb-5">
                            <div class="img-radius"><img src="https://annedece.sirv.com/Images/pexels-andrea-piacquadio-839011.jpg"></div>
                            <div class="ml-3"><img src="https://annedece.sirv.com/Images/5e5fd7c602ca7c29a9feb660_quote-icon.svg"></div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam vulputate congue
                            vitae et neque. Pellentesque non justo velit. Donec quis tempus mi.</p>
                        <h5 class="font-weight-bold">Richard</h5>
                        <p>Student</p>
                    </div>
                    <div class="p-5">
                        <div class="d-flex align-items-end mb-5">
                            <div class="img-radius"><img src="https://annedece.sirv.com/Images/pexels-andrea-piacquadio-762020%20(1).jpg"></div>
                            <div class="ml-3"><img src="https://annedece.sirv.com/Images/5e5fd7c602ca7c29a9feb660_quote-icon.svg"></div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam vulputate congue
                            vitae et neque. Pellentesque non justo velit. Donec quis tempus mi.</p>
                        <h5 class="font-weight-bold">Jennifer</h5>
                        <p>Student</p>
                    </div>
                    <div class="p-5">
                        <div class="d-flex align-items-end mb-5">
                            <div class="img-radius"><img src="https://annedece.sirv.com/Images/pexels-andrea-piacquadio-839011.jpg"></div>
                            <div class="ml-3"><img src="https://annedece.sirv.com/Images/5e5fd7c602ca7c29a9feb660_quote-icon.svg"></div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at risus ac quam vulputate congue
                            vitae et neque. Pellentesque non justo velit. Donec quis tempus mi.</p>
                        <h5 class="font-weight-bold">Richard</h5>
                        <p>Student</p>
                    </div>
                </div>
                <div class="shape-four"></div>
            </div>
        </div>
        <div class="bg-light">
            <div class="container py-5">
                <div class="row pt-5">
                    <div class="col-md-6 col-lg-3 mb-5">
                        <h3 class="font-weight-bold mb-4">Languages</h3>
                        <p class="semi-bold"> The best way to learn from a Tutor. </p>
                        <div class="social-icons mt-4"><a href="#"><i class="lni lni-facebook-filled"></i></a> <a href="#"><i class="lni lni-twitter-filled"></i></a> <a href="#"><i class="lni lni-instagram-filled"></i></a> <a href="#"><i class="lni lni-github-original"></i></a></div>
                    </div>
                    @guest
                    <div class="col-md-6 col-lg-3 mb-5">
                        <h6 class="mb-4 font-weight-bold">User</h6>
                        <ul class="list-unstyled bb m-0">
                            <li><a href="{{route('login')}}">Login</a></li>
                            <li><a href="{{route('register')}}">Register</a></li>
                            <li><a href="{{route('teach.join')}}">Apply to teach</a></li>
                        </ul>
                    </div>
                    @endguest
                    <div class="col-md-6 col-lg-3 mb-5">
                        <h6 class="mb-4 font-weight-bold">Company</h6>
                        <ul class="list-unstyled bb m-0">
                            <li><a href="">About Us</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Press</a></li>
                            <li><a href="">Investors</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-5">
                        <h6 class="mb-4 font-weight-bold">Privacy & Terms</h6>
                        <ul class="list-unstyled bb m-0">
                            <li><a href="">Community</a></li>
                            <li><a href="">Privacy</a></li>
                            <li><a href="">Terms</a></li>
                            <li><a href="">Copyright</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3 bg-white">
            <div class="container">
                <p class="m-0 text-center small medium-500">Copyright &copy; </p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script>
        $('.testimonials').owlCarousel({
            loop: false,
            margin: 20,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2
                }
            }
        })
    </script>
</body>

</html>
