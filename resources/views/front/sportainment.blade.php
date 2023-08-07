@extends('front.templates.pages')
@section('title', 'Food And Beverage')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="container">
    <div class="row pt-0 pt-md-4">
      <div class="banner3">
        @foreach($sportainment->hangout_place_images as $hangout_place_image)
          <div style="height: 400px;">
            <img src="{{ asset('food-and-beverage/image/'.$hangout_place_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover; border-radius: 30px;">
          </div>
        @endforeach
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-9">
        <h5 class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $sportainment->nama_tempat }}</h5>
        <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $sportainment->deskripsi_tempat !!}</div>
        <div class="fs-5 fw-bold">Lokasi</div>
        <div class="text-muted lh-sm mb-3">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}, {{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}, {{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</div>
        <div class="fs-5 fw-bold mb-2">Public Viewing</div>
        <div class="mb-3" style="height: 50px; aspect-ratio: 1;">
          <img src="{{ asset('food-and-beverage/logo/'.$sportainment["logo"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
        </div>
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
            <div class="fw-bold mb-2">Lokasi</div>
            <div class="parent2">{!! $sportainment->lokasi !!}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('sportainments') }}" class="color">View All</a></div>
    </div>
    <div class="row g-4 g-md-2">
      @foreach($sportainments as $sportainment)
      <?php $lokasi = $sportainment->provinsi.", ".$sportainment->kabupaten_kota.", ".$sportainment->kecamatan ?>
        <div class="col-md-3">
          <a href="{{ route('sportainment', Crypt::encrypt($sportainment->id)) }}">
            <div class="card h-100 border-0" style="height: 230px">
              @foreach($sportainment->hangout_place_images->take(1) as $hangout_place_image)
              <div style="height: 150px">
                <img src="{{ asset('food-and-beverage/image/'.$hangout_place_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
              </div>
              @endforeach
              <div class="d-flex justify-content-between align-items-center mt-1">
                <div class="fw-bold text-dark">{{ Str::limit($sportainment->nama_tempat, 25) }}</div>
                <div style="height: 20px; aspect-ratio: 1;">
                  <img src="{{ asset('food-and-beverage/logo/'.$sportainment["logo"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
              </div>
              <p class="small fw-bold m-0 text-muted" style="font-size: 10px;">
                @foreach($provinsis as $provinsi)
                  @if($sportainment->provinsi == $provinsi->id_provinsi){{ Str::title(strtolower($provinsi->nama_provinsi)) }}, @endif
                @endforeach
                @foreach($kabupatens as $kabupaten)
                  @if($sportainment->kabupaten_kota == $kabupaten->id_kabupaten){{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}, @endif
                @endforeach
                @foreach($kecamatans as $kecamatan)
                  @if($sportainment->kecamatan == $kecamatan->id_kecamatan){{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}@endif
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