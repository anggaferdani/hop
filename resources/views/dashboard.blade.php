@extends('templates.pages')
@section('title', 'Dashboard')
@section('header')
<h1>Dashboard</h1>
@endsection
@section('content')
Lorem ipsum dolor {{ auth()->user()->email }} sit amet consectetur adipisicing elit. Quasi soluta facilis distinctio dolorum quaerat. Aspernatur vitae in quo? Quam obcaecati distinctio esse ut iste facilis, consectetur voluptatem soluta corporis sapiente.
@endsection