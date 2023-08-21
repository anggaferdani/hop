@extends('front.templates.pages')
@section('title', 'Community')
@section('content')
<section class="py-5">
  <div class="container">
    <div class="pt-4 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Community Categories</div>
    </div>
    <div class="row">
      <div class="d-flex flex-wrap gap-2 mt-3">
        @foreach($kategoris as $kategori)
          <a href="{{ route('kategoris', $kategori->slug) }}" class="p-1 px-3 tagging2">{{ $kategori->kategori }}</a>
        @endforeach
      </div>
    </div>
    @if(count($kategoris))
      @foreach($kategoris as $kategori)
        <div class="pt-4 pb-4 d-flex justify-content-between align-items-center">
          <div class="fs-3 fw-bold color m-0">{{ $kategori->kategori }}</div>
          <div href="" class="fs-5 fw-bold m-0"><a href="" class="color">View All</a></div>
        </div>
        <div class="row pt-2">
          <div class="card3">
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
                      <div class="card-title text-dark lh-sm fw-bold" style="text-align: justify; word-break: break-all;">{{ Str::limit($activity_manajemen->judul, 35) }}</div>
                      <div class="card-text small text-muted lh-sm deskripsi3 mb-2" style="text-align: justify; word-break: break-all;">{!! $activity_manajemen->deskripsi !!}</div>
                    </div>
                    <p class="text-muted m-0" style="font-size: 12px;">{{ \Carbon\Carbon::parse($activity_manajemen->tanggal_publikasi)->format('l, d M Y') }}</p>
                  </div>
                  <a href="{{ route('activity-manajemen', $activity_manajemen->slug) }}" class="stretched-link"></a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    @endif
  </div>
</section>
@endsection