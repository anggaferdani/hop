@extends('front.templates.pages')
@section('title', 'Community')
@section('content')
<section class="py-md-5 pb-2">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center">
          <div class="fs-3 fw-bold color m-0">{{ $activity_manajemen->judul }}</div>
        </div>
        <hr class="text-secondary">
        <div class="row">
          <div class="image2">
            @foreach($activity_manajemen->activity_manajemen_images as $activity_manajemen_image)
              <div style="width: 300px; height: 200px;">
                <img src="{{ asset('activity-manajemen/image/'.$activity_manajemen_image["image"]) }}" alt="" class="rounded-2" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
            @endforeach
          </div>
        </div>
        <hr class="text-secondary">
        <div>
          <h5 class="fw-bold" style="text-align: justify;">Deskripsi</h5>
          <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $activity_manajemen->deskripsi !!}</div>
          <div class="btn-group dropend">
            <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div></button>
            <ul class="dropdown-menu px-4">
              {!! $share !!}
            </ul>
          </div>
        </div>
        <hr class="text-secondary">
        <div>
          <?php $lokasi = $activity_manajemen->provinsi.", ".$activity_manajemen->kabupaten_kota.", ".$activity_manajemen->kecamatan ?>
          <div class="fw-bold"><span class="fs-5">Lokasi : </span><span class="text-muted">{{ $provinsi->nama_provinsi }}, {{ $kabupaten->nama_kabupaten }}, {{ $kecamatan->nama_kecamatan }}</span></div>
        </div>
        <hr class="text-secondary">
        <div class="row align-items-center">
          <div class="col-md-2 col-4">
            <div style="width: 100%; aspect-ratio: 1;"><img src="{{ asset('user/logo/'.$activity_manajemen->users["logo"]) }}" class="rounded-circle" style="object-fit: cover; width: 100%; height: 100%;" alt=""></div>
          </div>
          <div class="col-md-10 col-8 h-100 align-items-center">
            <div class="fs-5 fw-bold">{{ $activity_manajemen->users->nama_panjang }}</div>
            <div class="text-muted">{{ $activity_manajemen->users->email }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="row row-cols-1 gap-2">
          <div class="col">
            <div class="card p-0" style="border-radius: 15px;">
              <div class="card-body">
                <div class="text-muted mb-1 fw-bold">Harga Mulai Dari</div>
                <div class="fs-5 p-1 px-3 tagging2">{{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($activity_manajemen->harga_mulai)), 3))) }}</div>
              </div>
            </div>
          </div>
          @if(!empty($activity_manajemen->instagram) || !empty($activity_manajemen->whatsapp) || !empty($activity_manajemen->tiktok))
            <div class="col">
              <div class="card p-0" style="border-radius: 15px;">
                <div class="card-body">
                  <div class="text-muted mb-1 fw-bold">Our Social Media</div>
                  <div class="d-flex gap-2">
                    @if(!empty($activity_manajemen->instagram))
                      <a href="{{ $activity_manajemen->instagram }}" class="text-muted fs-3"><div class="fa-brands fa-instagram"></div></a>
                    @endif
                    @if(!empty($activity_manajemen->whatsapp))
                      <a href="{{ $activity_manajemen->whatsapp }}" class="text-muted fs-3"><div class="fa-brands fa-whatsapp"></div></a>
                    @endif
                    @if(!empty($activity_manajemen->tiktok))
                      <a href="{{ $activity_manajemen->tiktok }}" class="text-muted fs-3"><div class="fa-brands fa-tiktok"></div></a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endif
          <div class="col">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body">
                <div class="fs-5 fw-bold mb-2">Lokasi</div>
                <div class="parent2">{!! $activity_manajemen->lokasi !!}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('activity-manajemens') }}" class="color">View All</a></div>
    </div>
    <div class="row pt-3">
      <div class="card3">
        @foreach($kategoris as $kategori)
          @if($kategori->id == $activity_manajemen->kategori_id)
            @foreach($kategori->activity_manajemens as $activity_manajemen)
              <div class="col-md-2" style="width: 24.99999999%">
                <div class="card h-100">
                  @foreach($activity_manajemen->activity_manajemen_images->take(1) as $activity_manajemen_image)
                  <div style="height: 120px;">
                    <img src="{{ asset('activity-manajemen/image/'.$activity_manajemen_image["image"]) }}" alt="" class="card-img-top" style="height: 100%; object-fit: cover;">
                  </div>
                  @endforeach
                  <div class="card-body" style="height: 170px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div class="div">
                      <div class="card-title text-dark fw-bold" style="text-align: justify; word-break: break-all;">{{ Str::limit($activity_manajemen->judul, 15) }}</div>
                      <div class="card-text small text-muted lh-sm deskripsi3 mb-2" style="text-align: justify; word-break: break-all;">{!! $activity_manajemen->deskripsi !!}</div>
                    </div>
                    <div>
                      <p class="text-muted mb-2" style="font-size: 12px;">{{ \Carbon\Carbon::parse($activity_manajemen->tanggal_publikasi)->format('l, d M Y') }}</p>
                      <div class="d-flex gap-1">
                        @foreach($activity_manajemen->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <a href="{{ route('activity-manajemen', Crypt::encrypt($activity_manajemen->id)) }}" class="stretched-link"></a>
                </div>
              </div>
            @endforeach
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection