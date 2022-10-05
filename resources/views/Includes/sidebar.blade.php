<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <!--i class="fas fa-laugh-wink"></i-->
        </div>
        <div class="sidebar-brand-text mx-3">BF-App<sup>1.0</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::currentRouteName() == "dashboard" ? 'active' : '' }}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ Route::currentRouteName() == "booking" ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('booking.index') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Booking</span></a>
    </li>

    <li class="nav-item {{ in_array(Route::currentRouteName(),['member.index','member.edit','member.create']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('member.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Member</span></a>
    </li>

    <li class="nav-item {{ in_array(Route::currentRouteName(),['fields.index','fields.create','fields.edit']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('fields.index') }}">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Field</span></a>
    </li>

    <li class="nav-item {{ Route::currentRouteName() == "users" ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Users</span></a>
    </li>



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
