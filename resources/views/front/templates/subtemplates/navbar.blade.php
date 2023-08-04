<header>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background: white;box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);">
    <div class="container">
      <a href="{{ route('index') }}">
        <img src="{{ asset('front/img/logo2.png') }}" alt="" width="190" class="d-inline-block align-text-top">
      </a>
      <button class="mx-4 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto py-4">
          <li class="nav-item mx-1">
            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'index') ? 'active2' : '' }}" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'updates') || str_contains(Route::currentRouteName(), 'update') ? 'active2' : '' }}" href="{{ route('updates') }}">Updates</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'agendas') || str_contains(Route::currentRouteName(), 'agenda') ? 'active2' : '' }}" href="{{ route('agendas') }}">Agendas</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'food-and-beverages') ||
            str_contains(Route::currentRouteName(), 'food-and-beverage') ||
            str_contains(Route::currentRouteName(), 'lodgings') ||
            str_contains(Route::currentRouteName(), 'lodging') ||
            str_contains(Route::currentRouteName(), 'public-areas') ||
            str_contains(Route::currentRouteName(), 'public-area') ? 'active2' : '' }} dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hangout Places</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item my-1 {{ str_contains(Route::currentRouteName(), 'food-and-beverages') || str_contains(Route::currentRouteName(), 'food-and-beverage') ? 'active2' : '' }}" href="{{ route('food-and-beverages') }}">Resto & Cafe</a></li>
            <li><a class="dropdown-item my-1 {{ str_contains(Route::currentRouteName(), 'lodgings') || str_contains(Route::currentRouteName(), 'lodging') ? 'active2' : '' }}" href="{{ route('lodgings') }}">Hotel</a></li>
              <li><a class="dropdown-item my-1 {{ str_contains(Route::currentRouteName(), 'sportainments') ? 'active2' : '' }}" href="{{ route('sportainments') }}">Sportainment</a></li>
              <li><a class="dropdown-item my-1 {{ str_contains(Route::currentRouteName(), 'public-areas') || str_contains(Route::currentRouteName(), 'public-area') ? 'active2' : '' }}" href="{{ route('public-areas') }}">Public Area</a></li>
            </ul>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'activity-manajemens') || str_contains(Route::currentRouteName(), 'activity-manajemen') ? 'active2' : '' }}" href="{{ route('activity-manajemens') }}">Community</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'about-us') ? 'active2' : '' }}" href="{{ route('about-us') }}">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>