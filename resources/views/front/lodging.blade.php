@extends('front.templates.pages')
@section('title', 'Lodging')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="banner3 pt-0 pt-md-3">
    @foreach($lodging->lodging_images as $lodging_image)
      <div style="height: 400px;">
        <img src="{{ asset('lodging/image/'.$lodging_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
      </div>
    @endforeach
  </div>
  <br>
  <div class="container">
    <div class="row">
      <h5 class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $lodging->nama_tempat }}</h5>
      <div class="fs-5 text-muted lh-sm mt-1" style="text-align: justify;">{!! $lodging->deskripsi_tempat !!}</div>
      <div class="fs-5 fw-bold">Lokasi</div>
      <div class="fs-5 text-muted lh-sm">{{ $lodging->provinsi }}, {{ $lodging->kabupaten_kota }}, {{ $lodging->kecamatan }}</div>
    </div>
  </div>
</section>
@endsection