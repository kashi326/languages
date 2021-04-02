@extends('layouts.app')
@section('content')
    <style>
        /* Code By Webdevtrick ( https://webdevtrick.com ) */
        @import url('https://fonts.googleapis.com/css?family=Hind:300,400');

        *,
        *:before,
        *:after {
            -webkit-box-sizing: inherit;
            box-sizing: inherit;
        }

        html {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }


        .container1 {
            margin: 0 auto;
            padding: 4rem;
            width: 48rem;
        }

        h3 {
            font-size: 1.75rem;
            color: #373d51;
            padding: 1.3rem;
            margin: 0;
        }

        .accordion a {
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            padding: 1rem 3rem 1rem 1rem;
            color: #7288a2;
            font-size: 1.15rem;
            font-weight: 400;
            border-bottom: 1px solid #e5e5e5;
        }

        .accordion a:hover,
        .accordion a:hover::after {
            cursor: pointer;
            color: #ff5353;
        }

        .accordion a:hover::after {
            border: 1px solid #ff5353;
        }

        .accordion a.active {
            color: #ff5353;
            border-bottom: 1px solid #ff5353;
        }

        .accordion a::after {
            font-family: 'Ionicons';
            font-weight: bold;
            content: '+';
            position: absolute;
            float: right;
            right: 1rem;
            font-size: 1rem;
            color: #7288a2;
            padding: 3px;
            width: 30px;
            height: 30px;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            border: 1px solid #7288a2;
            text-align: center;
        }

        .accordion a.active::after {
            font-family: 'Ionicons';
            content: '-';
            color: #ff5353;
            border: 1px solid #ff5353;
        }

        .accordion .content {
            opacity: 0;
            padding: 0 1rem;
            max-height: 0;
            border-bottom: 1px solid #e5e5e5;
            overflow: hidden;
            clear: both;
            -webkit-transition: all 0.2s ease 0.15s;
            -o-transition: all 0.2s ease 0.15s;
            transition: all 0.2s ease 0.15s;
        }

        .accordion .content p {
            font-size: 1rem;
            font-weight: 300;
        }

        .accordion .content.active {
            opacity: 1;
            padding: 1rem;
            max-height: 100%;
            -webkit-transition: all 0.35s ease 0.15s;
            -o-transition: all 0.35s ease 0.15s;
            transition: all 0.35s ease 0.15s;
        }

        .zoom {
            padding: 50px;
            transition: transform .2s;
            /* Animation */
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(1.2);
        }

    </style>
    <link rel="stylesheet" href="{{ asset('css/gifts/main.css') }}">
    <header>
        <div class="content  m-auto">
            <h1 class="text-center" style="font-size: 72px">Give The Gift of Language.</h1>
            <h5 style="color: black">
                Learning to speak a new language enriches a person’s life more than any material present ever could. Give a
                Verbling gift card to someone today, redeemable for purchasing lessons w
                ith any teacher.
            </h5>
            <a href="/buy" class="btn btn-main d-block">Buy a Gift</a>
        </div>
    </header>
    <div class="row" style="padding: 0 0 20px 0; background-color:white;height:400px;">
        <div class="zoom col-md-4">
            <h4 class="text-bold">How Verbling Gift Cards Work</h4>
            <img src="{{ asset('/images/verb.png') }}" alt="" style="width:250px;height:300px;">
        </div>

    </div>
    <div class="row" style="padding: 0 70px 30px 70px; background-color:white">
        <div class="zoom col-md-4">
            <h1>1</h1>
            <div>
                <h2 class="text-bold">Choose a Recipient</h2>
                <p class="text-large"><span>Give the name and email of the recipient, and write a message. We will send the
                        gift card to this email address.</span></p>
            </div>
        </div>
        <div class="zoom col-md-4">
            <h1>2</h1>
            <div>
                <h2 class="text-bold">Choose Amount</h2>
                <p class="text-large"><span>Choose the amount you would like to give. Verbling offers gift cards in the
                        amounts of $25, $50, $100, $150, $200, and $250.</span></p>
            </div>
        </div>
        <div class="zoom col-md-4">
            <h1>3</h1>
            <div>
                <h2 class="text-bold">Redeem Gift Card</h2>
                <p class="text-large"><span>The recipient will receive an email with information on how to redeem the gift
                        on Verbling.</span></p>
            </div>
        </div>

    </div>
    <div class="container1">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion">
            <div class="accordion-item">
                <a>Can I use gift cards with any teacher?</a>
                <div class="content">
                    <p>Yes! Gift cards are redeemable with any teacher on Verbling..</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Can I use gift cards for any language?</a>
                <div class="content">
                    <p>Of course. Gift cards may be used with any teacher of any language on Verbling.</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Do gift cards expire?</a>
                <div class="content">
                    <p>Yes, gift cards expire 1 year after purchase.</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>How much money is a single class?</a>
                <div class="content">
                    <p>The average price is $25/class. However, teachers set their own prices, and prices may vary greatly
                        based on language and region.</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Can I return a gift card?</a>
                <div class="content">
                    <p>No. Once purchased, gift cards are not redeemable for cash.</p>
                </div>
            </div>

        </div>

    </div>
    <div class="react-reveal"
        style="animation-fill-mode: both; animation-duration: 1000ms; animation-delay: 0ms; animation-iteration-count: 1; opacity: 1; animation-name: react-reveal-111008823989963-1;">
        <div class="LandingPage__Waves flex flex-direction-column flex-justify-content-center text-center"
            style="background-image:linear-gradient(116deg, #0699cd, #3bb85c)">
            <div style="padding: 100px 0 0 0">
               

                    <a href="/buy" style="font-size: 220%; background-color:white;color:blue"
                    class="btn btn-primary btn-lg">Buy a Gift Card</a>
            </div>
            <div class="LandingPage__Waves__bottom"><img
                    src="https://cdn.verbling.com/static/svg/482d12a014dd62db2c8cc624a86b3850.waves-bottom.svg"
                    alt="blue background"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var scroll_start = 0;
            var startchange = $('.navbar');
            var offset = startchange.offset();
            if (startchange.length) {
                $(document).scroll(function() {
                    scroll_start = $(this).scrollTop();
                    if (scroll_start > offset.top) {
                        $(".navbar").css('background-color', "#FFF");
                        $(".navbar .navbar-brand").css('color', "#1997FD");
                        $(".navbar .side-link").css('color', "#1997FD");
                        $(".navbar .register-button").css('background', "#1997FD");
                        $(".navbar").addClass('shadow')
                        $('.navbar .dropdown .dropdown-button').css('color', '#00aaf4');
                    } else {
                        $(".navbar").css('background-color', "transparent");
                        $(".navbar .navbar-brand").css('color', "#FFF");
                        $(".navbar .side-link").css('color', "#FFF");
                        $(".navbar .register-button").css('background', 'transparent');
                        $('.navbar .dropdown .dropdown-button').css('color', '#FFF');
                        $(".navbar").removeClass('shadow')
                    }
                });
            }


        });
        const items = document.querySelectorAll(".accordion a");

        function toggleAccordion() {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
        }
        items.forEach(item => item.addEventListener('click', toggleAccordion));

    </script>
@endsection
