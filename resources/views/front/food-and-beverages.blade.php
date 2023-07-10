@extends('front.templates.pages')
@section('title', 'Food And Beverages')
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
        <div class="row">
          <div class="py-2">
            <h4 class="fw-bold color2 m-0">Location</h4>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Provinsi</label>
          <input type="text" class="form-control" placeholder="Masukan Provinsi">
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Kota/Kabupaten</label>
          <input type="text" class="form-control" placeholder="Masukan Kota/Kabupaten">
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Kecamatan</label>
          <input type="text" class="form-control" placeholder="Masukan Kecamatan">
        </div>
        <div class="row">
          <div class="py-2">
            <h4 class="fw-bold color2 m-0">Seating Area</h4>
          </div>
        </div>
        <div class="pt-1 pb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" checked>
            <label class="form-check-label">Outdoor</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Semi Outdoor</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Indoor Non-Smoking</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
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
            <input class="form-check-input" type="checkbox" value="" checked>
            <label class="form-check-label"><= Rp.50.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Rp.50.000 - Rp.100.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">>= Rp.100.000</label>
          </div>
        </div>
        <div class="row">
          <div class="py-2">
            <h4 class="fw-bold color2 m-0">Features</h4>
          </div>
        </div>
        <div class="pt-1 pb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" checked>
            <label class="form-check-label">Debit/Kredit/QRIS</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Cash Only</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Free Wifi</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Services Alcohol</label>
          </div>
        </div>
        <div class="row">
          <div class="py-2">
            <h4 class="fw-bold color2 m-0">Entertaiment</h4>
          </div>
        </div>
        <div class="pt-1 pb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" checked>
            <label class="form-check-label">Live Music</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Public Viewing</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Sports Area</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Games Area</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="">
            <label class="form-check-label">Kids Area</label>
          </div>
        </div>
      </div>
      <div class="col-sm-9 py-4">
        <div class="row">
          <div class="pt-4 pb-3">
            <div class="fs-3 fw-bold color m-0">Food and Beverages</div>
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
                  <img src="{{ asset('food-and-beverage/image/'.$food_and_beverage_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
                  @endforeach
                  <div class="fw-bold text-dark fs-5 py-2">{{ Str::limit($food_and_beverage->nama_tempat, 20) }}</div>
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