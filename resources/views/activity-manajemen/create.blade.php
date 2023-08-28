@extends('templates.pages')
@section('title', 'Community')
@section('header')
<h1>Community</h1>
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
            <form action="{{ route('superadmin.activity-manajemen.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @elseif(auth()->user()->level == 'Admin')
            <form action="{{ route('admin.activity-manajemen.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @elseif(auth()->user()->level == 'Vendor')
            <form action="{{ route('vendor.activity-manajemen.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @endif
        @else
          <form action="{{ route('partner.activity-manajemen-post') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @if (Auth::check())
            @if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin')
              <div class="form-group">
                <label for="">Vendor <span class="text-danger">*</span></label>
                <select class="form-control select2" name="user_id">
                  <option disabled selected>Select</option>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama_panjang }}</option>
                  @endforeach
                </select>
                @if(auth()->user()->level == 'Superadmin')
                  <div class="text-danger">Data tidak ditemukan? <a href="{{ route('superadmin.vendor.index') }}">Klik untuk menambahkan data</a></div>
                @elseif(auth()->user()->level == 'Admin')
                  <div class="text-danger">Data tidak ditemukan? <a href="{{ route('admin.vendor.index') }}">Klik untuk menambahkan data</a></div>
                @endif
                @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
              </div>
            @endif
          @else
            <div class="form-group">
              <label class="d-block">Sudah mengisi form ini sebelumnya?</label>
              <div class="toggle">
                <div class="form-check form-check-inline">
                  <input checked type="radio" class="form-check-input" name="sudah_mengisi_form_ini_sebelumnya" value="iya" data-toggle-element=".radio-button-selections">
                  <label for="" class="form-check-label">Iya</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" class="form-check-input" name="sudah_mengisi_form_ini_sebelumnya" value="tidak" data-toggle-element=".radio-button-selections">
                  <label for="" class="form-check-label">Tidak</label>
                </div>
              </div>
            </div>
            <div class="radio-button-selections border p-4 mb-4" data-toggle-element-value="tidak">
              <div class="form-group">
                <label for="">Profile Perusahaan</label>
                <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 1 images</div>
                <div class="input-images2"></div>
              </div>
              <div class="form-group">
                <label for="">Nama Perusahaan</label>
                <input type="text" class="form-control" name="nama_panjang">
                @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
              </div>
              <div class="form-group">
                <label for="">Email Perusahaan</label>
                <input type="email" class="form-control" name="email">
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
              </div>
            </div>
            <div class="form-group radio-button-selections" data-toggle-element-value="iya">
              <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
              <select class="form-control select2" name="user_id">
                <option disabled selected>Select</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->nama_panjang }}</option>
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
                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
              @endforeach
            </select>
            @if (Auth::check())
              @if(auth()->user()->level == 'Superadmin')
                <div class="text-danger">Data tidak ditemukan? <a href="{{ route('superadmin.kategori.index') }}">Klik untuk menambahkan data</a></div>
              @elseif(auth()->user()->level == 'Admin')
                <div class="text-danger">Data tidak ditemukan? <a href="{{ route('admin.kategori.index') }}">Klik untuk menambahkan data</a></div>
              @endif
            @endif
            @error('kategori_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Nama Community <span class="text-danger">*</span></label>
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
            <label for="">Image <span class="text-danger">*</span></label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="input-images"></div>
          </div>
          <div class="form-group">
            <label for="">Embed Ifreme Lokasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="lokasi">
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi <span class="text-danger">*</span></label>
              <select class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}">{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota <span class="text-danger">*</span></label>
              <select class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan <span class="text-danger">*</span></label>
              <select class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
              </select>
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Harga Mulai <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="harga_mulai" onkeyup="formatNumber(this)">
            @error('harga_mulai')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Link WhatsApp</label>
              <input type="text" class="form-control" name="whatsapp" placeholder="Paste link disini">
              @error('whatsapp')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Link Instagram</label>
              <input type="text" class="form-control" name="instagram" placeholder="Paste link disini">
              @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Link Tiktok</label>
              <input type="text" class="form-control" name="tiktok" placeholder="Paste link disini">
              @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if (Auth::check())
            @if(auth()->user()->level == 'Superadmin')
              <a href="{{ route('superadmin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
            @elseif(auth()->user()->level == 'Admin')
              <a href="{{ route('admin.activity-manajemen.index') }}" class="btn btn-secondary">Back</a>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.input-images2').imageUploader({
      imagesInputName: 'logo',
      maxSize: 1 * 1024 * 1024,
      maxFiles: 1,
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $('[data-toggle-element]').toggleVisibility();
  });
</script>
@endpush