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

                <li>
                    <a href="#sidebarBrands" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Brands Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBrands" data-bs-toggle="collapse">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.brands.index') }}" class="tp-link">All Brands</a>
                            </li>
                            <li>
                                <a href="#" class="tp-link">Add New Brand</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarWarehouses" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Ware Houses </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarWarehouses" data-bs-toggle="collapse">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.warehouses.index') }}" class="tp-link">All Ware Houses</a>
                            </li>
                            <li>
                                <a href="#" class="tp-link">Add New Ware House</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarSuppliers" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Suppliers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSuppliers" data-bs-toggle="collapse">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.suppliers.index') }}" class="tp-link">All Suppliers</a>
                            </li>
                            <li>
                                <a href="#" class="tp-link">Add New Supplier</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCustomer" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Customer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCustomer" data-bs-toggle="collapse">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.customers.index') }}" class="tp-link">All customer</a>
                            </li>
                            <li>
                                <a href="#" class="tp-link">Add New customer</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCategory" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCategory" data-bs-toggle="collapse">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.categories.index') }}" class="tp-link">All Category</a>
                            </li>
                            <li>
                                <a href="#" class="tp-link">Add New Category</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title">Pages</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Authentication </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="auth-login.html" class="tp-link">Log In</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="menu-title mt-2">General</li>

                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Components </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="ui-accordions.html" class="tp-link">Accordions</a>
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
