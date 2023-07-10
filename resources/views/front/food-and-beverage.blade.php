@extends('front.templates.pages')
@section('title', 'Food And Beverage')
@section('content')
<section class="pb-3 pb-md-5">
  <div class="banner3 pt-0 pt-md-3">
    @foreach($food_and_beverage->food_and_beverage_images as $food_and_beverage_image)
      <div style="height: 400px;">
        <img src="{{ asset('food-and-beverage/image/'.$food_and_beverage_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
      </div>
    @endforeach
  </div>
  <br>
  <div class="container">
    <div class="row">
      <h5 class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $food_and_beverage->nama_tempat }}</h5>
      <div class="fs-5 text-muted lh-sm mt-1" style="text-align: justify;">{!! $food_and_beverage->deskripsi_tempat !!}</div>
      <div class="fs-5 fw-bold">Lokasi</div>
      <div class="fs-5 text-muted lh-sm">{{ $food_and_beverage->provinsi }}, {{ $food_and_beverage->kabupaten_kota }}, {{ $food_and_beverage->kecamatan }}</div>
    </div>
  </div>
</section>
@endsection