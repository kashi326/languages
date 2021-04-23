<style>
    #settingNav .active {
        border-bottom: 2px solid #0699cd !important;
    }

    .setting-nav {
        border-top: 1px solid #d8d8d8;
        border-bottom: 1px solid #d8d8d8;
    }

    .setting-links:hover {
        border-bottom: 2px solid #0699cd !important;
    }
</style>

<nav class="setting-nav navbar navbar-expand-md bg-light p-0">
    <div class="container" style="padding:1px;">
        <button class="navbar-toggler pull-right" type="button" data-toggle="collapse" data-target="#settingNav">
            <span class="fa fa-arrow-down"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="settingNav">
            <ul class="navbar-nav">
                <li class="nav-item settingNav" id="general">
                    <a href="{{route('setting.profile.get')}}" class="nav-link side-link setting-links"> <img src="{{asset('icons/home.png')}}" alt="" width="24" height="24">Profile</a>
                </li>
                <li class="nav-item settingNav" id="blocks">
                    <a href="/setting/blocks" class="nav-link side-link setting-links"> <img src="{{asset('icons/class.png')}}" alt="" width="24" height="24"> Blocks</a>
                </li>
                <!-- <li class="nav-item settingNav" id="gifts">
                    <a href="/setting/gifts" class="nav-link side-link setting-links"> <img src="{{asset('icons/talk_female.svg')}}" alt="" width="24" height="24"> Gifts</a>
                </li> -->
                <li class="nav-item settingNav" id="credits">
                    <a href="/setting/credits" class="nav-link side-link setting-links"> <img src="{{asset('icons/sheets.svg')}}" alt="" width="24" height="24"> Credits</a>
                </li>
                <li class="nav-item settingNav" id="receipts">
                    <a href="/setting/receipts" class="nav-link side-link setting-links"> <img src="{{asset('icons/sheets.svg')}}" alt="" width="24" height="24"> Receipts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(function(){
        const url  =window.location.pathname;
        $('.side-link').removeClass("active");
        $(`a[href=${url}]`).addClass('active')

    });
</script>
