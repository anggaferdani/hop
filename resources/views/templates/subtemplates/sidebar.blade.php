<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="{{ asset('front/img/logo2.png') }}" width="130px" alt="">
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <img src="{{ asset('front/img/logo.png') }}" width="30px" alt="">
    </div>
    <ul class="sidebar-menu">
      @if(auth()->user()->level == 'Superadmin')
        <li class="menu-header">Menu</li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.dashboard') }}"><i class="fas fa-quote-right"></i><span>Dashboard</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.admin') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.admin.index') }}"><i class="fas fa-user"></i><span>Admin</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.vendor') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.vendor.index') }}"><i class="fas fa-user"></i><span>Vendor</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.update') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.update.index') }}"><i class="fas fa-quote-left"></i><span>Update</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.agenda') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.agenda.index') }}"><i class="fas fa-star"></i><span>Agenda</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.food-and-beverage') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.food-and-beverage.index') }}"><i class="fas fa-coffee"></i><span>Resto & Cafe</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.lodging') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.lodging.index') }}"><i class="fas fa-building"></i><span>Penginapan</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.public-area') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.public-area.index') }}"><i class="fas fa-map"></i><span>Public Area</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.activity-manajemen') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.activity-manajemen.index') }}"><i class="fas fa-th"></i><span>Community</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.banner') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.banner.index') }}"><i class="fas fa-share-alt"></i><span>Banner</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.scanner') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.scanner') }}"><i class="fas fa-camera"></i><span>Scanner</span></a></li>
      @endif
      @if(auth()->user()->level == 'Admin')
        <li class="menu-header">Menu</li>
        <li class="{{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-quote-right"></i><span>Dashboard</span></a></li>
        @if(auth()->user()->level_admin == 'Admin')
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.vendor') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.vendor.index') }}"><i class="fas fa-user"></i><span>Vendor</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.update') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.update.index') }}"><i class="fas fa-quote-left"></i><span>Update</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.agenda') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agenda.index') }}"><i class="fas fa-star"></i><span>Agenda</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.food-and-beverage') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.food-and-beverage.index') }}"><i class="fas fa-coffee"></i><span>Resto & Cafe</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.lodging') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.lodging.index') }}"><i class="fas fa-building"></i><span>Penginapan</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.public-area') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.public-area.index') }}"><i class="fas fa-map"></i><span>Public Area</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.activity-manajemen') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.activity-manajemen.index') }}"><i class="fas fa-th"></i><span>Community</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.banner') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.banner.index') }}"><i class="fas fa-share-alt"></i><span>Banner</span></a></li>
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.scanner') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.scanner') }}"><i class="fas fa-camera"></i><span>Scanner</span></a></li>
        @elseif(auth()->user()->level_admin == 'Food And Beverage')
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.food-and-beverage') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.food-and-beverage.index') }}"><i class="fas fa-coffee"></i><span>Resto & Cafe</span></a></li>
        @elseif(auth()->user()->level_admin == 'Lodging')
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.lodging') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.lodging.index') }}"><i class="fas fa-building"></i><span>Penginapan</span></a></li>
        @elseif(auth()->user()->level_admin == 'Public Area')
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.public-area') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.public-area.index') }}"><i class="fas fa-map"></i><span>Public Area</span></a></li>
        @elseif(auth()->user()->level_admin == 'Activity Manajemen')
          <li class="{{ str_contains(Route::currentRouteName(), 'admin.activity-manajemen') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.activity-manajemen.index') }}"><i class="fas fa-th"></i><span>Community</span></a></li>
        @endif
      @endif
      @if(auth()->user()->level == 'Vendor')
        <li class="menu-header">Menu</li>
        <li class="{{ str_contains(Route::currentRouteName(), 'vendor.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('vendor.dashboard') }}"><i class="fas fa-quote-right"></i><span>Dashboard</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'vendor.activity-manajemen') ? 'active' : '' }}"><a class="nav-link" href="{{ route('vendor.activity-manajemen.index') }}"><i class="fas fa-th"></i><span>Community</span></a></li>
      @endif
    </ul>
  </aside>
</div>