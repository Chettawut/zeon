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
    <title>Inventory</title>

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
                            <h1 class="m-0"><i class="nav-icon fas  fa-file-alt"></i> Monthly Sales Forecast</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                                <li class="breadcrumb-item active">Monthly Sales Forecast</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <button style="color:white;background : #148F77; font-size:20px;text-shadow:2px 2px 4px #000000;"
                        type="button" id="btnRefresh" class="btn">
                        <i class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                    <br>
                    <br>
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
                                                <label>รหัสสินค้า</label>
                                                <div class="input-group"><input type="text" class="form-control"
                                                        name="stcode" id="stcode" value="100001" readonly>
                                                    <span class="input-group-btn"><button class="btn btn-default"
                                                            data-toggle="modal" data-target="#modal_stock"
                                                            data-whatever="" type="button">
                                                            <span class="fa fa-search"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>Reservation Month</label>
                                                <input type="number" class="form-control"  name="yeardate" id="yeardate" min="1900" max="2099" step="1"  />
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
                                <table id="tableData" class="table table-sm">
                                    <thead>
                                        
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td class="lefttable" colspan="2" scope="row">Beg of Month </td>
                                            <td scope="row">26,275</td>
                                            <td scope="row">13,675</td>
                                            <td scope="row">51,375</td>
                                            <td scope="row">48,675</td>
                                            <td scope="row">44,775</td>
                                            <td scope="row">39,875</td>
                                            <td scope="row">30,975</td>
                                            <td scope="row">13,575</td>
                                            <td scope="row">19,275</td>
                                            <td scope="row">23,275</td>
                                            <td scope="row">42,075</td>
                                            <td scope="row">14,675</td>
                                            <td scope="row"></td>
                                        </tr> -->
                                        <!-- บรรทัดแรก -->
                                        <!-- <tr>
                                            <td height="70" class="lefttable" colspan="2" scope="row">Product</td>
                                            <td scope="row"></td>
                                            <td scope="row">39,600</td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row"></td>
                                            <td scope="row">23,100</td>
                                            <td scope="row">26,400</td>
                                            <td scope="row">46,200</td>
                                            <td scope="row"></td>
                                            <td scope="row">52,800</td>
                                            <td scope="row">188,100</td>
                                        </tr> -->
                                        <!-- บรรทัด2 -->
                                        <!-- <tr>
                                            <td height="70" style="text-align:left" colspan="2" scope="row">Sales</td>
                                            <td class="font-weight-bold" scope="row">12,600</td>
                                            <td class="font-weight-bold" scope="row">1,900</td>
                                            <td class="font-weight-bold" scope="row">2,700</td>
                                            <td class="font-weight-bold" scope="row">3,900</td>
                                            <td class="font-weight-bold" scope="row">4,900</td>
                                            <td class="font-weight-bold" scope="row">8,900</td>
                                            <td class="font-weight-bold" scope="row">17,400</td>
                                            <td class="font-weight-bold" scope="row">17,40</td>
                                            <td class="font-weight-bold" scope="row">22,400</td>
                                            <td class="font-weight-bold" scope="row">27,400</td>
                                            <td class="font-weight-bold" scope="row">27,400</td>
                                            <td class="font-weight-bold" scope="row">32,400</td>
                                            <td scope="row">179,300</td>
                                        </tr> -->
                                        <!-- บรรทัด3 -->
                                        <!-- <tr>
                                            <td style="text-align:left" colspan="2" scope="row">End of Month</td>
                                            <td scope="row">13,675</td>
                                            <td scope="row">51,375</td>
                                            <td scope="row">48,675</td>
                                            <td scope="row">44,775</td>
                                            <td scope="row">39,975</td>
                                            <td scope="row">30,975</td>
                                            <td scope="row">13,575</td>
                                            <td scope="row">19,275</td>
                                            <td scope="row">23,275</td>
                                            <td scope="row">42,075</td>
                                            <td scope="row">14,675</td>
                                            <td scope="row">35,075</td>
                                            <td scope="row">1.08</td>
                                        </tr> -->
                                        <!-- บรรทัด4 -->
                                        <!-- <tr>
                                            <td style="text-align:left" colspan="2" scope="row">Inventory ratio</td>
                                            <td scope="row">13,675</td>
                                            <td scope="row">51,375</td>
                                            <td scope="row">48,675</td>
                                            <td scope="row">44,775</td>
                                            <td scope="row">39,975</td>
                                            <td scope="row">30,975</td>
                                            <td scope="row">13,575</td>
                                            <td scope="row">19,275</td>
                                            <td scope="row">23,275</td>
                                            <td scope="row">42,075</td>
                                            <td scope="row">14,675</td>
                                            <td scope="row">1.08</td>
                                            <td class="deletetable"></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <?php include_once('modal/modal_stock.php');?>

    </div>

    <?php
    include_once ROOT_CSS .'/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>