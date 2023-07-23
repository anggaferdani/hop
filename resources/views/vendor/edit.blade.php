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
        <h4>Edit</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.vendor.update', Crypt::encrypt($vendor->id)) }}" method="POST" class="needs-validation" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.vendor.update', Crypt::encrypt($vendor->id)) }}" method="POST" class="needs-validation" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Nama Vendor</label>
            <input type="text" class="form-control" name="nama_panjang" value="{{ $vendor->nama_panjang }}">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $vendor->email }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
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