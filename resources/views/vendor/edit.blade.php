@extends('templates.pages')
@section('title', 'Vendor')
@section('header')
<h1>Vendor</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(session()->get('errors'))
      <div class="alert alert-important alert-danger" role="alert">
        @foreach($errors->all() as $error)
          {{ $error }}<br>
        @endforeach
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Edit</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 'Superadmin')
          <form action="{{ route('superadmin.vendor.update', Crypt::encrypt($vendor->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @elseif(auth()->user()->level == 'Admin')
          <form action="{{ route('admin.vendor.update', Crypt::encrypt($vendor->id)) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="">Logo</label>
            <div class="text-muted">Maksimum upload file size 1MB. Recommended image size 1080x310. Maksimum file upload 1 images</div>
            <div class="input-images mb-3"></div>
            <div class="image-uploader">
              <div class="uploaded">
                <div class="uploaded-image">
                  <img src="{{ asset('user/logo/'.$vendor["logo"]) }}" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Nama Vendor <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama_panjang" value="{{ $vendor->nama_panjang }}">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email <span class="text-danger">*</span></label>
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
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.input-images').imageUploader({
      imagesInputName: 'logo',
      maxSize: 1 * 1024 * 1024,
      maxFiles: 1,
    });
  });
</script>
@endpush