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
        <h4>Edit</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('superadmin.admin.update', Crypt::encrypt($admin->id)) }}" method="POST" class="needs-validation" novalidate="">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input type="text" class="form-control" name="nama_panjang" value="{{ $admin->nama_panjang }}">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Level Admin</label>
            <select class="form-control select2" name="level_admin">
              <option disabled selected>Select</option>
              <option value="Admin" @if($admin->level_admin == 'Admin')@selected(true)@endif>Admin Biasa</option>
              <option value="Food And Beverage" @if($admin->level_admin == 'Food And Beverage')@selected(true)@endif>Admin Resto & Cafe</option>
              <option value="Lodging" @if($admin->level_admin == 'Lodging')@selected(true)@endif>Admin Hotel</option>
              <option value="Public Area" @if($admin->level_admin == 'Public Area')@selected(true)@endif>Admin Public Area</option>
              <option value="Activity Manajemen" @if($admin->level_admin == 'Activity Manajemen')@selected(true)@endif>Admin Community</option>
            </select>
            @error('level_admin')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $admin->email }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <a href="{{ route('superadmin.admin.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection