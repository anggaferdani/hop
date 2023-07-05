@extends('templates.pages')
@section('title', 'Update')
@section('header')
<h1>Update</h1>
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
          <form action="{{ route('superadmin.update.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.update.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Judul</label>
            <input type="text" class="form-control" name="judul">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea class="ckeditor" name="deskripsi"></textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Publikasi</label>
            <input type="date" class="form-control" name="tanggal_publikasi">
            @error('tanggal_publikasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tag</label>
            <select class="form-control select2" name="tag[]" multiple>
              @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
              @endforeach
            </select>
            @error('tag[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.update.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.update.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Clear</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection