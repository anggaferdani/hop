@extends('front.templates.pages')
@section('title', $agenda->judul)
@push('style')
<style>
  .slick-slider .slick-list{
    border-radius: 10px;
  }
</style>
@endpush
@section('content')
@php
  date_default_timezone_set('Asia/Jakarta');
@endphp
<section class="pt-md-4 pb-md-2 pt-1 pb-2">
  <div class="container">
    {{-- <div class="row mb-md-4">
      <div class="banner3">
        @foreach($agenda->agenda_images as $agenda_image)
          <div style="height: 400px;">
            <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover; border-radius: 10px;">
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
      <div class="col-md-9 mb-4 mb-md-0">
        <div class="fs-4 fw-bold" style="text-align: justify;">{{ $agenda->judul }}</div>
        <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $agenda->deskripsi !!}</div>
        <div class="fs-5 fw-bold">Event Type</div>
        <div class="text-muted lh-sm mb-3">{{ $agenda->jenis }}, 
          @foreach($agenda->types as $type)
            {{ $type->type }},
          @endforeach
        </div>
        <div class="fs-5 fw-bold">Lokasi</div>
        <div class="text-muted lh-sm mb-3">{{ Str::title(strtolower($agenda->hangout_places->Provinsi->nama_provinsi)) }}, {{ Str::title(strtolower($agenda->hangout_places->Kabupaten->nama_kabupaten)) }}, {{ Str::title(strtolower($agenda->hangout_places->Kecamatan->nama_kecamatan)) }}</div>
        <div class="fs-5 fw-bold">Start End Date</div>
        @if($agenda->tiket == 'Berbayar')
          <div class="text-muted lh-sm mb-3">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('l, d M Y') }}</div>
          <div class="fs-5 fw-bold">Tickets</div>
          @foreach($agenda->jenis_tikets as $jenis_tiket)
            <div class="text-muted lh-sm">{{ $jenis_tiket->tiket }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($jenis_tiket->harga)), 3))) }}</div>
          @endforeach
        @endif
        @if($agenda->tiket == 'Gratis')
          <div class="text-muted lh-sm">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('l, d M Y') }}</div>
        @endif
        <div class="btn-group dropend mt-3">
          <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div> Share</button>
          <ul class="dropdown-menu px-4">
            {!! $share !!}
          </ul>
        </div>
        <div class="d-block text-center text-md-start mt-3">
          @if($agenda->redirect_link_pendaftaran == 'Aktif')
            <a href="{{ $agenda->link_pendaftaran }}" target="_blank" class="text-white border-0 rounded-pill fs-5 px-5 py-2" style="background-color: #5AA4C2;">PESAN</a>
          @elseif($agenda->redirect_link_pendaftaran == 'Tidak Aktif')
            <button class="text-white border-0 rounded-2 fs-5 px-5 py-1 w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #5AA4C2;">PESAN</button>
          @endif
        </div>
      </div>
      <div class="col-md-3">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="fs-5 fw-bold mb-2">Lokasi</div>
            <div class="parent2">{!! $agenda->hangout_places->lokasi !!}</div>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="row mt-0 mt-md-2">
      <div class="col-md-4">
        <div class="banner3">
          @foreach($agenda->agenda_images as $agenda_image)
            <div style="height: 400px;">
              <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="d-block w-100" style="height: 100%; object-fit: cover;">
            </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-5">
        <div class="fs-4 fw-bold lh-sm" style="text-align: justify;">{{ $agenda->judul }}</div>
        <div class="text-muted lh-sm mt-1" style="text-align: justify;">{!! $agenda->deskripsi !!}</div>
        <div class="fw-bold">Event Type</div>
        <div class="text-muted lh-sm mb-2">{{ $agenda->jenis }}, 
          @foreach($agenda->types as $type)
            {{ $type->type }},
          @endforeach
        </div>
        <div class="fw-bold">Lokasi</div>
        <div class="text-muted lh-sm mb-2">{{ Str::title(strtolower($agenda->hangout_places->Provinsi->nama_provinsi)) }}, {{ Str::title(strtolower($agenda->hangout_places->Kabupaten->nama_kabupaten)) }}, {{ Str::title(strtolower($agenda->hangout_places->Kecamatan->nama_kecamatan)) }}</div>
        <div class="fw-bold">Start End Date</div>
        @if($agenda->tiket == 'Berbayar')
          <div class="text-muted lh-sm mb-2">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('l, d M Y') }}</div>
          <div class="fw-bold">Tickets</div>
          @foreach($agenda->jenis_tikets as $jenis_tiket)
            <div class="text-muted lh-sm">{{ $jenis_tiket->tiket }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($jenis_tiket->harga)), 3))) }}</div>
          @endforeach
        @endif
        @if($agenda->tiket == 'Gratis')
          <div class="text-muted lh-sm">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('l, d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('l, d M Y') }}</div>
        @endif
        <div class="btn-group dropend mt-2">
          <button type="button" class="btn tagging2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><div class="fas fa-share-alt"></div> Share</button>
          <ul class="dropdown-menu px-4">
            {!! $share !!}
          </ul>
        </div>
        @if(Session::get('success'))
          <div class="alert alert-important alert-primary mt-3" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif
        @php
          use Carbon\Carbon;

          $tanggalBerakhir = Carbon::parse($agenda->tanggal_berakhir)->setTimezone('Asia/Jakarta');
          $now = Carbon::now('Asia/Jakarta');
        @endphp
        @if ($now->lt($tanggalBerakhir) || $now->isSameDay($tanggalBerakhir))
          <div class="d-block text-center text-md-start mt-3">
            @if($agenda->redirect_link_pendaftaran == 'Aktif')
              <a href="{{ $agenda->link_pendaftaran }}" target="_blank" class="text-white border-0 rounded-pill fs-5 px-5 py-2" style="background-color: #5AA4C2;">PESAN</a>
            @elseif($agenda->redirect_link_pendaftaran == 'Tidak Aktif')
              <button class="text-white border-0 rounded-pill fs-5 px-5 py-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #5AA4C2;">PESAN</button>
            @endif
          </div>
        @endif
      </div>
      <div class="col-md-3 mt-3 mt-md-0">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="fs-5 fw-bold mb-2">Lokasi</div>
            <div class="parent2">{!! $agenda->hangout_places->lokasi !!}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-4 mb-2 d-flex justify-content-between align-items-center">
      <div class="fs-4 fw-bold color m-0">Pilihan Lainnya</div>
      <div class="fs-5 fw-bold m-0"><a href="{{ route('agendas') }}" class="color">View All</a></div>
    </div>
    <div class="row">
      <div class="card2">
        @foreach($agendas as $agenda2)
        <?php $lokasi = $agenda2->hangout_places->Provinsi->nama_provinsi.", ".$agenda2->hangout_places->Kabupaten->nama_kabupaten.", ".$agenda2->hangout_places->Kecamatan->nama_kecamatan ?>
          <div class="col-md-4">
            @if($agenda2->tiket == 'Berbayar')
            <div class="card" style="background-color: #EC5D71;">
              <div class="row g-0">
                @foreach($agenda2->agenda_images->take(1) as $agenda_image)
                <div class="col-4 col-md-4" style="height: 210px">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 210px; display: flex; justify-content: space-between; flex-direction: column;">
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
                      <div class="small mb-0 text-white" style="font-size: 12px;">{{ Str::limit(Str::title(strtolower($lokasi)), 65) }}</div>
                      <div class="small mb-0 text-white" style="font-size: 12px;">{{ \Carbon\Carbon::parse($agenda2->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda2->tanggal_berakhir)->format('d M Y') }}</div>
                      <div class="d-flex gap-1 mt-2">
                        @foreach($agenda2->types->take(2) as $type)
                          <div class="tagging3 rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <a href="{{ route('agenda', $agenda2->slug) }}" class="stretched-link"></a>
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
                <div class="col-4 col-md-4" style="height: 210px">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-8 col-md-8">
                  <div class="card-body" style="height: 210px; display: flex; justify-content: space-between; flex-direction: column;">
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
                      <div class="small mb-0 color" style="font-size: 12px;">{{ Str::limit(Str::title(strtolower($lokasi)), 65) }}</div>
                      <div class="small mb-0 color" style="font-size: 12px;">{{ \Carbon\Carbon::parse($agenda2->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda2->tanggal_berakhir)->format('d M Y') }}</div>
                      <div class="d-flex gap-1 mt-2">
                        @foreach($agenda2->types->take(2) as $type)
                          <div class="tagging4 rounded-2 py-1 px-2">{{ Str::limit($type->type, 10) }}</div>
                        @endforeach
                      </div>
                      <a href="{{ route('agenda', $agenda2->slug) }}" class="stretched-link"></a>
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
          <div class="row g-2">
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
          <div class="row g-2">
            <div class="mb-3 col-md-4">
              <label class="form-label">Provinsi <span class="text-danger">*</span></label>
              <select class="form-select" name="provinsi" id="provinsi" required>
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
              <select class="form-select" name="kabupaten_kota" id="kabupaten" required>
                <option disabled selected>Select</option>
              </select>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
              <select class="form-select" name="kecamatan" id="kecamatan" required>
                <option disabled selected>Select</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" class="form-control" name="pekerjaan">
          </div>
          @if($agenda->tiket == 'Berbayar')
          <div class="alert alert-danger">Pembayaran tiket bisa melalui QRIS</div>
            <div class="mb-3">
              <label class="form-label">Jenis Tiket <span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_tiket_id" @if($agenda->tiket == 'Berbayar')@required(true)@endif>
                <option selected disabled value="">Select</option>
                @foreach($agenda->jenis_tikets as $jenis_tiket)
                  <option value="{{ $jenis_tiket->id }}">{{ $jenis_tiket->tiket }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($jenis_tiket->harga)), 3))) }}</option>
                @endforeach
              </select>
            </div>
            <img src="{{ asset('front/qris.jpeg') }}" class="mb-2" width="200" alt="">
            <div class="mb-3">
              <label class="form-label">Bukti Transfer <span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="bukti_transfer" @if($agenda->tiket == 'Berbayar')@required(true)@endif>
            </div>
          @elseif($agenda->tiket == 'Gratis')
          @endif
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