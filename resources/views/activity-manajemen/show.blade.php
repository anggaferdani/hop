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
        <h4>Show</h4>
      </div>
      <div class="card-body">
        <form action="" method="POST" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Kategori</label>
            <select disabled class="form-control select2" name="kategori_id">
              <option disabled selected>Select</option>
              @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" @if($activity_manajemen->kategori_id == $kategori->id)@selected(true)@endif>{{ $kategori->kategori }}</option>
              @endforeach
            </select>
            @error('kategori')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Judul</label>
            <input disabled type="text" class="form-control" name="judul" value="{{ $activity_manajemen->judul }}">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea disabled class="ckeditor" name="deskripsi">{{ $activity_manajemen->deskripsi }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Publikasi</label>
            <input disabled type="date" class="form-control" name="tanggal_publikasi" value="{{ $activity_manajemen->tanggal_publikasi }}">
            @error('tanggal_publikasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <input disabled type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($activity_manajemen->activity_manajemen_images as $image)
              <div class="image2"><img src="{{ asset('activity-manajemen/image/'.$image["image"]) }}" alt="" class="image3"></div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Jenis</label>
            <select disabled class="form-control select2" name="jenis">
              <option disabled selected>Select</option>
              <option value="Online" @if($activity_manajemen->jenis == 'Online')@selected(true)@endif>Online</option>
              <option value="Offline" @if($activity_manajemen->jenis == 'Offline')@selected(true)@endif>Offline</option>
              <option value="Hybird" @if($activity_manajemen->jenis == 'Hybird')@selected(true)@endif>Hybird</option>
            </select>
            @error('jenis')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Type</label>
            <select disabled class="form-control select2" name="type[]" multiple>
              @foreach($types as $type)
                <option value="{{ $type->id }}"
                @foreach($activity_manajemen->types as $type2)
                  @if($type2->id == $type->id)@selected(true)@endif
                @endforeach
                >{{ $type->type }}</option>
              @endforeach
            </select>
            @error('type[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <input disabled type="text" class="form-control" name="provinsi" value="{{ $activity_manajemen->provinsi }}">
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <input disabled type="text" class="form-control" name="kabupaten_kota" value="{{ $activity_manajemen->kabupaten_kota }}">
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <input disabled type="text" class="form-control" name="kecamatan" value="{{ $activity_manajemen->kecamatan }}">
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input disabled type="text" class="form-control" name="lokasi" value="{{ $activity_manajemen->lokasi }}">
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">WhatsApp</label>
            <input disabled type="text" class="form-control" name="whatsapp" value="{{ $activity_manajemen->whatsapp }}">
            @error('whatsapp')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Instagram</label>
            <input disabled type="text" class="form-control" name="instagram" value="{{ $activity_manajemen->instagram }}">
            @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Twitter</label>
            <input disabled type="text" class="form-control" name="twitter" value="{{ $activity_manajemen->twitter }}">
            @error('twitter')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Harga Mulai</label>
            <input disabled type="text" class="form-control" name="harga_mulai" value="{{ $activity_manajemen->harga_mulai }}" onkeyup="formatNumber(this)">
            @error('harga_mulai')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $activity_manajemen->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $activity_manajemen->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $activity_manajemen->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $activity_manajemen->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection