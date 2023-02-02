<?php
include_once('../../conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ใบสั่งงานผลิต (Work Order)</title>

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
                            <h1 class="m-0">ใบสั่งงานผลิต (Work Order)</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Production</a></li>
                                <li class="breadcrumb-item active">Work Order</li>
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

                                    <!-- <div class="btn-group" id="btnAddSO" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#modal_add"><i class="fa fa fa-tags" aria-hidden="true"></i>
                                            เพิ่มใบสั่งผลิต</button>
                                    </div> -->
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
                                        <th width="15%">Number</th>
                                        <th width="15%">Customer</th>
                                        <th width="15%">Company</th>
                                        <th width="15%">Service</th>
                                        <th width="15%">Orders</th>
                                        <th width="17%">Booking Date</th>
                                        <th width="15%">Location</th>
                                        <th width="15%">State</th>
                                        <th width="15%">Created&nbsp;At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <th width="15%">001</th>
                                        <th width="15%">Sorranun.B</th>
                                        <th width="15%">Test000</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size S</th>
                                        <th width="15%">25/01/66</th>
                                        <th width="15%">Rayong</th>
                                        <th width="15%">Pending</th>
                                        <th width="15%">20/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">002</th>
                                        <th width="15%">Mark</th>
                                        <th width="15%">Test020</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size M</th>
                                        <th width="15%">25/01/66</th>
                                        <th width="15%">Bangkok</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">09/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">003</th>
                                        <th width="15%">Jame</th>
                                        <th width="15%">Test300</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size XL</th>
                                        <th width="15%">19/01/66</th>
                                        <th width="15%">Chonburi</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">10/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">004</th>
                                        <th width="15%">Jason</th>
                                        <th width="15%">Test860</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size L</th>
                                        <th width="15%">10/02/66</th>
                                        <th width="15%">Bangkok</th>
                                        <th width="15%">Pending</th>
                                        <th width="15%">29/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">005</th>
                                        <th width="15%">Nemo</th>
                                        <th width="15%">Test985</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size SS</th>
                                        <th width="15%">02/02/66</th>
                                        <th width="15%">Nan</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">20/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">006</th>
                                        <th width="15%">Sirirat.T</th>
                                        <th width="15%">Test069</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size X</th>
                                        <th width="15%">03/03/66</th>
                                        <th width="15%">Lao</th>
                                        <th width="15%">Pending</th>
                                        <th width="15%">05/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">007</th>
                                        <th width="15%">Ron</th>
                                        <th width="15%">Test885</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size S</th>
                                        <th width="15%">27/02/66</th>
                                        <th width="15%">Bangkok</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">20/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">008</th>
                                        <th width="15%">Dang</th>
                                        <th width="15%">Test225</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size S</th>
                                        <th width="15%">08/02/66</th>
                                        <th width="15%">Rayong</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">01/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">009</th>
                                        <th width="15%">Gift</th>
                                        <th width="15%">Test330</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size L</th>
                                        <th width="15%">25/01/66</th>
                                        <th width="15%">Bangkok</th>
                                        <th width="15%">Completed</th>
                                        <th width="15%">20/01/66</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">010</th>
                                        <th width="15%">Gunman</th>
                                        <th width="15%">Test650</th>
                                        <th width="15%">build</th>
                                        <th width="15%">Size SS</th>
                                        <th width="15%">05/06/66</th>
                                        <th width="15%">Bangkok</th>
                                        <th width="15%">Pending</th>
                                        <th width="15%">04/02/66</th>
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