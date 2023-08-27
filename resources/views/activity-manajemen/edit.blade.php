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

    @if(session()->get('errors'))
      <div class="alert alert-important alert-danger" role="alert">
        @foreach($errors->all() as $error)
          {{ $error }}<br>
        @endforeach
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
              <div><a href="" data-toggle="modal" data-target="#modal">Tampilkan data vendor</a></div>
              @if(auth()->user()->level == 'Superadmin')
                <div class="text-danger">Data tidak ditemukan? <a href="{{ route('superadmin.vendor.index') }}">Klik untuk menambahkan data</a></div>
              @elseif(auth()->user()->level == 'Admin')
                <div class="text-danger">Data tidak ditemukan? <a href="{{ route('admin.vendor.index') }}">Klik untuk menambahkan data</a></div>
              @endif
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
            @if(auth()->user()->level == 'Superadmin')
              <div class="text-danger">Data tidak ditemukan? <a href="{{ route('superadmin.kategori.index') }}">Klik untuk menambahkan data</a></div>
            @elseif(auth()->user()->level == 'Admin')
              <div class="text-danger">Data tidak ditemukan? <a href="{{ route('admin.kategori.index') }}">Klik untuk menambahkan data</a></div>
            @endif
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
            <label for="">Image</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="input-images mb-3"></div>
            <div class="image-uploader">
              <div class="uploaded">
                @foreach($activity_manajemen->activity_manajemen_images as $image)
                  <div class="uploaded-image">
                    <img src="{{ asset('activity-manajemen/image/'.$image["image"]) }}" alt="">
                    @if(auth()->user()->level == 'Superadmin')
                      <a href="{{ route('superadmin.activity-manajemen.delete-image', Crypt::encrypt($image->id)) }}" class="delete-image" style="text-decoration: none"><i class="iui-close text-white"></i></a>
                    @elseif(auth()->user()->level == 'Admin')
                      <a href="{{ route('admin.activity-manajemen.delete-image', Crypt::encrypt($image->id)) }}" class="delete-image" style="text-decoration: none"><i class="iui-close text-white"></i></a>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
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
            <label for="">Harga Mulai</label>
            <input type="text" class="form-control" name="harga_mulai" value="{{ $activity_manajemen->harga_mulai }}" onkeyup="formatNumber(this)">
            @error('harga_mulai')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Link WhatsApp</label>
              <input type="text" class="form-control" name="whatsapp" value="{{ $activity_manajemen->whatsapp }}" placeholder="Paste link disini">
              @error('whatsapp')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Link Instagram</label>
              <input type="text" class="form-control" name="instagram" value="{{ $activity_manajemen->instagram }}" placeholder="Paste link disini">
              @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Link Tiktok</label>
              <input type="text" class="form-control" name="tiktok" value="{{ $activity_manajemen->tiktok }}" placeholder="Paste link disini">
              @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label>Logo</label>
            <div style="width: 150px; height: 150px;"><img src="{{ asset('user/logo/'.$activity_manajemen->users['logo']) }}" id="image" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
          </div>
          <div class="form-group mb-3">
            <label>Nama Vendor</label>
            <input disabled type="text" class="form-control" name="user_id" value="{{ $activity_manajemen->users->nama_panjang }}">
          </div>
          <div class="form-group mb-3">
            <label>Email</label>
            <input disabled type="email" class="form-control" name="email" value="{{ $activity_manajemen->users->email }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
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