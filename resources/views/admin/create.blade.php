@extends('templates.pages')
@section('title', 'Admin')
@section('header')
<h1>Admin</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Create</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('superadmin.admin.store') }}" method="POST" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input type="text" class="form-control" name="nama_panjang">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Level Admin</label>
            <select class="form-control select2" name="level_admin">
              <option disabled selected>Select</option>
              <option value="Admin">Admin Biasa</option>
              <option value="Food And Beverage">Admin Resto & Cafe</option>
              <option value="Lodging">Admin Penginapan</option>
              <option value="Public Area">Admin Public Area</option>
              <option value="Activity Manajemen">Admin Community</option>
            </select>
            @error('level_admin')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input type="text" class="form-control" name="password">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <a href="{{ route('superadmin.admin.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection