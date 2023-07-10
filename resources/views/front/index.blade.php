@extends('front.templates.pages')
@section('title', 'Index')
@section('content')
<section class="py-0 py-md-4" style="position: relative;">
  <div class="banner2 mt-0" style="width: 100%; height: 400px;">
    @foreach($banners as $banner)
      <a href="{{ $banner->link }}" style="width: 100%; height: 400px;"><img src="{{ asset('banner/thumbnail/'.$banner["thumbnail"]) }}" style="width: 100%; height: 400px; object-fit: cover;" alt=""></a>
    @endforeach
  </div>
  <div class="text-white w-100" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
    <h1 class="fw-bold text-center">Bingung Tentuin TUJUAN Hangout?</h1>
    <h4 class="text-center">Biarkan Kami Membantumu</h4>
    <form action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
      @csrf
      <div class="input-group justify-content-center">
        <div class="input-group-text bg-white border-0 rounded-end ps-2 ps-md-3 rounded-pill"><i class="fa-solid fa-magnifying-glass fs-4 text-muted"></i></div>
        <input type="text" class="p-2 border-0 rounded-start py-2 py-md-3 rounded-pill" name="" style="width: 50%; height: 50%;">
      </div>
    </form>
  </div>
</section>

<section class="pt-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Updates</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('updates') }}" class="color">View All</a></div>
    </div>
    <div class="row pb-4">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($updates as $update)
          <div class="col-md-4">
            <a href="{{ route('update', Crypt::encrypt($update->id)) }}">
              <div class="card h-100">
                @foreach($update->update_images->take(1) as $update_image)
                <div style="height: 120px;">
                  <img src="{{ asset('update/image/'.$update_image["image"]) }}" alt="" class="card-img-top" style="height: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="card-body">
                  <div class="fw-bold text-dark mb-2" style="text-align: justify;">{{ Str::limit($update->judul, 35) }}</div>
                  <div class="card-text small text-muted lh-sm" style="text-align: justify;">{!! Str::limit($update->deskripsi, 140) !!}</div>
                  <div class="row align-items-center">
                    <div class="col-md-6 my-auto"> 
                      <p class="small text-muted m-0">{{ \Carbon\Carbon::parse($update->tanggal_publikasi)->format('l, d M Y') }}</p>
                    </div>
                    <div class="col-md-6 my-auto">
                      <div class="d-flex justify-content-end ms-auto gap-1">
                        @foreach($update->tags->take(2) as $tag)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($tag->tag, 15) }}</div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="pb-5">
  <div class="container">
    <div class="pt-4 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Agendas</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('agendas') }}" class="color">View All</a></div>
    </div>
    <div class="row pb-4">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($agendas as $agenda)
        <?php $lokasi = $agenda->provinsi.", ".$agenda->kabupaten_kota.", ".$agenda->kecamatan ?>
          <div class="col-md-4">
            <a href="{{ route('agenda', Crypt::encrypt($agenda->id)) }}">
              <div class="card">
                <div class="row g-0">
                  @foreach($agenda->agenda_images->take(1) as $agenda_image)
                  <div class="col-md-4">
                    <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                  </div>
                  @endforeach
                  <div class="col-md-8">
                    <div class="card-body">
                      <div class="fw-bold color mb-2">{{ Str::limit($agenda->judul, 20) }}</div>
                      <div class="small color lh-sm" style="text-align: justify;">{!! Str::limit($agenda->deskripsi, 70) !!}</div>
                      <div class="d-flex gap-1">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 color mt-3">{{ Str::limit($lokasi, 30) }}</div>
                      <div class="small mb-0 color">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
      {{-- <button class="button-arrow-left position-absolute start-0 top-50 translate-middle-y">
        <img class="hy" src="{{ asset('front/img/kiri.png') }}" alt="">
      </button>
      <button class="button-arrow-right  position-absolute end-0 top-50 translate-middle-y">
        <img class="hy" src="{{ asset('front/img/kanan.png') }}" alt="">
      </button> --}}
    </div>
  </div>
</section>
@endsection