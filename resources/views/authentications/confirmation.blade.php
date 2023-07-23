@extends('templates.authentications')
@section('title', 'Confirmation')
@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Confirmation</h4></div>
  <div class="card-body">
    <p>We just sent your authentication code via email to {{ $email }}. Check your email</p>
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block">Login</a>
  </div>
</div>
@endsection