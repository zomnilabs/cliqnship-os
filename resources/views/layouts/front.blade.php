<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CliqNShip') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    @yield('stylesheets')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="{{ !Auth::guest() ? 'app' : 'guest' }}">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="images/logo.png"/>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (! Auth::guest())
                        @if (Auth::user()->user_group_id == 1)
                            <li class="{{ set_active(['admin']) }}"><a href="/admin">Dashboard <span class="sr-only">(current)</span></a></li>
                            <li class="{{ set_active(['admin/dispatching*']) }}"><a href="/admin/dispatching">Dispatching</a></li>
                            <li class="{{ set_active(['admin/riders*']) }}"><a href="/admin/riders">Riders</a></li>
                            <li class="{{ set_active(['admin/customers*']) }}"><a href="/admin/customers">Customers</a></li>
                            <li class="{{ set_active(['admin/users*']) }}"><a href="/admin/users">Users</a></li>
                            <li class="{{ set_active(['admin/bookings*']) }}"><a href="/admin/bookings">Bookings</a></li>
                            <li class="{{ set_active(['admin/shipments*']) }}"><a href="/admin/shipments">Shipments</a></li>
                            <li class="{{ set_active(['admin/reports*']) }}"><a href="/admin/reports">Reports</a></li>
                            <li class="{{ set_active(['admin/cms*']) }}"><a href="/admin/cms">CMS</a></li>
                        @else
                            <li class="{{ set_active(['customers']) }}"><a href="/customers">Dashboard <span class="sr-only">(current)</span></a></li>
                            <li class="{{ set_active(['customers/addressbooks*']) }}"><a href="/customers/addressbooks">Addressbooks</a></li>
                            <li class="{{ set_active(['customers/bookings*']) }}"><a href="/customers/bookings">Bookings</a></li>
                            <li class="{{ set_active(['customers/shipments*']) }} dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    Shipments <span class="caret"></span></a>

                                <ul class="dropdown-menu">
                                    <li><a href="/customers/shipments">All Shipments</a></li>
                                    <li><a href="/customers/shipments/returned">Returned Shipments</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/customers/shipments/cash-on-delivery">Cash-on-Delivery Shipments</a></li>
                                </ul>
                            </li>
                        @endif
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->profile->full_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Profile</a></li>

                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

<!-- Fix for vue -->
    @if(Auth::guest())
        <div id="app"></div>
    @endif
</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
