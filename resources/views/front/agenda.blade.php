@extends('front.templates.pages')
@section('title', 'Agenda')
@section('content')
<section class="pt-md-4 pb-md-4 pt-1 pb-4">
  <div class="banner3">
    @foreach($agenda->agenda_images as $agenda_image)
      <div style="height: 400px;">
        <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
      </div>
    @endforeach
  </div>
  <br>
  <div class="container">
    @if(Session::get('success'))
      <div class="alert text-white" role="alert" style="background-color: #5AA4C2;">
        {{ Session::get('success') }}
      </div>
    @endif
    <div class="row">
      <div class="fs-4 fw-bold" style="text-align: justify;">{{ $agenda->judul }}</div>
      <div class="fs-5 text-muted lh-sm mt-1" style="text-align: justify;">{!! $agenda->deskripsi !!}</div>
      <div class="fs-5 fw-bold">Event Type</div>
      <div class="fs-5 text-muted lh-sm mb-3">{{ $agenda->jenis }}, 
        @foreach($agenda->types as $type)
          {{ $type->type }},
        @endforeach
      </div>
      <div class="fs-5 fw-bold">Lokasi</div>
      <div class="fs-5 text-muted lh-sm mb-3">{{ $agenda->provinsi }}, {{ $agenda->kabupaten_kota }}, {{ $agenda->kecamatan }}</div>
      <div class="fs-5 fw-bold">Start End Date</div>
      <div class="fs-5 text-muted lh-sm">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('l, d M Y') }}</div>
      <div class="d-block text-center text-md-start mt-4">
        <button class="text-white border-0 rounded-pill fs-5 px-5 py-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #5AA4C2;">PESAN</button>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Lorem ipsum dolor sit amet.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('post-register') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @csrf
          <input type="hidden" class="form-control" name="agenda_id" value="{{ $agenda->id }}">
          <div class="mb-3">
            <label class="form-label">Nama Panjang <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_panjang">
          </div>
          <div class="row g-3">
            <div class="mb-3 col-md-6">
              <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="tanggal_lahir">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_kelamin">
                <option disabled selected>Select</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="no_telepon">
          </div>
          <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email">
          </div>
          <div class="row g-3">
            <div class="mb-3 col-md-4">
              <label class="form-label">Provinsi <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="provinsi">
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kabupaten_kota">
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kecamatan">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" class="form-control" name="pekerjaan">
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Pesan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection