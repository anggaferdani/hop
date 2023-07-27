@extends('templates.scanner')
@section('title', 'Scanner')
@section('header')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div id="reader"></div>
  </div>
  <div class="row">
    <input type="text" id="search" class="result2">
    <div id="result" style="display:none">
      <ul class="list-group" id="list">
       
      </ul>
    </div>
  </div>
</div>
@endsection