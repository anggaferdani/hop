@extends('templates.scanner')
@section('title', 'Scanner')
@section('header')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div id="reader"></div>
  </div>
  <form class="row" id="barcode-form">
    <input type="text" id="search" class="result2">
  </form>
  <div id="result"></div>
</div>
@endsection