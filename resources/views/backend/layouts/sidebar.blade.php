<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li>
                <!-- User Info -->
                <div class="user-info">
                    <div class="admin-image">
                        @if (auth()->user()->photo)
                                <img src="{{ auth()->user()->photo }}" alt="avatar">
                        @else
                                <img src="{{ Helper::userDefaultImage() }}" alt="avatar">
                        @endif
                    </div>
                    <div class="admin-action-info"> <span>Welcome</span>
                        <h3>{{ auth()->user()->full_name }}</h3>
                    </div>
                </div>
                <!-- #User Info -->
            </li>
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ \Request::is('admin') ? 'open active' : '' }}"> <a href="{{ route('admin') }}"
                    class="menu-toggle"><i class='bx bxs-dashboard'></i><span>Dashboard</span> </a>


            </li>
            <li
                class="{{ \Request::is('admin/banner') ? 'open active' : (\Request::is('admin/banner/create') ? 'open active' : '') }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="fa-solid fa-image"></i><span>Banner
                        Management</span> </a>
                <ul class="ml-menu">
                    <li class="{{ \Request::is('admin/banner') ? 'active' : '' }}"> <a
                            href="{{ route('banner.index') }}">All banners</a></li>
                    <li class="{{ \Request::is('admin/banner/create') ? 'active' : '' }}"> <a
                            href="{{ route('banner.create') }}">Add banner</a></li>
                </ul>
            </li>
            <li
                class="{{ \Request::is('admin/user') ? 'open active' : (\Request::is('admin/user/create') ? 'open active' : '') }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="fa-solid fa-user"></i>
                    <span>User Management</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ \Request::is('admin/user') ? 'active' : '' }}"> <a
                            href="{{ route('user.index') }}">All users</a></li>
                    <li class="{{ \Request::is('admin/user/create') ? 'active' : '' }}"> <a
                            href="{{ route('user.create') }}">Add user</a></li>
                </ul>
            </li>
            <li
                class="{{ \Request::is('admin/category') ? 'open active' : (\Request::is('admin/category/create') ? 'open active' : '') }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="fa-solid fa-folder-tree"></i><span>Category
                        Management</span> </a>
                <ul class="ml-menu">
                    <li class="{{ \Request::is('admin/category') ? 'active' : '' }}"> <a
                            href="{{ route('category.index') }}">All categories</a></li>
                    <li class="{{ \Request::is('admin/category/create') ? 'active' : '' }}"> <a
                            href="{{ route('category.create') }}">Add category</a></li>
                </ul>
            </li>
            <li
                class="{{ \Request::is('admin/brand') ? 'open active' : (\Request::is('admin/brand/create') ? 'open active' : '') }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="fa-brands fa-apple"></i><span>Publisher
                        Management</span> </a>
                <ul class="ml-menu">
                    <li class="{{ \Request::is('admin/brand') ? 'active' : '' }}"> <a
                            href="{{ route('brand.index') }}">All publishers</a></li>
                    <li class="{{ \Request::is('admin/brand/create') ? 'active' : '' }}"> <a
                            href="{{ route('brand.create') }}">Add publisher</a></li>
                </ul>
            </li>
            <li
                class="{{ \Request::is('admin/product') ? 'open active' : (\Request::is('admin/product/create') ? 'open active' : '') }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="fa-solid fa-plus"></i><span>Products
                        Management</span> </a>
                <ul class="ml-menu">
                    <li class="{{ \Request::is('admin/product') ? 'active' : '' }}"> <a
                            href="{{ route('product.index') }}">All products</a></li>
                    <li class="{{ \Request::is('admin/product/create') ? 'active' : '' }}"> <a
                            href="{{ route('product.create') }}">Add product</a></li>
                </ul>
            </li>
            <li
                class="{{ \Request::is('admin/coupon') ? 'open active' : (\Request::is('admin/coupon/create') ? 'open active' : '') }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Coupon Management</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ \Request::is('admin/coupon') ? 'active' : '' }}"> <a
                            href="{{ route('coupon.index') }}">All coupon</a></li>
                    <li class="{{ \Request::is('admin/coupon/create') ? 'active' : '' }}"> <a
                            href="{{ route('coupon.create') }}">Create coupon</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('order.index') }}"
                    class="menu-toggle {{ \Request::is('admin/order') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Order Management</span>
                </a>
            </li>
        </ul>
    </div>
</aside>