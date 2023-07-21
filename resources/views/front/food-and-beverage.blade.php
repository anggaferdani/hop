@extends('front.templates.pages')
@section('title', 'Food And Beverage')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="banner3 pt-0 pt-md-3">
    @foreach($food_and_beverage->food_and_beverage_images as $food_and_beverage_image)
      <div style="height: 400px;">
        <img src="{{ asset('food-and-beverage/image/'.$food_and_beverage_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
      </div>
    @endforeach
  </div>
  <br>
  <div class="container">
    <div class="row">
      <h5 class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $food_and_beverage->nama_tempat }}</h5>
      <div class="fs-5 text-muted lh-sm mt-1" style="text-align: justify;">{!! $food_and_beverage->deskripsi_tempat !!}</div>
      <div class="fs-5 fw-bold">Lokasi</div>
      <div class="fs-5 text-muted lh-sm">{{ $food_and_beverage->provinsi }}, {{ $food_and_beverage->kabupaten_kota }}, {{ $food_and_beverage->kecamatan }}</div>
    </div>
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('agendas') }}" class="color">View All</a></div>
    </div>
    <div class="row g-4 g-md-2">
      @foreach($food_and_beverages as $food_and_beverage)
      <?php $lokasi = $food_and_beverage->provinsi.", ".$food_and_beverage->kabupaten_kota.", ".$food_and_beverage->kecamatan ?>
        <div class="col-md-3">
          <a href="{{ route('food-and-beverage', Crypt::encrypt($food_and_beverage->id)) }}">
            <div class="card h-100 border-0" style="height: 230px">
              @foreach($food_and_beverage->food_and_beverage_images->take(1) as $food_and_beverage_image)
              <div style="height: 150px">
                <img src="{{ asset('food-and-beverage/image/'.$food_and_beverage_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
              </div>
              @endforeach
              <div class="fw-bold text-dark py-2">{{ Str::limit($food_and_beverage->nama_tempat, 25) }}</div>
              <p class="small fw-bold m-0 text-muted"><i class="fa-solid fa-location-dot"></i> 1.0 km</p>
              <p class="small fw-bold m-0 text-muted">{{ Str::limit($lokasi, 30) }}</p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection