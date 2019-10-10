<style>
  a {
    color: black;
  }

  a:link {
    text-decoration: none;
  }

  a:visited {
    text-decoration: none;
  }

  a:hover {
    text-decoration: none;
    color: black;
  }

  a:active {
    text-decoration: none;
  }

  /*  .w3-container:hover {
    cursor: pointer;
  }*/

  p {
    padding-left: 10px;
    padding-right: 10px;
  }

  h3 {
    font-weight: bolder;
    padding-left: 10px;
    padding-right: 10px;
  }

  .carousel-inner>img {
    width: 640px;
    height: 360px;
  }
</style>
<!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
<div class="main-header" data-background-color="purple">
  <!-- Logo Header -->
  <div class="logo-header mt-1">
    <a href="{{ url('/catalogue') }}" class="logo">
      <img src="{{asset('storage/primajaya.jpg')}}" alt="navbar brand" class="navbar-brand" style="width:100%;height:50px">  
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false"
      aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
              <i class="fa fa-bars"></i>
            </span>
          </button>
    <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
    <div class="navbar-minimize">
      <button class="btn btn-minimize btn-rounded">
              <i class="fa fa-bars"></i>
            </button>
    </div>
  </div>
  <!-- End Logo Header -->

  <!-- Navbar Header -->
  <nav class="navbar navbar-header navbar-expand-lg">

    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center mb-1 mt-1">
        <li>
          @guest
          <li class="nav-item dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
              <div class="avatar-sm">
                <img src="{{asset('storage/profile.jpg')}}" alt="Login" class="avatar-img rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <li>
                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
              <li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
              @endif
            </ul>
          </li>
          @endguest
        </li>

      </ul>

    </div>
  </nav>
  <!-- End Navbar -->
</div>