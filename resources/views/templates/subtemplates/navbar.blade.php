<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    @if (Auth::check())
      <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i class="far fa-envelope"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
          <div class="dropdown-header">Messages
            <div class="float-right">
              <a href="#">Mark All As Read</a>
            </div>
          </div>
          <div class="dropdown-list-content dropdown-list-message">
            <a href="#" class="dropdown-item dropdown-item-unread">
              <div class="dropdown-item-avatar">
                <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-2.png') }}" class="rounded-circle">
              </div>
              <div class="dropdown-item-desc">
                <b>Dedik Sugiharto</b>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                <div class="time">12 Hours Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item dropdown-item-unread">
              <div class="dropdown-item-avatar">
                <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-3.png') }}" class="rounded-circle">
                <div class="is-online"></div>
              </div>
              <div class="dropdown-item-desc">
                <b>Agung Ardiansyah</b>
                <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <div class="time">12 Hours Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-avatar">
                <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-4.png') }}" class="rounded-circle">
              </div>
              <div class="dropdown-item-desc">
                <b>Ardian Rahardiansyah</b>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                <div class="time">16 Hours Ago</div>
              </div>
            </a>
          </div>
          <div class="dropdown-footer text-center">
            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </li>
      <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
          <div class="dropdown-header">Notifications
            <div class="float-right">
              <a href="#">Mark All As Read</a>
            </div>
          </div>
          <div class="dropdown-list-content dropdown-list-icons">
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-danger text-white">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="dropdown-item-desc">
                <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                <div class="time">10 Hours Ago</div>
              </div>
            </a>
            <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
              </div>
              <div class="dropdown-item-desc">
                <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                <div class="time">12 Hours Ago</div>
              </div>
            </a>
          </div>
          <div class="dropdown-footer text-center">
            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </li>
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->email }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.profile') }}" class="dropdown-item">PROFILE</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.profile') }}" class="dropdown-item">PROFILE</a>
          @elseif(auth()->user()->level == 'Vendor')
            <a href="{{ route('vendor.profile') }}" class="dropdown-item">PROFILE</a>
          @endif
          <a href="{{ route('logout') }}" class="dropdown-item text-danger">LOGOUT</a>
        </div>
      </li>
    @endif
  </ul>
</nav>