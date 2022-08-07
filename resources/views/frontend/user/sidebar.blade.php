<div class="sidebar-account pixel-corners bg-account">
    <ul>
        <li class="{{ \Request::is('user/dashbaord') ? 'active' : '' }}">
            <a href="{{ route('user.dashbaord') }}"><i class='bx bxs-dashboard'></i>Dashbaord</a>
        </li>
        <li class="{{ \Request::is('user/account') ? 'active' : '' }}">
            <a href="{{ route('user.account') }}"><i class='bx bxs-user-detail'></i>Account details</a>
        </li>
        <li class="{{ \Request::is('user/logout') ? 'active' : '' }}">
            <a href="{{ route('user.logout') }}"><i class='bx bx-log-out'></i>Logout</a>
        </li>
    </ul>
</div>
