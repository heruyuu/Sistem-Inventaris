<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">Inven</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item {{ Request::is('/*') ? 'active' : '' }}">
          <a href="{{ asset('/') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Management</li>
        <li class="nav-item {{ Request::is('comodities*') ? 'active' : '' }}"><a class="nav-link" href="{{ asset('comodities') }}"><i class="fas fa-columns"></i> <span>Data Barang</span></a>
        </li>
        <li class="nav-item {{ Request::is('school_operationals*') ? 'active' : '' }}"><a class="nav-link" href="{{ asset('school_operationals') }}"><i class="far fa-square"></i> <span>Dana Bos</span></a></li>
        <li class="nav-item {{ Request::is('comodity_locations*') ? 'active' : '' }}"><a class="nav-link" href="{{ asset('comodity_locations') }}"><i class="fas fa-th"></i> <span>Daftar Ruang</span></a></li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="{{ route('logout') }}" class="btn btn-primary btn-lg btn-block btn-icon-split" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
        </form>
      </div>
  </aside>
