<div class="app-header header sticky" style="margin-bottom: -74px;">
    <div class="container-fluid main-container">
        <div class="d-flex"> <a aria-label="Hide Sidebar" class="app-sidebar__toggle"
                data-bs-toggle="sidebar" href="javascript:void(0)"></a> <!-- sidebar-toggle--> <a
                class="logo-horizontal " href="index.html"> <img src="{{asset('assets/images/logo.png')}}"
                    class="header-brand-img desktop-logo" alt="logo"> <img
                    src="{{asset('assets/images/logo.png')}}" height="70px" class="header-brand-img light-logo1"
                    alt="logo"> </a> <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <button
                    class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation"> <span
                        class="navbar-toggler-icon fe fe-more-vertical"></span> </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex"> <a href="javascript:void(0)"
                                    class="nav-link icon" data-bs-toggle="dropdown"> <i
                                        class="fe fe-search"></i> </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2"> <input type="text"
                                            class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary"> <i
                                                class="fa fa-search" aria-hidden="true"></i> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown d-flex profile-1"> 
                                <a href="javascript:void(0)"
                                    data-bs-toggle="dropdown" class="nav-link leading-none d-flex"> 
                                    <img src="{{fotoAkun()}}" alt="profile-user"
                                        class="avatar  profile-user brround cover-image"> 
                                    </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{auth()->user()->nama}}
                                            </h5> <small class="text-muted">Operator</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div> 
                                    <a class="dropdown-item"
                                        {{-- href="profile.html"> <i class="dropdown-icon fe fe-user"></i>
                                        Profile </a>  --}}
                                        {{-- <a class="dropdown-item" href="email-inbox.html">
                                        <i class="dropdown-icon fe fe-mail"></i> Inbox <span
                                            class="badge bg-danger rounded-pill float-end">5</span> </a>
                                    <a class="dropdown-item" href="lockscreen.html"> <i
                                            class="dropdown-icon fe fe-lock"></i> Lockscreen </a>  --}}
                                    <a class="dropdown-item" href="{{route('logout')}}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="dropdown-icon fe fe-alert-circle"></i> {{__('Sign out')}}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    {{-- <a class="dropdown-item" href="login.html"> <i
                                            class="dropdown-icon fe fe-alert-circle"></i> Sign out </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>