<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>POS</title>

    <link href="{{ asset('/fonts/vendor/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/sb-admin/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/fonts/vendor/font-awesome/js/all.js') }}" data-auto-replace-svg="nest" defer></script>
    <script src="{{ asset('/asset/sb-admin/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('/asset/sb-admin/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('/asset/sb-admin/sb-admin-2.min.js') }}" defer></script>
    <script src="{{ asset('/asset/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('/asset/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('/asset/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('/asset/jquery.mask.min.js') }}"></script>
</head>

<body>
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-cash-register"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Point of Sales</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::segment(1) === 'home' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::segment(1) === 'items' ? 'active' : null }}">
                <a class="nav-link" href="{{ url('/items') }}">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Items</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::segment(1) === 'orders' ? 'active' : null }}">
                <a class="nav-link" href="{{ url('/orders') }}">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Orders</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::segment(1) === 'history' ? 'active' : null }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_history"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-history"></i>
                    <span>History</span>
                </a>
                <div id="collapse_history" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Orders</h6>
                        
                        <hr class="m-0 ml-3 mr-3">
                        <a href="{{ route('history/orders/all') }}"
                            class="collapse-item {{ Request::segment(3) === 'all' || Request::segment(3) === 'dateRange' || Request::segment(3) === 'detail' ? 'active' : null }}">All</a>
                        <a href="{{ route('history/orders/today') }}"
                            class="collapse-item {{ Request::segment(3) === 'today' ? 'active' : null }}">Today</a>

                        <h6 class="collapse-header">Items</h6>
                        
                        <hr class="m-0 ml-3 mr-3">
                        <a href="{{ route('history/items/deleted') }}"
                            class="collapse-item {{ Request::segment(3) === 'deleted' ? 'active' : null }}">Deleted</a>

                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Others
            </div>
            <li class="nav-item {{ Request::segment(1) === 'users' ? 'active' : null }}">
                <a class="nav-link" href="{{ url('/users') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::segment(1) === 'company' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('company') }}">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Company</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            {{-- <div class="sidebar-heading">
                Addons
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> --}}

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-light topbar static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <i class="fa fa-calendar-alt"></i>
                        {{ date('d/m/Y') }}
                    </div>
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        {{-- <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li> --}}

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                @if (count($items) > 9)
                                    <span class="badge badge-danger badge-counter">
                                        9+
                                    </span>
                                @elseif(count($items) > 0)
                                    <span class="badge badge-danger badge-counter">
                                        {{ count($items) }}
                                    </span>
                                @endif
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown" id="notifications">
                                <h6 class="dropdown-header">
                                    Notifications
                                </h6>
                                @foreach ($items as $item)
                                    <a class="dropdown-item" href="{{ route('items/edit', $item->id) }}">
                                        <div>
                                            <div class="small">{{ $item->name }}</div>
                                            <span class="font-weight-bold">{{ $item->part_number }}</span>
                                            <span class="font-weight-bold pull-right">Stock: {{ $item->stock }}</span>
                                        </div>
                                    </a>
                                @endforeach
                                
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if (Auth::user()->role == 1)
                                    <a class="dropdown-item" href="{{ route('users/edit', Auth::user()->id) }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                @elseif (Auth::user()->role == 2)
                                    <a class="dropdown-item" href="{{ route('users/changePassword', Auth::user()->id) }}">
                                        <i class="fas fa-unlock-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Change Password
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form method="GET" action="{{ route('logout') }}">
                                    
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="main">
                    <div class="card p-5 rounded-0">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    
    @stack('scripts')
</body>

</html>
