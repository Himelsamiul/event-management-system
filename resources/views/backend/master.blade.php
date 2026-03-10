
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <script src="{{url('backend/assets/js/color-modes.js')}}"></script>

  @notifyCss

  <link href="{{url('backend/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <meta name="theme-color" content="#712cf9">

  <title>Admin Dashboard</title>

  <!-- Custom styles for this template -->
  <link href="{{url('backend/dashboard.css')}}" rel="stylesheet">
</head>

  <body>
    

  




    @include('backend.partials.header')






<div class="container-fluid">
  <div class="row">
    


    @include('backend.partials.sidebar')




    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
        


      @yield('content')



    </main>
  </div>
</div>
<script src="{{url('backend/assets/dist/js/bootstrap.bundle.min.js')}}" ></script>
<script src="{{url('backend/dashboard.js')}}"></script>
    @include('notify::components.notify')
    @notifyJs
  </body>
</html>
