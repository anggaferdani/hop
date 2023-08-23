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
        <h4>Create</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.banner.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.banner.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Thumbnail</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1440x413. Maksimum file upload 1 images</div>
            <div class="input-images"></div>
          </div>
          <div class="form-group">
            <label for="">Link</label>
            <input type="text" class="form-control" name="link">
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
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.input-images').imageUploader({
      imagesInputName: 'thumbnail',
      maxSize: 1 * 1024 * 1024,
      maxFiles: 1,
    });
  });
</script>
@endpush