<!DOCTYPE html>
<html>

<head>
    @include('backend.layouts.head')
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <p>Please wait...</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Search  -->
    <div class="search-bar">
        <div class="search-icon"> <i class="fa-solid fa-magnifying-glass fa-xl"></i> </div>
        <input type="text" placeholder="Explore...">
        <div class="close-search"> <i class="fa-solid fa-xmark"></i> </div>
    </div>

    @include('backend.layouts.nav')

    @include('backend.layouts.sidebar')
    @include('backend.layouts.ride_sidebar')

    <!-- main content -->
    @yield('content')

    @include('backend.layouts.footer')
</body>

</html>
