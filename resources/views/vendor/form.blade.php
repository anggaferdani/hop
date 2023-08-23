@extends('templates.authentications')
@section('title', 'Login')
@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Login</h4></div>
  <div class="card-body">

    @if(Session::get('success'))
      <div class="alert alert-important alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('post-login') }}" class="needs-validation" novalidate="">
      @csrf
      <div class="form-group">
        <label>Email</label>
        <select class="form-control select2" name="">
            <option disabled selected>Select</option>
        </select>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" required autofocus>
        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
      </div>
    </form>
  </div>
</div>
@endsection