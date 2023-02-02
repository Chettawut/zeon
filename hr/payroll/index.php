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
    <title>บัญชีเงินเดือน (PayRoll)</title>

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
                            <h1 class="m-0">รายงานเงินเดือน/ค่าจ้าง</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">HR</a></li>
                                <li class="breadcrumb-item active">Payroll Period</li>
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
                                            สร้าง PP</button>
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
                    <br>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                aria-controls="all" aria-selected="true">ทั้งหมด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab"
                                aria-controls="month" aria-selected="false">เงินเดือน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="day-tab" data-toggle="tab" href="#day" role="tab"
                                aria-controls="day" aria-selected="false">ค่าจ้างรายวัน</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <table name="tablePP" id="tablePP" class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th width="15%" style="text-align:left">เลขที่เอกสาร</th>
                                                <th width="20%" style="text-align:left">ช่วงวันที่</th>
                                                <th width="15%" style="text-align:left">วันที่ชำระ</th>
                                                <th width="20%" style="text-align:right">รวมค่าใช้จ่ายพนักงาน</th>
                                                <th width="15%" style="text-align:right">ยอดจ่ายสุทธิ</th>
                                                <th width="15%" style="text-align:center">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">...</div>
                        <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="day-tab">...</div>
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