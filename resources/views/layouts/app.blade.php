<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="妄想クローゼット,妄想コーデ,妄想ファッション,EC" />
<meta name="description" content="@yield('description')">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@dreamCloset_jp" />
<meta property="og:url" content="http://rarala.sakura.ne.jp/@yield('url')" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta property="og:image" content="https://rarala.sakura.ne.jp/storage/img/@yield('ogimage').png" />
<meta property="og:site_name" content="妄想クローゼット" />


<title>@yield('title')</title>
<!--CSS追加-->
<link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
<!--GoogleFont-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<!--<link href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">-->
<link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Kosugi+Maru&display=swap" rel="stylesheet">

<!--favicon設定-->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">-->
<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">-->
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>-->
</head>


<body>

    
    
    @yield("content")
  
      <footer id="footer">
        <div id="copywrite">&copy; #私の妄想コーデ</div>
    </footer>
                   
  

<!--js追加-->

  <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
  <script src="{{ asset('assets/js/index.js') }}"></script>
  <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
  <!--<script src="https://unpkg.com/infinite-scroll@3.0.1/dist/infinite-scroll.pkgd.min.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.9/jquery.jscroll.js"></script>-->
</body>
</html>

