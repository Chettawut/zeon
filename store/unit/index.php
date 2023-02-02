<?php
session_start();
$_SESSION["menu"] = "store";
include_once('../../conn.php');
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน่วยวัสดุ</title>

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
                            <h1 class="m-0">หน่วยวัสดุ</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Store</a></li>
                                <li class="breadcrumb-item active">Unit</li>
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
                                            เพิ่มหน่วยวัสดุ</button>
                                        <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                                class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                                    </div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div>

                                    

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div id="mainStock">
                                <table name="tableUnit" id="tableUnit" class="table table-bordered table-striped">
                                    <thead style=" background-color:#D6EAF8;">
                                        <tr>
                                            
                                            <th width="70%">ชื่อหน่วยวัสดุ</th>
                                            <th width="30%" style="text-align:center">สถานะการใช้งาน</th>

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
    include_once ROOT . '/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>