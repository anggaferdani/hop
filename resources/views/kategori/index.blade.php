@extends('templates.pages')
@section('title', 'Community Categories')
@section('header')
<h1>Community Categories</h1>
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
            <a href="{{ route('superadmin.kategori.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input kategori="text" class="form-control" placeholder="Search" id="contact-filter">
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered" id="contact-table">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Kategori</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($kategoris as $kategori)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $kategori->kategori }}</td>
                  <td>{{ $kategori->created_at }}</td>
                  <td style="white-space: nowrap">
                    @if(auth()->user()->level == 'Superadmin')
                      <form action="{{ route('superadmin.kategori.destroy', Crypt::encrypt($kategori->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('superadmin.kategori.show', Crypt::encrypt($kategori->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('superadmin.kategori.edit', Crypt::encrypt($kategori->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button kategori="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @elseif(auth()->user()->level == 'Admin')
                      <form action="{{ route('admin.kategori.destroy', Crypt::encrypt($kategori->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.kategori.show', Crypt::encrypt($kategori->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('admin.kategori.edit', Crypt::encrypt($kategori->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button kategori="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $kategoris->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection