@extends('templates.pages')
@section('title', 'Kategori')
@section('header')
<h1>Kategori</h1>
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
          <form action="{{ route('superadmin.kategori.store') }}" method="POST" class="needs-validation" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.kategori.store') }}" method="POST" class="needs-validation" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Kategori</label>
            <input type="text" class="form-control" name="kategori">
            @error('kategori')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.kategori.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button kategori="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection