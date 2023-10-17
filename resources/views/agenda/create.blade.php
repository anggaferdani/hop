@extends('templates.pages')
@section('title', 'Agenda')
@section('header')
<h1>Agenda</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session('error'))
      <div class="alert alert-important alert-primary" role="alert">
        {{ Session('error') }}
      </div>
    @endif

    @if(session()->get('errors'))
      <div class="alert alert-important alert-danger" role="alert">
        @foreach($errors->all() as $error)
          {{ $error }}<br>
        @endforeach
      </div>
    @endif

    @if (Auth::check())
      @if(auth()->user()->level == 'Superadmin')
        <form action="{{ route('superadmin.agenda.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
      @elseif(auth()->user()->level == 'Admin')
        <form action="{{ route('admin.agenda.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
      @endif
    @else
      <form action="{{ route('partner.agenda-post') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
    @endif
    @csrf
    <div class="card">
      <div class="card-header bg-dark text-white">
        <h4>Informasi Agenda</h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="">Hangout Places</label>
          <select class="form-control select2" name="hangout_place_id">
            <option disabled selected>Select</option>
            @foreach($hangout_places as $hangout_place)
              <option value="{{ $hangout_place->id }}">{{ $hangout_place->nama_tempat }}</option>
            @endforeach
          </select>
          @error('hangout_place_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label for="">Judul</label>
          <input type="text" class="form-control" name="judul">
          @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label for="">Deskripsi</label>
          <textarea class="ckeditor" name="deskripsi"></textarea>
          @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label for="">Informasi Pembayaran</label>
          <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
          <div class="input-images"></div>
        </div>
        <div class="form-group">
          <label for="">Jenis</label>
          <select class="form-control select2" name="jenis">
            <option disabled selected>Select</option>
            <option value="Online">Online</option>
            <option value="Offline">Offline</option>
            <option value="Hybird">Hybird</option>
          </select>
          @error('jenis')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label for="">Type</label>
          <select class="form-control select2" name="type[]" multiple>
            @foreach($types as $type)
              <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
          </select>
          @error('type[]')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai">
            @error('tanggal_mulai')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group col-md-6">
            <label for="">Tanggal Berakhir</label>
            <input type="date" class="form-control" name="tanggal_berakhir">
            @error('tanggal_berakhir')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-group">
          <label for="">Tiket</label>
          <select class="form-control select2" name="tiket" id="Menu1">
            <option disabled selected>Select</option>
            <option value="Berbayar">Berbayar</option>
            <option value="Gratis">Gratis</option>
          </select>
          @error('tiket')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div id="Menu2Container">
          <div class="form-group">
            <label class="d-block">Redirect Link Untuk Pembelian Tiket</label>
            <div class="toggle">
              <div class="form-check form-check-inline">
                <input checked type="radio" class="form-check-input" name="redirect_link_pendaftaran" value="Aktif" data-toggle-element=".radio-button-selections">
                <label for="" class="form-check-label">Aktif (Menambahkan link redirect ke page lain untuk melakukan transaksi pembayaran pembelian tiket)</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="redirect_link_pendaftaran" value="Tidak Aktif" data-toggle-element=".radio-button-selections" checked>
                <label for="" class="form-check-label">Tidak Aktif (Pembayaran pembelian tiket dapat dilakukan disini)</label>
              </div>
            </div>
          </div>
          <div class="radio-button-selections form-group" data-toggle-element-value="Aktif">
            <label for="">Link Pendaftaran</label>
            <input type="text" class="form-control" name="link_pendaftaran">
            @error('link_pendaftaran')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="radio-button-selections" data-toggle-element-value="Tidak Aktif">
            @if(Auth::check())
            @else
              <div class="form-group">
                <label for="">Masukan QRIS untuk transaksi pembelian tiket <span class="text-danger">*</span></label>
                <div class="text-muted small">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 1 images</div>
                <div class="qris"></div>
              </div>
            @endif
            <div class="form-group">
              <label for="">Jenis Tiket <span class="text-danger">*</span></label>
              <button type="button" class="d-block mb-2 btn btn-icon btn-primary add2"><i class="fas fa-plus"></i></button>
              <div class="jenis_tiket"></div>
              @error('jenis_tiket.*')<div class="text-danger">{{ $message }}</div>@enderror
              @error('harga.*')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header bg-dark text-white">
        <h4>Kebutuhan Kelengkapan Data</h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <button type="button" class="d-block mb-2 btn btn-icon btn-primary add2"><i class="fas fa-plus"></i></button>
          <div class="agenda_input"></div>
        </div>
        @if (Auth::check())
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.agenda.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Back</a>
          @endif
        @endif
        <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
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
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.qris').imageUploader({
      imagesInputName: 'qris',
      maxSize: 1 * 1024 * 1024,
      maxFiles: 1,
    });
  });
</script>
@endpush
@push('script')
<script type="text/javascript">
  $("#Menu2Container").hide();
 
  $("#Menu1").on("change", function(){  
    if ($(this).val()=="Berbayar")
      $("#Menu2Container").show();
    else
      $("#Menu2Container").hide();
  });
</script>
<script type="text/javascript">
  $("#Menu4Container").hide();
 
  $("#Menu3").on("change", function(){  
    if ($(this).val()=="Aktif")
      $("#Menu4Container").show();
    else
      $("#Menu4Container").hide();
  });
</script>
<script type="text/javascript">
  $(function() {
    $('[data-toggle-element]').toggleVisibility();
  });
</script>
@endpush