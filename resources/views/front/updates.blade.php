@extends('front.templates.pages')
@section('title', 'Updates')
@section('content')
<section class="banner-update">
  @foreach($update_banners as $update_banner)
  <a href="{{ route('update', $update_banner->slug) }}">
    @foreach ($update_banner->update_images->take(1) as $update_image)
    <section style="height: 400px; background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('update/image/'.$update_image["image"]) }}'); background-size: cover; background-position: center;">
    @endforeach
      <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-end py-4 px-md-0 py-md-5 px-4">
          <div class="col-md-10">
            <h1 class="text-white fw-bold">{!! Str::limit($update_banner->deskripsi, 60) !!}</h1>
            <div class="text-white lh-sm deskripsi mb-2" style="text-align: justify">{!! $update_banner->deskripsi !!}</div>
            <div class="text-white">{{ \Carbon\Carbon::parse($update_banner->tanggal_publikasi)->format('l, d M Y') }}</div>
          </div>
        </div>
      </div>
    </section>
  </a>
  @endforeach
</section>

<section class="py-5">
  <div class="container">
    {{-- <div class="pt-4 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Rekomendasi Untuk Saya</div>
    </div>
    <div class="row">
      <div class="d-flex flex-wrap gap-2 mt-3">
        @foreach($tags as $tag)
          <a href="{{ route('tags', Crypt::encrypt($tag->id)) }}" class="fs-5 p-1 px-3 tagging2">{{ $tag->tag }}</a>
        @endforeach
      </div>
    </div> --}}
    <div class="pt-3 pb-3 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Updates</div>
    </div>
    <div class="row g-2">
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
                    <div class="tagging rounded-2 py-1 px-2" style="white-space: nowrap;">{{ Str::limit($tag->tag, 10) }}</div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <a href="{{ route('update', $update->slug) }}" class="stretched-link"></a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection