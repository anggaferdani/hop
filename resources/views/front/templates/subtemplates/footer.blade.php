<footer class="pt-5 pb-3" style="background-color: #5AA4C2;">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="text-white fs-4 fw-bold mb-2">About Us</div>
        <ul class="list-unstyled">
          <li class="text-white" style="text-align: justify;">Hangout Project atau lebih dikenal dengan HOP adalah wadah untuk menyapa audiens, brands, sponsors, dan penyelenggara dengan informasi dan aktivitas di jaringan Horeca (Hotel, Resto, Cafe).</li>
        </ul>
      </div>
      <div class="col-md-3">
        <div class="text-white fs-4 fw-bold mb-2 ps-0 ps-md-5">Hangout Places</div>
        <ul class="list-unstyled ps-0 ps-md-5">
          <li><a href="{{ route('food-and-beverages') }}" class="text-white">Resto & Cafe</a></li>
          <li><a href="{{ route('lodgings') }}" class="text-white">Hotel</a></li>
          <li><a href="{{ route('sportainments') }}" class="text-white">Sportstainment</a></li>
          <li><a href="{{ route('public-areas') }}" class="text-white">Public Area</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <div class="text-white fs-4 fw-bold mb-2">Social Media</div>
        <ul class="list-unstyled">
          <li><a href="https://www.instagram.com/hangoutproject.id/" class="text-white"><div class="fa-brands fa-instagram fs-5"></div></a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <div class="col-6 col-md-12 mx-auto">
          <img src="{{ asset('front/logo2.png') }}" style="filter: drop-shadow(0.1px 0 0 white) drop-shadow(0 0.1px 0 white) drop-shadow(-0.1px 0 0 white) drop-shadow(0 -0.1px 0 white)" class="img-fluid w-100" alt="">
        </div>
        <div class="small text-center mb-2 text-white">Part of</div>
        <div class="col-4 col-md-6 mx-auto mb-1">
          <a href="https://www.mixnetwork.id/" target="_blank"><img src="{{ asset('front/img/MIX.png') }}" style="filter: drop-shadow(1px 0 0 white) drop-shadow(0 1px 0 white) drop-shadow(-1px 0 0 white) drop-shadow(0 -1px 0 white)" class="img-fluid mb-3" alt=""></a>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <hr class="text-white">
      {{-- <div class="col-md-6 order-md-1 order-2">
        <div class="text-md-start text-center text-white">Created by Spero.id</div>
      </div>
      <div class="col-md-6 order-md-2 order-1">
        <div class="text-md-end text-center text-white">Terms & Condition - Privacy - Cookies</div>
      </div> --}}
      <div class="text-md-start text-center text-white terms-and-condition text-hitam">Terms & Condition - Privacy - Cookies</div>
    </div>
  </div>
</footer>