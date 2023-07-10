@extends('front.templates.pages')
@section('title', 'Agendas')
@section('content')
<section>
  <div class="container">
    <div class="row">
      <div class="py-4">
        <div class="fs-3 fw-bold color m-0">Agendas</div>
        <p class="elit m-0">Mau kemana?</p>
      </div>
    </div>
    <div id="outer-grid4">
      <div >
        <input class="form-control form-control-sm " type="text" placeholder="Provinsi" aria-label=".form-control-sm example">
      </div>
      <div >
        <input class="form-control form-control-sm " type="text" placeholder="Kota/Kabupaten" aria-label=".form-control-sm example">
      </div>
      <div >
        <input class="form-control form-control-sm " type="text" placeholder="Kecamatan" aria-label=".form-control-sm example">
      </div>
      <div >
        <input class="form-control form-control-sm " type="text" placeholder="Start Date" aria-label=".form-control-sm example">
      </div>
      <div >
        <input class="form-control form-control-sm " type="text" placeholder="End Date" aria-label=".form-control-sm example">
      </div>
    </div>
    <div class="row g-2 py-4">
      @foreach($agendas as $agenda)
      <?php $lokasi = $agenda->provinsi.", ".$agenda->kabupaten_kota.", ".$agenda->kecamatan ?>
        <div class="col-md-4">
          <a href="{{ route('agenda', Crypt::encrypt($agenda->id)) }}">
            <div class="card">
              <div class="row g-0">
                @foreach($agenda->agenda_images->take(1) as $agenda_image)
                <div class="col-md-4">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-md-8">
                  <div class="card-body">
                    <div class="fw-bold color mb-2">{{ Str::limit($agenda->judul, 20) }}</div>
                    <div class="small color lh-sm" style="text-align: justify;">{!! Str::limit($agenda->deskripsi, 70) !!}</div>
                    <div class="d-flex gap-1">
                      @foreach($agenda->types->take(2) as $type)
                        <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                      @endforeach
                    </div>
                    <div class="small mb-0 color mt-3">{{ Str::limit($lokasi, 30) }}</div>
                    <div class="small mb-0 color">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
    <div class="row">
      <div class="d-flex justify-content-center">{{ $agendas->links('pagination::bootstrap-4') }}</div>
    </div>
  </div>
</section>
@endsection