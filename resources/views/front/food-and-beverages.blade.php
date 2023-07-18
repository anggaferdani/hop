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
          <div class="row">
            <div class="py-2">
              <h4 class="fw-bold color2 m-0">Seating Area</h4>
            </div>
          </div>
          <div class="pt-1 pb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="seating" value="Outdoor">
              <label class="form-check-label">Outdoor</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="seating" value="Semi Outdoor">
              <label class="form-check-label">Semi Outdoor</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="seating" value="Indoor Non-Smoking">
              <label class="form-check-label">Indoor Non-Smoking</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="seating" value="Indoor Smoking">
              <label class="form-check-label">Indoor Smoking</label>
            </div>
          </div>
          <div class="row">
            <div class="py-2">
              <h4 class="fw-bold color2 m-0">Price</h4>
            </div>
          </div>
          <div class="pt-1 pb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="harga" value="< = Rp.50.000">
              <label class="form-check-label">< = Rp.50.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="harga" value="Rp.50.000 - Rp.100.000">
              <label class="form-check-label">Rp.50.000 - Rp.100.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="harga" value="> = Rp.100.000">
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
    </div>
  </div>
</section>
@endsection