<div>
  <div class="row">
    <div class="col-md-3 p-4 border-end border-2">
      <div class="row">
        <div class="py-4">
          <div class="fs-3 fw-bold color">Sort By</div>
        </div>
      </div>
      <form wire:submit.prevent="searching">
        <div class="row">
          <div class="py-2">
            <h4 class="fw-bold color2 m-0">Location</h4>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Provinsi</label>
          <input type="text" class="form-control" name="" wire:model="provinsi">
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Kabupaten/Kota</label>
          <input type="text" class="form-control" name="" wire:model="kabupaten">
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Kecamatan</label>
          <input type="text" class="form-control" name="" wire:model="kecamatan">
        </div>
        <div class="row">
          <div class="py-2">
            <h4 class="fw-bold color2 m-0">Seating Area</h4>
          </div>
        </div>
        <div class="pt-1 pb-3">
          @foreach($fasilitasies as $fasilitas)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" wire:model.defer="selectedFasilitas" value="{{ $fasilitas->id }}">
              <label class="form-check-label">{{ $fasilitas->fasilitas }}</label>
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
            <input class="form-check-input" type="radio" name="price" value="< = Rp.50.000" wire:model.defer="harga">
            <label class="form-check-label">< = Rp.50.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="price" value="Rp.50.000 - Rp.100.000" wire:model.defer="harga">
            <label class="form-check-label">Rp.50.000 - Rp.100.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="price" value="> = Rp.100.000" wire:model.defer="harga">
            <label class="form-check-label">> = Rp.100.000</label>
          </div>
        </div>
        <button class="btn btn-primary w-100" style="background-color: #5AA4C2 !important">Apply</button>
      </form>
    </div>
    <div class="col-sm-9 py-4">
      <div class="row">
        <div class="pt-4 pb-3">
          <div class="fs-3 fw-bold color m-0">Penginapan</div>
          <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="row g-4 g-md-2">
        @foreach($lodgings as $lodging)
          <div class="col-md-3">
            <a href="{{ route('lodging', Crypt::encrypt($lodging->id)) }}">
              <div class="card h-100 border-0" style="height: 230px">
                @foreach($lodging->hangout_place_images->take(1) as $lodging_image)
                <div style="height: 150px">
                  <img src="{{ asset('lodging/image/'.$lodging_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="fs-5 py-2 text-dark fw-bold">{{ Str::limit($lodging->nama_tempat, 20) }}</div>
                <p class="small fw-bold m-0 text-muted"><i class="fa-solid fa-location-dot"></i> 1.0 km</p>
                <p class="small fw-bold m-0 text-muted" style="font-size: 10px;">{{ $lodging->Provinsi->nama_provinsi }}, {{ $lodging->Kabupaten->nama_kabupaten }}, {{ $lodging->Kecamatan->nama_kecamatan }}</p>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
