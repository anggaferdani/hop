@extends('front.templates.pages')
@section('title', 'Kategoris')
@section('content')
<section class="py-5">
  <div class="container">
    <div class="pt-4 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">{{ $kategori->kategori }}</div>
    </div>
    <div class="row pb-4">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row row-cols-1 row-cols-md-5 g-2 pt-2">
      @foreach($kategori->activity_manajemens as $activity_manajemen)
        <div class="col">
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
    </div>
  </div>
</section>
@endsection