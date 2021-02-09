<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <a href="{{ url('/home') }}" class="navbar-brand sidebar-gone-hide">Boojbook</a>
  <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
  <div class="nav-collapse" style="width: 70%;"></div>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="image" src="{{ url('uploads/avatar-1.png') }}" class="rounded-circle mr-1">
      <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:;" class="dropdown-item has-icon" id="generate-token">
          <i class="fas fa-key"></i> Generate API Token
        </a>
        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>

<nav class="navbar navbar-secondary navbar-expand-lg">
  <div class="container">
    <ul class="navbar-nav">
      <li class="nav-item {{ (\Request::path() == 'home') ? 'active' : '' }}">
        <a href="{{ url('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li class="nav-item {{ (\Request::path() == 'api/docs') ? 'active' : '' }}">
        <a href="{{ url('api/docs') }}" class="nav-link"><i class="fas fa-key"></i><span>API Docs</span></a>
      </li>
    </ul>
  </div>
</nav>