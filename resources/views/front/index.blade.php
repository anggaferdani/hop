@extends('front.templates.pages')
@section('title', 'Hangout Project')
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
    <div class="d-flex mb-2 justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Updates</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('updates') }}" class="color">View All</a></div>
    </div>
    <div class="row">
      <div class="col-md-8 px-auto pe-md-2" style="height: 400px">
        <div class="banner4"> 
          @foreach($updates->take(10) as $update3)
            @foreach($update3->update_images->take(1) as $update_image2)
              <div class="position-relative">
                <img class="h-100" src="{{ asset('update/image/'.$update_image2["image"]) }}" alt="" style="width: 100%; object-fit: cover;">
                <div class="w-md-50 w-100 ms-0 ms-md-5 p-4 h-100 text-white position-absolute small top-0 left-0" style="text-align: justify; background: rgba(0, 0, 0, 0.7)">
                  <span class="deskripsi6">{!! $update3->deskripsi !!}</span><br>
                  <a href="{{ route('update', $update3->slug) }}" class="color">Read More.</a>
                </div>
              </div>
            @endforeach
          @endforeach
        </div>
      </div>
      <div class="col-md-4 pe-4 ps-4 ps-md-3 pt-md-0 pt-2">
        <div class="vertical row justify-content-between h-100 gap-2" style="min-height: 130px">
          @foreach($updates->take(10) as $update2)
            <div class="card" style="min-height: 125px">
              <div class="card-body" style="display: flex; justify-content: space-between; flex-direction: column;">
                <div class="small" style="font-size: 12px">{{ \Carbon\Carbon::parse($update2->tanggal_publikasi)->format('l, d M Y') }}</div>
                <div class="card-title m-0 judul3">{{ $update2->judul }}</div>
                <div class="small"><a href="{{ route('update', $update2->slug) }}" class="color stretched-link">Read Article</a></div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pb-2 pb-md-5">
  <div class="container position-relative">
    <div class="d-flex mb-2 justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Agendas</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('agendas') }}" class="color">View All</a></div>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($agendas as $agenda)
        <?php $lokasi = $agenda->hangout_places->Provinsi->nama_provinsi.", ".$agenda->hangout_places->Kabupaten->nama_kabupaten.", ".$agenda->hangout_places->Kecamatan->nama_kecamatan ?>
          <div class="col-md-4">
            @if($agenda->tiket == 'Berbayar')
            <div class="card" style="background-color: #EC5D71;">
              <div class="row g-0">
                @foreach($agenda->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4" style="max-height: 210px;">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 210px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm text-white">{{ Str::limit($agenda->judul, 25) }}</div>
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
                      <div class="small mb-0 text-white" style="font-size: 11px;">{{ Str::limit(Str::title(strtolower($lokasi)), 65) }}</div>
                      <div class="small mb-0 text-white" style="font-size: 11px;">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                      <div class="d-flex gap-1 mt-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging3 rounded-2 py-1 px-2" style="white-space: nowrap;">{{ Str::limit($type->type, 10) }}</div>
                        @endforeach
                      </div>
                      <a href="{{ route('agenda', $agenda->slug) }}" class="stretched-link"></a>
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
                <div class="col-4 col-md-4" style="max-height: 210px;">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 210px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm color">{{ Str::limit($agenda->judul, 25) }}</div>
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
                      <div class="small mb-0 color" style="font-size: 11px;">{{ Str::limit(Str::title(strtolower($lokasi)), 65) }}</div>
                      <div class="small mb-0 color" style="font-size: 11px;">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                      <div class="d-flex gap-1 mt-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging4 rounded-2 py-1 px-2" style="white-space: nowrap;">{{ Str::limit($type->type, 10) }}</div>
                        @endforeach
                      </div>
                      <a href="{{ route('agenda', $agenda->slug) }}" class="stretched-link"></a>
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