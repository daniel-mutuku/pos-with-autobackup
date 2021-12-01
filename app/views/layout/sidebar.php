<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url();?>dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-cart-arrow-down"></i>
                </div>
                <div class="sidebar-brand-text mx-3">POS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>dashboard">
                    <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                My Shop
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventory"
                    aria-expanded="true" aria-controls="inventory">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Inventory</span>
                </a>
                <div id="inventory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/listproducts" id="products">Products</a>
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/categories" id="categories">Categories</a>
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/warehouses" id="warehouses">Warehouses</a>
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/purchases" id="purchases">Purhases</a>
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/stockreturns" id="stockreturns">Stock Return</a>
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/suppliers" id="suppliers">Suppliers</a>
                        <a class="collapse-item" href="<?php echo base_url();?>inventory/supplierpmts" id="supplierpmts">Supplier Payments</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales"
                   aria-expanded="true" aria-controls="sales">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Sales</span>
                </a>
                <div id="sales" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url();?>sales/possales" id="possales">POS Sales</a>
                        <a class="collapse-item" href="<?php echo base_url();?>sales/creditsales" id="creditsales">Credit Sales</a>
                        <a class="collapse-item" href="<?php echo base_url();?>sales/cashsales" id="cashsales">Cash Sales</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#crm"
                   aria-expanded="true" aria-controls="crm">
                    <i class="fas fa-shopping-bag"></i>
                    <span>CRM</span>
                </a>
                <div id="crm" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url();?>crm/clients" id="clients">Clients</a>
                        <a class="collapse-item" href="<?php echo base_url();?>crm/clientpmts" id="clientpmts">Client Payments</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administration
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hrm"
                   aria-expanded="true" aria-controls="hrm">
                    <i class="fas fa-shopping-bag"></i>
                    <span>HRM</span>
                </a>
                <div id="hrm" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url();?>hrm/employees" id="employees">Employees</a>
                        <a class="collapse-item" href="<?php echo base_url();?>hrm/roles" id="roles">Roles</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">