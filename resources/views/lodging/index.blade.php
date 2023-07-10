@extends('templates.pages')
@section('title', 'Lodging')
@section('header')
<h1>Lodging</h1>
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
            <a href="{{ route('superadmin.lodging.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('superadmin.fasilitas.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-couch"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.lodging.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-couch"></i></a>
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

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Nama Tempat</th>
                <th>Provinsi, Kabupaten/Kota, Kecamatan</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($lodgings as $lodging)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $lodging->nama_tempat }}</td>
                  <td>{{ $lodging->provinsi }}, {{ $lodging->kabupaten_kota }}, {{ $lodging->kecamatan }}</td>
                  <td>
                    @foreach($lodging->lodging_images->take(1) as $lodging_image)
                      <div class="image2"><img src="{{ asset('lodging/image/'.$lodging_image["image"]) }}" alt="" class="image3"></div>
                    @endforeach
                  </td>
                  <td>{{ $lodging->created_at }}</td>
                  <td style="white-space: nowrap">
                    @if(auth()->user()->level == 'Superadmin')
                      <form action="{{ route('superadmin.lodging.destroy', Crypt::encrypt($lodging->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('superadmin.lodging.show', Crypt::encrypt($lodging->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('superadmin.lodging.edit', Crypt::encrypt($lodging->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @elseif(auth()->user()->level == 'Admin')
                      <form action="{{ route('admin.lodging.destroy', Crypt::encrypt($lodging->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.lodging.show', Crypt::encrypt($lodging->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('admin.lodging.edit', Crypt::encrypt($lodging->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $lodgings->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection