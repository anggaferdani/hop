@extends('templates.pages')
@section('title', 'Banner')
@section('header')
<h1>Banner</h1>
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
          <form action="{{ route('superadmin.banner.update', Crypt::encrypt($banner->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.banner.update', Crypt::encrypt($banner->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Thumbnail</label>
            <input type="file" class="form-control-file" name="thumbnail" value="{{ $banner->thumbnail }}" onchange="file(event)">
            @error('thumbnail')<div class="text-danger">{{ $message }}</div>@enderror
            <div><img src="{{ asset('banner/thumbnail/'.$banner['thumbnail']) }}" id="image" alt="" width="200px"></div>
          </div>
          <div class="form-group">
            <label for="">Link</label>
            <input type="text" class="form-control" name="link" value="{{ $banner->link }}">
            @error('link')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.banner.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection