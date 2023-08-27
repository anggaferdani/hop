@extends('templates.pages')
@section('title', 'Public Area')
@section('header')
<h1>Public Area</h1>
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
            <a href="{{ route('superadmin.public-area.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.public-area.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Nama Tempat</th>
                <th>Provinsi, Kabupaten/Kota, Kecamatan</th>
                <th>Image</th>
                <th>Status Approved</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($public_areas as $public_area)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $public_area->nama_tempat }}</td>
                  <td>
                    @foreach($provinsis as $provinsi)
                      @if($public_area->provinsi == $provinsi->id_provinsi){{ Str::title(strtolower($provinsi->nama_provinsi)) }}, @endif
                    @endforeach
                    @foreach($kabupatens as $kabupaten)
                      @if($public_area->kabupaten_kota == $kabupaten->id_kabupaten){{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}, @endif
                    @endforeach
                    @foreach($kecamatans as $kecamatan)
                      @if($public_area->kecamatan == $kecamatan->id_kecamatan){{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}@endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($public_area->hangout_place_images->take(1) as $public_area_image)
                      <div class="image2"><img src="{{ asset('public-area/image/'.$public_area_image["image"]) }}" alt="" class="image3"></div>
                    @endforeach
                  </td>
                  <td>
                    @if($public_area->status_approved == 'Approved')
                    <div class="badge badge-primary">Approved</div>
                    @elseif($public_area->status_approved == 'Belum Di Approved')
                    <div class="badge badge-danger">Belum Di Approved</div>
                    @endif
                  </td>
                  <td style="white-space: nowrap">
                    @if($public_area->status_approved == 'Belum Di Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.public-area.delete-permanently', Crypt::encrypt($public_area->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.public-area.show', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.public-area.edit', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('superadmin.public-area.approved', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.public-area.delete-permanently', Crypt::encrypt($public_area->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.public-area.show', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.public-area.edit', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('admin.public-area.approved', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @endif
                    @elseif($public_area->status_approved == 'Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.public-area.destroy', Crypt::encrypt($public_area->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.public-area.show', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.public-area.edit', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.public-area.destroy', Crypt::encrypt($public_area->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.public-area.show', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.public-area.edit', Crypt::encrypt($public_area->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @endif
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $public_areas->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection