<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.activities.index") }}" class="nav-link {{ request()->is('admin/activities') || request()->is('admin/activities/*') ? 'active' : '' }}">
                    <i class="fa fa-cubes nav-icon">

                    </i>
                    {{ trans('global.activity.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.blogs.index") }}" class="nav-link {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}">
                    <i class="fa fa-rss-square nav-icon"></i>
                    {{ trans('global.blog.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.booking.index')}}" class="nav-link {{ request()->is('admin/booking') || request()->is('admin/booking/*') ? 'active' : '' }}">
                    <i class="fa fa-cart-arrow-down nav-icon">

                    </i>
                    {{ trans('global.booking.title') }}
                </a>
            </li>
            <!--currency-->
            <li class="nav-item">
                <a href="{{ route("admin.currencies.index") }}" class="nav-link {{ request()->is('admin/currencies') || request()->is('admin/currencies/*') ? 'active' : '' }}">
                    <i class="fas fa-euro nav-icon">

                    </i>
                    {{ trans('global.currency.title') }}
                </a>
            </li>
            <!--currency end-->
            <li class="nav-item">
                <a href="{{ route("admin.destinations.index") }}" class="nav-link {{ request()->is('admin/destinations') || request()->is('admin/destinations/*') ? 'active' : '' }}">
                    <i class="fa fa-map-marker nav-icon">

                    </i>
                    {{ trans('global.destination.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.inqueries") }}" class="nav-link {{ request()->is('admin/inqueries') || request()->is('admin/inqueries/*') ? 'active' : '' }}">
                    <i class="fa fa-envelope nav-icon"></i>
                    {{ trans('global.inquery.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.itineraries.index") }}" class="nav-link {{ request()->is('admin/itineraries') || request()->is('admin/itineraries/*') ? 'active' : '' }}">
                    <i class="fa fa-database nav-icon">

                    </i>
                    {{ trans('global.itinerary.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.paymentSettings") }}" class="nav-link {{ request()->is('admin/paymentSettings') || request()->is('admin/paymentSettings/*') ? 'active' : '' }}">
                    <i class="fas fa-wrench nav-icon">

                    </i>
                    {{ trans('global.paymentSetting.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.transections.index") }}" class="nav-link {{ request()->is('admin/transections') || request()->is('admin/transections/*') ? 'active' : '' }}">
                    <i class="fas fa-money nav-icon">

                    </i>
                    {{ trans('global.transection.title') }}
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fas fa-users nav-icon">

                    </i>
                    {{ trans('global.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('global.permission.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('global.role.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon">

                            </i>
                            {{ trans('global.user.title') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>