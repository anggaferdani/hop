@extends('templates.pages')
@section('title', 'Admin')
@section('header')
<h1>Admin</h1>
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
          <a href="{{ route('superadmin.admin.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
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
                <th>Nama Panjang</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($admins as $admin)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $admin->nama_panjang }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->created_at }}</td>
                  <td style="white-space: nowrap">
                    <form action="{{ route('superadmin.admin.destroy', Crypt::encrypt($admin->id)) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="{{ route('superadmin.admin.show', Crypt::encrypt($admin->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                      <a href="{{ route('superadmin.admin.edit', Crypt::encrypt($admin->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                      <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $admins->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection