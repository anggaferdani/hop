@extends('templates.pages')
@section('title', 'Vendor')
@section('header')
<h1>Vendor</h1>
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
            <a href="{{ route('superadmin.vendor.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.vendor.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
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
                <th>Nama Panjang</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($vendors as $vendor)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $vendor->nama_panjang }}</td>
                  <td>{{ $vendor->email }}</td>
                  <td>{{ $vendor->created_at }}</td>
                  <td style="white-space: nowrap">
                    @if(auth()->user()->level == 'Superadmin')
                      <form action="{{ route('superadmin.vendor.destroy', Crypt::encrypt($vendor->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('superadmin.vendor.show', Crypt::encrypt($vendor->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('superadmin.vendor.edit', Crypt::encrypt($vendor->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @elseif(auth()->user()->level == 'Admin')
                      <form action="{{ route('admin.vendor.destroy', Crypt::encrypt($vendor->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.vendor.show', Crypt::encrypt($vendor->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('admin.vendor.edit', Crypt::encrypt($vendor->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
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
          {{ $vendors->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection