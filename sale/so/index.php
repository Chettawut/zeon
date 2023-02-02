<?php
include_once('../../conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ใบเปิดสั่งขาย (Sale Order)</title>

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
                            <h1 class="m-0">ใบเปิดสั่งขาย (Sale Order)</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Sale</a></li>
                                <li class="breadcrumb-item active">Sale Order</li>
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
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#modal_add"><i class="fa fa fa-tags" aria-hidden="true"></i>
                                            เพิ่มใบสั่งขาย</button>
                                    </div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
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
                            <table name="tableWD" id="tableWD" class="table table-bordered table-striped">
                                <thead>
                                    <tr style=" background-color:#D6EAF8;">
                                        <th width="15%">เลขที่ออกเอกสาร</th>
                                        <th width="15%">วันที่ออกเอกสาร</th>
                                        <th width="15%">รหัสลูกค้า</th>
                                        <th width="15%">ชื่อลูกค้า</th>
                                        <th width="15%">จำนวนเงินทั้งสิ้น</th>
                                        <th width="15%">สถานะ</th>
                                        <th width="15%">ผู้รับผิดชอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="15%">SO000001</th>
                                        <th width="15%">10/01/2566</th>
                                        <th width="15%">C1001</th>
                                        <th width="15%">Sorranun.B</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO000002</th>
                                        <th width="15%">12/01/2566</th>
                                        <th width="15%">C1001</th>
                                        <th width="15%">Sorranun.B</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO000003</th>
                                        <th width="15%">13/01/2566</th>
                                        <th width="15%">C1001</th>
                                        <th width="15%">Sorranun.B</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO000004</th>
                                        <th width="15%">14/01/2566</th>
                                        <th width="15%">C1001</th>
                                        <th width="15%">Sorranun.B</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO005901</th>
                                        <th width="15%">11/01/2566</th>
                                        <th width="15%">C1002</th>
                                        <th width="15%">Srrirat.T</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO058001</th>
                                        <th width="15%">20/01/2566</th>
                                        <th width="15%">C1003</th>
                                        <th width="15%">Peerapong.C</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Pending</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO059501</th>
                                        <th width="15%">21/01/2566</th>
                                        <th width="15%">C1004</th>
                                        <th width="15%">Teerapat.P</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO059502</th>
                                        <th width="15%">22/01/2566</th>
                                        <th width="15%">C1004</th>
                                        <th width="15%">Teerapat.P</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">SO059503</th>
                                        <th width="15%">22/01/2566</th>
                                        <th width="15%">C1004</th>
                                        <th width="15%">Peerapong.C</th>
                                        <th width="15%">10,000-</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">MR.Josh</th>
                                    </tr>
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