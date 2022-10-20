<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>حضور و غیاب نمایشگاه</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/custom.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="/assets/media/image/favicon.png">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->
    @yield('head')
</head>
<body>

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<!-- begin::side menu -->
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            <li class="side-menu-divider">فهرست</li>
            <li><a class="{{(isset($menuActive) && ($menuActive == 'dashboard')) ? 'active':''}}" href="/"><i
                        class="icon ti-home"></i> <span>داشبورد</span> </a></li>
            <li class="{{(isset($menuActive) && (in_array($menuActive, ['list-personnel','create-personnel']))) ? 'open':''}}">
                <a href="#"><i class="icon ti-user"></i> <span>پرسنل</span></a>
                <ul>
                    <li><a href="/personnel"
                           class="{{(isset($menuActive) && ($menuActive == 'list-personnel')) ? 'active':''}}">لیست </a>
                    </li>
                    <li><a href="/personnel/create"
                           class="{{(isset($menuActive) && ($menuActive == 'create-personnel')) ? 'active':''}}">ثبت
                            جدید </a></li>
                </ul>
            </li>
            <li class="{{(isset($menuActive) && (in_array($menuActive, ['report-detail','report-all']))) ? 'open':''}}">
                <a href="#"><i class="icon ti-import"></i> <span>گزارشات</span> </a>
                <ul>
                    <li><a  class="{{(isset($menuActive) && ($menuActive == 'report-detail')) ? 'active':''}}" href="/reportDetail">جزییات حضور </a></li>
                    <li><a  class="{{(isset($menuActive) && ($menuActive == 'report-all')) ? 'active':''}}" href="/reportAll">مجموع ساعات </a></li>
                    <li><a href="/reportUsers/?type=presents">لیست غذا </a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end::side menu -->

<!-- begin::navbar -->
<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            <a href="#">
                <img src="/assets/media/image/light-logo.png" alt="...">
                <span class="logo-text d-none d-lg-block">حضور نمایشگاه</span>
            </a>
        </div>

        <div class="header-body">
            <form class="search">
                <div class="input-group">


                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="d-lg-none d-sm-block nav-link search-panel-open">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown">
                        <figure class="avatar avatar-sm avatar-state-info">
                            <img class="rounded-circle" src="/assets/media/image/user-avatar.jpg" alt="...">
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/profile" class="dropdown-item">تغییر رمز</a>
                        {{--                        <a href="#" data-sidebar-target="#settings" class="sidebar-open dropdown-item">تنظیمات</a>--}}
                        <div class="dropdown-divider"></div>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bx bx-power-off mr-50"></i>
                                خروج
                            </button>
                        </form>
                    </div>
                </li>
                <li class="nav-item d-lg-none d-sm-block">
                    <a href="#" class="nav-link side-menu-open">
                        <i class="ti-menu"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<!-- end::navbar -->

<!-- begin::main content -->
<main class="main-content">

    <div class="container-fluid">

        @yield('content')

    </div>

</main>
<!-- end::main content -->

<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
{{--<script src="/assets/js/custom.js"></script>--}}
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->
@yield('script')

</body>
</html>
