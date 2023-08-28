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

    @if(session()->get('errors'))
      <div class="alert alert-important alert-danger" role="alert">
        @foreach($errors->all() as $error)
          {{ $error }}<br>
        @endforeach
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Create</h4>
      </div>
      <div class="card-body">
        @if (Auth::check())
          @if(auth()->user()->level == 'Superadmin')
            <form action="{{ route('superadmin.public-area.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @elseif(auth()->user()->level == 'Admin')
            <form action="{{ route('admin.public-area.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @endif
        @else
          <form action="{{ route('partner.public-area-post') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama Tempat</label>
            <input type="text" class="form-control" name="nama_tempat">
            @error('nama_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi Tempat</label>
            <textarea class="ckeditor" name="deskripsi_tempat"></textarea>
            @error('deskripsi_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="input-images"></div>
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input type="text" class="form-control" name="lokasi">
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <select class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
              </select>
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Link Instagram</label>
              <input type="text" class="form-control" name="instagram">
              @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Link Tiktok</label>
              <input type="text" class="form-control" name="tiktok">
              @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if (Auth::check())
            @if(auth()->user()->level == 'Superadmin')
              <a href="{{ route('superadmin.public-area.index') }}" class="btn btn-secondary">Back</a>
            @elseif(auth()->user()->level == 'Admin')
              <a href="{{ route('admin.public-area.index') }}" class="btn btn-secondary">Back</a>
            @endif
          @endif
          <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.input-images').imageUploader({
      imagesInputName: 'image',
      maxSize: 1 * 1024 * 1024,
      maxFiles: 3,
    });
  });
</script>
@endpush