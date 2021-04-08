<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các danh mục">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Các danh mục</span>
            </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Khách sạn, nhà nghỉ, homestay">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers"
               data-parent="#mylistings">
                <i class="fa fa-fw fa-unlock-alt"></i>
                <span class="nav-link-text">Quản lí tài khoản</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseUsers">
                <li>
                    <a href="{{ route('admin.users.index') }}">Danh sách</a>
                </li>
            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Địa điểm du lịch">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAttractions"
               data-parent="#mylistings">
                <i class="fa fa-fw fa-map-marker"></i>
                <span class="nav-link-text">Địa điểm tham quan</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseAttractions">
                <li>
                    <a href="{{ route('admin.attractions.index') }}">Danh sách tham quan</a>
                </li>
                <li>
                    <a href="listings.html">Thống kê <span class="badge badge-pill badge-primary">6</span></a>
                </li>
            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Khách sạn, nhà nghỉ, homestay">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAccommodations"
               data-parent="#mylistings">
                <i class="fa fa-fw fa-home"></i>
                <span class="nav-link-text">Địa điểm nghỉ ngơi</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseAccommodations">
                <li>
                    <a href="{{ route('admin.accommodations.index') }}">Danh sách nơi nghỉ</a>
                </li>
                <li>
                    <a href="listings.html">Thống kê <span class="badge badge-pill badge-primary">6</span></a>
                </li>
            </ul>
        </li>

    </ul>
    <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
                <i class="fa fa-fw fa-angle-left"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-envelope"></i>
                <span class="d-lg-none">Messages
                  <span class="badge badge-pill badge-primary">12 New</span>
                </span>
                <span class="indicator text-primary d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">New Messages:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <strong>David Miller</strong>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome!
                        These messages clip off when they reach the end of the box so they don't overflow over to
                        the sides!
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <strong>Jane Smith</strong>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00
                        instead of 4:00. Thanks!
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <strong>John Doe</strong>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">I've sent the final files over to you for review. When
                        you're able to sign off of them let me know and we can discuss distribution.
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all messages</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i>
                <span class="d-lg-none">Alerts
                  <span class="badge badge-pill badge-warning">6 New</span>
                </span>
                <span class="indicator text-warning d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">New Alerts:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                      <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">This is an automated server response message. All systems
                        are online.
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-danger">
                    <strong>
                      <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                  </span>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">This is an automated server response message. All systems
                        are online.
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                      <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                    <span class="small float-right text-muted">11:21 AM</span>
                    <div class="dropdown-message small">This is an automated server response message. All systems
                        are online.
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all alerts</a>
            </div>
        </li>
        <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
                <div class="input-group">
                    <input class="form-control search-top" type="text" placeholder="Tìm kiếm...">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Đăng xuất</a>
        </li>
    </ul>
</div>
