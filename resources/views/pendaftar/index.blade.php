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
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-append">                                            
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>

        <div class="clearfix form-group"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Nama Panjang</th>
                <th>Jenis Kelamin</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($pendaftars as $pendaftar)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $pendaftar->nama_panjang }}</td>
                  <td>{{ $pendaftar->jenis_kelamin }}</td>
                  <td>{{ $pendaftar->no_telepon }}</td>
                  <td>{{ $pendaftar->email }}</td>
                  <td>{{ $pendaftar->created_at }}</td>
                  <td style="white-space: nowrap">
                    <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#pendaftar"><i class="fa fa-info-circle"></i></button>
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
<div class="modal fade" id="pendaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
          <div class="form-group">
            <label>Token</label>
            <input disabled type="text" class="form-control" name="token" value="{{ $pendaftar2->token }}">
          </div>
          <div class="form-group">
            <label>Nama Panjang</label>
            <input disabled type="text" class="form-control" name="nama_panjang" value="{{ $pendaftar2->nama_panjang }}">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Tanggal Lahir <span class="text-danger">*</span></label>
              <input disabled type="date" class="form-control" name="tanggal_lahir" value="{{ $pendaftar2->tanggal_lahir }}">
            </div>
            <div class="form-group col-md-6">
              <label>Jenis Kelamin <span class="text-danger">*</span></label>
              <select disabled class="form-control" name="jenis_kelamin">
                <option selected disabled value="">Select</option>
                <option value="Laki-laki" @if($pendaftar2->jenis_kelamin == 'Laki-laki')@selected(true)@endif>Laki-laki</option>
                <option value="Perempuan" @if($pendaftar2->jenis_kelamin == 'Perempuan')@selected(true)@endif>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>No. Telepon <span class="text-danger">*</span></label>
            <input disabled type="number" class="form-control" name="no_telepon" value="{{ $pendaftar2->no_telepon }}">
          </div>
          <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input disabled type="email" class="form-control" name="email" value="{{ $pendaftar2->email }}">
          </div>
          <div class="form-group">
            <label>Bukti Transfer</label>
            <input disabled type="file" class="form-control" name="bukti_transfer" value="{{ $pendaftar2->bukti_transfer }}">
            <div><a href="{{ asset('pendaftar/bukti-transfer/'.$pendaftar2["bukti_transfer"]) }}" target="_blank">{{ $pendaftar2->bukti_transfer }}</a></div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Provinsi <span class="text-danger">*</span></label>
              <input disabled type="text" class="form-control" name="provinsi" value="{{ $pendaftar2->provinsi }}">
            </div>
            <div class="form-group col-md-4">
              <label>Kabupaten/Kota <span class="text-danger">*</span></label>
              <input disabled type="text" class="form-control" name="kabupaten_kota" value="{{ $pendaftar2->kabupaten_kota }}">
            </div>
            <div class="form-group col-md-4">
              <label>Kecamatan <span class="text-danger">*</span></label>
              <input disabled type="text" class="form-control" name="kecamatan" value="{{ $pendaftar2->kecamatan }}">
            </div>
          </div>
          <div class="form-group">
            <label>Pekerjaan</label>
            <input disabled type="text" class="form-control" name="pekerjaan" value="{{ $pendaftar2->pekerjaan }}">
          </div>
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