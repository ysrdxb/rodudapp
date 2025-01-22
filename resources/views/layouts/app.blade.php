<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title : 'Dashboard' }}</title>

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/dashboard.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #333;
      }

      .container-fluid {
        margin-top: 20px;
      }

      main {
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
      }

      h1, h2 {
        font-weight: 700;
        color: #333;
      }

      .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      .card-body {
        font-size: 16px;
      }

      .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
      }

      .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
      }

      footer {
        padding: 20px;
        text-align: center;
        background-color: #343a40;
        color: #fff;
        border-radius: 10px 10px 0 0;
      }

      /* Sidebar adjustments for responsiveness */
      @media (max-width: 991px) {
        #sidebarMenu {
          position: absolute;
          top: 0;
          bottom: 0;
          left: -250px;
          width: 250px;
          transition: 0.3s;
          background-color: #343a40;
        }

        #sidebarMenu.show {
          left: 0;
        }

        .navbar-toggler {
          display: block;
        }
      }

      /* Button to toggle sidebar visibility */
      .sidebar-toggler {
        display: none;
      }

      @media (max-width: 991px) {
        .sidebar-toggler {
          display: block;
          position: absolute;
          top: 15px;
          left: 15px;
          z-index: 1050;
          font-size: 1.5rem;
          color: #fff;
        }
      }
    </style>
    
    @stack('head')
  </head>
  <body>
    
    @include('layouts.navigation')

    <div class="container-fluid">
      <div class="row">
        @if (Auth::check())
        <div class="col-md-3 col-lg-2" id="sidebarMenu">
          @include('layouts.sidebar')
        </div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          @yield('content')
          @if(isset($slot))
            {{ $slot }}
          @endif
        </main>
        @else
        <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
          @yield('content')
          @if(isset($slot))
            {{ $slot }}
          @endif
        </main>
        @endif
      </div>
    </div>

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

    @stack('scripts')

    <script>
      document.querySelector('.sidebar-toggler').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebarMenu');
        sidebar.classList.toggle('show');
      });
    </script>

  </body>
</html>