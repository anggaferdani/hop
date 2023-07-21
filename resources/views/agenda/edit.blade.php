@extends('templates.pages')
@section('title', 'Agenda')
@section('header')
<h1>Agenda</h1>
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
          <form action="{{ route('superadmin.agenda.update', Crypt::encrypt($agenda->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.agenda.update', Crypt::encrypt($agenda->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Penyelenggara</label>
            <input type="text" class="form-control" name="penyelenggara" value="{{ $agenda->penyelenggara }}">
            @error('penyelenggara')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{ $agenda->judul }}">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea class="ckeditor" name="deskripsi">{{ $agenda->deskripsi }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image <span class="text-danger"> *disarankan 1116x400</span></label>
            <input type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($agenda->agenda_images as $image)
              <div style="width: 250px; height: 200px; background-image: url({{ asset('agenda/image/'.$image["image"]) }}); background-position: center; object-fit: cover; margin-bottom: 1%; padding: 1%;">
                @if(auth()->user()->level == 'Superadmin')
                  <a href="{{ route('superadmin.agenda.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @elseif(auth()->user()->level == 'Admin')
                  <a href="{{ route('admin.agenda.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @endif
              </div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Jenis</label>
            <select class="form-control select2" name="jenis">
              <option disabled selected>Select</option>
              <option value="Online" @if($agenda->jenis == 'Online')@selected(true)@endif>Online</option>
              <option value="Offline" @if($agenda->jenis == 'Offline')@selected(true)@endif>Offline</option>
              <option value="Hybird" @if($agenda->jenis == 'Hybird')@selected(true)@endif>Hybird</option>
            </select>
            @error('jenis')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Type</label>
            <select class="form-control select2" name="type[]" multiple>
              @foreach($types as $type)
                <option value="{{ $type->id }}"
                @foreach($agenda->types as $type2)
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
              <input type="text" class="form-control" name="provinsi" value="{{ $agenda->provinsi }}">
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <input type="text" class="form-control" name="kabupaten_kota" value="{{ $agenda->kabupaten_kota }}">
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <input type="text" class="form-control" name="kecamatan" value="{{ $agenda->kecamatan }}">
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Tiket</label>
            <select class="form-control select2" name="tiket">
              <option disabled selected>Select</option>
              <option value="Berbayar" @if($agenda->tiket == 'Berbayar')@selected(true)@endif>Berbayar</option>
              <option value="Gratis" @if($agenda->tiket == 'Gratis')@selected(true)@endif>Gratis</option>
            </select>
            @error('tiket')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Harga Mulai</label>
              <input type="text" class="form-control" name="harga_mulai" value="{{ $agenda->harga_mulai }}" onkeyup="formatNumber(this)">
              @error('harga_mulai')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Harga Akhir</label>
              <input type="text" class="form-control" name="harga_akhir" value="{{ $agenda->harga_akhir }}" onkeyup="formatNumber(this)">
              @error('harga_akhir')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Tanggal Mulai</label>
              <input type="date" class="form-control" name="tanggal_mulai" value="{{ $agenda->tanggal_mulai }}">
              @error('tanggal_mulai')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Tanggal Berakhir</label>
              <input type="date" class="form-control" name="tanggal_berakhir" value="{{ $agenda->tanggal_berakhir }}">
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