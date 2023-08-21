@extends('front.templates.pages')
@section('title', $tag->tag)
@section('content')
<section class="py-5">
  <div class="container">
    <div class="pt-4 d-flex justify-content-between align-items-center">
      <div class="fs-3 fw-bold color m-0">{{ $tag->tag }}</div>
    </div>
    <div class="row pb-4">
      <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="row g-2">
      @foreach($tag->updates as $update)
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