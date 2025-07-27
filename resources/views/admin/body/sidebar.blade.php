<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="index.html" class="tp-link">Analytical</a>
                            </li>
                            <li>
                                <a href="ecommerce.html" class="tp-link">E-commerce</a>
                            </li>
                        </ul>
                    </div>
                </li>








                <li class="menu-title">Product Management</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.products.index') }}" class="tp-link">Product List</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.create') }}" class="tp-link">Add New Product</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title mt-2">General Setup</li>

                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Base Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.categories.index') }}" class="tp-link">All Category</a>
                                <a href="{{ route('admin.customers.index') }}" class="tp-link">All customer</a>
                                <a href="{{ route('admin.suppliers.index') }}" class="tp-link">All Suppliers</a>
                                <a href="{{ route('admin.warehouses.index') }}" class="tp-link">All Ware Houses</a>
                                <a href="{{ route('admin.brands.index') }}" class="tp-link">Brands Management</a>
                                <a href="{{ route('admin.units.index') }}" class="tp-link">Unit Management</a>
                                <a href="{{ route('admin.colors.index') }}" class="tp-link">Color Management</a>
                                <a href="{{ route('admin.sizes.index') }}" class="tp-link">Size Management</a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
