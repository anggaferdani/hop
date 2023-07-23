<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
</head>
<body>
  <div>{!! DNS2D::getBarcodeHTML("$token", 'QRCODE') !!}</div>
  <br>
  <div>{!! $nama_panjang !!}</div>
  <div>{!! $judul !!}</div>
  <div>{!! $deskripsi !!}</div>
  <div>{!! $lokasi !!}</div>
  <div>{!! $tanggal_mulai_dan_berakhir !!}</div>
</body>
</html>