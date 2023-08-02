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

    <div class="card">
      <div class="card-header">
        <h4>Create</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.agenda.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.agenda.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
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
            <label for="">Image <span class="text-danger"> *disarankan 1116x400</span></label>
            <input type="file" class="form-control multiple-image" id="image2" name="image[]" accept="image/*" multiple>
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
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
          <div class="form-group">
            <label for="">Tiket</label>
            <select class="form-control select2" name="tiket" id="Menu1">
              <option disabled selected>Select</option>
              <option value="Berbayar">Berbayar</option>
              <option value="Gratis">Gratis</option>
            </select>
            @error('tiket')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group" id="Menu2Container">
            <label for="">Jenis Tiket</label>
            <button type="button" class="d-block mb-2 btn btn-icon btn-primary add"><i class="fas fa-plus"></i></button>
            <div class="jenis_tiket"></div>
            @error('jenis_tiket.*')<div class="text-danger">{{ $message }}</div>@enderror
            @error('harga.*')<div class="text-danger">{{ $message }}</div>@enderror
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
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.agenda.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
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
@endpush