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
        <h4>Show</h4>
      </div>
      <div class="card-body">
        <form action="" method="POST" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Judul</label>
            <input disabled type="text" class="form-control" name="judul" value="{{ $update->judul }}">
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea disabled class="ckeditor" name="deskripsi">{{ $update->deskripsi }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Publikasi</label>
            <input disabled type="date" class="form-control" name="tanggal_publikasi" value="{{ $update->tanggal_publikasi }}">
            @error('tanggal_publikasi')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <input disabled type="file" class="form-control" id="image2" name="image[]" accept="image/*" multiple>
            @foreach($update->update_images as $image)
              <div class="image2"><img src="{{ asset('update/image/'.$image["image"]) }}" alt="" class="image3"></div>
            @endforeach
            @error('image[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tag</label>
            <select disabled class="form-control select2" name="tag[]" multiple>
              @foreach($update->tags as $tag)
                <option value="{{ $tag->id }}" @if($tag_id->contains($tag->id))@selected(true)@endif>{{ $tag->tag }}</option>
              @endforeach
            </select>
            @error('tag[]')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Penulis</label>
            <input disabled type="text" class="form-control" name="user_id" value="{{ $update->users->nama_panjang }}">
            @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created By</label>
              <input disabled type="text" class="form-control" name="created_by" value="{{ $update->created_by }}">
              @error('created_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated By</label>
              <input disabled type="text" class="form-control" name="updated_by" value="{{ $update->updated_by }}">
              @error('updated_by')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Created At</label>
              <input disabled type="text" class="form-control" name="created_at" value="{{ $update->created_at }}">
              @error('created_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="">Updated At</label>
              <input disabled type="text" class="form-control" name="updated_at" value="{{ $update->updated_at }}">
              @error('updated_at')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.update.index') }}" class="btn btn-secondary">Back</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.update.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection