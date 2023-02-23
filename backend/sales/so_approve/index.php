<?php
include_once('../../conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>อนุมัติใบสั่งขาย (Sale Order Approve) </title>

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
                            <h1 class="m-0"><i class="fa fa-check"></i> อนุมัติใบสั่งขาย (Sale Order Approval)</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo PATH; ?>/sales">Sales</a></li>
                                <li class="breadcrumb-item active">Sale Order Approval</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <form data-ajax="false" target="_blank" method="post">
                                <div data-role="fieldcontain">

                                        <button type="button" id="btnAddSO" data-toggle="modal" data-target="#modal_add"  class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มใบสั่งขาย</button>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>

                                    <input type="hidden" id="printsocode" class="btn btn-default" name="printsocode"
                                        value="John">
                                    <input type="hidden" id="editsalecode" class="btn btn-default" value="John">

                                </div>
                            </form>

                            <table name="tableSO" id="tableSO" class="table table-bordered table-striped">
                                <thead style="background-color:#D6EAF8;">
                                    <tr>

                                        <th width="10%">SO No.</th>
                                        <th width="10%">SO Date</th>
                                        <th width="10%">FG Code</th>
                                        <th width="25%">FG Name</th>
                                        <th width="25%">Cusname</th>
                                        <th width="10%">Status</th>
                                        <th width="5%"></th>
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
         include_once('modal/modal_giveaway.php');
         include_once('modal/modal_giveaway2.php');
         include_once('modal/modal_customer.php');
         include_once('modal/modal_stock.php');
         include_once('modal/modal_stock2.php');
         include_once('modal/modal_unit.php');
         include_once('modal/modal_unit2.php');?>




    </div>

    <?php
    include_once ROOT . '/import_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>