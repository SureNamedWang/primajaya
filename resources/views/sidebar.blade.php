<!-- Sidebar -->
<div class="sidebar">

  <div class="sidebar-background"></div>
  <div class="sidebar-wrapper scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav">
        @guest @else
        <div class="user">
          <div class="avatar-sm float-left mr-2">
            <img src="{{asset('storage/profile.jpg')}}" alt="avatar" class="avatar-img rounded-circle">
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                  <span>
                  {{ Auth::user()->name }}
                  @if(Auth::user()->admin=='Admin')
                    <span class="user-level">Administrator</span>
                  @elseif(Auth::user()->admin=='Pemilik')
                    <span class="user-level">Owner</span>
                  @elseif(Auth::user()->admin=='User')
                    <span class="user-level">User</span>
                  @endif
                    <span class="caret"></span>
                  </span>
                </a>
            <div class="clearfix"></div>

            <div class="collapse in" id="collapseExample">
              <ul class="nav">
                <li>
                  <a href="#profile">
                        <span class="link-collapse">My Profile</span>
                      </a>
                </li>
                <li>
                  <a href="#edit">
                        <span class="link-collapse">Edit Profile</span>
                      </a>
                </li>
                {{-- <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                                          <span class="link-collapse">{{ __('Logout') }}</span>
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </li> --}}
              </ul>
            </div>
          </div>
        </div>
        @endguest
      </ul>
      <ul class="nav">
        <li class="nav-item">
          <a href="{{route('catalogue.index')}}">
            <i class="la flaticon-store" style="font-size:25px"></i>
            <p>Store</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
          <h4 class="text-section">Menu</h4>
        </li>
        <li class="nav-item">
          <a href="{{route('cart.index')}}">
            <i class="la flaticon-shopping-bag" style="font-size:25px"></i>
            <p>Keranjang Belanja</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('orders.index')}}">
            <i class="la flaticon-file-1" style="font-size:25px"></i>
            <p>Orders</p>
          </a>
        </li>
        @isset($user)
        @if($user->admin!='User')
        <li class="nav-item">
          <a href="{{route('barang.index')}}">
            <i class="la flaticon-box-1" style="font-size:25px"></i>
            <p>Barang</p>
          </a>
        </li>
        @endif
        @if($user->admin=="Pemilik")
        <li class="nav-item">
          <a href="{{route('karyawan.index')}}">
            <i class="la flaticon-users" style="font-size:25px"></i>
            <p>Karyawan</p>
          </a>
        </li>
        @endif
        @endisset
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->