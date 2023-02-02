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
    <title>จัดการเวลาทำงาน (Time attendance)</title>

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
            <img class="animation__shake" src="<?php echo PATH; ?>/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" height="80"
                width="80">
        </div>

        <?php include_once ROOT . '/menu_head.php'; ?>

        <?php include_once ROOT . '/menu_left.php'; ?>



        <div class="content-wrapper">

            <section class="content">
                <section class="content-header">

                    <H1 id="menuName" style="margin-down:50px;">จัดการเวลาทำงาน </H1>

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Person</a></li>
                        <li class="breadcrumb-item active">Time attendance</li>
                    </ol>
                </section>
                <section class="content panel-info" style="padding:20px;">
                    <div class="row">
                        <div class="col-md-3" id="frmList">
                            <ul id="ulList" class="nav nav-pills nav-sidebar flex-column sidenav"
                                style="overflow-x: hidden;">
                                <ul class="sidebar-menu">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <form class="form-inline">
                                                    <input class="form-control col-md-8" type="search"
                                                        placeholder="Search" aria-label="Search">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modal_unit" type="button">
                                                            <span class="fa fa-search">
                                                            </span>
                                                        </button>
                                                    </span>

                                                    <!-- <span class="input-group-btn">
                                                        <button id="btnAdd" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal_unit" type="button">
                                                            <span class="fa fa-user-plus">
                                                            </span>
                                                        </button>
                                                    </span> -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                                <table id="listperson" class="table"
                                    style="color: #c2c7d0;font-size: 14px;background-color: transparent;">
                                    <tbody id="tlist">
                                        <?php 
                                        // $conn= sql_pdo() ;

                                        $strSQL = "SELECT empcode,etitlename,firstname,lastname,a.dpcode,dpname,iddep  ";
                                        $strSQL .= "FROM employee as a ";
                                        $strSQL .= "inner join department as b on(a.dpcode=b.dpcode) ";
                                        $strSQL .= " order by b.iddep,a.empcode";

                                        // echo $strSQL;
                                        $query = mysqli_query($conn,$strSQL);

                                        $json_result=array(
                                            "dpcode" => array(),
                                            "dpname" => array(),
                                            "empcode" => array(),
                                            "firstname" => array(),
                                            "lastname" => array(),
                                            "etitlename" => array()
                                            );
                                    
                                        while($row = $query->fetch_assoc()) 
                                        {
                                            
                                            array_push($json_result['dpcode'],$row['dpcode']);
                                            array_push($json_result['dpname'],$row['dpname']);
                                            array_push($json_result['empcode'],$row['empcode']);
                                            array_push($json_result['firstname'],$row['firstname']);
                                            array_push($json_result['lastname'],$row['lastname']);
                                            array_push($json_result['etitlename'],$row['etitlename']);
                                               
                                        }

                                        $dpcode='';
                                        $html='';

                                        for ($count = 0; $count < count($json_result['dpcode']); $count++) {
                                            
                                            
                                            if ($dpcode != $json_result['dpcode'][$count] && $count!=0) 
                                            $html .='</tbody></table></div></td></tr>';
                                            
                                            if ($dpcode != $json_result['dpcode'][$count]) {
                                                $html .='<tr data-widget="expandable-table" aria-expanded="false"><td><i class = "expandable-table-caret fas fa-caret-right fa-fw"></i>'.$json_result['dpname'][$count].'</td></tr> <tr class="expandable-body"><td><div class="p-0"><table class="table"><tbody>';
                                            }
                                            $dpcode = $json_result['dpcode'][$count];
                                            $html .= '<tr onclick="onclickEditEmployee(\''.$json_result['empcode'][$count].'\')" ><td>'.$json_result['etitlename'][$count].' '.$json_result['firstname'][$count].' '.$json_result['lastname'][$count].'</td></tr>';
                            
                                        }
                                        $html .= '</td></tr></tbody></table>';
                                        echo $html;
                                        
                                        ?>
                                    </tbody>
                                </table>
                            </ul>
                        </div>

                        <!-- ข้อมูลทางด้านขวา -->

                        <div class="col-md-9" id="frmMenu" style="display:none;">
                            <div class="card card-primary card-outline card-outline-tabs" style="padding:20px;">
                                <div class="card-header p-0 border-bottom-0">
                                    <form name="frmEmployee" id="frmEmployee" method="post"
                                        style="background-color: #FFFFFF;" action="javascript:void(0);">
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="txtCode">รหัสพนักงาน :</label>
                                                <input type="text" class="form-control" name="txtCode" id="txtCode"
                                                value="610718001"  required>

                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="EmpName">ชื่อ :</label>
                                                <input type="text" class="form-control" name="EmpName" id="EmpName"
                                                    value="ชยพัทธิ์" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="LastName">นามสกุล :</label>
                                                <input type="text" class="form-control" name="LastName" id="LastName"
                                                    value="นิโรภาส" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <label for="EmpTestDate">จากวันที่ :</label>
                                                <input type="date" class="form-control" name="EmpTestDate"
                                                    id="EmpTestDate" value="" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="EmpFirstDate">ถึงวันที่ :</label>
                                                <input type="date" class="form-control" name="EmpFirstDate"
                                                    id="EmpFirstDate" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary form-control">แสดง</button>
                                            </div>
                                        </div>
                                        <br>
                                        <table name="tabletime" id="tabletime" class="table table-bordered table-striped">
                                            <thead style=" background-color:#D6EAF8;font-size: 14px;text-align: center;">
                                                <tr>
                                                    <th width="11%">วันที่</th>
                                                    <th width="11%">รหัสบัตร</th>
                                                    <th width="11%">รหัสเครื่อง</th>
                                                    <th width="10%">เวลา</th>
                                                    <th width="10%">สถานะอนุมัติ</th>
                                                    <th width="16%">สถานะ</th>
                                                    <th width="9%">หมายเหตุ</th>                                                    
                                                    <th width="10%">วันที่บันทึก</th>
                                                    <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </div>
    <?php
    include_once ROOT.'/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>