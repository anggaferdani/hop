@extends('templates.pages')
@section('title', 'Food And Beverage')
@section('header')
<h1>Food And Beverage</h1>
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
            <label for="">Image</label>
            <input type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($food_and_beverage->food_and_beverage_images as $image)
              <div style="width: 250px; height: 200px; background-image: url({{ asset('food-and-beverage/image/'.$image["image"]) }}); background-position: center; object-fit: cover; margin-bottom: 1%; padding: 1%;">
                @if(auth()->user()->level == 'Superadmin')
                  <a href="{{ route('superadmin.food-and-beverage.delete-image', ['id' => Crypt::encrypt($image->id), 'food_and_beverage_id' => Crypt::encrypt($food_and_beverage->id)]) }}" class="text-white"><i class="fas fa-times"></i></a>
                @elseif(auth()->user()->level == 'Admin')
                  <a href="{{ route('admin.food-and-beverage.delete-image', ['id' => Crypt::encrypt($image->id), 'food_and_beverage_id' => Crypt::encrypt($food_and_beverage->id)]) }}" class="text-white"><i class="fas fa-times"></i></a>
                @endif
              </div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="">Provinsi</label>
              <input type="text" class="form-control" name="provinsi" value="{{ $food_and_beverage->provinsi }}">
              @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kabupaten/Kota</label>
              <input type="text" class="form-control" name="kabupaten_kota" value="{{ $food_and_beverage->kabupaten_kota }}">
              @error('kabupaten_kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-4">
              <label for="">Kecamatan</label>
              <input type="text" class="form-control" name="kecamatan" value="{{ $food_and_beverage->kecamatan }}">
              @error('kecamatan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Seating</label>
            <select class="form-control select2" name="seating">
              <option disabled selected>Select</option>
              <option value="Outdoor" @if($food_and_beverage->seating == 'Outdoor')@selected(true)@endif>Outdoor</option>
              <option value="Semi Outdoor" @if($food_and_beverage->seating == 'Semi Outdoor')@selected(true)@endif>Semi Outdoor</option>
              <option value="Indoor Non-Smoking" @if($food_and_beverage->seating == 'Indoor Non-Smoking')@selected(true)@endif>Indoor Non-Smoking</option>
              <option value="Indoor Smoking" @if($food_and_beverage->seating == 'Indoor Smoking')@selected(true)@endif>Indoor Non-Smoking</option>
            </select>
            @error('seating')<div class="text-danger">{{ $message }}</div>@enderror
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