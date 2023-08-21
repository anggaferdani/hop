@extends('front.templates.pages')
@section('title', $update->judul)
@push('style')
<style>
  .slick-slider .slick-list{
    border-radius: 10px;
  }
</style>
@endpush
@section('content')
<section class="pb-3 pb-md-5 pt-md-4">
  <div class="container">
    <div class="row">
      <div class="banner8">
        @foreach($update->update_images as $update_image)
          <div style="height: 400px;">
            <img src="{{ asset('update/image/'.$update_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover; border-radius: 10px;">
          </div>
        @endforeach
      </div>
      <h5 class="pt-4 fs-4 fw-bold" style="text-align: justify;">{{ $update->judul }}</h5>
      <div class="small text-muted mb-2">{{ \Carbon\Carbon::parse($update->tanggal_publikasi)->format('l, d M Y') }}, {{ $update->users->nama_panjang }}</div>
      <div class="text-muted lh-sm" style="text-align: justify;">{!! $update->deskripsi !!}</div>
    </div>
    <div class="btn-group dropend mb-2">
      <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div> Share</button>
      <ul class="dropdown-menu px-4">
        {!! $share !!}
      </ul>
    </div>
    <div class="row">
      <div class="d-flex flex-wrap gap-2">
        @foreach($update->tags as $tag)
          <a href="{{ route('tags', $tag->slug) }}" class="p-1 px-3 tagging2">{{ $tag->tag }}</a>
        @endforeach
      </div>
    </div>
    {{-- <div class="row pt-2">
      <div class="col-md-4">
        <div class="banner3">
          @foreach($update->update_images as $update_image)
            <div style="height: 400px;">
              <img src="{{ asset('update/image/'.$update_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
            </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-8 mt-2 mt-md-0">
        <h5 class="fs-4 fw-bold" style="text-align: justify;">{{ $update->judul }}</h5>
        <div class="small text-muted mb-2">{{ \Carbon\Carbon::parse($update->tanggal_publikasi)->format('l, d M Y') }}, {{ $update->users->nama_panjang }}</div>
        <div class="text-muted lh-sm" style="text-align: justify;">{!! $update->deskripsi !!}</div>
        <div class="btn-group dropend mb-3">
          <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div> Share</button>
          <ul class="dropdown-menu px-4">
            {!! $share !!}
          </ul>
        </div>
        <div class="d-flex flex-wrap gap-2">
          @foreach($update->tags as $tag)
            <a href="{{ route('tags', $tag->slug) }}" class="p-1 px-3 tagging2">{{ $tag->tag }}</a>
          @endforeach
        </div>
      </div>
    </div> --}}
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('updates') }}" class="color">View All</a></div>
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
  </div>
</section>
@endsection