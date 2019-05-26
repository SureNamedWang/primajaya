<div id="wrapper">

  <!-- Sidebar -->
  <ul class="sidebar navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{route('catalogue.index')}}">
        <i class="fas fa-fw fa-tags"></i>
        <span>Catalogue</span>
      </a>
    </li>
    @if(isset($user))
    <div class="dropdown-divider"></div>
    @if($user->admin==0)
    <li class="nav-item">
      <a class="nav-link" href="{{route('cart.index')}}">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Keranjang Belanja</span>
      </a>
    </li>
    @endif
    <li class="nav-item">
      <a class="nav-link" href="{{route('orders.index')}}">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>List Order</span>
      </a>
    </li>
    @if(isset($user))
    @else
    <li class="nav-item">
      <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-user"></i>
        <span>Login/Register</span></a>
      </li>
      @endif
    @endif
      @if(isset($user) and $user->admin==101))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Orders</span>
        </a>

        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="login.html">List Order</a>
          <a class="dropdown-item" href="login.html">Pembayaran</a>
          <a class="dropdown-item" href="register.html">Produksi</a>
        </div>
      </li>
      @endif
    </ul>
    <div id="content-wrapper">

      <div class="container-fluid">
