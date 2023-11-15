<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
      <div class="search-element">
        <p class="navbar-text"><b>{{ Carbon\Carbon::now()->formatLocalized('%A %d %B %Y') }}</b></p>
      </div>
    </form>
    {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg"></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
        </div>
    </li> --}}
    <ul class="navbar-nav navbar-right">
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        @if (!empty(auth()->user()->foto))
            <img alt="image" src="{{ asset('public/img_user/'. auth()->user()->foto) }}" class="rounded-circle mr-1">
        @else
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
        @endif
        <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">Logged</div>
          <a href="{{ asset('/setting') }}" class="dropdown-item has-icon">
            <i class="fas fa-cog"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
          <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
