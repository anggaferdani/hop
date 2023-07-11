@extends('front.templates.pages')
@section('title', 'Activity Manajemen')
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
          <?php $lokasi = $activity_manajemen->provinsi.", ".$activity_manajemen->kabupaten_kota.", ".$activity_manajemen->kecamatan ?>
          <h5 class="fw-bold">Lokasi : <a href="{{ $activity_manajemen->lokasi }}" class="color">{{ $lokasi }}</a></h5>
        </div>
        <hr class="text-secondary">
        <div>
          <h5 class="fw-bold" style="text-align: justify;">Deskripsi</h5>
          <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $activity_manajemen->deskripsi !!}</div>
        </div>
        <hr class="text-secondary">
        <div class="d-flex gap-3">
          @if(!empty($activity_manajemen->whatsapp))<a href="{{ $activity_manajemen->whatsapp }}" class="business"><i class="fa-brands fa-whatsapp fs-2"></i></a>@endif
          @if(!empty($activity_manajemen->instagram))<a href="{{ $activity_manajemen->instagram }}" class="business"><i class="fa-brands fa-instagram fs-2"></i></a>@endif
          @if(!empty($activity_manajemen->twitter))<a href="{{ $activity_manajemen->twitter }}" class="business"><i class="fa-brands fa-twitter fs-2"></i></a>@endif
        </div>
      </div>
      <div class="col-md-3 py-3 py-md-0">
        <div class="row row-cols-1 gap-2">
          <div class="col">
            <div class="card p-0">
              <div class="card-body">
                <div class="text-muted mb-1 fw-bold">Harga Mulai Dari</div>
                <div class="fs-5 p-1 px-3 tagging2">{{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($activity_manajemen->harga_mulai)), 3))) }}</div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card p-0">
              <div class="card-body">
                <div class="card-title d-flex align-items-center gap-2">
                  <img src="{{ asset('front/img/63.png') }}" class="img-fluid" alt="">
                  <h5 class="text-muted small fw-bold m-0">Dapatkan Point HOP</h5>
                </div>
                <hr>
                <p class="small m-0" style="text-align: justify; word-break: break-all;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil eius cupiditate fugit similique ipsum dolore quidem voluptatem.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-0 pt-md-4 pb-1 d-flex justify-content-between align-items-center">
      <div class="fs-5 fw-bold m-0">Pilihan Lainnya</div>
    </div>
    <div class="row pt-3">
      <div class="card3">
        @foreach($kategoris as $kategori)
          @if($kategori->id == $activity_manajemen->kategori_id)
            @foreach($kategori->activity_manajemens as $activity_manajemen)
              <div class="col-md-2" style="width: 24.99999999%">
                <a href="{{ route('activity-manajemen', Crypt::encrypt($activity_manajemen->id)) }}">
                  <div class="card h-100">
                    @foreach($activity_manajemen->activity_manajemen_images->take(1) as $activity_manajemen_image)
                    <div style="height: 120px;">
                      <img src="{{ asset('activity-manajemen/image/'.$activity_manajemen_image["image"]) }}" alt="" class="card-img-top" style="height: 100%; object-fit: cover;">
                    </div>
                    @endforeach
                    <div class="card-body">
                      <div class="card-title text-dark fw-bold" style="text-align: justify; word-break: break-all;">{{ Str::limit($activity_manajemen->judul, 15) }}</div>
                      <div class="card-text small text-muted lh-sm" style="text-align: justify; word-break: break-all;">{!! Str::limit($activity_manajemen->deskripsi, 75) !!}</div>
                      <p class="text-muted mb-2" style="font-size: 12px;">{{ \Carbon\Carbon::parse($activity_manajemen->tanggal_publikasi)->format('l, d M Y') }}</p>
                      <div class="d-flex gap-1">
                        @foreach($activity_manajemen->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection