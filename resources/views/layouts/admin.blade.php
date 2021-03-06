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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminLte/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminLte/css/skins/skin-blue.min.css') }}">
    @yield('stylesheets')

<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="{{ !Auth::guest() ? 'app' : 'guest' }}" style="position: relative">
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>C</b>LIQ</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Cliq<b>N</b>Ship</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/images/panda-logo.png" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            @if (! Auth::guest())
                            <span class="hidden-xs">{{ Auth::user()->profile->full_name }} <span style="font-size: 0.8em;">[{{ Auth::user()->account_id }}]</span> <span class="caret"></span></span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user fa-lg"></i> &nbsp;&nbsp;&nbsp;Profile</a></li>
                            <li><a href="#"><i class="fa fa-cogs fa-lg"></i> &nbsp;&nbsp;&nbsp;Settings</a></li>

                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-lg"></i> &nbsp;&nbsp;&nbsp;Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/images/panda-logo.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    @if (! Auth::guest())
                    <p>{{ Auth::user()->profile->full_name }}</p>
                    @endif
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Enter tracking number...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                @if (! Auth::guest())

                    <li class="{{ set_active(['admin']) }}">
                        <a href="/admin"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="{{ set_active(['admin/dispatching*']) }} dropdown treeview">
                        <a href="#"><i class="fa fa-sitemap"></i> <span>Dispatching</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/dispatching/bookings">Bookings</a></li>
                            <li class="active dropdown treeview">
                                <a href="/admin/dispatching/shipments/all"><span>Shipments</span></a>
                            </li>
                            <li><a href="/admin/dispatching/item-requests">Item Requests</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active(['admin/receiving*']) }} dropdown treeview">
                        <a href="#"><i class="fa fa-sitemap"></i> <span>Receiving</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/receiving/rider">Shipments</a></li>
                            <li><a href="/admin/receiving/item-requests">Item Requests</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active(['admin/receiving*']) }} dropdown treeview">
                        <a href="#"><i class="fa fa-warning"></i> <span>Resolution</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ set_active(['admin/resolutions*']) }} dropdown treeview">
                                <a href="/admin/resolutions">Returned Shipments</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ set_active(['admin/cash-on-delivery*']) }} dropdown treeview">
                        <a href="#"><i class="fa fa-money"></i> <span>Cash-on-Deliver</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/cash-on-delivery/all">All</a></li>
                            <li><a href="/admin/cash-on-delivery/customer">Customer Bank</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active(['admin/riders*']) }}">
                        <a href="/admin/riders"><i class="fa fa-motorcycle"></i> <span>Riders</span></a>
                    </li>
                    <li class="{{ set_active(['admin/customers*']) }}">
                        <a href="/admin/customers"><i class="fa fa-users"></i> <span>Customers</span></a>
                    </li>
                    <li class="{{ set_active(['admin/users*']) }}">
                        <a href="/admin/users"><i class="fa fa-users"></i> <span>Users</span></a>
                    </li>
                    <li class="{{ set_active(['admin/bookings*']) }}">
                        <a href="/admin/bookings"><i class="fa fa-book"></i> <span>Bookings</span></a>
                    </li>
                    <li class="{{ set_active(['admin/shipments*']) }}">
                        <a href="/admin/shipments"><i class="fa fa-truck"></i> <span>Shipments</span></a>
                    </li>
                    <li class="{{ set_active(['admin/items*']) }}">
                        <a href="/admin/items"><i class="fa fa-archive"></i> <span>Items</span></a>
                    </li>
                    <li class="{{ set_active(['admin/reports*']) }}">
                        <a href="/admin/reports"><i class="fa fa-bar-chart-o"></i> <span>Reports</span></a>
                    </li>
                    <li class="{{ set_active(['admin/cms*']) }}">
                        <a href="/admin/cms"><i class="fa fa-object-group"></i> <span>CMS</span></a>
                    </li>
                @endif
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

<!-- Fix for vue -->
    @if(Auth::guest())
        <div id="app"></div>
    @endif
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')
</body>
</html>
