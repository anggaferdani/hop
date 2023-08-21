@extends('templates.pages')
@section('title', 'Hotel')
@section('header')
<h1>Hotel</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session::get('success'))
      <div class="alert alert-important alert-danger" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Edit</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.lodging.update', Crypt::encrypt($lodging->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.lodging.update', Crypt::encrypt($lodging->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Nama Tempat</label>
            <input type="text" class="form-control" name="nama_tempat" value="{{ $lodging->nama_tempat }}">
            @error('nama_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi Tempat</label>
            <textarea class="ckeditor" name="deskripsi_tempat">{{ $lodging->deskripsi_tempat }}</textarea>
            @error('deskripsi_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="input-images mb-3"></div>
            <div class="image-uploader">
              <div class="uploaded">
                @foreach($lodging->hangout_place_images as $image)
                  <div class="uploaded-image">
                    <img src="{{ asset('lodging/image/'.$image["image"]) }}" alt="">
                    @if(auth()->user()->level == 'Superadmin')
                      <a href="{{ route('superadmin.lodging.delete-image', Crypt::encrypt($image->id)) }}" class="delete-image" style="text-decoration: none"><i class="iui-close text-white"></i></a>
                    @elseif(auth()->user()->level == 'Admin')
                      <a href="{{ route('admin.lodging.delete-image', Crypt::encrypt($image->id)) }}" class="delete-image" style="text-decoration: none"><i class="iui-close text-white"></i></a>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input type="text" class="form-control" name="lokasi" value="{{ $lodging->lokasi }}">
            <div class="parent2">{!! $lodging->lokasi !!}</div>
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <select class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}" @if($lodging->provinsi == $provinsi->id_provinsi)@selected(true)@endif>{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
                @foreach($kabupatens as $kabupaten)
                  <option value="{{ $lodging->kabupaten_kota }}" @if($lodging->kabupaten_kota == $kabupaten->id_kabupaten)@selected(true)@endif>{{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}</option>
                @endforeach
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
                @foreach($kecamatans as $kecamatan)
                  <option value="{{ $lodging->kecamatan }}" @if($lodging->kecamatan == $kecamatan->id_kecamatan)@selected(true)@endif>{{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</option>
                @endforeach
              </select>
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Harga</label>
            <select class="form-control select2" name="harga">
              <option disabled selected>Select</option>
              <option value="< = Rp.50.000" @if($lodging->harga == '< = Rp.50.000')@selected(true)@endif>< = Rp.500.000</option>
              <option value="Rp.50.000 - Rp.100.000" @if($lodging->harga == 'Rp.50.000 - Rp.100.000')@selected(true)@endif>Rp.500.000 - Rp.1.00.000</option>
              <option value="> = Rp.100.000" @if($lodging->harga == '> = Rp.100.000')@selected(true)@endif>> = Rp.1.000.000</option>
            </select>
            @error('harga')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Fasilitas</label>
            <select class="form-control select2" name="fasilitas[]" multiple>
              @foreach($fasilitasies as $fasilitas)
                <option value="{{ $fasilitas->id }}"
                @foreach($lodging->fasilitas as $fasilitas2)
                  @if($fasilitas2->id == $fasilitas->id)@selected(true)@endif
                @endforeach
                >{{ $fasilitas->fasilitas }}</option>
              @endforeach
            </select>
            @error('fasilitas[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Link Instagram</label>
              <input type="text" class="form-control" name="instagram" value="{{ $lodging->instagram }}">
              @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Link Tiktok</label>
              <input type="text" class="form-control" name="tiktok" value="{{ $lodging->tiktok }}">
              @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.lodging.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.lodging.index') }}" class="btn btn-secondary">Back</a>
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