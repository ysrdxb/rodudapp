<!DOCTYPE html>
<html lang="en">

<head>

        <meta charset="utf-8" />
        <title>@yield('title', 'Admin')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content=""/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">
        <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
        <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        @livewireStyles
        <style>
            .badge-warning { background-color: yellow !important; color: black !important; }
            .badge-info { background-color: blue; color: white; }
            .badge-success { background-color: green; color: white; }
            .badge-secondary { background-color: gray; color: white; }
            .table th {
                text-transform: uppercase;
                font-size: 0.825rem;
                letter-spacing: 0.5px;
            }
            
            .btn-outline-primary {
                transition: all 0.2s ease;
            }
            
            .btn-outline-primary:hover {
                transform: translateY(-1px);
            }
            
            .badge {
                padding: 0.5em 0.75em;
                font-weight: 500;
            }
            
            .card {
                border-radius: 0.75rem;
            }
            
            .form-control, .form-select {
                padding: 0.625rem 0.875rem;
            }
            
            .form-control:focus, .form-select:focus {
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
            
            .alert {
                border-left: 4px solid #198754;
            }
            
            .pagination {
                margin-bottom: 0;
            }
            
            @media (max-width: 768px) {
                .d-flex.align-items-center.gap-3 {
                    flex-direction: column;
                    align-items: stretch !important;
                    gap: 1rem !important;
                }
                
                .form-control, .form-select {
                    width: 100%;
                }
            }
            </style>    
        @stack('head')
    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">

            <!-- Topbar Start -->
            <div class="topbar-custom">
                <div class="container-xxl">
                    <div class="d-flex justify-content-between">
                        <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                            <li>
                                <button class="button-toggle-menu nav-link ps-0">
                                    <i data-feather="menu" class="noti-icon"></i>
                                </button>
                            </li>
                            <li class="d-none d-lg-block">
                                <div class="position-relative topbar-search">
                                    <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4" placeholder="Search...">
                                    <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                </div>
                            </li>
                        </ul>

                        <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">                        
        
                            <li class="dropdown notification-list topbar-dropdown">
                                <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ asset('admin/images/user.png') }}" alt="user-image" class="rounded-circle">
                                    <span class="pro-user-name ms-1">
                                        User <i class="mdi mdi-chevron-down"></i> 
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome, {{ Auth::user()->name }}!</h6>
                                    </div>                                    
        
                                    <div class="dropdown-divider"></div>
        
                                    <!-- item-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                    <a class="dropdown-item notify-item" href="#" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                        <span>Logout</span>
                                    </a>                                    
        
                                </div>
                            </li>
        
                        </ul>
                    </div>

                </div>
               
            </div>
            <!-- end Topbar -->

            <!-- Left Sidebar Start -->
            @include('admin.layouts.sidebar')

            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                            </div>
                        </div>

                        <!-- start row -->
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                @yield('section')

                                @if(isset($slot))
                    
                                    {{ $slot }}
                    
                                @endif
                            </div> <!-- end sales -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">Yasir Hussain</a> 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        <div class="modal fade show" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="notificationMessage">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>                       
                    </div>
                </div>
            </div>   
        </div>  
        
        <!-- Vendor -->
        <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('admin/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('admin/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('admin/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/js/pages/analytics-dashboard.init.js') }}"></script>
        <script src="{{ asset('admin/js/app.js') }}"></script>
        
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <script>
            var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
            });

            var channel = pusher.subscribe('order-channel');
            channel.bind('order-updated', function (data) {
                document.getElementById('notificationMessage').innerHTML = data.message;
                $('#notificationModal').modal('show');
            });            
        </script>                
        @livewireScripts
    
        @stack('scripts')

    </body>
</html>