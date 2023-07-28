@extends('templates.pages')
@section('title', 'Penginapan')
@section('header')
<h1>Penginapan</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Show</h4>
      </div>
      <div class="card-body">
        <form action="" method="POST" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Nama Tempat</label>
            <input disabled type="text" class="form-control" name="nama_tempat" value="{{ $lodging->nama_tempat }}">
            @error('nama_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi Tempat</label>
            <textarea disabled class="ckeditor" name="deskripsi_tempat">{{ $lodging->deskripsi_tempat }}</textarea>
            @error('deskripsi_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <input disabled type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($lodging->hangout_place_images as $image)
              <div class="image2"><img src="{{ asset('lodging/image/'.$image["image"]) }}" alt="" class="image3"></div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input disabled type="text" class="form-control" name="lokasi" value="{{ $lodging->lokasi }}">
            <div class="parent2">{!! $lodging->lokasi !!}</div>
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <select disabled class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}" @if($lodging->provinsi == $provinsi->id_provinsi)@selected(true)@endif>{{ $provinsi->nama_provinsi }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select disabled class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
                @foreach($kabupatens as $kabupaten)
                  <option value="{{ $lodging->kabupaten_kota }}" @if($lodging->kabupaten_kota == $kabupaten->id_kabupaten)@selected(true)@endif>{{ $kabupaten->nama_kabupaten }}</option>
                @endforeach
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select disabled class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
                @foreach($kecamatans as $kecamatan)
                  <option value="{{ $lodging->kecamatan }}" @if($lodging->kecamatan == $kecamatan->id_kecamatan)@selected(true)@endif>{{ $kecamatan->nama_kecamatan }}</option>
                @endforeach
              </select>
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Harga</label>
            <select disabled class="form-control select2" name="harga">
              <option disabled selected>Select</option>
              <option value="< = Rp.50.000" @if($lodging->harga == '< = Rp.50.000')@selected(true)@endif>< = Rp.50.000</option>
              <option value="Rp.50.000 - Rp.100.000" @if($lodging->harga == 'Rp.50.000 - Rp.100.000')@selected(true)@endif>Rp.50.000 - Rp.100.000</option>
              <option value="> = Rp.100.000" @if($lodging->harga == '> = Rp.100.000')@selected(true)@endif>> = Rp.100.000</option>
            </select>
            @error('harga')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Fasilitas</label>
            <select disabled class="form-control select2" name="fasilitas[]" multiple>
              @foreach($lodging->fasilitas as $fasilitas)
                <option value="{{ $fasilitas->id }}" @if($fasilitas_id->contains($fasilitas->id))@selected(true)@endif>{{ $fasilitas->fasilitas }}</option>
              @endforeach
            </select>
            @error('fasilitas[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $lodging->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $lodging->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $lodging->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $lodging->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.lodging.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.lodging.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection