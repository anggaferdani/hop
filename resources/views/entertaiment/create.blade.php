@extends('templates.pages')
@section('title', 'Entertaiment')
@section('header')
<h1>Entertaiment</h1>
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
          <form action="{{ route('superadmin.entertaiment.store') }}" method="POST" class="needs-validation" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.entertaiment.store') }}" method="POST" class="needs-validation" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Entertaiment</label>
            <input type="text" class="form-control" name="entertaiment">
            @error('entertaiment')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.entertaiment.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.entertaiment.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection