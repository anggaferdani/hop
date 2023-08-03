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
        <h4>Create</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.vendor.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.vendor.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Logo</label>
            <input type="file" class="form-control-file" name="logo" onchange="file(event)">
            @error('logo')<div class="text-danger">{{ $message }}</div>@enderror
            <div style="width: 250px; height: 250px;"><img src="" id="image" style="width: 100%; object-fit: cover; height: 100%;" alt=""></div>
          </div>
          <div class="form-group">
            <label for="">Nama Vendor <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_panjang">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Password <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="password">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.vendor.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.vendor.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection