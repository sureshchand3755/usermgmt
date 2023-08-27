
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="{{ URL::to('images/'.Auth::user()->avatar) }}" width="20" alt="">
                    <div class="header-info ms-3">
                        <span class="font-w600 ">Hi,<b>{{ Auth::user()->name }}</b></span>
                        <small class="text-end font-w400">{{ Auth::user()->email }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ms-2">Logout </span>
                    </a>
                </div>
            </li>

            <li><a href="{{ route('user/list') }}"><i class="flaticon-025-dashboard"></i><span class="nav-text">User Management</span></a></li>

        </li>
        </ul>
    </div>
</div>
