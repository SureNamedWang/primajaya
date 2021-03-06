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
        {{--
        <li class="nav-item dropdown hidden-caret">
          <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
                  <i class="fa fa-envelope"></i>
                </a>
          <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
            <li>
              <div class="dropdown-title d-flex justify-content-between align-items-center">
                Messages
                <a href="#" class="small">Mark all as read</a>
              </div>
            </li>
            <li>
              <div class="message-notif-scroll scrollbar-outer">
                <div class="notif-center">
                  <a href="#">
                    <div class="notif-img">
                      <img src="../assets/img/jm_denis.jpg" alt="Img Profile">
                    </div>
                    <div class="notif-content">
                      <span class="subject">Jimmy Denis</span>
                      <span class="block">
                              How are you ?
                            </span>
                      <span class="time">5 minutes ago</span>
                    </div>
                  </a>
                  <a href="#">
                    <div class="notif-img">
                      <img src="../assets/img/chadengle.jpg" alt="Img Profile">
                    </div>
                    <div class="notif-content">
                      <span class="subject">Chad</span>
                      <span class="block">
                              Ok, Thanks !
                            </span>
                      <span class="time">12 minutes ago</span>
                    </div>
                  </a>
                  <a href="#">
                    <div class="notif-img">
                      <img src="../assets/img/mlane.jpg" alt="Img Profile">
                    </div>
                    <div class="notif-content">
                      <span class="subject">Jhon Doe</span>
                      <span class="block">
                              Ready for the meeting today...
                            </span>
                      <span class="time">12 minutes ago</span>
                    </div>
                  </a>
                  <a href="#">
                    <div class="notif-img">
                      <img src="../assets/img/talha.jpg" alt="Img Profile">
                    </div>
                    <div class="notif-content">
                      <span class="subject">Talha</span>
                      <span class="block">
                              Hi, Apa Kabar ?
                            </span>
                      <span class="time">17 minutes ago</span>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li>
              <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown hidden-caret">
          <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  <span class="notification">4</span>
                </a>
          <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
            <li>
              <div class="dropdown-title">You have 4 new notification</div>
            </li>
            <li>
              <div class="notif-scroll scrollbar-outer">
                <div class="notif-center">
                  <a href="#">
                    <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                    <div class="notif-content">
                      <span class="block">
                              New user registered
                            </span>
                      <span class="time">5 minutes ago</span>
                    </div>
                  </a>
                  <a href="#">
                    <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                    <div class="notif-content">
                      <span class="block">
                              Rahmad commented on Admin
                            </span>
                      <span class="time">12 minutes ago</span>
                    </div>
                  </a>
                  <a href="#">
                    <div class="notif-img">
                      <img src="../assets/img/profile2.jpg" alt="Img Profile">
                    </div>
                    <div class="notif-content">
                      <span class="block">
                              Reza send messages to you
                            </span>
                      <span class="time">12 minutes ago</span>
                    </div>
                  </a>
                  <a href="#">
                    <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                    <div class="notif-content">
                      <span class="block">
                              Farrah liked Admin
                            </span>
                      <span class="time">17 minutes ago</span>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li>
              <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
            </li>
          </ul>
        </li> --}}
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