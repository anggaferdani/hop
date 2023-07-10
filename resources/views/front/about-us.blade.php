@extends('front.templates.pages')
@section('title', 'Agenda')
@section('content')
<section class="pt-5" style="background: linear-gradient(180deg, #5AA4C2 40%, rgba(90, 164, 194, 0) 100%);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-3 order-2 order-md-1">
        <div class="text-white fw-bold fs-5 text-center">TENTUKAN TUJUANMU DENGAN MUDAH</div>
      </div>
      <div class="col-md-6 order-3 order-md-2">
        <div class="text-white"><img src="{{ asset('front/img/about.png') }}" class="img-fluid" alt=""></div>
      </div>
      <div class="col-md-3 order-1 order-md-3">
        <div class="text-white fw-bold fs-5 text-center">BERSAMA HANGOUT PROJECT</div>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="fs-3 fw-bold text-center">What is Hangout Project ?</div>
      <div class="pt-4 fs-4 text-center" style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae enim in lorem congue finibus non quis ligula. Quisque sit amet tempor lorem. Nullam vitae semper ante. Mauris laoreet lobortis varius. Proin eu maximus nisi. Donec in orci velit. Phasellus consequat felis sed lectus finibus, ac pretium elit efficitur.</div>
      <div class="col-md-3 text-center mx-auto pt-4">
        <img src="{{ asset('front/img/logo2.png') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</section>
@endsection