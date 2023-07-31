@extends('front.templates.pages')
@section('title', 'Index')
@push('style')
<style>
  #myInput {
    background-image: url('/front/img/search.png');
    background-position: 15px 15px;
    background-size: 25px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 50px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }
  #myUL {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myUL li a {
    border: 1px solid #ddd;
    background-color: #f6f6f6;
    padding: 12px;
    text-decoration: none;
    font-size: 18px;
    color: black;
    display: block
  }
  #myUL li a:hover:not(.header) {
    background-color: #eee;
  }
  .color4{
    background-color: #eee !important;
  }
</style>
@endpush
@section('content')
<section class="py-0 pt-md-4" style="position: relative;">
  <div class="banner2 mt-0" style="width: 100%; height: 400px;">
    @foreach($banners as $banner)
      <a href="{{ $banner->link }}" style="width: 100%; height: 400px;"><img src="{{ asset('banner/thumbnail/'.$banner["thumbnail"]) }}" style="width: 100%; height: 400px; object-fit: cover;" alt=""></a>
    @endforeach
  </div>
  <div class="text-white w-100" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
    <div class="position-realtive">
      @livewire('search')
    </div>
  </div>
</section>

<section class="pt-5 mb-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Updates</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('updates') }}" class="color">View All</a></div>
    </div>
    <div class="row mb-2">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($updates as $update)
        <div class="col-md-4">
          <div class="card h-100">
            @foreach($update->update_images->take(1) as $update_image)
            <div style="height: 120px;">
              <img src="{{ asset('update/image/'.$update_image["image"]) }}" alt="" class="card-img-top" style="height: 100%; object-fit: cover;">
            </div>
            @endforeach
            <div class="card-body" style="height: 170px; display: flex; justify-content: space-between; flex-direction: column;">
              <div>
                <div class="fw-bold text-dark mb-2" style="text-align: justify; word-break: break-all;">{{ Str::limit($update->judul, 35) }}</div>
                <div class="card-text small text-muted lh-sm deskripsi mb-2" style="text-align: justify; word-break: break-all;">{!! $update->deskripsi !!}</div>
              </div>
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
            <a href="{{ route('update', Crypt::encrypt($update->id)) }}" class="stretched-link"></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="pb-2 pb-md-5">
  <div class="container position-relative">
    <div class="d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Agendas</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('agendas') }}" class="color">View All</a></div>
    </div>
    <div class="row mb-2">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($agendas as $agenda)
        <?php $lokasi = $agenda->provinsi.", ".$agenda->kabupaten_kota.", ".$agenda->kecamatan ?>
          <div class="col-md-4">
            @if($agenda->tiket == 'Berbayar')
            <div class="card" style="background-color: #EC5D71;">
              <div class="row g-0">
                @foreach($agenda->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 200px; display: flex; justify-content: space-between; flex-direction: column;">
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
                      <div class="small text-white lh-sm deskripsi2 mb-2" style="text-align: justify; word-break: break-all;">{!! $agenda->deskripsi !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging3 rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 text-white" style="font-size: 11px;">
                        @foreach($provinsis as $provinsi)
                          @if($agenda->provinsi == $provinsi->id_provinsi){{ $provinsi->nama_provinsi }}, @endif
                        @endforeach
                        @foreach($kabupatens as $kabupaten)
                          @if($agenda->kabupaten_kota == $kabupaten->id_kabupaten){{ $kabupaten->nama_kabupaten }}, @endif
                        @endforeach
                        @foreach($kecamatans as $kecamatan)
                          @if($agenda->kecamatan == $kecamatan->id_kecamatan){{ $kecamatan->nama_kecamatan }}@endif
                        @endforeach
                      </div>
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
                <div class="col-4 col-md-4">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 200px; display: flex; justify-content: space-between; flex-direction: column;">
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
                      <div class="small color lh-sm deskripsi2 mb-2" style="text-align: justify; word-break: break-all;">{!! $agenda->deskripsi !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 color2" style="font-size: 11px;">
                        @foreach($provinsis as $provinsi)
                          @if($agenda->provinsi == $provinsi->id_provinsi){{ $provinsi->nama_provinsi }}, @endif
                        @endforeach
                        @foreach($kabupatens as $kabupaten)
                          @if($agenda->kabupaten_kota == $kabupaten->id_kabupaten){{ $kabupaten->nama_kabupaten }}, @endif
                        @endforeach
                        @foreach($kecamatans as $kecamatan)
                          @if($agenda->kecamatan == $kecamatan->id_kecamatan){{ $kecamatan->nama_kecamatan }}@endif
                        @endforeach
                      </div>
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
</section>
@endsection