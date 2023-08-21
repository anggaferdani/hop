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
          <select class="form-select" name="provinsi" wire:model="selectedProvinsi" wire:model.defer="provinsi">
            <option value="">Provinsi</option>
            @foreach($provinsis as $provinsi)
              <option value="{{ $provinsi->id_provinsi }}" wire:key="{{ $provinsi->id_provinsi }}">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Kabupaten/Kota</label>
          <select class="form-select" name="kabupaten" wire:model="selectedKabupaten" wire:model.defer="kabupaten">
            <option value="">Kabupaten/Kota</option>
            @foreach($kabupatens as $kabupaten)
              <option value="{{ $kabupaten->id_kabupaten }}" wire:key="{{ $kabupaten->id_kabupaten }}">{{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fs-5">Kecamatan</label>
          <select class="form-select" name="kecamatan" wire:model.defer="kecamatan">
            <option value="">Kecamatan</option>
            @foreach($kecamatans as $kecamatan)
              <option value="{{ $kecamatan->id_kecamatan }}" wire:key="{{ $kecamatan->id_kecamatan }}">{{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</option>
            @endforeach
          </select>
        </div>
        <button class="btn btn-primary w-100" style="background-color: #5AA4C2 !important">Apply</button>
      </form>
    </div>
    <div class="col-sm-9 py-4">
      <div class="row">
        <div class="pt-4 pb-3">
          <div class="fs-3 fw-bold color m-0">Public Area</div>
        </div>
      </div>
      <div class="row g-4 g-md-2">
        @foreach($public_areas as $public_area)
        <?php $lokasi = $public_area->provinsi.", ".$public_area->kabupaten_kota.", ".$public_area->kecamatan ?>
          <div class="col-md-3">
            <a href="{{ route('public-area', $public_area->slug) }}">
              <div class="card h-100 border-0" style="height: 230px">
                @foreach($public_area->hangout_place_images->take(1) as $public_area_image)
                <div style="height: 150px">
                  <img src="{{ asset('public-area/image/'.$public_area_image["image"]) }}" alt="" class="card-img-top rounded-2" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="mt-1 text-dark fw-bold">{{ Str::limit($public_area->nama_tempat, 25) }}</div>
                <p class="small fw-bold m-0 text-muted" style="font-size: 10px;">{{ Str::title(strtolower($public_area->Provinsi->nama_provinsi)) }}, {{ Str::title(strtolower($public_area->Kabupaten->nama_kabupaten)) }}, {{ Str::title(strtolower($public_area->Kecamatan->nama_kecamatan)) }}</p>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
