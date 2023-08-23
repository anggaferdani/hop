<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  <link rel="stylesheet" href="{{ asset('drag-drop-image-uploader/dist/image-uploader.min.css') }}">
  @livewireStyles

  @stack('style')

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>

  <style>
    .parent2{
      position: relative;
      width: 25%;
      aspect-ratio: 1;
    }
    .parent2 iframe{
      position: absolute;
      width: 100%;
      height: 100%;
    }
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
    .logo2{
      display: block;
      width: 100px;
      height: 100px;
      margin-bottom: 1%;
    }
    .logo3{
      width: 100%;
      height: 100%;
      object-fit: cover;
      cursor: pointer;
    }
    .modal-backdrop{
      display: none;
    }
    .modal{
      background: rgba(0, 0, 0, 0.5); 
    }
  </style>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KS0R358QZZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KS0R358QZZ');
</script>
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
  @livewireScripts
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.all.js" integrity="sha512-AINSNy+d2WG9ts1uJvi8LZS42S8DT52ceWey5shLQ9ArCmIFVi84nXNrvWyJ6bJ+qIb1MnXR46+A4ic/AUcizQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" src="{{ asset('drag-drop-image-uploader/dist/image-uploader.min.js') }}"></script>
  @stack('scripts')
  
  <script type="text/javascript">
    $(function() {
        $("button[type='submit']").click(function(event) {
            var $fileUpload = $(".multiple-image");
            if (parseInt($fileUpload.get(0).files.length) > 5) {
                alert("You are only allowed to upload a maximum of 5 images");
                event.preventDefault();
            }
        });
    });
  </script>
  
  <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {
      function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (var chr = 0; chr < str.length; chr++) {
          strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
        }
        return strVal
      }

      $('#provinsi').on('change', function() {
         var id_provinsi = $(this).val();
         if(id_provinsi) {
             $.ajax({
                 url: '/kabupaten/'+id_provinsi,
                 type: "GET",
                 data: {
                  _token: CSRF_TOKEN,
                },
                 dataType: "json",
                 success:function(data)
                 {
                   if(data){
                      $('#kabupaten').empty();
                      $('#kabupaten').append('<option disabled selected>Select</option>'); 
                      $.each(data, function(key, kabupatens){
                          $('select[name="kabupaten_kota"]').append('<option value="'+ kabupatens.id_kabupaten +'">' + capitalize((kabupatens.nama_kabupaten).toLowerCase()) + '</option>');
                      });
                  }else{
                      $('#kabupaten').empty();
                  }
               }
             });
         }else{
           $('#kabupaten').empty();
         }
      });
    });
  </script>

  <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {
      function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (var chr = 0; chr < str.length; chr++) {
          strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
        }
        return strVal
      }

      $('#kabupaten').on('change', function() {
         var id_kabupaten = $(this).val();
         if(id_kabupaten) {
             $.ajax({
                 url: '/kecamatan/'+id_kabupaten,
                 type: "GET",
                 data: {
                  _token: CSRF_TOKEN,
                },
                 dataType: "json",
                 success:function(data)
                 {
                   if(data){
                      $('#kecamatan').empty();
                      $('#kecamatan').append('<option disabled selected>Select</option>'); 
                      $.each(data, function(key, kecamatans){
                          $('select[name="kecamatan"]').append('<option value="'+ kecamatans.id_kecamatan +'">' + capitalize((kecamatans.nama_kecamatan).toLowerCase()) + '</option>');
                      });
                  }else{
                      $('#kecamatan').empty();
                  }
               }
             });
        }else{
           $('#kecamatan').empty();
        }
      });
    });
  </script>

  <script type="text/javascript">
    $('.add').on('click', function(){
        add();
    });

    function add(){
      var jenis_tiket =
        '<div><div class="form-row mb-2"><div class="col"><input type="text" class="form-control" name="jenis_tiket[]" placeholder="Jenis Tiket" required></div><div class="col"><input type="text" class="form-control" name="harga[]" placeholder="Harga" required onkeyup="formatNumber(this)"></div><div class="col-auto my-auto"><a href="javascript:void(0)" class="delete2" style="text-decoration: none;">Delete</a></div></div></div>';
      $('.jenis_tiket').append(jenis_tiket);
    };

    $("body").on("click",".delete2",function(){ 
        $(this).parents(".form-row").remove();
    });
  </script>

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
  <script type="text/javascript">
    $(document).ready(function(){
      if(window.File && window.FileList && window.FileReader){
        $("#logo2").on("change", function(e){
          var files = e.target.files,
          filesLength = files.length;
          for(var i = 0; i < filesLength; i++){
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e){
              var file = e.target;
              $("<span class=\"logo2\">" + "<img class=\"logo3\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" + "</span>").insertAfter("#logo2");
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