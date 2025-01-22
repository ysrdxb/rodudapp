<header class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Rodudapp</a>
    
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto d-flex align-items-center mb-0">
        
        @if (Auth::check())
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="nav-link px-3 bg-transparent border-0">
                Logout
              </button>
            </form>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link px-3" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3" href="{{ route('register') }}">Register</a>
          </li>
        @endif
      </ul>
    </div>
  </header>
  