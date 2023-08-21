@extends('templates.pages')
@section('title', 'Resto & Cafe')
@section('header')
<h1>Resto & Cafe</h1>
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
            <label for="">Nama Tempat</label>
            <input disabled type="text" class="form-control" name="nama_tempat" value="{{ $food_and_beverage->nama_tempat }}">
            @error('nama_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi Tempat</label>
            <textarea disabled class="ckeditor" name="deskripsi_tempat">{{ $food_and_beverage->deskripsi_tempat }}</textarea>
            @error('deskripsi_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1:1. Maksimum file upload 3 images</div>
            <div class="image-uploader">
              <div class="uploaded">
                @foreach($food_and_beverage->hangout_place_images as $image)
                  <div class="uploaded-image">
                    <img src="{{ asset('food_and_beverage/image/'.$image["image"]) }}" alt="">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Logo Sportstainment</label>
            <input disabled type="file" class="form-control" id="logo2" name="logo[]" accept="logo/*" multiple>
            @foreach($food_and_beverage->hangout_place_logos as $logo)
              <div class="logo2"><img src="{{ asset('food-and-beverage/logo/'.$logo["logo"]) }}" alt="" class="logo3"></div>
            @endforeach
            @error('logo[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input disabled type="text" class="form-control" name="lokasi" value="{{ $food_and_beverage->lokasi }}">
            <div class="parent2">{!! $food_and_beverage->lokasi !!}</div>
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <select disabled class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}" @if($food_and_beverage->provinsi == $provinsi->id_provinsi)@selected(true)@endif>{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select disabled class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
                @foreach($kabupatens as $kabupaten)
                  <option value="{{ $food_and_beverage->kabupaten_kota }}" @if($food_and_beverage->kabupaten_kota == $kabupaten->id_kabupaten)@selected(true)@endif>{{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}</option>
                @endforeach
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select disabled class="form-control select2" name="kecamatan" id="kecamatan">
                <option disabled selected>Select</option>
                @foreach($kecamatans as $kecamatan)
                  <option value="{{ $food_and_beverage->kecamatan }}" @if($food_and_beverage->kecamatan == $kecamatan->id_kecamatan)@selected(true)@endif>{{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}</option>
                @endforeach
              </select>
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Seating</label>
            <select disabled class="form-control select2" name="seating[]" multiple>
              @foreach($food_and_beverage->seatings as $seating)
                <option value="{{ $seating->id }}" @if($seating_id->contains($seating->id))@selected(true)@endif>{{ $seating->seating }}</option>
              @endforeach
            </select>
            @error('seating[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Features</label>
            <select disabled class="form-control select2" name="feature[]" multiple>
              @foreach($food_and_beverage->features as $feature)
                <option value="{{ $feature->id }}" @if($feature_id->contains($feature->id))@selected(true)@endif>{{ $feature->feature }}</option>
              @endforeach
            </select>
            @error('feature[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Entertaiment</label>
            <select disabled class="form-control select2" name="entertaiment[]" multiple>
              @foreach($food_and_beverage->entertaiments as $entertaiment)
                <option value="{{ $entertaiment->id }}" @if($entertaiment_id->contains($entertaiment->id))@selected(true)@endif>{{ $entertaiment->entertaiment }}</option>
              @endforeach
            </select>
            @error('entertaiment[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Harga</label>
            <select disabled class="form-control select2" name="harga">
              <option disabled selected>Select</option>
              <option value="< = Rp.50.000" @if($food_and_beverage->harga == '< = Rp.50.000')@selected(true)@endif>< = Rp.50.000</option>
              <option value="Rp.50.000 - Rp.100.000" @if($food_and_beverage->harga == 'Rp.50.000 - Rp.100.000')@selected(true)@endif>Rp.50.000 - Rp.100.000</option>
              <option value="> = Rp.100.000" @if($food_and_beverage->harga == '> = Rp.100.000')@selected(true)@endif>> = Rp.100.000</option>
            </select>
            @error('harga')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Link Instagram</label>
              <input disabled type="text" class="form-control" name="instagram" value="{{ $food_and_beverage->instagram }}">
              @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Link Tiktok</label>
              <input disabled type="text" class="form-control" name="tiktok" value="{{ $food_and_beverage->tiktok }}">
              @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $food_and_beverage->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $food_and_beverage->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $food_and_beverage->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $food_and_beverage->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.food-and-beverage.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.food-and-beverage.index') }}" class="btn btn-secondary">Back</a>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.input-images2').imageUploader({
      imagesInputName: 'logo',
      maxSize: 1 * 1024 * 1024,
    });
  });
</script>
@endpush