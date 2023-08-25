@extends('templates.pages')
@section('title', 'Resto & Cafe')
@section('header')
<h1>Resto & Cafe</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session::get('success'))
      <div class="alert alert-important alert-primary" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif
  
    <div class="card">
      <div class="card-body">
        <div class="float-left">
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.food-and-beverage.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('superadmin.seating.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-couch"></i> Seating</a>
            <a href="{{ route('superadmin.feature.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-table-tennis"></i> Feature</a>
            <a href="{{ route('superadmin.entertaiment.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-star"></i> Entertaiment</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.food-and-beverage.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('superadmin.seating.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-couch"></i> Seating</a>
            <a href="{{ route('superadmin.feature.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-table-tennis"></i> Feature</a>
            <a href="{{ route('superadmin.entertaiment.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-star"></i> Entertaiment</a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Nama Tempat</th>
                <th>Provinsi, Kabupaten/Kota, Kecamatan</th>
                <th>Image</th>
                <th>Status Approved</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($food_and_beverages as $food_and_beverage)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $food_and_beverage->nama_tempat }}</td>
                  <td>
                    @foreach($provinsis as $provinsi)
                      @if($food_and_beverage->provinsi == $provinsi->id_provinsi){{ Str::title(strtolower($provinsi->nama_provinsi)) }}, @endif
                    @endforeach
                    @foreach($kabupatens as $kabupaten)
                      @if($food_and_beverage->kabupaten_kota == $kabupaten->id_kabupaten){{ Str::title(strtolower($kabupaten->nama_kabupaten)) }}, @endif
                    @endforeach
                    @foreach($kecamatans as $kecamatan)
                      @if($food_and_beverage->kecamatan == $kecamatan->id_kecamatan){{ Str::title(strtolower($kecamatan->nama_kecamatan)) }}@endif
                    @endforeach
                  </td>
                  <td>
                    @foreach($food_and_beverage->hangout_place_images->take(1) as $food_and_beverage_image)
                      <div class="image2"><img src="{{ asset('food-and-beverage/image/'.$food_and_beverage_image["image"]) }}" alt="" class="image3"></div>
                    @endforeach
                  </td>
                  <td>
                    @if($food_and_beverage->status_approved == 'Approved')
                    <div class="badge badge-primary">Approved</div>
                    @elseif($food_and_beverage->status_approved == 'Belum Di Approved')
                    <div class="badge badge-danger">Belum Di Approved</div>
                    @endif
                  </td>
                  <td style="white-space: nowrap">
                    @if($food_and_beverage->status_approved == 'Belum Di Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.food-and-beverage.delete-permanently', Crypt::encrypt($food_and_beverage->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.food-and-beverage.show', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.food-and-beverage.edit', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('superadmin.food-and-beverage.approved', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.food-and-beverage.delete-permanently', Crypt::encrypt($food_and_beverage->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.food-and-beverage.show', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.food-and-beverage.edit', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('admin.food-and-beverage.approved', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @endif
                    @elseif($food_and_beverage->status_approved == 'Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.food-and-beverage.destroy', Crypt::encrypt($food_and_beverage->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.food-and-beverage.show', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.food-and-beverage.edit', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.food-and-beverage.destroy', Crypt::encrypt($food_and_beverage->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.food-and-beverage.show', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.food-and-beverage.edit', Crypt::encrypt($food_and_beverage->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @endif
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $food_and_beverages->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection