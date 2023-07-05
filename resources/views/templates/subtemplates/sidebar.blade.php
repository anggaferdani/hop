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
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.update') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.update.index') }}"><i class="fas fa-quote-left"></i><span>Update</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.agenda') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.agenda.index') }}"><i class="fas fa-star"></i><span>Agenda</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.food-and-beverage') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.food-and-beverage.index') }}"><i class="fas fa-lemon"></i><span>Food And Beverage</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'superadmin.lodging') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.lodging.index') }}"><i class="fas fa-home"></i><span>Lodging</span></a></li>
      @endif
      @if(auth()->user()->level == 'Admin')
        <li class="menu-header">Menu</li>
        <li class="{{ str_contains(Route::currentRouteName(), 'admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-quote-right"></i><span>Dashboard</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'admin.update') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.update.index') }}"><i class="fas fa-quote-left"></i><span>Update</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'admin.agenda') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.agenda.index') }}"><i class="fas fa-star"></i><span>Agenda</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'admin.food-and-beverage') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.food-and-beverage.index') }}"><i class="fas fa-lemon"></i><span>Food And Beverage</span></a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'admin.lodging') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.lodging.index') }}"><i class="fas fa-home"></i><span>Lodging</span></a></li>
      @endif
      @if(auth()->user()->level == 'Vendor')
        <li class="menu-header">Menu</li>
        <li class="{{ str_contains(Route::currentRouteName(), 'vendor.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('vendor.dashboard') }}"><i class="fas fa-quote-right"></i><span>Dashboard</span></a></li>
      @endif
    </ul>
  </aside>
</div>