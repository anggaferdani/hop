@extends('front.templates.pages')
@section('title', 'Public Area')
@section('content')
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 p-4 border-end border-2">
        <div class="row">
          <div class="py-4">
            <div class="fs-3 fw-bold color">Sort By</div>
          </div>
        </div>
        <form action="{{ route('public-areas') }}">
          <div class="row">
            <div class="py-2">
              <h4 class="fw-bold color2 m-0">Location</h4>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Provinsi</label>
            <input type="text" class="form-control" name="provinsi" placeholder="Masukan Provinsi">
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Kabupaten/Kota</label>
            <input type="text" class="form-control" name="kabupaten_kota" placeholder="Masukan Kota/Kabupaten">
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Kecamatan</label>
            <input type="text" class="form-control" name="kecamatan" placeholder="Masukan Kecamatan">
          </div>
          <button class="btn btn-primary w-100" style="background-color: #5AA4C2 !important">Apply</button>
        </form>
      </div>
      <div class="col-sm-9 py-4">
        <div class="row">
          <div class="pt-4 pb-3">
            <div class="fs-3 fw-bold color m-0">Public Area</div>
            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="row g-4 g-md-2">
          @foreach($public_areas as $public_area)
          <?php $lokasi = $public_area->provinsi.", ".$public_area->kabupaten_kota.", ".$public_area->kecamatan ?>
            <div class="col-md-3">
              <a href="{{ route('public-area', Crypt::encrypt($public_area->id)) }}">
                <div class="card h-100 border-0" style="height: 230px">
                  @foreach($public_area->hangout_place_images->take(1) as $public_area_image)
                  <div style="height: 150px">
                    <img src="{{ asset('public-area/image/'.$public_area_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
                  </div>
                  @endforeach
                  <div class="fs-5 py-2 text-dark fw-bold">{{ Str::limit($public_area->nama_tempat, 20) }}</div>
                  <p class="small fw-bold m-0 text-muted"><i class="fa-solid fa-location-dot"></i> 1.0 km</p>
                  <p class="small fw-bold m-0 text-muted" style="font-size: 10px;">
                    @foreach($provinsis as $provinsi)
                      @if($public_area->provinsi == $provinsi->id_provinsi){{ $provinsi->nama_provinsi }}, @endif
                    @endforeach
                    @foreach($kabupatens as $kabupaten)
                      @if($public_area->kabupaten_kota == $kabupaten->id_kabupaten){{ $kabupaten->nama_kabupaten }}, @endif
                    @endforeach
                    @foreach($kecamatans as $kecamatan)
                      @if($public_area->kecamatan == $kecamatan->id_kecamatan){{ $kecamatan->nama_kecamatan }}@endif
                    @endforeach
                  </p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection