@extends('templates.pages')
@section('title', 'Update')
@section('header')
<h1>Update</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session::get('success'))
      <div class="alert alert-important alert-primary" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif
  
    <div class="card">
      <div class="card-body">
        <div class="float-left">
          @if(auth()->user()->level == 'Superadmin')
            <a href="{{ route('superadmin.update.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('superadmin.tag.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-tag"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.update.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('admin.tag.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-tag"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Tanggal Publikasi</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($updates as $update)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $update->judul }}</td>
                  <td>{{ $update->tanggal_publikasi }}</td>
                  <td>
                    @foreach($update->update_images->take(1) as $update_image)
                      <div class="image2"><img src="{{ asset('update/image/'.$update_image["image"]) }}" alt="" class="image3"></div>
                    @endforeach
                  </td>
                  <td>{{ $update->created_at }}</td>
                  <td style="white-space: nowrap">
                    @if(auth()->user()->level == 'Superadmin')
                      <form action="{{ route('superadmin.update.destroy', Crypt::encrypt($update->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('superadmin.update.show', Crypt::encrypt($update->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('superadmin.update.edit', Crypt::encrypt($update->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @elseif(auth()->user()->level == 'Admin')
                      <form action="{{ route('admin.update.destroy', Crypt::encrypt($update->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.update.show', Crypt::encrypt($update->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('admin.update.edit', Crypt::encrypt($update->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $updates->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection