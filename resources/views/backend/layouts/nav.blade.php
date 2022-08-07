<nav class="navbar clearHeader">
    <div class="col-12">
        <div class="navbar-header"> <a href="javascript:void(0);" class="bars"><i class='bx bxs-invader'></i></a><a
                class="navbar-brand" href="{{ route('admin') }}">Admin</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('home') }}" target='_black'><i class='bx bx-home-alt-2'></i></a></li>
            <li><a class="mega-menu" data-close="true" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-power-off'></i>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true">
                    <i class='bx bx-dots-vertical-rounded'></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
