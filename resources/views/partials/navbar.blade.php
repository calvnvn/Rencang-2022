<nav class="navbar navbar-expand-lg navbar-light navbar-layer shadow">
    <div class="navbar-left mobileOnly">
        <a class="mx-auto" href="{{ route('home') }}">
            <img src="{{ asset('images/public/logo-rencang.png') }}" alt="Logo Rencang" class="rounded-circle p-2" height=68 style="background-color: white;">
        </a>
    </div>
    <div class="navbar-right">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 dual-collapse2 order-1 order-md-0">
        <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item nav-item-left mx-5">
                <a id="home" class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item nav-item-left mx-5">
                <a id="what-we-do" class="nav-link" href="{{ route('what-we-do') }}">What We Do?</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto my-2 order-0 order-md-1 position-relative desktopOnly">
        <a class="mx-auto" href="{{ route('home') }}">
            <img src="{{ asset('images/public/logo-rencang.png') }}" alt="Logo Rencang" class="rounded-circle p-2" height=68 style="background-color: white;">
        </a>
    </div>
    <div class="navbar-collapse collapse w-100 dual-collapse2 order-2 order-md-2">
        <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item nav-item-right mx-5">
                <div class="dropdown"> 
                    <div id="dropdownToggle" class="js-scroll-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a id="who-we-are" class="nav-link">Who We Are?</a>
                    </div>
                    <div id="dropdownMenu" class="dropdown-menu py-0" aria-labelledby="dropdownToggle">
                        <a class="dropdown-item py-3" href="{{ route('who-we-are') }}">Profile</a>
                        <a class="dropdown-item py-3" href="{{ route('coming-soon') }}">Our Family</a>
                    </div>
                </div>
            </li>
            <li class="nav-item nav-item-right mx-5">
                <a id="articles" class="nav-link" href="{{ route('coming-soon') }}">Articles</a>
            </li>
        </ul>
    </div>  
</nav>