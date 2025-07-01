
    
            <nav class="navbar navbar-expand-lg main-navbar bg-maroon justify-content-between">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
    <li class="nav-item dropdown">
        <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if(!empty(get_setting()))
                <img alt="logo" src="{{ URL::asset('public/upload/admin/setting/')}}/{{ get_setting()->logo }}" class="rounded-circle mr-1" />
            @else
                <img alt="logo-avtar" src="{{ URL::asset('/public/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1" />
            @endif
            <span class="d-sm-none d-lg-inline-block">Hello, {{ ucfirst(Auth()->user()->name) }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li><a href="{{ url('/Auth/resetpassword') }}" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Change Password</a></li>
        </ul>
    </li>
</ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

            </nav>
