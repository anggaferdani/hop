@extends('templates.authentications')
@section('title', 'Register')
@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Register</h4></div>
  <div class="card-body">

    @if(Session::get('success'))
      <div class="alert alert-important alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif

    @if(Session::get('fail'))
      <div class="alert alert-important alert-danger" role="alert">
        {{ Session::get('fail') }}
      </div>
    @endif

    <form method="POST" action="{{ route('post-register2') }}" class="needs-validation" novalidate="">
      @csrf
      @method('POST')
      <div class="form-group">
        <label>Business Name</label>
        <input type="text" class="form-control" name="nama_panjang" required autofocus>
        @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" required autofocus>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" required autofocus>
        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="terms_and_conditions" class="custom-control-input" id="agree">
          <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
        </div>
        @error('terms_and_conditions')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
      </div>
    </form>
  </div>
</div>
@endsection