@extends('templates.pages')
@section('title', 'Profile')
@section('header')
<h1>Profile</h1>
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
      <div class="card-header">
        <h4>Profile</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
            <form action="{{ route('superadmin.post-profile') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
            <form action="{{ route('admin.post-profile') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Vendor')
            <form action="{{ route('vendor.post-profile') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Logo</label>
            <input type="file" class="form-control-file" name="logo" value="{{ $profile->logo }}" onchange="file(event)">
            @error('logo')<div class="text-danger">{{ $message }}</div>@enderror
            <div style="width: 250px; height: 250px;"><img src="{{ asset('user/logo/'.$profile['logo']) }}" id="image" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
          </div>
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input type="text" class="form-control" name="nama_panjang" value="{{ $profile->nama_panjang }}">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $profile->email }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">New Password</label>
            <input type="text" class="form-control" name="password">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
            @if(auth()->user()->level == 'Superadmin')
                <a href="{{ route('superadmin.dashboard') }}" class="btn btn-secondary">Back</a>
            @elseif(auth()->user()->level == 'Admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back</a>
            @elseif(auth()->user()->level == 'Vendor')
                <a href="{{ route('vendor.dashboard') }}" class="btn btn-secondary">Back</a>
            @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection