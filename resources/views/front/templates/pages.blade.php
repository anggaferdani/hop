<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="icon" href="{{ asset('front/img/logo.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Kaushan+Script&family=Libre+Franklin&family=Roboto&family=Roboto+Condensed&family=Sofia+Sans+Condensed:ital,wght@1,500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
  @stack('style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<style>
  @media (min-width:768px) {
    .w-md-50 {
        width: 50% !important;
    }
  }
  .banner4{
    height: 100%;
  }
  .banner4 .slick-list.draggable{
    height: 100%;
  }
  .slick-track{
    height: 100%;
  }
  .banner4 .slick-slide div:nth-child(1){
    height: 100%;
  }
  #search::-webkit-search-cancel-button{
    -webkit-appearance: none;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E %3Cpath d='M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z'%3E%3C/path%3E %3C/svg%3E") center no-repeat;
    cursor: pointer;
    width: 20px;
    height: 20px;
  }
  .active2{
    color: #EC5D71 !important;
  }
  .tagging{
    width: max-content;
    background-color: #EC5D71;
    color: white;
    text-decoration: none;
    font-weight: 400;
    font-size: 10px;
  }
  .card2 .slick-list{
    margin: 0 -5px !important;
  }
  .card2 .slick-slide > div{
    margin: 0 5px !important;
  }
  .card3 .slick-list{
    margin: 0 -5px !important;
  }
  .card3 .slick-slide > div{
    margin: 0 5px !important;
  }
  .image2 .slick-list{
    margin: 0 -5px !important;
  }
  .image2 .slick-slide > div{
    margin: 0 5px !important;
  }
  .image2 .slick-slide{
    height: 200px;
  }
  .image2 .slick-slide img{
    height: 200px;
  }
</style>
<body style="margin-top: 80px;">
  @include('front.templates.subtemplates.navbar')
  
  @yield('content')
  
  @include('front.templates.subtemplates.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $("#search").autocomplete({
        source: function(request, response){
          $.ajax({
            url: "{{ route('autocomplete') }}",
            type: 'GET',
            dataType: "json",
            data: {
              _token: CSRF_TOKEN,
              search: request.term
            },
            success: function(data){
              response(data);
            }
          });
        },
        select: function(event, ui){
          $('#search').val(ui.item.judul);
          return false;
        }
      }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
          .append( "<div><span class='fw-bold'>" + item.judul + "</span><br><span>" + item.deskripsi + "</span><br><span class='small fw-light'>" + item.provinsi + "</span>, <span class='small fw-light'>" + item.kabupaten_kota + "</span>, <span class='small fw-light'>" + item.kecamatan + "</span></div>" )
          .appendTo( ul );
      };
      $("#search").autocomplete("widget").attr('style', 'max-height: 250px; overflow-y: auto; overflow-x: hidden;');
    });
  </script>

  <script type="text/javascript">
    var cards = $('.height2');
    var maxHeight = 0;

    for (var i = 0; i < cards.length; i++) {
      if (maxHeight < $(cards[i]).outerHeight()) {
        maxHeight = $(cards[i]).outerHeight();
      }
    }
    for (var i = 0; i < cards.length; i++) {
      $(cards[i]).height(maxHeight);
    }
  </script>

  <script type="text/javascript">
    var cards = $('.height3');
    var maxHeight = 0;

    for (var i = 0; i < cards.length; i++) {
      if (maxHeight < $(cards[i]).outerHeight()) {
        maxHeight = $(cards[i]).outerHeight();
      }
    }
    for (var i = 0; i < cards.length; i++) {
      $(cards[i]).height(maxHeight);
    }
  </script>

  <script type="text/javascript">
    var cards = $('.height4');
    var maxHeight = 0;

    for (var i = 0; i < cards.length; i++) {
      if (maxHeight < $(cards[i]).outerHeight()) {
        maxHeight = $(cards[i]).outerHeight();
      }
    }
    for (var i = 0; i < cards.length; i++) {
      $(cards[i]).height(maxHeight);
    }
  </script>

  <script type="text/javascript">
    var cards = $('.height5');
    var maxHeight = 0;

    for (var i = 0; i < cards.length; i++) {
      if (maxHeight < $(cards[i]).outerHeight()) {
        maxHeight = $(cards[i]).outerHeight();
      }
    }
    for (var i = 0; i < cards.length; i++) {
      $(cards[i]).height(maxHeight);
    }
  </script>

  <script type="text/javascript">
    $('.banner2').slick({
      autoplay: true,
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>

  <script type="text/javascript">
    $('.banner3').slick({
      arrows: false,
      autoplay: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>

  <script type="text/javascript">
    $('.banner4').slick({
      arrows: false,
      autoplay: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>

  <script type="text/javascript">
    $('.image2').slick({
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>
  
  <script type="text/javascript">
    $('.image2').slick({
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>

  <script type="text/javascript">
    $('.card2').slick({
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>

  <script type="text/javascript">
    $('.card3').slick({
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 5,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
          }
        }
      ]
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.deskripsi').each(function(f){
        var newstr = $(this).text().substring(0, 130) + "...";
        $(this).text(newstr);
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.deskripsi2').each(function(f){
        var newstr = $(this).text().substring(0, 90) + "...";
        $(this).text(newstr);
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.deskripsi3').each(function(f){
        var newstr = $(this).text().substring(0, 70) + "...";
        $(this).text(newstr);
      });
    });
  </script>

  <script type="text/javascript">
    (function(){
      'use strict'
      var forms = document.querySelectorAll('.needs-validation')
      Array.prototype.slice.call(forms)
        .forEach(function (form){
          form.addEventListener('submit', function(event){
            if(!form.checkValidity()){
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
</body>
</html>