@extends('front.templates.pages')
@section('title', 'Resto & Cafe')
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
        <form action="{{ route('food-and-beverages') }}">
          @csrf
          <div class="row">
            <div class="py-2">
              <h4 class="fw-bold color2 m-0">Location</h4>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Provinsi</label>
            <select class="form-select select2" name="provinsi" id="provinsi" required>
              <option disabled selected>Select</option>
              @foreach($provinsis as $provinsi)
                <option value="{{ $provinsi->id_provinsi }}" {{ $provinsi->id_provinsi == old('provinsi') ? 'selected' : null }}>{{ $provinsi->nama_provinsi }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Kabupaten/Kota</label>
            <select class="form-select select2" name="kabupaten_kota" id="kabupaten" required>
              <option disabled selected>Select</option>
              @foreach($kabupatens as $kabupaten)
                <option value="{{ $kabupaten->id_kabupaten }}" {{ $kabupaten->id_kabupaten == old('kabupaten_kota') ? 'selected' : null }}>{{ $kabupaten->nama_kabupaten }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Kecamatan</label>
            <select class="form-select select2" name="kecamatan" id="kecamatan" required>
              <option disabled selected>Select</option>
            </select>
          </div>
          <div class="row">
            <div class="py-2">
              <h4 class="fw-bold color2 m-0">Seating Area</h4>
            </div>
          </div>
          <div class="pt-1 pb-3">
            @foreach($seatings as $seating)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="seating[]" value="{{ $seating->seating }}" id="{{ $seating->seating }}" {{ $seating->seating == old('seating') ? 'selected' : null }}>
                <label class="form-check-label">{{ $seating->seating }}</label>
              </div>
            @endforeach
          </div>
          <div class="row">
            <div class="py-2">
              <h4 class="fw-bold color2 m-0">Price</h4>
            </div>
          </div>
          <div class="pt-1 pb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="price" value="< = Rp.50.000" id="< = Rp.50.000" {{ old('< = Rp.50.000') ? 'selected' : null }}>
              <label class="form-check-label">< = Rp.50.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="price" value="Rp.50.000 - Rp.100.000" id="Rp.50.000 - Rp.100.000" {{ old('Rp.50.000 - Rp.100.000') ? 'selected' : null }}>
              <label class="form-check-label">Rp.50.000 - Rp.100.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="price" value="> = Rp.100.000" id="> = Rp.100.000" {{ old('> = Rp.100.000') ? 'selected' : null }}>
              <label class="form-check-label">> = Rp.100.000</label>
            </div>
          </div>
          <button class="btn btn-primary w-100" style="background-color: #5AA4C2 !important">Apply</button>
        </form>
      </div>
      <div class="col-sm-9 py-4">
        <div class="row">
          <div class="pt-4 pb-3">
            <div class="fs-3 fw-bold color m-0">Resto & Cafe</div>
            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="row g-4 g-md-2">
          @foreach($food_and_beverages as $food_and_beverage)
            <div class="col-md-3 food-and-beverage" data-category="{{ $food_and_beverage->provinsi }}, {{ $food_and_beverage->harga }}, @foreach($food_and_beverage->seatings as $seating){{ $seating->seating }}, @endforeach">
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
                  <p class="small fw-bold m-0 text-muted"><i class="fa-solid fa-location-dot"></i> 1.0 km</p>
                  <p class="small fw-bold m-0 text-muted" style="font-size: 10px;">{{ $food_and_beverage->Provinsi->nama_provinsi }}, {{ $food_and_beverage->Kabupaten->nama_kabupaten }}, {{ $food_and_beverage->Kecamatan->nama_kecamatan }}
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