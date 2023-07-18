@extends('templates.pages')
@section('title', 'Seating')
@section('header')
<h1>Seating</h1>
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
            <a href="{{ route('superadmin.food-and-beverage.index') }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            <a href="{{ route('superadmin.seating.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.food-and-beverage.index') }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
            <a href="{{ route('admin.seating.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
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
                <th>Seating</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($seatings as $seating)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $seating->seating }}</td>
                  <td>{{ $seating->created_at }}</td>
                  <td style="white-space: nowrap">
                    @if(auth()->user()->level == 'Superadmin')
                      <form action="{{ route('superadmin.seating.destroy', Crypt::encrypt($seating->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('superadmin.seating.show', Crypt::encrypt($seating->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('superadmin.seating.edit', Crypt::encrypt($seating->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                      </form>
                    @elseif(auth()->user()->level == 'Admin')
                      <form action="{{ route('admin.seating.destroy', Crypt::encrypt($seating->id)) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.seating.show', Crypt::encrypt($seating->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('admin.seating.edit', Crypt::encrypt($seating->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
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
          {{ $seatings->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection