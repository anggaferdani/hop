@extends('templates.pages')
@section('title', 'Pendaftar')
@section('header')
<h1>Pendaftar : {{ $agenda->judul }}</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session::get('success'))
      <div class="alert alert-important alert-primary" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif
  
    <div class="card">
      <div class="card-body">
        <div class="float-left">
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.agenda.index') }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" id="contact-filter">
            </div>
          </form>
        </div>

        <div class="clearfix form-group"></div>

        <div class="table-responsive">
          <table class="table table-bordered" id="contact-table">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Nama Panjang</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Status Approved</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($pendaftars as $pendaftar)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $pendaftar->nama_panjang }}</td>
                  <td>{{ $pendaftar->jenis_kelamin }}</td>
                  <td>{{ $pendaftar->email }}</td>
                  <td>
                    @if($pendaftar->status_approved == 'Approved')
                    <div class="badge badge-primary">Approved</div>
                    @elseif($pendaftar->status_approved == 'Belum Di Approved')
                    <div class="badge badge-danger">Belum Di Approved</div>
                    @endif
                  </td>
                  <td style="white-space: nowrap">
                    @if($pendaftar->status_approved == 'Belum Di Approved')
                        @if(auth()->user()->level == 'Superadmin')
                            <form action="{{ route('superadmin.pendaftar.delete-permanently', Crypt::encrypt($pendaftar->id)) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#pendaftar{{ $pendaftar->id }}"><i class="fa fa-info-circle"></i></button>
                                <a href="{{ route('superadmin.pendaftar.approved', Crypt::encrypt($pendaftar->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                                <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-times"></i></button>
                            </form>
                        @elseif(auth()->user()->level == 'Admin')
                            <form action="{{ route('admin.pendaftar.delete-permanently', Crypt::encrypt($pendaftar->id)) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#pendaftar{{ $pendaftar->id }}"><i class="fa fa-info-circle"></i></button>
                                <a href="{{ route('admin.pendaftar.approved', Crypt::encrypt($pendaftar->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                                <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-times"></i></button>
                            </form>
                        @endif
                    @elseif($pendaftar->status_approved == 'Approved')
                      <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#pendaftar{{ $pendaftar->id }}"><i class="fa fa-info-circle"></i></button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $pendaftars->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($pendaftars as $pendaftar2)
<div class="modal fade" id="pendaftar{{ $pendaftar2->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ $pendaftar2->nama_panjang }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
        <div class="modal-body">
          <div class="form-group mb-2">
            <div style="font-weight: bold;">Token</div>
            <div style="word-wrap: break-word;">{{ $pendaftar2->token }}</div>
          </div>
          <div class="form-group mb-2">
            <div style="font-weight: bold;">Nama Panjang</div>
            <div style="word-wrap: break-word;">{{ $pendaftar2->nama_panjang }}</div>
          </div>
          <div class="form-group mb-2">
            <div style="font-weight: bold;">Tanggal Lahir</div>
            <div style="word-wrap: break-word;">{{ $pendaftar2->tanggal_lahir }}</div>
          </div>
          <div class="form-group mb-2">
            <div style="font-weight: bold;">Jenis Kelamin</div>
            <div style="word-wrap: break-word;">{{ $pendaftar2->jenis_kelamin }}</div>
          </div>
          <div class="form-group mb-2">
            <div style="font-weight: bold;">No. Telepon</div>
            <div style="word-wrap: break-word;">{{ $pendaftar2->no_telepon }}</div>
          </div>
          <div class="form-group mb-2">
            <div style="font-weight: bold;">Email</div>
            <div style="word-wrap: break-word;">{{ $pendaftar2->email }}</div>
          </div>
          @if($agenda->tiket == 'Berbayar')
            @if(!empty($pendaftar2->jenis_tiket_id))
            <div class="form-group mb-2">
              <div style="font-weight: bold;">Jenis Tiket</div>
              <div style="word-wrap: break-word;">{{ $pendaftar2->jenis_tikets->tiket }} - {{ 'Rp. '.strrev(implode('.', str_split(strrev(strval($pendaftar2->jenis_tikets->harga)), 3))) }}</div>
            </div>
            <div class="form-group mb-2">
              <div style="font-weight: bold;">Bukti Transfer</div>
              <div><a href="{{ asset('pendaftar/bukti-transfer/'.$pendaftar2["bukti_transfer"]) }}" target="_blank"><img src="{{ asset('pendaftar/bukti-transfer/'.$pendaftar2["bukti_transfer"]) }}" style="width: 100%" alt=""></a></div>
            </div>
            @endif
          @endif
          <div class="form-group mb-2">
            <div style="font-weight: bold;">Provinsi</div>
            <div style="word-wrap: break-word;">{{ Str::title(strtolower($pendaftar2->Provinsi->nama_provinsi)) }} - {{ Str::title(strtolower($pendaftar2->Kabupaten->nama_kabupaten)) }} - {{ Str::title(strtolower($pendaftar2->Kecamatan->nama_kecamatan)) }}</div>
          </div>
          @if(!empty($pendaftar2->pekerjaan))
            <div class="form-group mb-2">
              <div style="font-weight: bold;">Pekerjaan</div>
              <div style="word-wrap: break-word;">{{ $pendaftar2->pekerjaan }}</div>
            </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endsection