@extends('front.templates.pages')
@section('title', 'Agenda')
@section('content')
<section class="pt-md-4 pb-md-5 pt-1 pb-4">
  <div class="container">
    <div class="row mb-md-4">
      <div class="banner3">
        @foreach($agenda->agenda_images as $agenda_image)
          <div style="height: 400px;">
            <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover; border-radius: 30px;">
          </div>
        @endforeach
      </div>
      <br>
    </div>
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
      <div class="fs-5 text-muted lh-sm mb-3">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('l, d M Y') }}</div>
      @if($agenda->tiket == 'Berbayar')
      <div class="fs-5 fw-bold">Tickets</div>
      <div class="fs-5 text-muted lh-sm">{{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($agenda->harga_mulai)), 3))) }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($agenda->harga_akhir)), 3))) }}</div>
      @endif
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
        <h5 class="modal-title" id="staticBackdropLabel">{{ $agenda->judul }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>1 tiket untuk 1 nama pesanan <span class="text-danger">*</span></p>
        <form action="{{ route('post-register') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @csrf
          <input type="hidden" class="form-control" name="agenda_id" value="{{ $agenda->id }}" required>
          <div class="mb-3">
            <label class="form-label">Nama Panjang <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_panjang" required>
          </div>
          <div class="row g-3">
            <div class="mb-3 col-md-6">
              <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="tanggal_lahir" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_kelamin" required>
                <option selected disabled value="">Select</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="no_telepon" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <img src="{{ asset('front/img/qr.jpeg') }}" class="mb-2" width="200" alt="">
          <div class="mb-3">
            <label class="form-label">Bukti Transfer <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="bukti_transfer" required>
          </div>
          <div class="row g-3">
            <div class="mb-3 col-md-4">
              <label class="form-label">Provinsi <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="provinsi" required>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kabupaten_kota" required>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kecamatan" required>
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