@extends('front.templates.pages')
@section('title', 'Food And Beverage')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="container">
    <div class="row pt-0 pt-md-4">
      <div class="banner3">
        @foreach($food_and_beverage->hangout_place_images as $hangout_place_image)
          <div style="height: 400px;">
            <img src="{{ asset('food-and-beverage/image/'.$hangout_place_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover; border-radius: 30px;">
          </div>
        @endforeach
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-9">
        <h5 class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $food_and_beverage->nama_tempat }}</h5>
        <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $food_and_beverage->deskripsi_tempat !!}</div>
        <div class="fs-5 fw-bold">Lokasi</div>
        <div class="text-muted lh-sm mb-3">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}, {{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}, {{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</div>
        @if(!empty($food_and_beverage->logo))
          <div class="fs-5 fw-bold mb-2">Public Viewing</div>
          <div class="mb-3" style="height: 50px; aspect-ratio: 1;">
            <img src="{{ asset('food-and-beverage/logo/'.$food_and_beverage["logo"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
          </div>
        @endif
        <div class="btn-group dropend">
          <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div> Share</button>
          <ul class="dropdown-menu px-4">
            {!! $share !!}
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="fs-5 fw-bold mb-2">Lokasi</div>
            <div class="parent2">{!! $food_and_beverage->lokasi !!}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-5 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('food-and-beverages') }}" class="color">View All</a></div>
    </div>
    <div class="row g-4 g-md-2">
      @foreach($food_and_beverages as $food_and_beverage)
      <?php $lokasi = $food_and_beverage->provinsi.", ".$food_and_beverage->kabupaten_kota.", ".$food_and_beverage->kecamatan ?>
        <div class="col-md-3">
          <a href="{{ route('food-and-beverage', Crypt::encrypt($food_and_beverage->id)) }}">
            <div class="card h-100 border-0" style="height: 230px">
              @foreach($food_and_beverage->hangout_place_images->take(1) as $hangout_place_image)
              <div style="height: 150px">
                <img src="{{ asset('food-and-beverage/image/'.$hangout_place_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
              </div>
              @endforeach
              <div class="d-flex justify-content-between align-items-center mt-1">
                <div class="fw-bold text-dark">{{ Str::limit($food_and_beverage->nama_tempat, 25) }}</div>
                @if(!empty($food_and_beverage->logo))
                <div style="height: 20px; aspect-ratio: 1;">
                  <img src="{{ asset('food-and-beverage/logo/'.$food_and_beverage["logo"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endif
              </div>
              <p class="small fw-bold m-0 text-muted" style="font-size: 12px;">
                @foreach($provinsis as $provinsi)
                  @if($food_and_beverage->provinsi == $provinsi->id_provinsi){{ Str::title(strtolower($provinsi->nama_provinsi)) }}, @endif
                @endforeach
                @foreach($kabupatens as $kabupaten)
                  @if($food_and_beverage->kabupaten_kota == $kabupaten->id_kabupaten){{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}, @endif
                @endforeach
                @foreach($kecamatans as $kecamatan)
                  @if($food_and_beverage->kecamatan == $kecamatan->id_kecamatan){{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}@endif
                @endforeach
              </p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection