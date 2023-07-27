@extends('templates.pages')
@section('title', 'Community')
@section('header')
<h1>Community</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Create</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.activity-manajemen.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.activity-manajemen.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Vendor <span class="text-danger">*</span></label>
            <select class="form-control select2" name="user_id">
              <option disabled selected>Select</option>
              @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->nama_panjang }}</option>
              @endforeach
            </select>
            @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Kategori <span class="text-danger">*</span></label>
            <select class="form-control select2" name="kategori_id">
              <option disabled selected>Select</option>
              @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
              @endforeach
            </select>
            @error('kategori_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Judul <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi <span class="text-danger">*</span></label>
            <textarea class="ckeditor" name="deskripsi"></textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Publikasi <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="tanggal_publikasi">
            @error('tanggal_publikasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image <span class="text-danger"> *disarankan 271x200</span></label>
            <input type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Type <span class="text-danger">*</span></label>
            <select class="form-control select2" name="type[]" multiple>
              @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
              @endforeach
            </select>
            @error('type[]')<div class="text-danger">{{ $message }}</div>@enderror
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
                  <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}</option>
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
          <div class="form-group">
            <label for="">WhatsApp</label>
            <input type="text" class="form-control" name="whatsapp" placeholder="Paste link disini">
            @error('whatsapp')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Instagram</label>
            <input type="text" class="form-control" name="instagram" placeholder="Paste link disini">
            @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Twitter</label>
            <input type="text" class="form-control" name="twitter" placeholder="Paste link disini">
            @error('twitter')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Harga Mulai</label>
            <input type="text" class="form-control" name="harga_mulai" onkeyup="formatNumber(this)">
            @error('harga_mulai')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection