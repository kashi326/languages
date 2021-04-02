<style>
    #DashboardNav .active {
        border-bottom: 2px solid #0699cd !important;
    }
    .dash-nav{
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
                <li class="nav-item dashboardNav" id="record">
                    <a href="{{route('teach.lesson.record')}}" class="nav-link side-link"> <img src="{{asset('icons/coaching.svg')}}" alt="" width="28" height="28" class="pr-1">Lesson Record</a>
                </li>
                <li class="nav-item dashboardNav" id="homework">
                    <a href="{{route('teach.homework.index')}}" class="nav-link side-link dashboard-links"> <img src="{{asset('icons/homework.svg')}}" alt="" width="24" height="24"> Homework</a>
                </li>
                <li class="nav-item dashboardNav" id="teachingProfile">
                    <a href="{{route('teach.profile.update')}}" class="nav-link side-link dashboard-links"> <img src="{{asset('icons/teacher.png')}}" alt="" width="24" height="24"> Teaching Profile</a>
                </li>
                <li class="nav-item dashboardNav" id="decks">
                    <a href="{{route('decks.index')}}" class="nav-link side-link dashboard-links"> <img src="{{asset('icons/sheets.svg')}}" alt="" width="24" height="24"> Decks</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(function(){
        $('.nav-item.dashboardNav').click(function(){
            var id = $(this).attr('id');
            console.log(id)
            sessionStorage.setItem('dashboardNavActive',id);
        })
    });
    window.onload = function(){
        var id = sessionStorage.getItem('dashboardNavActive');
        $('#'+id).find('a').addClass('active');
    }
</script>
