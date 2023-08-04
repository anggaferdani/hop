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
        <h4>Show</h4>
      </div>
      <div class="card-body">
        <form action="" method="POST" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input disabled type="text" class="form-control" name="nama_panjang" value="{{ $admin->nama_panjang }}">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Level Admin</label>
            <select disabled class="form-control select2" name="level_admin">
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
            <input disabled type="email" class="form-control" name="email" value="{{ $admin->email }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $admin->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $admin->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $admin->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $admin->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <a href="{{ route('superadmin.admin.index') }}" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection