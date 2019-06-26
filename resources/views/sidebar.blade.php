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
                  @if(Auth::user()->admin==1)
                    <span class="user-level">Administrator</span>
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
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                                          <span class="link-collapse">{{ __('Logout') }}</span>
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        @endguest
      </ul>
      <ul class="nav">
        <li class="nav-item active">
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
          <a href="#base">
                  <i class="la flaticon-shopping-bag" style="font-size:25px"></i>
                  <p>Keranjang Belanja</p>
                </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->