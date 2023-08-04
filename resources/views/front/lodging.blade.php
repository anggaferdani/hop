@extends('front.templates.pages')
@section('title', 'Hotel')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="container">
    <div class="row pt-0 pt-md-4">
      <div class="banner3">
        @foreach($lodging->hangout_place_images as $lodging_image)
          <div style="height: 400px;">
            <img src="{{ asset('lodging/image/'.$lodging_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover; border-radius: 30px;">
          </div>
        @endforeach
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-9">
        <h5 class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $lodging->nama_tempat }}</h5>
        <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $lodging->deskripsi_tempat !!}</div>
        <div class="fs-5 fw-bold">Lokasi</div>
        <div class="text-muted lh-sm mb-3">{{ $provinsi->nama_provinsi }}, {{ $kabupaten->nama_kabupaten }}, {{ $kecamatan->nama_kecamatan }}</div>
        <div class="fs-5 fw-bold">Fasilitas</div>
        <div class="text-muted lh-sm">
          @foreach($lodging->fasilitas as $fasilitas)
          {{ $fasilitas->fasilitas }},
          @endforeach
        </div>
        <div class="btn-group dropend mt-3">
          <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div></button>
          <ul class="dropdown-menu px-4">
            {!! $share !!}
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="fs-5 fw-bold mb-2">Lokasi</div>
            <div class="parent2">{!! $lodging->lokasi !!}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('lodgings') }}" class="color">View All</a></div>
    </div>
    <div class="row g-4 g-md-2">
      @foreach($lodgings as $lodging)
      <?php $lokasi = $lodging->provinsi.", ".$lodging->kabupaten_kota.", ".$lodging->kecamatan ?>
        <div class="col-md-3">
          <a href="{{ route('lodging', Crypt::encrypt($lodging->id)) }}">
            <div class="card h-100 border-0" style="height: 230px">
              @foreach($lodging->hangout_place_images->take(1) as $lodging_image)
              <div style="height: 150px">
                <img src="{{ asset('lodging/image/'.$lodging_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
              </div>
              @endforeach
              <div class="mt-1 text-dark fw-bold">{{ Str::limit($lodging->nama_tempat, 20) }}</div>
              <p class="small fw-bold m-0 text-muted" style="font-size: 10px;">
                @foreach($provinsis as $provinsi)
                  @if($lodging->provinsi == $provinsi->id_provinsi){{ $provinsi->nama_provinsi }}, @endif
                @endforeach
                @foreach($kabupatens as $kabupaten)
                  @if($lodging->kabupaten_kota == $kabupaten->id_kabupaten){{ $kabupaten->nama_kabupaten }}, @endif
                @endforeach
                @foreach($kecamatans as $kecamatan)
                  @if($lodging->kecamatan == $kecamatan->id_kecamatan){{ $kecamatan->nama_kecamatan }}@endif
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