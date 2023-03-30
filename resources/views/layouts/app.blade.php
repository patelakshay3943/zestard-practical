<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link  href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
</head>
<body id="body-pd">
    @auth
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="javascript:void(0)" class="nav_logo"> <i class='bx bx-user nav_logo-icon'></i> <span class="nav_logo-name">Admin Panel</span> </a>
                <div class="nav_list">
                    <a href="{{route('election.index')}}" class="nav_link {{request()->is('election-data') ? 'active' : ''}}">
                        <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Election Data</span>
                    </a>
                    <a href="{{route('election.report')}}" class="nav_link {{request()->is('election-report') ? 'active' : ''}}">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Report</span>
                    </a>
                </div>
            </div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    @endauth
    <!--Container Main start-->
    <div class="height-100 bg-light">
        @yield('content')
    </div>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/scroll-fixed/jquery-scrolltofixed-min.js')}}"></script>
    <script src="{{asset('plugins/testimonial/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    @stack('scripts')

</body>
</html>
