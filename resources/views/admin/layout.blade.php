<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.png') }}">

    @yield('css')

    <!-- Core css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>


    <script src="{{ asset('assets/js/lazy-load/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('assets/js/lazy-load/jquery.lazy.plugins.min.js') }}"></script>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="/" class="align-justify-center">
                        <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo"> -->
                        <!-- <img class="logo-fold" src="{{ asset('assets/images/logo/logo-fold-white.png') }}" alt="Logo"> -->
                        <!-- Etsy -->
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="index.html">
                        <img data-src="{{ asset('assets/images/logo/logo-white.png') }}" alt="Logo">
                        <img class="logo-fold" src="{{ asset('assets/images/logo/logo-fold-white.png') }}" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="{{ asset('assets/images/logo/logo1.png') }}"  alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img src="{{ asset('assets/images/logo/logo1.png') }}" alt="">
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold">Quản trị viên</p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>    
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="{{ route('admin.order') }}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-shop"></i>
                                </span>
                                <span class="title">Đơn hàng</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="{{ route('services.index') }}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-inbox"></i>
                                </span>
                                <span class="title">Dịch vụ</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="{{ route('user.index') }}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-user"></i>
                                </span>
                                <span class="title">Khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container" id="page-container">
                
                @yield('body')

                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0"></p>
                    </div>
                </footer>

                <!-- Footer END -->

            </div>
            <!-- Page Container END -->


            @yield('sub_layout')
        </div>
    </div>
    @yield('modal')
    <!-- not a modal but can i have a slot? -->
    <div class="notification-toast top-right" id="notification-toast"></div>
    <div class="notification-toast top-right" id="notification-sending"></div>
    <!-- Core Vendors JS -->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

    <script src="{{ asset('assets/js/api.js') }}"></script>
    @yield('js')
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- Core JS -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>