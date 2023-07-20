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
    <form action="{{ route('agendas') }}" class="row g-3" method="GET">
      <div class="col-md-2"><input type="text" class="form-control" name="provinsi" placeholder="Provinsi"></div>
      <div class="col-md-2"><input type="text" class="form-control" name="kabupaten_kota" placeholder="Kabupaten/Kota"></div>
      <div class="col-md-2"><input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan"></div>
      <div class="col-md-2"><input type="date" class="form-control" name="tanggal_mulai" placeholder="Start Date"></div>
      <div class="col-md-2"><input type="date" class="form-control" name="tanggal_berakhir" placeholder="End Date"></div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100" style="background-color: #5AA4C2 !important">Apply</button>
      </div>
    </form>
    <div class="row g-2 py-4">
      @foreach($agendas as $agenda)
        <?php $lokasi = $agenda->provinsi.", ".$agenda->kabupaten_kota.", ".$agenda->kecamatan ?>
          <div class="col-md-4">
            <div class="card h-100">
              <div class="row g-0">
                @foreach($agenda->agenda_images->take(1) as $agenda_image)
                <div class="col-md-4">
                  <img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="rounded-start" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @endforeach
                <div class="col-md-8">
                  <div class="card-body" style="height: 200px; display: flex; justify-content: space-between; flex-direction: column;">
                    <div>
                      <div class="d-flex mb-2 justify-content-between">
                        <div class="col-md-10">
                          <div class="fw-bold lh-sm color">{{ Str::limit($agenda->judul, 35) }}</div>
                        </div>
                        <div class="col-md-2">
                          @if($agenda->tiket == 'Berbayar')
                            <div class="tagging rounded-2 py-1 px-2">Paid</div>
                          @endif
                          @if($agenda->tiket == 'Gratis')
                            <div class="tagging rounded-2 py-1 px-2">Free</div>
                          @endif
                        </div>
                      </div>
                      <div class="small color lh-sm deskripsi2 mb-2" style="text-align: justify; word-break: break-all;">{!! $agenda->deskripsi !!}</div>
                    </div>
                    <div>
                      <div class="d-flex gap-1 mb-2">
                        @foreach($agenda->types->take(2) as $type)
                          <div class="tagging rounded-2 py-1 px-2">{{ Str::limit($type->type, 15) }}</div>
                        @endforeach
                      </div>
                      <div class="small mb-0 color2">{{ Str::limit($lokasi, 30) }}</div>
                      <div class="small mb-0 color2">{{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_berakhir)->format('d M Y') }}</div>
                      <a href="{{ route('agenda', Crypt::encrypt($agenda->id)) }}" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    </div>
    <div class="row">
      <div class="d-flex justify-content-center">{{ $agendas->links('pagination::bootstrap-4') }}</div>
    </div>
  </div>
</section>
@endsection