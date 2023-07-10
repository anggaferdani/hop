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
        <h4>Show</h4>
      </div>
      <div class="card-body">
        <form action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Thumbnail</label>
            <input disabled type="file" class="form-control-file" name="thumbnail" value="{{ $banner->thumbnail }}" onchange="file(event)">
            @error('thumbnail')<div class="text-danger">{{ $message }}</div>@enderror
            <div><img src="{{ asset('banner/thumbnail/'.$banner['thumbnail']) }}" id="image" alt="" width="200px"></div>
          </div>
          <div class="form-group">
            <label for="">Link</label>
            <input disabled type="text" class="form-control" name="link" value="{{ $banner->link }}">
            @error('link')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $banner->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $banner->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $banner->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $banner->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.banner.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection