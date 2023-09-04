@extends('templates.pages')
@section('title', 'Agenda')
@section('header')
<h1>Agenda</h1>
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
            <label for="">Hangout Places</label>
            <select disabled class="form-control select2" name="hangout_place_id">
              <option disabled selected>Select</option>
              @foreach($hangout_places as $hangout_place)
                <option value="{{ $hangout_place->id }}" @if($agenda->hangout_place_id == $hangout_place->id)@selected(true)@endif>{{ $hangout_place->nama_tempat }}</option>
              @endforeach
            </select>
            @error('hangout_place_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Judul</label>
            <input disabled type="text" class="form-control" name="judul" value="{{ $agenda->judul }}">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea disabled class="ckeditor" name="deskripsi">{{ $agenda->deskripsi }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="image-uploader">
              <div class="uploaded">
                @foreach($agenda->agenda_images as $image)
                  <div class="uploaded-image">
                    <img src="{{ asset('agenda/image/'.$image["image"]) }}" alt="">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Jenis</label>
            <select disabled class="form-control select2" name="jenis">
              <option disabled selected>Select</option>
              <option value="Online" @if($agenda->jenis == 'Online')@selected(true)@endif>Online</option>
              <option value="Offline" @if($agenda->jenis == 'Offline')@selected(true)@endif>Offline</option>
              <option value="Hybird" @if($agenda->jenis == 'Hybird')@selected(true)@endif>Hybird</option>
            </select>
            @error('jenis')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Type</label>
            <select disabled class="form-control select2" name="type[]" multiple>
              @foreach($agenda->types as $type)
                <option value="{{ $type->id }}" @if($type_id->contains($type->id))@selected(true)@endif>{{ $type->type }}</option>
              @endforeach
            </select>
            @error('type[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <input disabled type="text" class="form-control" name="provinsi" value="{{ Str::title(strtolower($agenda->hangout_places->Provinsi->nama_provinsi)) }}">
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ Str::title(strtolower($agenda->hangout_places->Kabupaten->nama_kabupaten)) }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ Str::title(strtolower($agenda->hangout_places->Kecamatan->nama_kecamatan)) }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input disabled type="text" class="form-control" name="lokasi" value="{{ $agenda->hangout_places->lokasi }}">
            <div class="parent2">{!! $agenda->hangout_places->lokasi !!}</div>
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tiket</label>
            <select disabled class="form-control select2" name="tiket">
              <option disabled selected>Select</option>
              <option value="Berbayar" @if($agenda->tiket == 'Berbayar')@selected(true)@endif>Berbayar</option>
              <option value="Gratis" @if($agenda->tiket == 'Gratis')@selected(true)@endif>Gratis</option>
            </select>
            @error('tiket')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if($agenda->tiket == 'Berbayar')
            @if($agenda->redirect_link_pendaftaran == 'Tidak Aktif')
            <div class="form-group">
              <label for="">Jenis Tiket</label>
              @foreach($agenda->jenis_tikets as $jenis_tiket)
                <div class="form-row mb-2">
                  <div class="col"><input disabled type="text" class="form-control" name="jenis_tiket[]" value="{{ $jenis_tiket->tiket }}" placeholder="Jenis Tiket" required></div>
                  <div class="col"><input disabled type="text" class="form-control" name="harga[]" value="{{ $jenis_tiket->harga }}" placeholder="Harga" required onkeyup="formatNumber(this)"></div>
                </div>
              @endforeach
              @error('jenis_tiket.*')<div class="text-danger">{{ $message }}</div>@enderror
              @error('harga.*')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label for="">QRIS</label>
              <div class="image-uploader">
                <div class="uploaded">
                  <div class="uploaded-image">
                    <img src="{{ asset('agenda/qris/'.$agenda["qris"]) }}" alt="">
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($agenda->redirect_link_pendaftaran == 'Aktif')
            <div class="form-group">
              <label for="">Link Pendaftaran</label>
              <input disabled type="text" class="form-control" name="link_pendaftaran" value="{{ $agenda->link_pendaftaran }}">
              @error('link_pendaftaran')<div class="text-danger">{{ $message }}</div>@enderror
              <p><a href="{{ $agenda->link_pendaftaran }}" target="_blank">{{ $agenda->link_pendaftaran }}</a></p>
            </div>
            @endif
          @endif
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Tanggal Mulai</label>
              <input disabled type="date" class="form-control" name="tanggal_mulai" value="{{ $agenda->tanggal_mulai }}">
              @error('tanggal_mulai')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Tanggal Berakhir</label>
              <input disabled type="date" class="form-control" name="tanggal_berakhir" value="{{ $agenda->tanggal_berakhir }}">
              @error('tanggal_berakhir')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Redirect Link Pendaftaran</label>
            <select disabled class="form-control select2" name="redirect_link_pendaftaran">
              <option disabled selected>Select</option>
              <option value="Aktif" @if($agenda->redirect_link_pendaftaran == 'Aktif')@selected(true)@endif>Aktif</option>
              <option value="Tidak Aktif" @if($agenda->redirect_link_pendaftaran == 'Tidak Aktif')@selected(true)@endif>Tidak Aktif</option>
            </select>
            @error('redirect_link_pendaftaran')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $agenda->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $agenda->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $agenda->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $agenda->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.agenda.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Back</a>
          @endif
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