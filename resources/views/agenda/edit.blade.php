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
            <label for="">Hangout Places</label>
            <select class="form-control select2" name="hangout_place_id">
              <option disabled selected>Select</option>
              @foreach($hangout_places as $hangout_place)
                <option value="{{ $hangout_place->id }}" @if($agenda->hangout_place_id == $hangout_place->id)@selected(true)@endif>{{ $hangout_place->nama_tempat }}</option>
              @endforeach
            </select>
            @error('hangout_place_id')<div class="text-danger">{{ $message }}</div>@enderror
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
            <label for="">Image</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="input-images mb-3"></div>
            <div class="image-uploader">
              <div class="uploaded">
                @foreach($agenda->agenda_images as $image)
                  <div class="uploaded-image">
                    <img src="{{ asset('agenda/image/'.$image["image"]) }}" alt="">
                    @if(auth()->user()->level == 'Superadmin')
                      <a href="{{ route('superadmin.agenda.delete-image', Crypt::encrypt($image->id)) }}" class="delete-image" style="text-decoration: none"><i class="iui-close text-white"></i></a>
                    @elseif(auth()->user()->level == 'Admin')
                      <a href="{{ route('admin.agenda.delete-image', Crypt::encrypt($image->id)) }}" class="delete-image" style="text-decoration: none"><i class="iui-close text-white"></i></a>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
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
          <div class="form-group">
            <label for="">Tiket</label>
            <select class="form-control select2" name="tiket" id="Menu1">
              <option disabled selected>Select</option>
              <option value="Berbayar" @if($agenda->tiket == 'Berbayar')@selected(true)@endif>Berbayar</option>
              <option value="Gratis" @if($agenda->tiket == 'Gratis')@selected(true)@endif>Gratis</option>
            </select>
            @error('tiket')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group" id="Menu2Container">
            <label for="">Jenis Tiket</label>
            @foreach($agenda->jenis_tikets as $jenis_tiket)
              <div class="form-row mb-2">
                <div class="col"><input type="text" class="form-control" name="jenis_tiket[]" value="{{ $jenis_tiket->tiket }}" placeholder="Jenis Tiket" required></div>
                <div class="col"><input type="text" class="form-control" name="harga[]" value="{{ $jenis_tiket->harga }}" placeholder="Harga" required onkeyup="formatNumber(this)"></div>
                <div class="col-auto my-auto"><a href="javascript:void(0)" class="delete2" style="text-decoration: none;">Delete</a></div>
              </div>
            @endforeach
            <div class="jenis_tiket"></div>
            <button type="button" class="d-block mb-2 btn btn-icon btn-primary add"><i class="fas fa-plus"></i></button>
            @error('jenis_tiket.*')<div class="text-danger">{{ $message }}</div>@enderror
            @error('harga.*')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if($agenda->tiket == 'Berbayar')
          @endif
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
          <div class="form-group">
            <label for="">Redirect Link Pendaftaran</label>
            <select class="form-control select2" name="redirect_link_pendaftaran">
              <option disabled selected>Select</option>
              <option value="Aktif" @if($agenda->redirect_link_pendaftaran == 'Aktif')@selected(true)@endif>Aktif</option>
              <option value="Tidak Aktif" @if($agenda->redirect_link_pendaftaran == 'Tidak Aktif')@selected(true)@endif>Tidak Aktif</option>
            </select>
            @error('redirect_link_pendaftaran')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if($agenda->redirect_link_pendaftaran == 'Aktif')
            <div class="form-group">
              <label for="">Link Pendaftaran</label>
              <input type="text" class="form-control" name="link_pendaftaran" value="{{ $agenda->link_pendaftaran }}">
              @error('link_pendaftaran')<div class="text-danger">{{ $message }}</div>@enderror
              <p><a href="{{ $agenda->link_pendaftaran }}" target="_blank">{{ $agenda->link_pendaftaran }}</a></p>
            </div>
          @endif
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
@push('script')
<script type="text/javascript">
  $("#Menu2Container").hide();
  $("#Menu1").each(function(){  
    if($(this).val()=="Berbayar")
      $("#Menu2Container").show();
    else
      $("#Menu2Container").hide();
  });
  $("#Menu1").on("change", function(){  
    if($(this).val()=="Berbayar")
      $("#Menu2Container").show();
    else
      $("#Menu2Container").hide();
  });
</script>
@endpush