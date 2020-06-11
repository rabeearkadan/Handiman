<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">

{{--        <a href="#hero"><img src="../../../../public/img/logo.png" alt="" title=""/></a>--}}

        <div class="logo-src"></div>

        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                        <span>
                            <button type="button"
                                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">

                {{--              block   1   --}}
                <li class="app-sidebar__heading">System</li>

                <li>
                    <a href="{{route('service.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Services
                    </a>
                </li>

                {{--              block  2    --}}
                <li class="app-sidebar__heading">Users</li>

                <li>
                    <a href="{{route('client.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Clients
                    </a>
                </li>
                <li>

                    <a href="{{route('employee.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Employees
                    </a>
                </li>
                <li class="app-sidebar__heading">Requests
                </li>

                <li>
                    <a href="{{route('request.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Monitor Ongoing Requests
                    </a>
                </li>

                <li>
                    <a href="{{route('report.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Request's Reports
                    </a>
                </li>


                <li class="app-sidebar__heading">Statistics</li>

                <li>
                    <a href="{{route('statistics.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{route('statistics.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Services
                    </a>
                </li>

                <li>
                    <a href="{{route('statistics.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Requests
                    </a>
                </li>
                <li class="app-sidebar__heading">Contacted Us</li>

                <li>
                    <a href="{{route('contact.index')}}" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Messages
                    </a>
                </li>

                <li class="app-sidebar__heading">Reports & Blocking</li>
                <li>
                    <a href="" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Reports
                    </a>
                </li>
                <li>
                    <a href="" class="mm">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Blocking
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
