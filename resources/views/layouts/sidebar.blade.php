<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('user.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
          </a>
        </li>
  
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.orders') }}">
            <i class="fas fa-box-open"></i>
            My Orders
          </a>
        </li>

      </ul>
    </div>
  </nav>
  