
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--<![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">
  <title></title>
  <style type="text/css">
.ReadMsgBody { width: 100%; background-color: #ffffff; }
.ExternalClass { width: 100%; background-color: #ffffff; }
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
html { width: 100%; }
body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
table { border-spacing: 0; table-layout: auto; margin: 0 auto; }
.yshortcuts a { border-bottom: none !important; }
img:hover { opacity: 0.9 !important; }
a { color: #3cb2d0; text-decoration: none; }
.textbutton a { font-family: 'open sans', arial, sans-serif !important; }
.btn-link a { color: #FFFFFF !important; }
tbody ul{display: flex;align-items: center;justify-content: center;padding-left: 0;}
.mail-social li{list-style-type: none;margin-left: 0;padding:0 10px}

@media only screen and (max-width: 479px) {
body { width: auto !important; font-family: 'Open Sans', Arial, Sans-serif !important;}
.table-inner{ width: 90% !important; text-align: center !important;}
.table-full { width: 100%!important; max-width: 100%!important; text-align: center !important;}
/*gmail*/
u + .body .full { width:100% !important; width:100vw !important;}
}
</style>
</head>

<body class="body">
    <table class="full" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" background="{!! asset('/logo/forgot-bg.jpg') !!}" valign="top" style="background-size: cover; background-position: center;">
        <tr>
            <td>
                <table class="table-inner" align="center" width="600" style="max-width: 600px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="40"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF" style="border-top-left-radius: 30px;border-top-right-radius: 30px;" align="center">
                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="50"></td>
                                </tr>
                                <!-- logo -->
                                <tr>
                                    <td align="center" style="line-height: 0px;font-size: 25px;font-weight: bold;"><img src="{!! asset('logo/logo2.jpg') !!}" alt="logo" style="width:200px"></td>
                                </tr>
                                <!-- end logo -->

                                <tr>
                                  <td height="30"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <!-- title -->
                                <tr>
                                    <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:36px; color:#3b3b3b; font-weight: bold;">Thanks for subscribing</td>
                                </tr>
                                <!-- end title -->
                                <tr>
                                    <td align="center">
                                        <table width="25" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="15" style="border-bottom:2px solid #000;"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                </tr>
                                <!-- content -->
                                <tr>
                                    <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:14px; color:#7f8c8d; line-height:29px;">Please find your login credentials to view the e-Magazine:</br>
                                        Email: {!! $email !!}<br>
                                        Password: {!! $password !!}<br>
                                    </td>
                                </tr>
                                <!-- end content -->
                                <tr>
                                    <td height="10"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF" style="border-bottom-left-radius: 30px;border-bottom-right-radius: 30px;" align="center">
                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td height="40"></td>
                                    </tr>
                                    <!-- button -->
                                    <tr>
                                        <td align="center">
                                            <table class="textbutton" align="center" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td class="btn-link" bgcolor="#f76d37" height="55" align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:16px; color:#FFFFFF;font-weight: bold;padding-left: 25px;padding-right: 25px;border-radius:10px;"><a href="{{ route('magazines.index') }}" style="color:#fff;text-decoration:none">Click to View</a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- end button -->
                                    <tr>
                                        <td height="25"></td>
                                    </tr>
                                    <!-- START FOOTER -->
                                    <tr bgcolor="#ffffff">
                                        <td align="center">
                                            <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td height="25"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">
                                                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" style="font-size:16px; font-weight: 900; color:#333333;">Follow us</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="15"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table align="center" width="25%" border="0" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" width="30%" style="vertical-align: top;">
                                                                            <a href="https://www.facebook.com/tanyaje.my" target="_blank" style="list-style-type:none;margin: 0 5px;"> <img src="{{ asset('/images/new/facebook.png') }}" style="width:35px"> </a>
                                                                        </td>
                                                                        <td align="center" class="margin" width="30%" style="vertical-align: top;">
                                                                            <a href="https://www.instagram.com/tanyajemy/" target="_blank" style="list-style-type:none; margin: 0 5px;"> <img src="{{ asset('/images/new/instagram.png') }}" style="width:35px;"> </a>
                                                                        </td>
                                                                        <td align="center" width="30%" style="vertical-align: top;">
                                                                            <a href="https://www.youtube.com/channel/UCcGVll2iQ-KuyOZ1NLck64g" target="_blank" style="list-style-type:none;margin: 0 5px;"> <img src="{{ asset('/images/new/youtube.png') }}" style="width:35px"> </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="25"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <!-- END FOOTER -->
                    <tr>
                        <td height="25"></td>
                    </tr>
                    <tr>
                        <td style="color:#fff;text-align:center">© Cargo Trends Copyrights Reserved {!! date('Y') !!}</td>
                    </tr>
                    <tr>
                        <td height="30"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- end social -->
        <tr>
            <td height="45"></td>
        </tr>
    </table>
</body>

</html>