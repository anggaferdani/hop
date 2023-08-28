<!DOCTYPE html>
<html lang="en">
<head>
<title>Terima kasih anda telah melakukan pemesanan tiket</title>
<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">
/* Stop WebKit from changing text sizes */
body, table, td, a {
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
body {
	height: 100% !important;
	margin: 0 !important;
	padding: 0 !important;
	width: 100% !important;
}
/* Removes spacing between tables in Outlook 2007+ */
table, td {
	mso-table-lspace: 0pt;
	mso-table-rspace: 0pt;
} 
img {
	border: 0;
	line-height: 100%;
	text-decoration: none;
	-ms-interpolation-mode: bicubic; /* Smoother rendering in IE */
}
table {
	border-collapse: collapse !important;
}
/* iOS Blue Links */
a[x-apple-data-detectors] {
	color: inherit !important;
	text-decoration: none !important;
	font-size: inherit !important;
	font-family: inherit !important;
	font-weight: inherit !important;
	line-height: inherit !important;
}
/* Table fix for Outlook */
table {
	border-collapse:separate;
}
.ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {
	line-height: 100%;
}
.ExternalClass {
	width: 100%;
}
/* Mobile Styling */
@media screen and (max-width: 525px){
.wrapper {
	width: 100% !important;
	max-width: 100% !important;
}
.hide-element {
	display: none !important;
}
.no-padding {
	padding: 0 !important;
}
.img-max {
	max-width: 100% !important;
	width: 100% !important;
	height: auto !important;
}
.table-max {
	width: 100% !important;
}
.mobile-btn-container {
	margin: 0 auto;
	width: 100% !important;
}
.mobile-btn {
	padding: 15px !important;
	border: 0 !important;
	font-size: 16px !important;
	display: block !important;
}
}
/* iPads (landscape) Styling */
@media handheld, all and (device-width: 768px) and (device-height: 1024px) and (orientation : landscape) {
.wrapper-ipad {
	max-width: 280px !important;
}
.table-max-ipad{
	max-width:465px !important;
}
}

/* iPads (portrait) Styling */
@media handheld, all and  (device-width: 768px) and (device-height: 1024px) and (orientation : portrait) {
.wrapper-ipad {
	max-width: 280px !important;
}
.table-max-ipad{
	max-width:465px !important;
}
}
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="center">
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="wrapper">
        <tr>
          <td align="center" height="25" style="height:25px; font-size: 0;">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><a href="{{ route('index') }}" title="" target="_blank"><img src="{{ $message->embed('front/img/logo.png') }}" width="66" height="79" alt="" style="display: block; border:0; width:66px; height:79px;" border="0"></a></td>
        </tr>
        <tr>
          <td align="center" height="25" style="height:25px; font-size: 0;">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="#ffffff" align="center" style="padding: 0 10px 0 10px;">
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="table-max">
        <tr>
          <td><table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                	<div width="100%" alt="" style="display: block; border:0; width:100%; height:auto !important;" class="img-max">{!! $qrCodeHTML !!}</div>
                </td>
              </tr>
              <tr>
                <td><table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" height="25" style="height:25px; font-size: 0;">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left"><h4 style="font-family: Helvetica, Arial, sans-serif; font-size: 20px; font-weight:normal; color: #2C3E50; margin:0; mso-line-height-rule:exactly;">Terima kasih anda telah melakukan pemesanan tiket {!! $judul !!}</h4></td>
                    </tr>
                    <tr>
                      <td align="center" height="25" style="height:25px; font-size: 0;">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 25px; color: #2C3E50;">
                        Judul : {!! $judul !!}
                        <br>
                        Tanggal mulai dan berakhir : {!! \Carbon\Carbon::parse($tanggal_mulai)->format('l, d M Y') !!} - {!! \Carbon\Carbon::parse($tanggal_berakhir)->format('l, d M Y') !!}
                        <br>
                        Jenis tiket : {!! $jenis_tiket !!}
                        <br>
                        Nama : {!! $nama_panjang !!}
                        <br>
                        Email : {!! $email !!}
                        <br>
                        Tanggal pemesanan : {!! \Carbon\Carbon::parse($tanggal_pemesanan)->format('l, d M Y') !!}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center" height="25" style="height:25px; font-size: 0;">&nbsp;</td>
  </tr>
</table>
</body>
</html>