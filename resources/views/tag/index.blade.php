@extends('templates.pages')
@section('title', 'Tag')
@section('header')
<h1>Tag</h1>
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
            <a href="{{ route('superadmin.update.index') }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            <a href="{{ route('superadmin.tag.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.update.index') }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            <a href="{{ route('admin.tag.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" id="contact-filter">
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered" id="contact-table">
            <tbody>
              <tr>
                <th>No.</th>
                <th>Tag</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($tags as $tag)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $tag->tag }}</td>
                  <td>{{ $tag->created_at }}</td>
                  <td style="white-space: nowrap">
                    @if(auth()->user()->level == 'Superadmin')
                      <form action="{{ route('superadmin.tag.destroy', Crypt::encrypt($tag->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('superadmin.tag.show', Crypt::encrypt($tag->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('superadmin.tag.edit', Crypt::encrypt($tag->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @elseif(auth()->user()->level == 'Admin')
                      <form action="{{ route('admin.tag.destroy', Crypt::encrypt($tag->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.tag.show', Crypt::encrypt($tag->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('admin.tag.edit', Crypt::encrypt($tag->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
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
          {{ $tags->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection