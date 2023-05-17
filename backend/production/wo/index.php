<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../../../');
        exit;
    }    
    include_once('../../conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ใบสั่งงานผลิต (Work Order) </title>

    <?php 
    include_once('css.php'); 
    include_once('../../../config.php');
    include_once('../../import_css.php');
    include_once ROOT_CSS .'/func.php';
    ?>
</head>

<body class="hold-tranSales forecastsition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo PATH; ?>/backend/img/logo_fb.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <?php include_once ROOT_CSS . '/menu_head.php'; ?>

        <?php include_once ROOT_CSS . '/menu_left.php'; ?>



        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><i class="nav-icon fas fa-clipboard-list"></i> Work Order</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo PATH; ?>/production">Production</a></li>
                                <li class="breadcrumb-item active">Work Order</li>
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

                                    <button type="button" id="btnAddWO" data-toggle="modal" data-target="#modal_add"
                                        class="btn btn-success"><i class="fa fa fa-tags" aria-hidden="true"></i>
                                        Add Sales Forecast</button>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                                    

                                </div>
                            </form>

                            <table name="tableSO" id="tableSO" class="table table-bordered table-striped">
                                <thead style="background-color:#D6EAF8;">
                                    <tr>

                                        <th width="10%">SF No.</th>
                                        <th width="10%">SF Date</th>
                                        <th width="15%">FG Code</th>
                                        <th width="30%">FG Name</th>
                                        <th width="10%">Amount</th>
                                        <th width="10%">Unit</th>
                                        <th width="15%">Status</th>
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
         include_once('modal/modal_customer.php');
         include_once('modal/modal_stock.php');
         include_once('modal/modal_stock2.php');
         include_once('modal/modal_unit.php');
         include_once('modal/modal_unit2.php');
         ?>




    </div>

    <?php
    include_once ROOT_CSS . '/import_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>