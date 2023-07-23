@extends('front.templates.pages')
@section('title', 'Agenda')
@section('content')
<section class="pt-md-4 pb-md-2 pt-1 pb-2">
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
      @if($agenda->tiket == 'Berbayar')
        <div class="fs-5 text-muted lh-sm mb-3">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('l, d M Y') }}</div>
        <div class="fs-5 fw-bold">Tickets</div>
        <div class="fs-5 text-muted lh-sm">{{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($agenda->harga_mulai)), 3))) }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($agenda->harga_akhir)), 3))) }}</div>
      @endif
      @if($agenda->tiket == 'Gratis')
        <div class="fs-5 text-muted lh-sm">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('l, d M Y') }}</div>
      @endif
      <div class="d-block text-center text-md-start mt-4">
        <button class="text-white border-0 rounded-pill fs-5 px-5 py-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #5AA4C2;">PESAN</button>
      </div>
    </div>
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('agendas') }}" class="color">View All</a></div>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($agendas as $agenda2)
        <?php $lokasi = $agenda2->provinsi.", ".$agenda2->kabupaten_kota.", ".$agenda2->kecamatan ?>
          <div class="col-md-4">
            @if($agenda2->tiket == 'Berbayar')
            <div class="card" style="background-color: #EC5D71;">
              <div class="row g-0">
                @foreach($agenda2->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 200px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm text-white">{{ Str::limit($agenda2->judul, 35) }}</div>
                        </div>
                        <div class="col-md-2">
                          @if($agenda2->tiket == 'Berbayar')
                            <div class="tagging3 rounded-2 py-1 px-2">Paid</div>
                          @endif
                          @if($agenda2->tiket == 'Gratis')
                            <div class="tagging3 rounded-2 py-1 px-2">Free</div>
                          @endif
                        </div>
                      </div>
                      <div class="small text-white lh-sm deskripsi2 mb-2" style="text-align: justify; word-break: break-all;">{!! $agenda2->deskripsi !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda2->types->take(2) as $type)
                          <div class="tagging3 rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 text-white">{{ Str::limit($lokasi, 30) }}</div>
                      <div class="small mb-0 text-white">{{ \Carbon\Carbon::parse($agenda2->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda2->tanggal_berakhir)->format('d M Y') }}</div>
                      <a href="{{ route('agenda', Crypt::encrypt($agenda2->id)) }}" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($agenda2->tiket == 'Gratis')
            <div class="card">
              <div class="row g-0">
                @foreach($agenda2->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 200px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm color">{{ Str::limit($agenda2->judul, 35) }}</div>
                        </div>
                        <div class="col-md-2">
                          @if($agenda2->tiket == 'Berbayar')
                            <div class="tagging rounded-2 py-1 px-2">Paid</div>
                          @endif
                          @if($agenda2->tiket == 'Gratis')
                            <div class="tagging rounded-2 py-1 px-2">Free</div>
                          @endif
                        </div>
                      </div>
                      <div class="small color lh-sm deskripsi2 mb-2" style="text-align: justify; word-break: break-all;">{!! $agenda2->deskripsi !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda2->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 color2">{{ Str::limit($lokasi, 30) }}</div>
                      <div class="small mb-0 color2">{{ \Carbon\Carbon::parse($agenda2->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda2->tanggal_berakhir)->format('d M Y') }}</div>
                      <a href="{{ route('agenda', Crypt::encrypt($agenda2->id)) }}" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        @endforeach
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
        <p>1 tiket untuk setiap 1 pemesanan <span class="text-danger">*</span></p>
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
          <div class="mb-3">
            <label class="form-label">Jenis Tiket <span class="text-danger">*</span></label>
            <select class="form-select" name="jenis_tiket_id" required>
              <option selected disabled value="">Select</option>
              @foreach($agenda->jenis_tikets as $jenis_tiket)
                <option value="{{ $jenis_tiket->id }}">{{ $jenis_tiket->tiket }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($jenis_tiket->harga)), 3))) }}</option>
              @endforeach
            </select>
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