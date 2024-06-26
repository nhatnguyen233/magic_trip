<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ route('host.index') }}">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Điều phối</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
            <a class="nav-link" href="#">
                <i class="fa fa-fw fa-envelope-open"></i>
                <span class="nav-link-text">Tin nhắn</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các tours du lịch">
            <a class="nav-link" href="{{ route('host.attractions.index') }}">
                <i class="fa fa-fw fa-map-marker"></i>
                <span class="nav-link-text">Địa điểm tham quan</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các tours du lịch">
            <a class="nav-link" href="{{ route('host.accommodations.index') }}">
                <i class="fa fa-fw fa-home"></i>
                <span class="nav-link-text">Địa điểm nghỉ ngơi</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các tours du lịch">
            <a class="nav-link" href="{{ route('host.tours.index') }}">
                <i class="fa fa-fw fa-suitcase"></i>
                <span class="nav-link-text">Tours du lịch</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các tours du lịch">
            <a class="nav-link" href="{{ route('host.schedules.index') }}">
                <i class="fa fa-fw fa-calendar"></i>
                <span class="nav-link-text">Thiết lập lịch Tour</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bookings">
            <a class="nav-link" href="{{ route('host.bookings.index') }}">
                <i class="fa fa-fw fa-calendar-check-o"></i>
                <span class="nav-link-text">Quản lý Bookings</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các tours du lịch">
            <a class="nav-link" href="{{ route('host.reviews.index') }}">
                <i class="fa fa-fw fa-star"></i>
                <span class="nav-link-text">Đánh giá, nhận xét</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Các tours du lịch">
            <a class="nav-link" href="{{ route('host.bills.index') }}">
                <i class="fa fa-fw fa-file"></i>
                <span class="nav-link-text">Lập hóa đơn</span>
            </a>
        </li>
{{--        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Thông tin cá nhân">--}}
{{--            <a class="nav-link" href="user-profile.html">--}}
{{--                <i class="fa fa-fw fa-user"></i>--}}
{{--                <span class="nav-link-text">Thông tin cá nhân</span>--}}
{{--            </a>--}}
{{--        </li>--}}
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
