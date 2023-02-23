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
    <title>รายงาน Production</title>

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
            <img class="animation__shake" src="<?php echo PATH; ?>/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" height="60"
                width="60">
        </div>

        <?php include_once ROOT . '/menu_head.php'; ?>

        <?php include_once ROOT . '/menu_left.php'; ?>



        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">รายงาน Store</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Store</a></li>
                                <li class="breadcrumb-item active">Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div id="frmList" class="col-lg-12 col-12" style="cursor: pointer;">
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div id="month" class="info-box-content">
                                    <span class="info-box-text">รายงานสรุปยอดเบิกแยก Project</span>
                                    <!-- <span class="info-box-number">23,443.323 ตัน</span> -->
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon"><i class="fas fa-hammer"></i></span>

                                <div id="newreport" class="info-box-content">
                                    <span class="info-box-text">รายงานอื่นๆ กำลังปรับปรุง</span>
                                </div>
                            </div>
                        </div>
                        <div id="frmMenu" class="col-lg-9 col-9" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    รายงานการผลิตรายเดือน
                                    <div class="card-tools">
                                        <button type="button" id="cancleSelect" class="btn btn-tool">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">ปรับเปลี่ยนเงื่อนไข</h3>


                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>เลือกช่วงวันที่</label>
                                                        <select class="form-control select2" id="toolyear"
                                                            style="width: 100%;">
                                                            <?php for($j=0;$j<5;$j++)
                                                                {
                                                                    echo '<option value="'.(date("Y")-$j).'" ปี>'.(date("Y")-$j+543).'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>เลือกช่วงวันที่</label>
                                                        <input type="date" name="toolyear" id="toolyear"
                                                            class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col text-center">
                                                <button type="button" id="btnprint2"
                                                    class="btn btn-primary">ตกลง</button>
                                                <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>



    </div>
    <?php
    include_once ROOT . '/import_js.php';
    
    include_once('modal/modal_report.php'); 
    include_once('js.php'); 

    ?>
    <!-- <div style="display:none;">
        <iframe src="" id="printf" name="printf">

        </iframe>
    </div> -->
</body>

</html>
<?php
//  odbc_close_all();	
// }else{
// header( "location: login.php");
//  exit(0);	
// }
?>

</html>