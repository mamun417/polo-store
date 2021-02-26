<header class="header-area">
    <!--  Top Header Start -->
    <div class="top-header">
        <h3 class="top-header_title">{{ $globalSettingInfo ? $globalSettingInfo->header_top_title : '' }}</h3>
    </div>
    <!--  Top Header End -->
    <!--Logo Area Start-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="logo-wrapper">
                    <a href="{{ route('home') }}">
                        <img class="header-logo"
                             src="@if(empty($globalSettingInfo)) @else {{ $globalSettingInfo->image()->where('type', 'logo')->first()->url }} @endif"
                             alt="">
                    </a>
                    <div class="login-area">
                        <!--  Profile area-->
                        <div class="dropdown">
                            @auth
                                <button class="btn btn-secondary dropdown-toggle login-btn" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    {{ Str::limit(auth()->user()->name, 13) }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        LOGOUT
                                    </a>
                                </div>
                            @else
                                <button class="btn btn-secondary login-btn" type="button" data-toggle="modal"
                                        data-target="#loginModal">
                                    Login
                                </button>
                            @endauth
                        </div>

                        <!-- Profile area End -->
                        <a href="{{ route('cart.index') }}">
                                 <i class="fa fa-cart-plus admin-width ml-5" aria-hidden="true"></i>

                            <span class="cart-value">{{ Cart::instance('cart')->content()->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Logo Area End-->


    <!-- Navbar Area -->
    {{--    <div class="palatin-main-menu">--}}
    <div id="categoryTopMenu" class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-lg-center justify-content-left pl-0" id="palatinNav">
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler mt-0">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">

                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            @if($main_categories->count() >0)
                                @foreach(collect($main_categories)->chunk(5)[0] as $category)
                                    <li>
                                        <a href="{{ route('categories.products', @$category->slug) }}">
                                            {{ strtoupper(@$category->name) }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                            @endif
                        </ul>
                        <form action="" class="search-form" method="get">
                            <div class="form-group">
                                <input type="text" name="keyword" value="{{ request('keyword') }}"
                                       placeholder="Search" class="form-control header-search">
                                <i class="fa fa-search search-icon" aria-hidden="true"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Nav End -->
            </nav>
        </div>
    </div>
    {{--    </div>--}}
</header>

@push('script')
    <script>
        // When the user scrolls the page, execute myFunction
        window.onscroll = function () {
            myFunction()
        };

        // Get the navbar
        var navbar = document.getElementById("categoryTopMenu");

        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
@endpush
