<?php
include_once('../../conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ใบแจ้งซื้อ (Purchase Requisition)</title>

    <?php 
    include_once('css.php'); 
    include_once('../../config.php');
    include_once ROOT .'/func.php';
    include_once ROOT .'/import_css.php';
    ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo PATH; ?>/AdminLTE-3.2.0/dist/img/AdminLTELogo.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <?php include_once ROOT . '/menu_head.php'; ?>

        <?php include_once ROOT . '/menu_left.php'; ?>



        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">ใบแจ้งซื้อ (Purchase Requisition)</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Purchase</a></li>
                                <li class="breadcrumb-item active">Purchase Requisition</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <form data-ajax="false" target="_blank" method="post">
                                <div data-role="fieldcontain">

                                    <div class="btn-group" id="btnAddSO" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_add"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มใบแจ้งซื้อ</button>
                                    </div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fas fa-sync-alt" aria-hidden="true"></i> </button>
                                    <button type="button" id="btnCancle" style="display:none;" class="btn btn-danger"><i
                                            class="fa fa-check-circle" aria-hidden="true"></i>
                                        ยกเลิกใบสั่งขาย</button>
                                    <button type="submit" formaction="invoice-print.php" id="btnPrint"
                                        style="display:none;" class="btn btn-primary"><i class="fa fa-print"
                                            aria-hidden="true"></i> Print ใบสั่งซื้อ </button>
                                    <input type="hidden" id="printsocode" class="btn btn-default" name="printsocode"
                                        value="John">
                                    <input type="hidden" id="editsalecode" class="btn btn-default" value="John">

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <table name="tablePR" id="tablePR" class="table table-bordered table-striped">
                                <thead style=" background-color:#D6EAF8;">
                                    <tr>                                        
                                        <th width="15%">เลขที่ใบแจ้งซื้อ</th>
                                        <th width="15%">วันที่แจ้งซื้อ</th>
                                        <th width="15%">รหัสพัสดุ</th>
                                        <th width="15%">ชื่อรายการ</th>
                                        <th width="15%">จำนวนแจ้งซื้อ</th>                                        
                                        <th width="15%">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php 
        include_once('modal/modal_add.php');
        include_once('modal/modal_edit.php');
        include_once('modal/modal_stock.php');
        include_once('modal/modal_supplier.php');   
        include_once('modal/modal_unit.php');        
        ?>
        
    </div>
    <?php
    include_once ROOT . '/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>