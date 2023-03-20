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
    <title>Reservation Of Material</title>

    <?php 
    include_once('css.php'); 
    include_once('../../../config.php');
    include_once('../../import_css.php');
    include_once ROOT_CSS .'/func.php';
    ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
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
                            <h1 class="m-0"><i class="nav-icon fas fa-paste "></i></i> Reservation Of Material</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                                <li class="breadcrumb-item active">Reservation Of Material</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">ปรับเปลี่ยนเงื่อนไข</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reservation Month</label>
                                                <input type="month" class="form-control" name="sfdate" id="sfdate">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div id="table">
                                <table name="tableStock" id="tableStock" class="table table-bordered table-striped">
                                    <thead style=" background-color:#D6EAF8;">
                                        <tr>
                                            <th width="10%">รหัสวัสดุ</th>
                                            <th width="40%">ชื่อวัสดุ</th>
                                            <th width="12%" style="text-align:right">จำนวนที่จอง</th>
                                            <th width="14%" style="text-align:center">หน่วย</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <?php include_once('modal/modal_add.php');?>
        <?php include_once('modal/modal_edit.php');?>

    </div>

    <?php
    include_once ROOT_CSS .'/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>