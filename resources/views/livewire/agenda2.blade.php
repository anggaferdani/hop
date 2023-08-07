<div>
  <div class="container">
    <div class="row">
      <div class="py-4">
        <div class="fs-3 fw-bold color m-0">Agendas</div>
        <p class="elit m-0">Mau kemana?</p>
      </div>
    </div>
    <form wire:submit.prevent="searching" class="row g-3 mb-3">
      <div class="col-md-2">
        <select class="form-select" name="provinsi" wire:model="selectedProvinsi" wire:model.defer="provinsi">
          <option value="">Provinsi</option>
          @foreach($provinsis as $provinsi)
            <option value="{{ $provinsi->id_provinsi }}" wire:key="{{ $provinsi->id_provinsi }}">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <select class="form-select" name="kabupaten" wire:model="selectedKabupaten" wire:model.defer="kabupaten">
          <option value="">Kabupaten/Kota</option>
          @foreach($kabupatens as $kabupaten)
            <option value="{{ $kabupaten->id_kabupaten }}" wire:key="{{ $kabupaten->id_kabupaten }}">{{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <select class="form-select" name="kecamatan" wire:model.defer="kecamatan">
          <option value="">Kecamatan</option>
          @foreach($kecamatans as $kecamatan)
            <option value="{{ $kecamatan->id_kecamatan }}" wire:key="{{ $kecamatan->id_kecamatan }}">{{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2"><input type="date" class="form-control" name="" wire:model="tanggal_mulai" placeholder="Start Date"></div>
      <div class="col-md-2"><input type="date" class="form-control" name="" wire:model="tanggal_berakhir" placeholder="End Date"></div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100" style="background-color: #5AA4C2 !important">Apply</button>
      </div>
    </form>
    <div class="row g-2 mb-4">
      @foreach($agendas as $agenda)
        <?php $lokasi = $agenda->hangout_places->Provinsi->nama_provinsi.", ".$agenda->hangout_places->Kabupaten->nama_kabupaten.", ".$agenda->hangout_places->Kecamatan->nama_kecamatan ?>
          <div class="col-md-4">
            @if($agenda->tiket == 'Berbayar')
            <div class="card" style="background-color: #EC5D71;">
              <div class="row g-0">
                @foreach($agenda->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4" style="height: 210px">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 210px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm text-white">{{ Str::limit($agenda->judul, 35) }}</div>
                        </div>
                        <div class="col-md-2">
                          @if($agenda->tiket == 'Berbayar')
                            <div class="tagging3 rounded-2 py-1 px-2">Paid</div>
                          @endif
                          @if($agenda->tiket == 'Gratis')
                            <div class="tagging3 rounded-2 py-1 px-2">Free</div>
                          @endif
                        </div>
                      </div>
                      <div class="small text-white lh-sm mb-2" style="text-align: justify; word-break: break-all;">{!! Str::limit($agenda->deskripsi, 50) !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging3 rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 text-white" style="font-size: 12px;">{{ Str::limit(Str::title(strtolower($lokasi)), 65) }}</div>
                      <div class="small mb-0 text-white">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                      <a href="{{ route('agenda', Crypt::encrypt($agenda->id)) }}" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($agenda->tiket == 'Gratis')
            <div class="card">
              <div class="row g-0">
                @foreach($agenda->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4" style="height: 210px">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 210px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm color">{{ Str::limit($agenda->judul, 35) }}</div>
                        </div>
                        <div class="col-md-2">
                          @if($agenda->tiket == 'Berbayar')
                            <div class="tagging rounded-2 py-1 px-2">Paid</div>
                          @endif
                          @if($agenda->tiket == 'Gratis')
                            <div class="tagging rounded-2 py-1 px-2">Free</div>
                          @endif
                        </div>
                      </div>
                      <div class="small color lh-sm mb-2" style="text-align: justify; word-break: break-all;">{!! Str::limit($agenda->deskripsi, 50) !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 color2" style="font-size: 12px;">{{ Str::limit(Str::title(strtolower($lokasi)), 65) }}</div>
                      <div class="small mb-0 color2">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                      <a href="{{ route('agenda', Crypt::encrypt($agenda->id)) }}" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        @endforeach
    </div>
  </div>
</div>
