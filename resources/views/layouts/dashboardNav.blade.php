<style>
    #DashboardNav .active {
        border-bottom: 2px solid #0699cd !important;
    }

    .dash-nav {
        border-top: 1px solid #d8d8d8;
        border-bottom: 1px solid #d8d8d8;
    }
</style>

<nav class="dash-nav navbar navbar-expand-md bg-light p-0">
    <div class="container" style="padding:1px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#DashboardNav">
            <span class="fa fa-arrow-down"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="DashboardNav">
            <ul class="navbar-nav">
                <li class="nav-item dashboardNav" id="dashboard">
                    <a href="/dashboard" class="nav-link side-link "> <img src="{{asset('icons/home.png')}}" alt="" width="24" height="24">Profile</a>
                </li>
                <li class="nav-item dashboardNav" id="lessons">
                    <a href="/dashboard/lessons" class="nav-link side-link dashboard-links"> <img src="{{asset('icons/class.png')}}" alt="" width="24" height="24"> Lessons</a>
                </li>
                @if(Auth::user()->role=='user')
                <li class="nav-item dashboardNav" id="myTeachers">
                    <a href="/dashboard/myteachers" class="nav-link side-link dashboard-links"> <img src="{{asset('icons/talk_female.svg')}}" alt="" width="24" height="24"> Teachers</a>
                </li>
                <!-- <li class="nav-item dashboardNav" id="vocabulary">
                    <a href="/dashboard/vocabulary" class="nav-link side-link dashboard-links"> <img src="{{asset('icons/sheets.svg')}}" alt="" width="24" height="24"> Vocabulary</a>
                </li> -->
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
    $(function() {
        const url = window.location.pathname;
        $('.side-link').removeClass("active");
        $(`a[href='${url}']`).addClass('active')
    });
</script>
