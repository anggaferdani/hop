<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/assets/modules/fontawesome/css/all.min.css') }}">
  
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>

  <style>
    .image2{
      display: block;
      width: 250px;
      height: 200px;
      margin-bottom: 1%;
    }
    .image3{
      width: 100%;
      height: 100%;
      object-fit: cover;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('templates.subtemplates.navbar')
      
      @include('templates.subtemplates.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            @yield('header')
          </div>
          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      
      @include('templates.subtemplates.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('stisla/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('stisla/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('stisla/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.all.js" integrity="sha512-AINSNy+d2WG9ts1uJvi8LZS42S8DT52ceWey5shLQ9ArCmIFVi84nXNrvWyJ6bJ+qIb1MnXR46+A4ic/AUcizQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Page Specific JS File -->
  <script type="text/javascript">
    $('.delete').click(function(){
      Swal.fire({
        title: "Are you sure?",
        text: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus amet dolore ex saepe, incidunt accusamus distinctio voluptatum esse recusandae. Beatae dicta tempora culpa libero suscipit quam vero ad, corporis soluta.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it",
        closeOnConfirm: false
      }).then((result) => {
        if(result.isConfirmed){
          $(this).closest("form").submit();
          Swal.fire(
            'Deleted',
            'You have successfully deleted',
            'success',
          );
        }
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2({});
    });
  </script>

  <script type="text/javascript">
    function show(select){
      if(select.value == 'berbayar'){
        document.getElementById('hidden').style.display = "block";
      }else{
        document.getElementById('hidden').style.display = "none";
        var harga_tiket = document.getElementById('harga_tiket');
        harga_tiket.value = null;
        harga_tiket.focus();
        return false;
      }
    };
  </script>

  <script type="text/javascript">
    function formatNumber(input){
      var num = input.value.replace(/[^0-9]/g, '');

      var formattedNum = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
      input.value = formattedNum;
    }
  </script>
  
  <script type="text/javascript">
    var file = function(event){
      var image = document.getElementById('image');
      image.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      if(window.File && window.FileList && window.FileReader){
        $("#image2").on("change", function(e){
          var files = e.target.files,
          filesLength = files.length;
          for(var i = 0; i < filesLength; i++){
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e){
              var file = e.target;
              $("<span class=\"image2\">" + "<img class=\"image3\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" + "</span>").insertAfter("#image2");
            });
            fileReader.readAsDataURL(f);
          }
        });
      }else{
        alert("Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus amet dolore ex saepe, incidunt accusamus distinctio voluptatum esse recusandae. Beatae dicta tempora culpa libero suscipit quam vero ad, corporis soluta.");
      }
    });
  </script>

  @stack('script')
  
  <!-- Template JS File -->
  <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>
  <script src="{{ asset('stisla/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
</body>
</html>