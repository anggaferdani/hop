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
            <label for="">Image <span class="text-danger"> *disarankan 1116x400</span></label>
            <input type="file" class="form-control multiple-image" id="image2" name="image[]" accept="image/*" multiple>
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
              <select class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}" @if($agenda->provinsi == $provinsi->id_provinsi)@selected(true)@endif>{{ $provinsi->nama_provinsi }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
                @foreach($kabupatens as $kabupaten)
                  <option value="{{ $agenda->kabupaten_kota }}" @if($agenda->kabupaten_kota == $kabupaten->id_kabupaten)@selected(true)@endif>{{ $kabupaten->nama_kabupaten }}</option>
                @endforeach
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
                @foreach($kecamatans as $kecamatan)
                  <option value="{{ $agenda->kecamatan }}" @if($agenda->kecamatan == $kecamatan->id_kecamatan)@selected(true)@endif>{{ $kecamatan->nama_kecamatan }}</option>
                @endforeach
              </select>
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
          @if($agenda->tiket == 'Berbayar')
          <div class="form-group">
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