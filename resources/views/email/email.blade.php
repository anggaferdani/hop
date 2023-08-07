<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
</head>
<style>  
  @font-face {
  font-family: 'Oxygen';
  font-style: normal;
  font-weight: 300;
  src: local('Oxygen Light'), local('Oxygen-Light'), url(https://fonts.gstatic.com/s/oxygen/v7/AwBqWF2kjhlybWamaKMPcZBw1xU1rKptJj_0jans920.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2212, U+2215;
}
  
  @font-face {
  font-family: 'Oxygen';
  font-style: normal;
  font-weight: 400;
  src: local('Oxygen Regular'), local('Oxygen-Regular'), url(https://fonts.gstatic.com/s/oxygen/v7/qBSyz106i5ud7wkBU-FrPevvDin1pK8aKteLpeZ5c0A.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2212, U+2215;
}
  
  @font-face {
  font-family: 'Source Sans Pro';
  font-style: normal;
  font-weight: 400;
  src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v11/ODelI1aHBYDBqgeIAH2zlJbPFduIYtoLzwST68uhz_Y.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2212, U+2215;
}

  body{
    margin:0;
    padding:0;
  }

  img{
    border:0 none;
    height:auto;
    line-height:100%;
    outline:none;
    text-decoration:none;
  }

  a img{
    border:0 none;
  }

  .imageFix{
    display:block;
  }

  table, td{
    border-collapse:collapse;
  }

  #bodyTable{
    height:100% !important;
    margin:0;
    padding:0;
    width:100% !important;
  }
</style>
<body>
  <table width="100%" height="750" cellpadding="0" cellspacing="0" border="0" style="background: #fff url(https://drive.google.com/uc?id=1MiBhp2XC90SpIqElUFlvP-uHu8P7Jn5G) right bottom no-repeat; background-size: cover;color:#121212;padding:0px;margin:0px;width:100%;font-family: 'Source Sans Pro', sans-serif;font-weight: 400;line-height:1.5">
    <tbody>
      <tr>
        <td>
          <table cellpadding="0" cellspacing="0" border="0" style="padding:0px;margin:0px;width:100%;">
            <tr><td align="center" colspan="3" style="margin:0px;" height="20">&nbsp;</td></tr>
            <tr>
              <td style="padding:0px;margin:0px;">&nbsp;</td>
              <td align="center" style="background: #ffffff; box-shadow: 0 9px 18px 0 rgba(0,0,0,.3), 0 2px 6px 0 rgba(0,0,0,.3);border-radius: 16px;padding:30px;margin:0px;" width="400">
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                  <tbody>
                    <tr>
                      <td align="center">
                        <h4 style="margin: 0; padding: 0 0 20px;color: #DE1A1A;font-size:40px;font-family: 'Oxygen', sans-serif;font-weight: 700;">Thank You!</h4>
                      </td>
                    </tr>
                    <tr>
                      <td align="center">
                        {!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('$token', 'QRCODE', 10, 10) . '" alt="barcode"   />' !!}
                        <p style="color: #666666;font-size: 16px;margin: 0; padding: 10px 0 10px;">{!! $judul !!}</p>
                        <p style="color: #666666;font-size: 16px;margin: 0; padding: 10px 0 10px;">{!! $nama_panjang !!}</p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center">
                        <p style="color: #666666; font-size: 16px;margin: 0; padding: 10px 0;">We thank you for your business and we look forward to providing you with continued service in the future.</p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center">
                        <h1 style="font-size: 20px;font-family: 'Oxygen', sans-serif;font-weight: 400;margin:0; padding:20px 0 10px;">Hangout Project</h1>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="padding:0px;margin:0px;">&nbsp;</td>
            </tr>
            <tr><td colspan="3" style="padding:0px;margin:0px;font-size:20px;height:20px;" height="20">&nbsp;</td></tr>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  
</body>
</html>