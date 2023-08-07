@extends('templates.pages')
@section('title', 'Community')
@section('header')
<h1>Community</h1>
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
          <form action="{{ route('superadmin.activity-manajemen.update', Crypt::encrypt($activity_manajemen->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.activity-manajemen.update', Crypt::encrypt($activity_manajemen->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Vendor')
          <form action="{{ route('vendor.activity-manajemen.update', Crypt::encrypt($activity_manajemen->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          @if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin')
            <div class="form-group">
              <label for="">Vendor <span class="text-danger">*</span></label>
              <select class="form-control select2" name="user_id">
                <option disabled selected>Select</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}" @if($activity_manajemen->user_id == $user->id)@selected(true)@endif>{{ $user->nama_panjang }}</option>
                @endforeach
              </select>
              @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          @endif
          <div class="form-group">
            <label for="">Kategori <span class="text-danger">*</span></label>
            <select class="form-control select2" name="kategori_id">
              <option disabled selected>Select</option>
              @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" @if($activity_manajemen->kategori_id == $kategori->id)@selected(true)@endif>{{ $kategori->kategori }}</option>
              @endforeach
            </select>
            @error('kategori_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Nama Community <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul" value="{{ $activity_manajemen->judul }}">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi <span class="text-danger">*</span></label>
            <textarea class="ckeditor" name="deskripsi">{{ $activity_manajemen->deskripsi }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Publikasi <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="tanggal_publikasi" value="{{ $activity_manajemen->tanggal_publikasi }}">
            @error('tanggal_publikasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image <span class="text-danger"> *disarankan 271x200</span></label>
            <input type="file" class="form-control multiple-image" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($activity_manajemen->activity_manajemen_images as $image)
              <div style="width: 250px; height: 200px; background-image: url({{ asset('activity-manajemen/image/'.$image["image"]) }}); background-position: center; object-fit: cover; margin-bottom: 1%; padding: 1%;">
                @if(auth()->user()->level == 'Superadmin')
                  <a href="{{ route('superadmin.activity-manajemen.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @elseif(auth()->user()->level == 'Admin')
                  <a href="{{ route('admin.activity-manajemen.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @elseif(auth()->user()->level == 'Vendor')
                  <a href="{{ route('vendor.activity-manajemen.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @endif
              </div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Type <span class="text-danger">*</span></label>
            <select class="form-control select2" name="type[]" multiple>
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
          <div class="form-group">
            <label for="">Lokasi</label>
            <input type="text" class="form-control" name="lokasi" value="{{ $activity_manajemen->lokasi }}">
            <div class="parent2">{!! $activity_manajemen->lokasi !!}</div>
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <select class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}" @if($activity_manajemen->provinsi == $provinsi->id_provinsi)@selected(true)@endif>{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
                @foreach($kabupatens as $kabupaten)
                  <option value="{{ $activity_manajemen->kabupaten_kota }}" @if($activity_manajemen->kabupaten_kota == $kabupaten->id_kabupaten)@selected(true)@endif>{{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}</option>
                @endforeach
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
                @foreach($kecamatans as $kecamatan)
                  <option value="{{ $activity_manajemen->kecamatan }}" @if($activity_manajemen->kecamatan == $kecamatan->id_kecamatan)@selected(true)@endif>{{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</option>
                @endforeach
              </select>
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">WhatsApp</label>
            <input type="text" class="form-control" name="whatsapp" value="{{ $activity_manajemen->whatsapp }}" placeholder="Paste link disini">
            @error('whatsapp')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Instagram</label>
            <input type="text" class="form-control" name="instagram" value="{{ $activity_manajemen->instagram }}" placeholder="Paste link disini">
            @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tiktok</label>
            <input type="text" class="form-control" name="tiktok" value="{{ $activity_manajemen->tiktok }}" placeholder="Paste link disini">
            @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Harga Mulai</label>
            <input type="text" class="form-control" name="harga_mulai" value="{{ $activity_manajemen->harga_mulai }}" onkeyup="formatNumber(this)">
            @error('harga_mulai')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Vendor')
            <a href="{{ route('vendor.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection