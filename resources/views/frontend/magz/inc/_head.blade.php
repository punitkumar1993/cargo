<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<meta name="author" content="{{ Settings::get('company_name') }}">
{!! SEO::generate() !!}

@empty(Settings::get('favicon'))
<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
<link rel="manifest" href="/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
@else
<link rel="icon" sizes="32x32" href="{{ route('icon.display', Settings::get('favicon')) }}">
@endempty
<meta name="google-site-verification" content="{{ Settings::get('googlesiteverification') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('themes/magz/scripts/bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/ionicons/css/ionicons.min.css')}}">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/fontawesome/css/all.min.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/toast/jquery.toast.min.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/owlcarousel/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/owlcarousel/dist/assets/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/magnific-popup/dist/magnific-popup.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/scripts/sweetalert/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/css/skins/all.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/css/demo.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/prism.js/prism.css')}}">
<link rel="stylesheet" href="{{ asset('themes/magz/css/ct-custom.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
@yield('styles')


@if(Settings::get('publisherid'))
<!-- Google Adsense -->
<script data-ad-client="{{ Settings::get('publisherid') }}" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endif

@if(Settings::get('googleanalyticsid'))
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ Settings::get('googleanalyticsid') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ Settings::get("googleanalyticsid") }}');
</script>
@endif

<!-- Mailchimp -->
<script id="mcjs">
    ! function(c, h, i, m, p) {
        m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m, p)
    }(document, "script", "https://chimpstatic.com/mcjs-connected/js/users/dce4ca90b74e9fafbfb2697a6/b08078aa3fbf02461cb5d711e.js");
</script>
@yield('scripts')

{!! NoCaptcha::renderJs() !!}
