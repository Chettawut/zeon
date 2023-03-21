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
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <form data-ajax="false" target="_blank" method="post">
                                <div data-role="fieldcontain">

                                    <!-- <div class="btn-group" id="btnAddSO" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#modal_add"><i class="fa fa fa-tags" aria-hidden="true"></i>
                                            เพิ่มรหัสวัสดุ</button>
                                        <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                                class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                                    </div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div> -->


                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div id="table">
                                <table style="background-color:#e0ffe7;"  class="table table-sm " >
                                    <thead>
                                        <tr>
                                            <td style="font-size: 30px; background-color:#fbfb6a;" rowspan="2">Month</td>
                                            <th style=" border: 2px solid black; font-size: 15px; background-color:#74fc5a;" colspan="15">Product</th>
                                            <td style="font-size: 30px; background-color:#6aebfb;" rowspan="2">Total</td>
                                        </tr>
                                        <tr style="background-color:#99FF99;">
                                            <th style=" border: 2px solid black;" scope="row">PT1</th>
                                            <th style=" border: 2px solid black;" scope="row">PT2</th>
                                            <th style=" border: 2px solid black;" scope="row">PT3</th>
                                            <th style=" border: 2px solid black;" scope="row">PT4</th>
                                            <th style=" border: 2px solid black;" scope="row">PT5</th>
                                            <th style=" border: 2px solid black;" scope="row">PT6</th>
                                            <th style=" border: 2px solid black;" scope="row">PT7</th>
                                            <th style=" border: 2px solid black;" scope="row">PT8</th>
                                            <th style=" border: 2px solid black;" scope="row">PT9</th>
                                            <th style=" border: 2px solid black;" scope="row">PT10</th>
                                            <th style=" border: 2px solid black;" scope="row">PT11</th>
                                            <th style=" border: 2px solid black;" scope="row">PT12</th>
                                            <th style=" border: 2px solid black;" scope="row">PT13</th>
                                            <th style=" border: 2px solid black;" scope="row">PT14</th>
                                            <th style=" border: 2px solid black;" scope="row">PT15</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style="background-color:#FFFFCC;" scope="row">JAN</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF	;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;" scope="row">FEB</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th  style="background-color:#FFFFCC;"scope="row">MAR</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th  style="background-color:#FFFFCC;"scope="row">APR</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">MAY</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">JUN</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">JUL</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">AUG</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">SEP</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">OCT</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">NOV</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#FFFFCC;"scope="row">DEC</th>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td></td><td></td><td></td><td style="background-color:#CCFFFF;"></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f584e4;" scope="row">Total</th>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#FFCCFF;"></td>
                                            <td style="background-color:#F5DEB3;"></td>
                                        </tr>
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