@extends('front.templates.pages')
@section('title', 'Updates')
@section('content')
<section class="banner3">
  @foreach($update_banners as $update_banner)
  <a href="{{ route('update', Crypt::encrypt($update_banner->id)) }}">
    @foreach ($update_banner->update_images->take(1) as $update_image)
    <section style="height: 400px; background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('update/image/'.$update_image["image"]) }}'); background-size: cover; background-position: center;">
    @endforeach
      <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-end py-4 px-md-0 py-md-5 px-4">
          <div class="col-md-10">
            <h1 class="text-white fw-bold">{!! Str::limit($update_banner->deskripsi, 60) !!}</h1>
            <div class="text-white fs-5 deskripsi mb-2" style="text-align: justify">{!! $update_banner->deskripsi !!}</div>
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
    <div class="pt-4 pb-4 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">Updates</div>
    </div>
    <div class="row">
      <div class="col-md-8 px-auto pe-md-2" style="height: 400px">
        <div class="banner4 rounded"> 
          @foreach($updates->take(3) as $update3)
          @foreach($update3->update_images->take(1) as $update_image2)
          <div class="position-relative h-100">
            <img class="position-relative" src="{{ asset('update/image/'.$update_image2["image"]) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            <div class="w-md-50 ms-0 ms-md-5 p-4 text-white position-absolute small top-0 left-0" style="text-align: justify; height: 100%; background: rgba(0, 0, 0, 0.7)">{!! Str::limit($update3->deskripsi, 350) !!} <a href="" class="color">Read More.</a></div>
          </div>
              @endforeach
            @endforeach
        </div>
      </div>
      <div class="col-md-4 pe-4 ps-4 ps-md-3 pt-md-0 pt-2">
        <div class="row justify-content-between h-100 gap-2">
          @foreach($updates->take(3) as $update2)
            <div class="card" style="background-color: #D9D9D9;">
              <div class="card-body" style="height: 100px; display: flex; justify-content: space-between; flex-direction: column;">
                <div class="small">{{ \Carbon\Carbon::parse($update2->tanggal_publikasi)->format('l, d M Y') }}</div>
                <div class="card-title m-0 fw-bold">{{ Str::limit($update2->judul, 30) }}</div>
                <div class="small small"><a href="{{ route('update', Crypt::encrypt($update2->id)) }}" class="color stretched-link">Read Article</a></div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row pt-2 g-2">
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
</section>
@endsection