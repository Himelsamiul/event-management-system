<nav class="navbar main-nav border-less fixed-top navbar-expand-lg p-0">
  <div class="container-fluid p-0">
    <!-- logo -->
    <a class="navbar-brand" href="index.html">
      <img src="{{url('templateImage/logo.png')}}" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{route('home.page')}}">Home<span></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('all.events')}}">Packages<span></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('all.customize.events')}}">Customize Booking<span></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('sample.work')}}">Sample Work<span></span></a>
        </li>    
        <li class="nav-item">
          <a class="nav-link" href="{{route('create.appointment')}}">Appointment<span></span></a>
        </li>
        
        </ul>
     
      @auth('customerGuard')
      <a style="color:black;" href="{{route('logout')}}" class="ticket">Logout<a style="color:black;" class="ticket">|</a></a>

      <a href="{{route('view.profile')}}" class="ticket" style="color:black;">
    {{auth('customerGuard')->user()->name}}
      </a>

      @endauth

      @guest('customerGuard')
      <a style="color:black;" href="{{route('login')}}" class="ticket">Login<a style="color:black;" class="ticket">|</a></a>

      <a style="color:black;" href="{{route('registration')}}" class="ticket">Registration</a>

      @endguest     

    </div>
  </div>
</nav>