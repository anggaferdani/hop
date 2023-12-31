@extends('templates.pages')
@section('title', 'Agenda')
@section('header')
<h1>Agenda</h1>
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
            <a href="{{ route('superadmin.agenda.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('superadmin.type.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-tag"></i> Input Type</a>
          @elseif(auth()->user()->level == 'Admin')
            <a href="{{ route('admin.agenda.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
            <a href="{{ route('admin.type.index') }}" class="btn btn-icon btn-primary"><i class="fas fa-tag"></i> Input Type</a>
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
                <th>Judul</th>
                <th>Image</th>
                <th>Status Approved</th>
                <th>Action</th>
              </tr>
              <?php $id = 0; ?>
              @foreach($agendas as $agenda)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $agenda->judul }}</td>
                  <td>
                    @foreach($agenda->agenda_images->take(1) as $agenda_image)
                      <div class="image2"><img src="{{ asset('agenda/image/'.$agenda_image["image"]) }}" alt="" class="image3"></div>
                    @endforeach
                  </td>
                  <td>
                    @if($agenda->status_approved == 'Approved')
                    <div class="badge badge-primary">Approved</div>
                    @elseif($agenda->status_approved == 'Belum Di Approved')
                    <div class="badge badge-danger">Belum Di Approved</div>
                    @endif
                  </td>
                  <td style="white-space: nowrap">
                    @if($agenda->status_approved == 'Belum Di Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.agenda.delete-permanently', Crypt::encrypt($agenda->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.agenda.show', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.agenda.edit', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('superadmin.agenda.approved', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.agenda.delete-permanently', Crypt::encrypt($agenda->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.agenda.show', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.agenda.edit', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <a href="{{ route('admin.agenda.approved', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-danger approved" onclick="confirmation(event)"><i class="fas fa-check"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete-permanently"><i class="fas fa-times"></i></button>
                        </form>
                      @endif
                    @elseif($agenda->status_approved == 'Approved')
                      @if(auth()->user()->level == 'Superadmin')
                        <form action="{{ route('superadmin.agenda.destroy', Crypt::encrypt($agenda->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('superadmin.agenda.show', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('superadmin.agenda.edit', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                          <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                        </form>
                      @elseif(auth()->user()->level == 'Admin')
                        <form action="{{ route('admin.agenda.destroy', Crypt::encrypt($agenda->id)) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('admin.agenda.show', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ route('admin.agenda.edit', Crypt::encrypt($agenda->id)) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
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
          {{ $agendas->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection