@extends('templates.pages')
@section('title', 'Community')
@section('header')
<h1>Community</h1>
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
            <a href="{{ route('superadmin.activity-manajemen.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('superadmin.kategori.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-tag"></i> Input Community</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.activity-manajemen.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-tag"></i> Input Community</a>
          @elseif(auth()->user()->level == 'Vendor')
            <a href="{{ route('vendor.activity-manajemen.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>No.</th>
                @if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin')
                  <th>Vendor</th>
                @endif
                <th>Kategori</th>
                <th>Nama Community</th>
                <th>Image</th>
                <th>Status Approved</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($activity_manajemens as $activity_manajemen)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  @if(auth()->user()->level == 'Superadmin' || auth()->user()->level == 'Admin')
                    <td>{{ $activity_manajemen->users->nama_panjang }}</td>
                  @endif
                  <td>{{ $activity_manajemen->kategoris->kategori }}</td>
                  <td>{{ $activity_manajemen->judul }}</td>
                  <td>
                    @foreach($activity_manajemen->activity_manajemen_images->take(1) as $activity_manajemen_image)
                      <div class="image2"><img src="{{ asset('activity-manajemen/image/'.$activity_manajemen_image["image"]) }}" alt="" class="image3"></div>
                    @endforeach
                  </td>
                  <td>
                    @if($activity_manajemen->status_approved == 'Approved')
                    <div class="badge badge-primary">Approved</div>
                    @elseif($activity_manajemen->status_approved == 'Belum Di Approved')
                    <div class="badge badge-danger">Belum Di Approved</div>
                    @endif
                  </td>
                  <td style="white-space: nowrap">
                    @if($activity_manajemen->status_approved == 'Belum Di Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.activity-manajemen.delete-permanently', Crypt::encrypt($activity_manajemen->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.activity-manajemen.show', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.activity-manajemen.edit', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('superadmin.activity-manajemen.approved', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.activity-manajemen.delete-permanently', Crypt::encrypt($activity_manajemen->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.activity-manajemen.show', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.activity-manajemen.edit', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('admin.activity-manajemen.approved', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @endif
                    @elseif($activity_manajemen->status_approved == 'Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.activity-manajemen.destroy', Crypt::encrypt($activity_manajemen->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.activity-manajemen.show', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.activity-manajemen.edit', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.activity-manajemen.destroy', Crypt::encrypt($activity_manajemen->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.activity-manajemen.show', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.activity-manajemen.edit', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Vendor')
                        <form action="{{ route('vendor.activity-manajemen.destroy', Crypt::encrypt($activity_manajemen->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('vendor.activity-manajemen.show', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('vendor.activity-manajemen.edit', Crypt::encrypt($activity_manajemen->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @endif
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="float-right">
          {{ $activity_manajemens->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection