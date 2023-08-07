@extends('templates.pages')
@section('title', 'Resto & Cafe')
@section('header')
<h1>Resto & Cafe</h1>
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
          <form action="{{ route('superadmin.food-and-beverage.update', Crypt::encrypt($food_and_beverage->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.food-and-beverage.update', Crypt::encrypt($food_and_beverage->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Nama Tempat</label>
            <input type="text" class="form-control" name="nama_tempat" value="{{ $food_and_beverage->nama_tempat }}">
            @error('nama_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi Tempat</label>
            <textarea class="ckeditor" name="deskripsi_tempat">{{ $food_and_beverage->deskripsi_tempat }}</textarea>
            @error('deskripsi_tempat')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image <span class="text-danger"> *disarankan 241x150</span></label>
            <input type="file" class="form-control multiple-image" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($food_and_beverage->hangout_place_images as $image)
              <div style="width: 250px; height: 200px; background-image: url({{ asset('food-and-beverage/image/'.$image["image"]) }}); background-position: center; object-fit: cover; margin-bottom: 1%; padding: 1%;">
                @if(auth()->user()->level == 'Superadmin')
                  <a href="{{ route('superadmin.food-and-beverage.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @elseif(auth()->user()->level == 'Admin')
                  <a href="{{ route('admin.food-and-beverage.delete-image', Crypt::encrypt($image->id)) }}" class="text-white"><i class="fas fa-times"></i></a>
                @endif
              </div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Logo Public Viewing <span class="text-danger"> *disarankan 250x250</span></label>
            <input type="file" class="form-control-file" name="logo" value="{{ $food_and_beverage->logo }}" onchange="file(event)">
            @error('logo')<div class="text-danger">{{ $message }}</div>@enderror
            <div><img src="{{ asset('food-and-beverage/logo/'.$food_and_beverage['logo']) }}" id="image" alt="" width="200px"></div>
          </div>
          <div class="form-group">
            <label for="">Lokasi</label>
            <input type="text" class="form-control" name="lokasi" value="{{ $food_and_beverage->lokasi }}">
            <div class="parent2">{!! $food_and_beverage->lokasi !!}</div>
            @error('lokasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <select class="form-control select2" name="provinsi" id="provinsi">
                <option disabled selected>Select</option>
                @foreach($provinsis as $provinsi)
                  <option value="{{ $provinsi->id_provinsi }}" @if($food_and_beverage->provinsi == $provinsi->id_provinsi)@selected(true)@endif>{{ Str::title(strtolower($provinsi->nama_provinsi)) }}</option>
                @endforeach
              </select>
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <select class="form-control select2" name="kabupaten_kota" id="kabupaten">
                <option disabled selected>Select</option>
                @foreach($kabupatens as $kabupaten)
                  <option value="{{ $food_and_beverage->kabupaten_kota }}" @if($food_and_beverage->kabupaten_kota == $kabupaten->id_kabupaten)@selected(true)@endif>{{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}</option>
                @endforeach
              </select>
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <select class="form-control select2" name="kecamatan" id="kecamatan">
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
            <select class="form-control select2" name="seating[]" multiple>
              @foreach($seatings as $seating)
                <option value="{{ $seating->id }}"
                @foreach($food_and_beverage->seatings as $seating2)
                  @if($seating2->id == $seating->id)@selected(true)@endif
                @endforeach
                >{{ $seating->seating }}</option>
              @endforeach
            </select>
            @error('seating[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Features</label>
            <select class="form-control select2" name="feature[]" multiple>
              @foreach($features as $feature)
                <option value="{{ $feature->id }}"
                @foreach($food_and_beverage->features as $feature2)
                  @if($feature2->id == $feature->id)@selected(true)@endif
                @endforeach
                >{{ $feature->feature }}</option>
              @endforeach
            </select>
            @error('feature[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Entertaiment</label>
            <select class="form-control select2" name="entertaiment[]" multiple>
              @foreach($entertaiments as $entertaiment)
                <option value="{{ $entertaiment->id }}"
                @foreach($food_and_beverage->entertaiments as $entertaiment2)
                  @if($entertaiment2->id == $entertaiment->id)@selected(true)@endif
                @endforeach
                >{{ $entertaiment->entertaiment }}</option>
              @endforeach
            </select>
            @error('entertaiment[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Harga</label>
            <select class="form-control select2" name="harga">
              <option disabled selected>Select</option>
              <option value="< = Rp.50.000" @if($food_and_beverage->harga == '< = Rp.50.000')@selected(true)@endif>< = Rp.50.000</option>
              <option value="Rp.50.000 - Rp.100.000" @if($food_and_beverage->harga == 'Rp.50.000 - Rp.100.000')@selected(true)@endif>Rp.50.000 - Rp.100.000</option>
              <option value="> = Rp.100.000" @if($food_and_beverage->harga == '> = Rp.100.000')@selected(true)@endif>> = Rp.100.000</option>
            </select>
            @error('harga')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.food-and-beverage.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.food-and-beverage.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection