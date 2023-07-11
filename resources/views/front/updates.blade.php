@extends('front.templates.pages')
@section('title', 'Updates')
@section('content')
<section class="banner3">
  @foreach($update_banners as $update_banner)
  <a href="{{ route('update', Crypt::encrypt($update_banner->id)) }}">
    @foreach ($update_banner->update_images->take(1) as $update_image)
    <section style="height: 400px; background: url({{ asset('update/image/'.$update_image["image"]) }}); background-size: cover; background-position: center;">
    @endforeach
      <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-end py-4 px-md-0 py-md-5 px-4">
          <div class="col-md-10">
            <h1 class="text-white fw-bold">{!! Str::limit($update_banner->deskripsi, 60) !!}</h1>
            <div class="text-white fs-5" style="text-align: justify">{!! Str::limit($update_banner->deskripsi, 130) !!}</div>
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
    <div class="d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Updates</div>
    </div>
    <div class="row pb-4">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row g-2">
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
                <div class="fw-bold text-dark mb-2" style="text-align: justify; word-break: break-all;">{{ Str::limit($update->judul, 35) }}</div>
                <div class="card-text small text-muted lh-sm" style="text-align: justify; word-break: break-all;">{!! Str::limit($update->deskripsi, 140) !!}</div>
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
</section>
@endsection