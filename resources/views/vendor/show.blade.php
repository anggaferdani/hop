@extends('templates.pages')
@section('title', 'Vendor')
@section('header')
<h1>Vendor</h1>
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
            <label for="">Logo</label>
            <input disabled type="file" class="form-control-file" name="logo" value="{{ $vendor->logo }}" onchange="file(event)">
            @error('logo')<div class="text-danger">{{ $message }}</div>@enderror
            <div style="width: 250px; height: 250px;"><img src="{{ asset('user/logo/'.$vendor['logo']) }}" id="image" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
          </div>
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input disabled type="text" class="form-control" name="nama_panjang" value="{{ $vendor->nama_panjang }}">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input disabled type="email" class="form-control" name="email" value="{{ $vendor->email }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $vendor->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $vendor->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $vendor->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $vendor->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.vendor.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.vendor.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection