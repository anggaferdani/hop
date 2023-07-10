@extends('front.templates.pages')
@section('title', 'Update')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="banner3">
    @foreach($update->update_images as $update_image)
      <div style="height: 400px;">
        <img src="{{ asset('update/image/'.$update_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
      </div>
    @endforeach
  </div>
  <br>
  <div class="container">
    <div class="row">
      <h5 class="fs-4 fw-bold" style="text-align: justify;">{{ $update->judul }}</h5>
      <div class="fs-5 text-muted lh-sm" style="text-align: justify;">{!! $update->deskripsi !!}</div>
      <div class="fs-5 fw-bold">Tanggal Publikasi</div>
      <div class="fs-5 text-muted lh-sm mb-3">{{ \Carbon\Carbon::parse($update->tanggal_publikasi)->format('l, d M Y') }}</div>
      <div class="fs-5 fw-bold">Penulis</div>
      <div class="fs-5 text-muted lh-sm mb-4">{{ $update->users->nama_panjang }}</div>
      <div class="d-flex flex-wrap gap-2">
        @foreach($update->tags as $tag)
          <a href="" class="fs-5 p-1 px-3 tagging2">{{ $tag->tag }}</a>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection