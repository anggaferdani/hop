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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
  @yield('content')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

  <script type="text/javascript">
    function onScanSuccess(decodedText, decodedResult){
      $(".result2").val(decodedText);
    }
  
    function onScanFailure(error){
    }
  
    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 200 }, false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          
        $('#search').keyup(function(){
            var search = $('#search').val();
            if(search == ""){
                $("#list").html("");
                $('#result').hide();
            }else{
                $.get("{{ route('pendaftar.search') }}", {search:search}, function(data){
                    $('#list').empty().html(data);
                    $('#result').show();
                })
            }
        });
    });
  </script>
</body>
</html>