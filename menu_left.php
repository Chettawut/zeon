<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo PATH; ?>" class="brand-link">
        <img src="<?php echo PATH; ?>/img/logo_fb.png" class="brand-image img-circle elevation-3"
            style="background-color:white;">
        <span class="brand-text font-weight-light">Demo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo PATH; ?>/img/default.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Chayapat Niropas</a>
            </div>
        </div>

        <nav class="mt-2" id="sideStore" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/rr" class="nav-link">
                        <i class="nav-icon fa fa-truck-loading"></i>
                        <p>
                            ใบรับสินค้า (Goods Receipt)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/wd" class="nav-link">
                        <i class="nav-icon fas fa-light fa-cubes"></i>
                        <p>
                            ใบเบิกสินค้า (Goods Issued)
                        </p>
                    </a>
                </li>
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/inventory" class="nav-link">
                        <i class="nav-icon fa fa-cube"></i>
                        <p>
                            วัสดุพื้นฐาน (Inventory)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/unit" class="nav-link">
                        <i class="nav-icon 	fa fa-tag"></i>
                        <p>
                            หน่วยวัสดุ (Unit)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/warehouse" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            คลังสินค้า (Warehouse)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/project" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>
                            Cost Project
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/store/reports" class="nav-link">
                        <i class="nav-icon 	fa fa-book"></i>
                        <p>
                            รายงาน (Reports)
                        </p>
                    </a>
                </li>


            </ul>
        </nav>

        <nav class="mt-2" id="sidePurchase" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/purchase/pr" class="nav-link">
                        <i class="nav-icon fas fa-light fa-bullhorn"></i>
                        <p>
                            ใบแจ้งซื้อ (PR)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/purchase/pr_approve" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>
                            อนุมัติใบแจ้งซื้อ (Approve PR)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/purchase/po" class="nav-link">
                        <i class="nav-icon fas fa-light fa-book"></i>
                        <p>
                            ใบสั่งซื้อ (PO)
                        </p>
                    </a>
                </li>
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/purchase/supplier" class="nav-link">
                        <i class="nav-icon fas fa fa-shopping-cart"></i>
                        <p>
                            ผู้ขาย (Supplier)
                        </p>
                    </a>
                </li>


            </ul>
        </nav>

        <nav class="mt-2" id="sideHR" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/hr/time" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            จัดการเวลาทำงาน (Time attendance)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/hr/payroll" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            ระบบบัญชีเงินเดือน (PayRoll)
                        </p>
                    </a>
                </li>
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/hr/person" class="nav-link">
                        <i class="nav-icon fas fa fa-users"></i>
                        <p>
                            บุคคล (HR)
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <nav class="mt-2" id="sideSale" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/sale/so" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                            เปิดใบสั่งขาย (Sale Order)
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="mt-2" id="sideProduct" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/product/wo" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            ใบสั่งงานผลิต (Work Order)
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="mt-2" id="sidePlanner" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/planner/wo" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            ใบสั่งงานผลิต (Work Order)
                        </p>
                    </a>
                </li>
                


            </ul>
        </nav>

        <nav class="mt-2" id="sideEngineer" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/engineer/bom" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            สูตรการผลิต (Bill of Materials)
                        </p>
                    </a>
                </li>
            </ul>
        </nav>


        <nav class="mt-2" id="sideQC" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/qc/oqc" class="nav-link">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            ทดสอบคุณภาพส่งออก (OQC)
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="mt-2" id="sideWarehouse" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/warehouse/gr" class="nav-link">
                        <i class="nav-icon fas fa-truck-loading"></i>
                        <p>
                            รับสินค้า (Goods Receipt )
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/warehouse/shipment" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            การส่งสินค้า (Shipment)
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="mt-2" id="sideAccounting" style="display:none;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Systems</li>
                <li class="nav-item">
                    <a href="<?php echo PATH; ?>/account/invoice" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            ออกใบกำกับภาษี (Invoice)
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>