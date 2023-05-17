<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
        <a href="<?php echo PATH; ?>/backend/" class="brand-link bg-purple">
            <img src="<?php echo PATH; ?>/backend/img/logo_fb.png" class="brand-image img-circle elevation-3" <span
                class="brand-text font-weight-light">
                <span class="brand-text font-weight-light">Demo</span>
                
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo PATH; ?>/backend/img/default.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?> </a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-header">Systems</li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/sales/so" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Sales forecast
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/production/pp" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                            Production Plan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/production/wo" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Work order
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/store/gr" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                            Goods Receipt
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Data</li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/store/inventory" class="nav-link">
                            <i class="nav-icon fa fa-cube"></i>
                            <p>
                                Inventory
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/store/supplier" class="nav-link">
                            <i class="nav-icon fa fa-cube"></i>
                            <p>
                            Supplier
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/engineer/bom" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Bill of Materials
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/unit" class="nav-link">
                            <i class="nav-icon fas fas fa-box"></i>
                            <p>
                                Unit
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Reports</li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/reports/MSF01" class="nav-link">
                            <i class="nav-icon fas  fa-file-alt"></i>
                            <p>
                                Monthly Sales Forecast
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo PATH; ?>/backend/reports/RFM01" class="nav-link">
                            <i class="nav-icon fas fa-paste "></i>
                            <p>
                            Reservation Of Material
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>


            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>