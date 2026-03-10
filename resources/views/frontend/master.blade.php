<!DOCTYPE html>

<html lang="en">

<head>
<style type="text/css"> .notify{ z-index: 1000000; margin-top: 5%; } </style>



@notifyCss

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Eventre - Event &amp; Conference Html5 Template</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Event and Conference Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Eventre HTML Template v1.0">

  <!-- theme meta -->
  <meta name="theme-name" content="eventre" />

  <!-- PLUGINS CSS STYLE -->
  <!-- Bootstrap -->
  <link href="{{url('css/plugins/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{url('css/plugins/font-awsome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- Magnific Popup -->
  <link href="{{url('css/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
  <!-- Slick Carousel -->
  <link href="{{url('css/plugins/slick/slick.css')}}" rel="stylesheet">
  <link href="{{url('css/plugins/slick/slick-theme.css')}}" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="{{url('css/style.css')}}" rel="stylesheet">

  <!-- FAVICON -->
  <link href="{{url('templateImage/favicon.png')}}" rel="shortcut icon">

</head>

<body class="body-wrapper">




  <!--========================================
=            Navigation Section            =
=========================================-->



  @include('frontend.fixed.header')




  <!--====  End of Navigation Section  ====-->






  @yield('content')


  @include('notify::components.notify')






  <!--============================
=            Footer            =
=============================-->




  @include('frontend.fixed.footer')




  <!--====  End of Footer ====-->



  <!-- JAVASCRIPTS -->
  <!-- jQuey -->
  <script src="{{url('js/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{url('js/plugins/bootstrap/bootstrap.min.js')}}"></script>
  <!-- Shuffle -->
  <script src="{{url('js/plugins/shuffle/shuffle.min.js')}}"></script>
  <!-- Magnific Popup -->
  <script src="{{url('js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
  <!-- Slick Carousel -->
  <script src="{{url('js/plugins/slick/slick.min.js')}}"></script>
  <!-- SyoTimer -->
  <script src="{{url('js/plugins/syotimer/jquery.syotimer.min.js')}}"></script>
  <!-- Google Mapl -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
  <script src="{{url('js/plugins/google-map/gmap.js')}}"></script>
  <!-- Custom Script -->
  <script src="{{url('js/script.js')}}"></script>


@notifyJs
  
</body>

</html>  