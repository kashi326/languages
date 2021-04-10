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
</style>
<div>
    <div class="flex flex-align-center" style="background:url(&quot;https://cdn.Languages.com/static/img/enterprise/cd055b3f78a337faf1cb94bab3a1b0e1.landing-cover.jpg&quot;) no-repeat center center;background-position:center;background-repeat:no-repeat;height:100vh;background-size:cover">
        <div class="container">
            <form action="{{ route('enterprise.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6"></div>
                    <div class="col-12 col-md-6" style="background-color: white">
                        <div class="extra-panel-padding text-left panel panel-default">
                            <div class="panel-body">
                                <h1 class="no-margin-bottom">Make your team multilingual.</h1>
                                <p class="text-large">The simplest way to set up language lessons for a company.</p>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group--focuser form-group">
                                            <label class="control-label">First Name</label>
                                            <input placeholder="Jane" name="first_name" class="@error('first_name') is-invalid @enderror form-control--focuser form-control" value="">
                                            @error('first_name')
                                            <span class="invalid-feedback d-inline-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group--focuser form-group"><label class="control-label">Last
                                                Name</label><input placeholder="Doe" name="last_name" @error('last_name') is-invalid @enderror" class="form-control--focuser form-control" value="">
                                            @error('last_name')
                                            <span class="invalid-feedback d-inline-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group--focuser form-group"><label class="control-label">Organization
                                        name</label><input placeholder="Languages" name="organization_name" @error('organization_name') is-invalid @enderror" class="form-control--focuser form-control" value="">
                                    @error('organization_name')
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group--focuser form-group"><label class="control-label">Organization
                                        Email</label><input type="email" placeholder="name@company.com" name="email" @error('email') is-invalid @enderror" class="form-control--focuser form-control" value="">
                                    @error('email')
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group--focuser form-group"><label class="control-label">Phone
                                        Number</label><input type="tel" placeholder="123 456 7986" name="phone_number" @error('phone_number') is-invalid @enderror" class="form-control--focuser form-control" value="">
                                    @error('phone_number')
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-tall btn btn-default btn-block" style="background-color: cornflowerblue">Signup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<section class="padding-bottom-xxl">
    <div class="container padding-top-xl">
        <div class="react-reveal">
            <h2 class="text-center flex flex-align-center flex-justify-content-center margin-top-xxl">Why Choose
                Languages?</h2>
            <div class="row">
                <div class="col-md-4 col-12 margin-bottom-md text-center">
                    <h2 class="flex flex-direction-column flex-align-center flex-justify-content-center"><img width="50px" height="50px" alt="classroom" src="https://cdn.Languages.com/static/svg/icons8/6aa4609df05914e479b0dd25e4a135f8.icons8-classroom.svg" class="margin-right-sm" style="max-width:inherit;width:50px;height:50px">
                        <!-- -->Professional teachers</h2>
                    <div>Choose from thousands of native-speaking professional teachers, available 24/7.</div>
                </div>
                <div class="col-md-4 col-12 margin-bottom-md text-center">
                    <h2 class="flex flex-direction-column flex-align-center flex-justify-content-center"><img width="50px" height="50px" alt="video_conference" src="https://cdn.Languages.com/static/svg/icons8/8c823fb95a34df65d6c182c2a1cf7d50.icons8-video_conference.svg" class="margin-right-sm" style="max-width:inherit;width:50px;height:50px">
                        <!-- -->Integrated platform</h2>
                    <div>Schedule your lessons and meet with your teacher, all within your browser window.</div>
                </div>
                <div class="col-md-4 col-12 margin-bottom-md text-center">
                    <h2 class="flex flex-direction-column flex-align-center flex-justify-content-center"><img width="50px" height="50px" alt="toolbox" src="https://cdn.Languages.com/static/svg/icons8/564abb3512e1d7ae3ebb4694d57c3d98.icons8-toolbox.svg" class="margin-right-sm" style="max-width:inherit;width:50px;height:50px">
                        <!-- -->Language tools</h2>
                    <div>Learn with great features such as collaborative textpads, vocabulary review, and more.
                    </div>
                </div>
                <div class="col-md-4 col-12 margin-bottom-md text-center">
                    <h2 class="flex flex-direction-column flex-align-center flex-justify-content-center"><img width="50px" height="50px" alt="smartphone_tablet" src="https://cdn.Languages.com/static/svg/icons8/4c68d9752e2185c37a6558d7689682ec.icons8-smartphone_tablet.svg" class="margin-right-sm" style="max-width:inherit;width:50px;height:50px">
                        <!-- -->Multi-device support</h2>
                    <div>Access Languages on desktop browsers, iOS, and Android— we support it all.</div>
                </div>
                <div class="col-md-4 col-12 margin-bottom-md text-center">
                    <h2 class="flex flex-direction-column flex-align-center flex-justify-content-center"><img width="50px" height="50px" alt="goal" src="https://cdn.Languages.com/static/svg/icons8/a55dee167e15cc15d10d37553745b355.icons8-goal.svg" class="margin-right-sm" style="max-width:inherit;width:50px;height:50px">
                        <!-- -->Personalized education</h2>
                    <div>Progress through existing courses or ask your teacher to create curriculum for your
                        needs.</div>
                </div>
                <div class="col-md-4 col-12 margin-bottom-md text-center">
                    <h2 class="flex flex-direction-column flex-align-center flex-justify-content-center">
                        <img width="50px" height="50px" alt="rebalance_portfolio" src="https://cdn.Languages.com/static/svg/icons8/be312649bd40f76363d6b628cb31a647.icons8-rebalance_portfolio.svg" style="max-width:inherit;width:50px;height:50px;">
                        <!-- -->Easy Administration
                    </h2>
                    <div>No more spreadsheets or coordinating schedules. Easily view statistics and generate
                        reports from your dashboard.
                        <!-- --> Login using SSO. Provisioning via SCIM API.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="background:url(&quot;https://cdn.Languages.com/static/img/landing/89ce9e786b6de4cf160e6154cb490445.street.jpg&quot;)
                                    no-repeat center center;background-size:cover !important;background-position:center;background-repeat:no-repeat;height:50vh;">

    <div>
        <h1 style="padding: 80px 0 0 0; text-align:center;color: white;font-weight: bold;">“Today all global companies
            need to address the language dilemma head on.”</h1>
        <p style="text-align:center;color: white;font-weight: bold;font-border:black">Harvard Business Review</p>
    </div>
</div>
<div class="container1">
    <h2>Frequently Asked Questions</h2>
    <div class="accordion">
        <a>What is Languages for Enterprise?</a>
        <div class="content">
            <p>Languages for Enterprise is a language-learning
                service for businesses or organizations looking to improve their team’s communication in
                a new language. It offers quality language instruction via online video-chat based
                lessons, accessible on multiple devices platforms anywhere with a sufficient internet
                connection. Lessons are 1-on-1, hour-long video-chat sessions between a student and
                teacher. Curriculum is customizable to a student’s needs to ensure efficient, effective
                learning. Languages for Enterprise offers the education of a brick-and-mortar school or
                in-house tutor for a fraction of the price, with unparalleled convenience.</p>
        </div>

        <div class="accordion-item">
            <a>What is the difference between Languages and Languages for Enterprise?</a>
            <div class="content">
                <p>Students learn on the same Languages platform and
                    have access to the same great Languages teachers. Languages for Enterprise is an
                    administrative layer added on top of the standard Languages platform that allows for easy
                    and powerful administration and analysis of an organization and its members. It allows
                    an organization administrator to maintain an organization’s plan, make payments, invite
                    and manage membership, generate reports, analyze progress, set access controls, and
                    more.</p>
            </div>
        </div>
        <div class="accordion-item">
            <a>What languages can members learn?</a>
            <div class="content">
                <p>The following languages are currently supported, in
                    alphabetical order: Afrikaans, Albanian, Arabic, Armenian, Azerbaijani, Basque, Bengali,
                    Berber, Bulgarian, Cantonese, Catalan, Croatian, Czech, Danish, Dutch, English, Finnish,
                    French, German, Greek, Hebrew, Hindi, Hungarian, Icelandic, Igbo, Indonesian, Irish
                    Gaelic, Italian, Japanese, Korean, Kurdish, Latin, Latvian, Malay, Mandarin, Norwegian,
                    Pashto, Persian, Polish, Portuguese, Punjabi, Romanian, Russian, Serbian, Slovak,
                    Spanish, Swahili, Swedish, Tamil, Thai, Turkish, Ukrainian, Urdu, Vietnamese, and Zulu.</p>
            </div>
        </div>
        <div class="accordion-item">
            <a>How does one choose a teacher?</a>
            <div class="content">
                <p>One of Languages’s advantages is the ability for a
                    student to choose a teacher that uniquely suits their needs and personality. To find a
                    teacher, simply log on to Languages, navigate to the “Find a Teacher” page, and browse
                    the thousands of teachers who teach on Languages. It’s possible to filter by language,
                    accent, skills, and more so the student can find the right teacher for them.</p>
            </div>
        </div>
        <div class="accordion-item">
            <a>How good are the teachers on Languages?</a>
            <div class="content">
                <p>All of Languages’s teachers are accredited with
                    prior professional teaching experience who have passed our extensive application
                    process. Many teachers specialize in certain subjects and can customize the curriculum
                    to a student’s needs.</p>
            </div>
        </div>
        <div class="accordion-item">
            <a>What is the learning experience like?</a>
            <div class="content">
                <p>Over a million students from around the world love
                    Languages’s integrated platform. Languages’s digital classroom was built from the ground
                    up to focus on delivering the best learning experience possible, entirely in-browser. It
                    includes video- and audio-chat, messaging, flashcards, collaborative textpads, image and
                    PDF markup, file management, cloud storage, learning tools and widgets, and more! No
                    external downloads or third-party applications are required, with the exception of a
                    couple extensions developed by Languages to allow for screen-sharing and recording of
                    lessons.</p>
            </div>
        </div>
        <div class="accordion-item">
            <a>What technical requirements are there to use Languages?</a>
            <div class="content">
                <p>A student can access the digital classroom by using
                    the latest version of Chrome or Firefox on a computer, or by downloading the Languages
                    app, available on the App Store and Google Play Store. A minimum internet speed of
                    approximately 1 MB/s upload and download is required for a stable, quality video and
                    audio connection. Personal or corporate firewalls may need to be configured to allow for
                    WebRTC traffic</p>
            </div>
        </div>
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="col-12 flex flex-direction-column flex-align-center flex-justify-content-center text-center">
            <h2 class="margin-bottom-xl">Let's get started!</h2>
            <div class="ButtonToolbar flex flex-align-center ButtonToolbar--horizontal flex-direction-row"><a href="#" class="window btn-landing-cta-outline btn-tall btn btn-lg btn-default" style="background-color: rgb(17, 90, 226); margin: 2px">Create Organization</a><a href="#" class="window btn-landing-cta-outline btn-tall btn btn-lg btn-default" style="background-color: rgb(17, 90, 226)">Schedule a Demo</a></div>
        </div>
    </div>
</div>
<script>
    const items = document.querySelectorAll(".accordion a");

    function toggleAccordion() {
        this.classList.toggle('active');
        this.nextElementSibling.classList.toggle('active');
    }
    items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>
@endsection
