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
    <title>ข้อมูลวัสดุ</title>

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
            <img class="animation__shake" src="<?php echo PATH; ?>/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" height="80" width="80">
        </div>

        <?php include_once ROOT . '/menu_head.php'; ?>

        <?php include_once ROOT . '/menu_left.php'; ?>



        <div class="content-wrapper">


            <section class="content">
                <section class="content-header">

                    <H1 id="menuName" style="margin-down:50px;">จัดการข้อมูลส่วนบุคคล</H1>

                    <ol class="text-right">
                        Person
                    </ol>
                </section>
                <section class="content panel-info" >
                    <div class="row">
                        <div class="col-md-4" id="frmList" >
                            <ul id="ulList" class="nav nav-pills nav-sidebar flex-column sidenav" style="overflow-x: hidden;">
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

                                                    <span class="input-group-btn">
                                                        <button id="btnAdd" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal_unit" type="button">
                                                            <span class="fa fa-user-plus">
                                                            </span>
                                                        </button>
                                                    </span>
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

                        <div class="col-8">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <div id="frmMenu" style="display:none;" class="">
                                        <div class="nav nav-tabs" role="tablist">
                                            <a class="nav-link active" id="nav-main-tab" data-toggle="tab"
                                                data-target="#nav-main" type="button" role="tab"
                                                aria-controls="nav-main" aria-selected="true">ทั่วไป</a>
                                            <a class="nav-link" id="nav-private-tab" data-toggle="tab"
                                                data-target="#nav-private" type="button" role="tab"
                                                aria-controls="nav-private" aria-selected="false">ส่วนตัว</a>
                                            <a class="nav-link" id="nav-address-tab" data-toggle="tab"
                                                data-target="#nav-address" type="button" role="tab"
                                                aria-controls="nav-address" aria-selected="false">ที่อยู่</a>
                                            <a class="nav-link" id="nav-family-tab" data-toggle="tab"
                                                data-target="#nav-family" type="button" role="tab"
                                                aria-controls="nav-family" aria-selected="false">ครอบครัว</a>
                                            <a class="nav-link" id="nav-education-tab" data-toggle="tab"
                                                data-target="#nav-education" type="button" role="tab"
                                                aria-controls="nav-education" aria-selected="false">การศึกษา</a>
                                            <a class="nav-link" id="nav-history-tab" data-toggle="tab"
                                                data-target="#nav-history" type="button" role="tab"
                                                aria-controls="nav-history" aria-selected="false">ประวัติงาน</a>
                                            <a class="nav-link fa fa-refresh text-danger" id="btnReset"
                                                data-target="#nav-history" type="button" role="tab"
                                                aria-controls="nav-history" aria-selected="false">⋙</a>
                                        </div>
                                        <form name="frmEmployee" id="frmEmployee" method="post"
                                            style="background-color: #FFFFFF;" action="javascript:void(0);">
                                            <div class="tab-content">
                                                <!-- หัวข้อ 1 -->
                                                <div class="tab-pane fade show active" id="nav-main" role="tabpanel"
                                                    aria-labelledby="nav-main-tab">
                                                    <div class="active tab-pane" id="main">

                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="txtCode">รหัสพนักงาน :</label>
                                                                <input type="text" class="form-control" name="txtCode"
                                                                    id="txtCode" required>

                                                            </div>
                                                            <div class="col-md-4 mb-4">
                                                                <br>
                                                                <span id="lbCheck"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-2 mb-3">
                                                                <label for="ETitleName">คำนำหน้า(TH) :</label>
                                                                <select class="custom-select" name="ETitleName"
                                                                    id="ETitleName" required>
                                                                    <option value=""></option>
                                                                    <option value="นาย">นาย</option>
                                                                    <option value="น.ส.">น.ส.</option>
                                                                    <option value="นาง">นาง</option>
                                                                    <option value="ว่าที่ร้อยตรี">ว่าที่ร้อยตรี</option>
                                                                    <option value="ดร.">ดร.</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5 mb-3">
                                                                <label for="EmpName">ชื่อ :</label>
                                                                <input type="text" class="form-control" name="EmpName"
                                                                    id="EmpName" value="" required>
                                                            </div>
                                                            <div class="col-md-5 mb-3">
                                                                <label for="LastName">นามสกุล :</label>
                                                                <input type="text" class="form-control" name="LastName"
                                                                    id="LastName" value="" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-2 mb-3">
                                                                <label for="ETitleNameEN">คำนำหน้า(EN) :</label>
                                                                <select class="custom-select" name="ETitleNameEN"
                                                                    id="ETitleNameEN">
                                                                    <option value=""></option>
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Miss">Miss</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Dr.">Dr.</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5 mb-3">
                                                                <label for="EmpNameEN">ชื่อ :</label>
                                                                <input type="text" class="form-control" name="EmpNameEN"
                                                                    id="EmpNameEN" value="">
                                                            </div>
                                                            <div class="col-md-5 mb-3">
                                                                <label for="LastNameEN">นามสกุล :</label>
                                                                <input type="text" class="form-control"
                                                                    name="LastNameEN" id="LastNameEN" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="DepCode">ฝ่าย :</label>
                                                                <select class="custom-select" id="DepCode"
                                                                    name="DepCode" required>
                                                                    <option value=""></option>
                                                                    <option value="">เทคโนโลยีสารสนเทศ</option>
                                                                    <?php 
                                                                // $StrSQL = " SELECT [DepID],[DepName],[iddep] FROM [RWI_DATACENTER].[dbo].[Au_Department] order by iddep "; 
                                                                // $obj = sql_pdo()->prepare($StrSQL);
                                                                // $obj->execute();  
                                                                // while($row = $obj->fetch( PDO::FETCH_ASSOC ))                                        
                                                                // echo '<option value="'.$row['DepID'].'">'.$row['DepName'].'</option>' ;                                            
                                                            ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="SECODE">แผนก :</label>
                                                                <select class="custom-select" id="SECODE" name="SECODE"
                                                                    required>
                                                                    <option value=""></option>
                                                                    <option value="">IT</option>
                                                                    <?php 
                                                            // $StrSQL = " SELECT [SectionCode],[SectionName],DepCode FROM [RWI_DATACENTER].[dbo].[Au_Section] order by SectionCode asc";
                                                            // $obj = sql_pdo()->prepare($StrSQL);
                                                            // $obj->execute();  
                                                            // while($row = $obj->fetch( PDO::FETCH_ASSOC ))     
                                                            // echo  '<option value="'.$row['SectionCode'].'">'.$row['SectionName'].'</option>' ;
                                                        ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="EmpPosition">ตำแหน่ง :</label>
                                                                <select class="custom-select" id="EmpPosition"
                                                                    name="EmpPosition" required>
                                                                    <option value=""></option>
                                                                    <option value="P00">โปรแกรมเมอร์ </option>
                                                                    <option value="P00">นักศึกษาฝึกงาน :</option>
                                                                    <?php 
                                                            // $StrSQL = " SELECT [PositionCode] ,[PositionName],[PositionOrder] FROM [RWI_DATACENTER].[dbo].[Au_Position] order by PositionOrder,PositionCode asc";
                                                            // $obj = sql_pdo()->prepare($StrSQL);
                                                            //  $obj->execute();  
                                                            //  while($row = $obj->fetch( PDO::FETCH_ASSOC ))     
                                                            // echo  '<option value="'.$row['PositionCode'].'">'.$row['PositionName'].'</option>' ;
                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-2 mb-3">
                                                                <label for="validationTooltip04">เพศ :</label>
                                                                <select class="custom-select" id="Sex" name="Sex"
                                                                    required>
                                                                    <option value=""></option>
                                                                    <option value="M">ชาย</option>
                                                                    <option value="F">หญิง</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2 mb-3">
                                                                <label for="validationTooltip04">สถานะภาพ :</label>
                                                                <select class="custom-select" id="EmpStatus"
                                                                    name="EmpStatus" required>
                                                                    <option value=""></option>
                                                                    <option value="โสด">โสด</option>
                                                                    <option value="สมรส">สมรส</option>
                                                                    <option value="หม่าย">หม่าย</option>
                                                                    <option value="ม่าย">ม่าย</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2 mb-3">
                                                                <label for="validationTooltip04">ระดับพนักงาน :</label>
                                                                <select class="custom-select" id="EmpLevel"
                                                                    name="EmpLevel" required>
                                                                    <option value=""></option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-4">
                                                                <label for="EmpBirth">วันเกิด :</label>
                                                                <input type="date" class="form-control" name="EmpBirth"
                                                                    id="EmpBirth" required>
                                                            </div>
                                                            <div class="col-md-3 mb-4">
                                                                <label for="Age">อายุ :</label>
                                                                <input type="text" class="form-control" name="Age"
                                                                    id="Age" value="">
                                                            </div>
                                                            <div class="col-md-3 mb-4">
                                                                <label>ที่ทำงาน :</label>
                                                                <select class="form-control" name="WorkAt" id="WorkAt"
                                                                    required>
                                                                    <option value=""></option>
                                                                    <option value="H">โรงงานระยอง</option>
                                                                    <option value="F">ออฟฟิตกทม</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-4">
                                                                <label for="EmpTestDate">วันที่เริ่มงาน :</label>
                                                                <input type="date" class="form-control"
                                                                    name="EmpTestDate" id="EmpTestDate" value=""
                                                                    required>
                                                            </div>
                                                            <div class="col-md-3 mb-4">
                                                                <label for="EmpFirstDate">วันที่บรรจุ :</label>
                                                                <input type="date" class="form-control"
                                                                    name="EmpFirstDate" id="EmpFirstDate" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">

                                                            <div class="col-md-4 mb-3">
                                                                <label for="EmpPublicCode">เลขที่บัตรประชาชน :</label>
                                                                <input type="text" class="form-control"
                                                                    name="EmpPublicCode" id="EmpPublicCode" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- หัวข้อ 2 -->
                                                <div class="tab-pane fade" id="nav-private" role="tabpanel"
                                                    aria-labelledby="nav-private-tab">
                                                    <div class="tab-pane" id="private">
                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                <a class="nav-link active" id="nav-pri1-tab"
                                                                    data-toggle="tab" data-target="#nav-pri1"
                                                                    type="button" role="tab" aria-controls="nav-pri1"
                                                                    aria-selected="true">ส่วนที่
                                                                    1</a>
                                                                <a class="nav-link" id="nav-pri2-tab" data-toggle="tab"
                                                                    data-target="#nav-pri2" type="button" role="tab"
                                                                    aria-controls="nav-pri2"
                                                                    aria-selected="false">ส่วนที่
                                                                    2</a>
                                                                <a class="nav-link" id="nav-pri3-tab" data-toggle="tab"
                                                                    data-target="#nav-pri3" type="button" role="tab"
                                                                    aria-controls="nav-pri3"
                                                                    aria-selected="false">ส่วนที่
                                                                    3</a>
                                                                <a class="nav-link" id="nav-pri4-tab" data-toggle="tab"
                                                                    data-target="#nav-pri4" type="button" role="tab"
                                                                    aria-controls="nav-pri14"
                                                                    aria-selected="false">ส่วนที่
                                                                    4</a>
                                                            </div>
                                                        </nav>

                                                        <div class="tab-content">
                                                            <!-- ส่วนที่ 1 -->
                                                            <div class="tab-pane fade show active" id="nav-pri1"
                                                                role="tabpanel" aria-labelledby="nav-pri1-tab">
                                                                <div class="active tab-pane" id="pri1">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EmpNickName">ชื่อเล่น :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EmpNickName" id="EmpNickName">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EmpBirthPlace">สถานที่เกิด
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EmpBirthPlace" id="EmpBirthPlace">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Weight">น้ำหนัก :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Weight" id="Weight">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Height">ส่วนสูง :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Height" id="Height">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Citizen">เชื้อชาติ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Citizen" id="Citizen">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่ 2 -->
                                                            <div class="tab-pane fade" id="nav-pri2" role="tabpanel"
                                                                aria-labelledby="nav-pri2-tab">
                                                                <div class="tab-pane" id="pri2">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Nationality">สัญชาติ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Nationality" id="Nationality">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Religion">ศาสนา :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Religion" id="Religion">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Blood">กรุ๊ปเลือด :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Blood" id="Blood">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Mobile">โทรศัพท์ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Mobile" id="Mobile">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="TaxCode">เลขที่เสียภาษี
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="TaxCode" id="TaxCode">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่ 3 -->
                                                            <div class="tab-pane fade" id="nav-pri3" role="tabpanel"
                                                                aria-labelledby="nav-pri3-tab">
                                                                <div class="tab-pane" id="pri3">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="SocialCode">เลขที่ประกันสังคม
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="SocialCode" id="SocialCode">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label
                                                                                for="Conscripted">ผ่านการเกณฑ์ทหารแล้ว
                                                                                :</label>
                                                                            <select class="custom-select"
                                                                                name="Conscripted" id="Conscripted">
                                                                                <option value="">
                                                                                </option>
                                                                                <option value="จับได้ใบดำ">จับได้ใบดำ
                                                                                </option>
                                                                                <option value="เรียน รด.">เรียน รด.
                                                                                </option>
                                                                                <option value="ผ่านการเกณฑ์ทหารแล้ว">
                                                                                    ผ่านการเกณฑ์ทหารแล้ว</option>
                                                                                <option value="ยังไม่ผ่านการเกณฑ์ทหาร">
                                                                                    ยังไม่ผ่านการเกณฑ์ทหาร</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label
                                                                                for="AbilityComputer">ความสามารถคอมพิวเตอร์
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="AbilityComputer"
                                                                                id="AbilityComputer">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Hobbies">งานอดิเรก :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Hobbies" id="Hobbies">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Sports">กีฬา :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Sports" id="Sports">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่ 4 -->
                                                            <div class="tab-pane fade" id="nav-pri4" role="tabpanel"
                                                                aria-labelledby="nav-pri4-tab">
                                                                <div class="tab-pane" id="pri4">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="TypingTH">พิมพ์ไทย :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="TypingTH" id="TypingTH">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="TypingEN">พิมพ์อังกฤษ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="TypingEN" id="TypingEN">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label
                                                                                for="checkLicenceMotorcy">ใบขับขี่มอไซต์
                                                                                :
                                                                            </label>
                                                                            <input type="checkbox" class="flat-red"
                                                                                id="checkLicenceMotorcy"
                                                                                name="checkLicenceMotorcy">
                                                                            <input type="text" class="form-control"
                                                                                id="LicenceMotorcy"
                                                                                name="LicenceMotorcy">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="checkLicenceCar">ใบขับขี่รถยนต์
                                                                                :
                                                                            </label>
                                                                            <input type="checkbox" class="flat-red"
                                                                                id="checkLicenceCar"
                                                                                name="checkLicenceCar">
                                                                            <input type="text" class="form-control"
                                                                                id="LicenceCar" name="LicenceCar">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="Ability">ความสามารถพิเศษ
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="Ability" id="Ability">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                <a class="nav-link active" id="nav-lan1-tab"
                                                                    data-toggle="tab" data-target="#nav-lan1"
                                                                    type="button" role="tab" aria-controls="nav-lan1"
                                                                    aria-selected="true">
                                                                    ภาษาไทย</a>
                                                                <a class="nav-link" id="nav-lan2-tab" data-toggle="tab"
                                                                    data-target="#nav-lan2" type="button" role="tab"
                                                                    aria-controls="nav-lan2" aria-selected="false">
                                                                    ภาษาอังกฤษ</a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content">
                                                            <!-- ส่วนที่ 1TH-->
                                                            <div class="tab-pane fade show active" id="nav-lan1"
                                                                role="tabpanel" aria-labelledby="nav-lan1-tab">
                                                                <div class="form-row">
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="SpeakTH">พูด :</label>
                                                                        <select class="custom-select" name="SpeakTH"
                                                                            id="SpeakTH">
                                                                            <option value=""></option>
                                                                            <option value="ดี">ดี</option>
                                                                            <option value="พอใช้">พอใช้</option>
                                                                            <option value="ปรับปรุง">ปรับปรุง</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="ReadTH">อ่าน :</label>
                                                                        <select class="custom-select" name="ReadTH"
                                                                            id="ReadTH">
                                                                            <option value=""></option>
                                                                            <option value="ดี">ดี</option>
                                                                            <option value="พอใช้">พอใช้</option>
                                                                            <option value="ปรับปรุง">ปรับปรุง</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="WriteTH">เขียน :</label>
                                                                        <select class="custom-select" name="WriteTH"
                                                                            id="WriteTH">
                                                                            <option value=""></option>
                                                                            <option value="ดี">ดี</option>
                                                                            <option value="พอใช้">พอใช้</option>
                                                                            <option value="ปรับปรุง">ปรับปรุง</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- ส่วนที่ 2EN -->
                                                            <div class="tab-pane fade" id="nav-lan2" role="tabpanel"
                                                                aria-labelledby="nav-lan2-tab">

                                                                <div class="form-row">
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="SpeakEN">พูด :</label>
                                                                        <select class="custom-select" name="SpeakEN"
                                                                            id="SpeakEN">
                                                                            <option value=""></option>
                                                                            <option value="ดี">ดี</option>
                                                                            <option value="พอใช้">พอใช้</option>
                                                                            <option value="ปรับปรุง">ปรับปรุง</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="ReadEN">อ่าน :</label>
                                                                        <select class="custom-select" name="ReadEN"
                                                                            id="ReadEN">
                                                                            <option value=""></option>
                                                                            <option value="ดี">ดี</option>
                                                                            <option value="พอใช้">พอใช้</option>
                                                                            <option value="ปรับปรุง">ปรับปรุง</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="WriteEN">เขียน :</label>
                                                                        <select class="custom-select" name="WriteEN"
                                                                            id="WriteEN">
                                                                            <option value=""></option>
                                                                            <option value="ดี">ดี</option>
                                                                            <option value="พอใช้">พอใช้</option>
                                                                            <option value="ปรับปรุง">ปรับปรุง</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- หัวข้อ 3 -->
                                                <div class="tab-pane fade" id="nav-address" role="tabpanel"
                                                    aria-labelledby="nav-address-tab">
                                                    <div class="tab-pane" id="address">
                                                        <label for="colFormLabelLg"
                                                            class=" col-form-label-lg">ที่อยู่ปัจจุบัน</label>

                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddID1">บ้านเลขที่ :</label>
                                                                <input type="text" class="form-control" name="AddID1"
                                                                    id="AddID1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddAlley1">ซอย :</label>
                                                                <input type="text" class="form-control" name="AddAlley1"
                                                                    id="AddAlley1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddRoad1">ถนน :</label>
                                                                <input type="text" class="form-control" name="AddRoad1"
                                                                    id="AddAddRoad1ID1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddSubDistrict1">ตำบล :</label>
                                                                <input type="text" class="form-control"
                                                                    name="AddSubDistrict1" id="AddSubDistrict1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddDistrict1">อำเภอ :</label>
                                                                <input type="text" class="form-control"
                                                                    name="AddDistrict1" id="AddDistrict1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddProvince1">จังหวัด :</label>
                                                                <input type="text" class="form-control"
                                                                    name="AddProvince1" id="AddProvince1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddZip1">รหัสไปรษณีย์ :</label>
                                                                <input type="text" class="form-control" name="AddZip1"
                                                                    id="AddZip1">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddPhone1">โทรศัพท์ :</label>
                                                                <input type="text" class="form-control" name="AddPhone1"
                                                                    id="AddPhone1">
                                                            </div>
                                                        </div>
                                                        <label for="colFormLabelLg"
                                                            class=" col-form-label-lg">ที่ตามทะเบียนบ้าน</label>

                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddID2">บ้านเลขที่ :</label>
                                                                <input type="text" class="form-control" name="AddID2"
                                                                    id="AddID2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddAlley2">ซอย :</label>
                                                                <input type="text" class="form-control" name="AddAlley2"
                                                                    id="AddAlley2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddRoad2">ถนน :</label>
                                                                <input type="text" class="form-control" name="AddRoad2"
                                                                    id="AddAddRoad1ID2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddSubDistrict2">ตำบล :</label>
                                                                <input type="text" class="form-control"
                                                                    name="AddSubDistrict2" id="AddSubDistrict2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddDistrict2">อำเภอ :</label>
                                                                <input type="text" class="form-control"
                                                                    name="AddDistrict2" id="AddDistrict2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddProvince2">จังหวัด :</label>
                                                                <input type="text" class="form-control"
                                                                    name="AddProvince2" id="AddProvince2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddZip2">รหัสไปรษณีย์ :</label>
                                                                <input type="text" class="form-control" name="AddZip2"
                                                                    id="AddZip2">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddPhone2">โทรศัพท์ :</label>
                                                                <input type="text" class="form-control" name="AddPhone2"
                                                                    id="AddPhone2">
                                                                <br><br>
                                                                <button type="button"
                                                                    class="btn btn-primary">ข้อมูลตามที่อยู่ปัจจุบัน</button><br>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- หัวข้อ 4 -->
                                                <div class="tab-pane fade" id="nav-family" role="tabpanel"
                                                    aria-labelledby="nav-family-tab">
                                                    <div class="tab-pane" id="family">

                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="colFormLabelLg"
                                                                    class=" col-form-label-lg">จำนวนพี่น้อง</label>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddAlley1"></label>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="colFormLabelLg"
                                                                    class=" col-form-label-lg">จำนวนบุตร</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="MemberFamily">จำนวน :</label>
                                                                <input type="text" class="form-control"
                                                                    name="MemberFamily" id="MemberFamily">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddAlley1"></label>

                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="Son">จำนวนบุตรชาย :</label>
                                                                <input type="text" class="form-control" name="Son"
                                                                    id="Son">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddSubDistrict1"></label>

                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="ChildFamily">เป็นคนที่ :</label>
                                                                <input type="text" class="form-control"
                                                                    name="ChildFamily" id="ChildFamily">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddProvince1"></label>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="Daughter">จำนวนบุตรหญิง :</label>
                                                                <input type="text" class="form-control" name="Daughter"
                                                                    id="Daughter">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="AddPhone1"></label>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="subfamily">


                                                            <nav>
                                                                <div class="nav nav-tabs" role="tablist">
                                                                    <a class="nav-link active" id="nav-fami1-tab"
                                                                        data-toggle="tab" data-target="#nav-fami1"
                                                                        type="button" role="tab"
                                                                        aria-controls="nav-com1"
                                                                        aria-selected="true">บิดา</a>
                                                                    <a class="nav-link" id="nav-fami2-tab"
                                                                        data-toggle="tab" data-target="#nav-fami2"
                                                                        type="button" role="tab"
                                                                        aria-controls="nav-fami2"
                                                                        aria-selected="false">มารดา</a>
                                                                    <a class="nav-link" id="nav-fami3-tab"
                                                                        data-toggle="tab" data-target="#nav-fami3"
                                                                        type="button" role="tab"
                                                                        aria-controls="nav-fami3"
                                                                        aria-selected="false">คู่สมรส</a>
                                                                    <a class="nav-link" id="nav-fami4-tab"
                                                                        data-toggle="tab" data-target="#nav-fami4"
                                                                        type="button" role="tab"
                                                                        aria-controls="nav-fami4"
                                                                        aria-selected="false">ผู้ติดต่อฉุกเฉิน</a>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content">
                                                                <!-- ส่วนที่fam 1 -->
                                                                <div class="tab-pane fade show active" id="nav-fami1"
                                                                    role="tabpanel" aria-labelledby="nav-fami1-tab">
                                                                    <div class="active tab-pane" id="fami1">
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="FirstName3">ชื่อ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="FirstName3" id="FirstName3">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="LastName3">สกุล :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="LastName3" id="LastName3">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Occupation3">อาชีพ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Occupation3" id="Occupation3">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Mobile3">โทรศัพท์ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Mobile3" id="Mobile3">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- ส่วนที่fam 2 -->
                                                                <div class="tab-pane fade " id="nav-fami2"
                                                                    role="tabpanel" aria-labelledby="nav-fami2-tab">
                                                                    <div class=" tab-pane" id="fami2">
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="FirstName4">ชื่อ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="FirstName4" id="FirstName4">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="LastName4">สกุล :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="LastName4" id="LastName4">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Occupation4">อาชีพ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Occupation4" id="Occupation4">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Mobile4">โทรศัพท์ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Mobile4" id="Mobile4">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- ส่วนที่fam 3 -->
                                                                <div class="tab-pane fade " id="nav-fami3"
                                                                    role="tabpanel" aria-labelledby="nav-fami3-tab">
                                                                    <div class=" tab-pane" id="fami3">
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="FirstName5">ชื่อ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="FirstName5" id="FirstName5">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="LastName5">สกุล :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="LastName5" id="LastName5">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Occupation5">อาชีพ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Occupation5" id="Occupation5">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Mobile5">โทรศัพท์ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Mobile5" id="Mobile5">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- ส่วนที่fam 4 -->
                                                                <div class="tab-pane fade " id="nav-fami4"
                                                                    role="tabpanel" aria-labelledby="nav-fami4-tab">
                                                                    <div class=" tab-pane" id="fami4">
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="FirstName6">ชื่อ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="FirstName6" id="FirstName6">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="LastName6">สกุล :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="LastName6" id="LastName6">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Occupation6">อาชีพ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Occupation6" id="Occupation6">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="Mobile6">โทรศัพท์ :</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="Mobile6" id="Mobile6">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- หัวข้อ 5 -->
                                                <div class="tab-pane fade" id="nav-education" role="tabpanel"
                                                    aria-labelledby="nav-education-tab">
                                                    <div class="tab-pane" id="education">
                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                <a class="nav-link active" id="nav-edu1-tab"
                                                                    data-toggle="tab" data-target="#nav-edu1"
                                                                    type="button" role="tab" aria-controls="nav-edu1"
                                                                    aria-selected="true">ระดับที่
                                                                    1</a>
                                                                <a class="nav-link" id="nav-edu2-tab" data-toggle="tab"
                                                                    data-target="#nav-edu2" type="button" role="tab"
                                                                    aria-controls="nav-edu2"
                                                                    aria-selected="false">ระดับที่
                                                                    2</a>
                                                                <a class="nav-link" id="nav-edu3-tab" data-toggle="tab"
                                                                    data-target="#nav-edu3" type="button" role="tab"
                                                                    aria-controls="nav-edu3"
                                                                    aria-selected="false">ระดับที่
                                                                    3</a>
                                                                <a class="nav-link" id="nav-edu4-tab" data-toggle="tab"
                                                                    data-target="#nav-edu4" type="button" role="tab"
                                                                    aria-controls="nav-edu4"
                                                                    aria-selected="false">ระดับที่
                                                                    4</a>
                                                            </div>
                                                        </nav>

                                                        <div class="tab-content">
                                                            <!-- ส่วนที่ศึกษา 1 -->
                                                            <div class="tab-pane fade show active" id="nav-edu1"
                                                                role="tabpanel" aria-labelledby="nav-edu1-tab">
                                                                <div class="active tab-pane" id="edu1">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoName1">สถาบัน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoName1" id="EdoName1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoBackground1">คุณวุฒิ
                                                                                :</label>
                                                                            <select class="custom-select"
                                                                                name="EdoBackground1"
                                                                                id="EdoBackground1">
                                                                                <option value="">
                                                                                </option>
                                                                                <option value="ป.6">ป.6</option>
                                                                                <option value="ม.3">ม.3</option>
                                                                                <option value="ม.6">ม.6</option>
                                                                                <option value="ปวช">ปวช</option>
                                                                                <option value="ปวส">ปวส</option>
                                                                                <option value="ป.ตรี">ป.ตรี</option>
                                                                                <option value="ป.โท">ป.โท</option>
                                                                                <option value="ป.เอก">ป.เอก</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoDepartment1">สาขา :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoDepartment1"
                                                                                id="EdoDepartment1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoAvgGrade1">เกรดเฉลี่ย
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoAvgGrade1" id="EdoAvgGrade1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearIn1">ปีที่เข้า :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearIn1" id="EdoYearIn1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearOut1">ปีที่จบ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearOut1" id="EdoYearOut1">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่ศึกษา 2 -->
                                                            <div class="tab-pane fade show " id="nav-edu2"
                                                                role="tabpanel" aria-labelledby="nav-edu2-tab">
                                                                <div class=" tab-pane" id="edu2">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoName2">สถาบัน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoName2" id="EdoName2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoBackground2">คุณวุฒิ
                                                                                :</label>
                                                                            <select class="custom-select"
                                                                                name="EdoBackground2"
                                                                                id="EdoBackground2">
                                                                                <option value="">
                                                                                </option>
                                                                                <option value="ป.6">ป.6</option>
                                                                                <option value="ม.3">ม.3</option>
                                                                                <option value="ม.6">ม.6</option>
                                                                                <option value="ปวช">ปวช</option>
                                                                                <option value="ปวส">ปวส</option>
                                                                                <option value="ป.ตรี">ป.ตรี</option>
                                                                                <option value="ป.โท">ป.โท</option>
                                                                                <option value="ป.เอก">ป.เอก</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoDepartment2">สาขา :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoDepartment2"
                                                                                id="EdoDepartment2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoAvgGrade2">เกรดเฉลี่ย
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoAvgGrade2" id="EdoAvgGrade2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearIn2">ปีที่เข้า :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearIn2" id="EdoYearIn2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearOut2">ปีที่จบ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearOut2" id="EdoYearOut2">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่ศึกษา 3 -->
                                                            <div class="tab-pane fade " id="nav-edu3" role="tabpanel"
                                                                aria-labelledby="nav-edu3-tab">
                                                                <div class=" tab-pane" id="edu3">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoName3">สถาบัน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoName3" id="EdoName3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoBackground3">คุณวุฒิ
                                                                                :</label>
                                                                            <select class="custom-select"
                                                                                name="EdoBackground3"
                                                                                id="EdoBackground3">
                                                                                <option value="">
                                                                                </option>
                                                                                <option value="ป.6">ป.6</option>
                                                                                <option value="ม.3">ม.3</option>
                                                                                <option value="ม.6">ม.6</option>
                                                                                <option value="ปวช">ปวช</option>
                                                                                <option value="ปวส">ปวส</option>
                                                                                <option value="ป.ตรี">ป.ตรี</option>
                                                                                <option value="ป.โท">ป.โท</option>
                                                                                <option value="ป.เอก">ป.เอก</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoDepartment3">สาขา :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoDepartment3"
                                                                                id="EdoDepartment3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoAvgGrade3">เกรดเฉลี่ย
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoAvgGrade3" id="EdoAvgGrade3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearIn3">ปีที่เข้า :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearIn3" id="EdoYearIn3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearOut3">ปีที่จบ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearOut3" id="EdoYearOut3">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่ศึกษา 4 -->
                                                            <div class="tab-pane fade  " id="nav-edu4" role="tabpanel"
                                                                aria-labelledby="nav-edu4-tab">
                                                                <div class=" tab-pane" id="edu4">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoName4">สถาบัน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoName4" id="EdoName4">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoBackground4">คุณวุฒิ
                                                                                :</label>
                                                                            <select class="custom-select"
                                                                                name="EdoBackground4"
                                                                                id="EdoBackground4">
                                                                                <option value="">
                                                                                </option>
                                                                                <option value="ป.6">ป.6</option>
                                                                                <option value="ม.3">ม.3</option>
                                                                                <option value="ม.6">ม.6</option>
                                                                                <option value="ปวช">ปวช</option>
                                                                                <option value="ปวส">ปวส</option>
                                                                                <option value="ป.ตรี">ป.ตรี</option>
                                                                                <option value="ป.โท">ป.โท</option>
                                                                                <option value="ป.เอก">ป.เอก</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoDepartment4">สาขา :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoDepartment4"
                                                                                id="EdoDepartment4">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoAvgGrade4">เกรดเฉลี่ย
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoAvgGrade4" id="EdoAvgGrade4">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearIn4">ปีที่เข้า :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearIn4" id="EdoYearIn4">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="EdoYearOut4">ปีที่จบ :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="EdoYearOut4" id="EdoYearOut4">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- หัวข้อ 6 -->
                                                <div class="tab-pane fade" id="nav-history" role="tabpanel"
                                                    aria-labelledby="nav-history-tab">
                                                    <div class="tab-pane" id="history">
                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                <a class="nav-link active" id="nav-com1-tab"
                                                                    data-toggle="tab" data-target="#nav-com1"
                                                                    type="button" role="tab" aria-controls="nav-com1"
                                                                    aria-selected="true">บริษัทที่
                                                                    1</a>
                                                                <a class="nav-link" id="nav-com2-tab" data-toggle="tab"
                                                                    data-target="#nav-com2" type="button" role="tab"
                                                                    aria-controls="nav-com2"
                                                                    aria-selected="false">บริษัทที่
                                                                    2</a>
                                                                <a class="nav-link" id="nav-com3-tab" data-toggle="tab"
                                                                    data-target="#nav-com3" type="button" role="tab"
                                                                    aria-controls="nav-com3"
                                                                    aria-selected="false">บริษัทที่
                                                                    3</a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content">
                                                            <!-- ส่วนที่wk 1 -->
                                                            <div class="tab-pane fade show active" id="nav-com1"
                                                                role="tabpanel" aria-labelledby="nav-com1-tab">
                                                                <div class="active tab-pane" id="com1">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkName1">ชื่อบริษัท :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkName1" id="WorkName1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label
                                                                                for="WorkStartSalary1">เงินเดือนเริ่มต้น
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkStartSalary1"
                                                                                id="WorkStartSalary1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkStopSalary1">เงินเดือนล่าสุด
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkStopSalary1"
                                                                                id="WorkStopSalary1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkPosition1">ตำแหน่ง :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkPosition1" id="WorkPosition1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkDetail1">ลักษณะงาน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkDetail1" id="WorkDetail1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkReason1">สาเหตุที่ออก
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkReason1" id="WorkReason1">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่wk 2 -->
                                                            <div class="tab-pane fade show " id="nav-com2"
                                                                role="tabpanel" aria-labelledby="nav-com2-tab">
                                                                <div class=" tab-pane" id="com2">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkName2">ชื่อบริษัท :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkName2" id="WorkName2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label
                                                                                for="WorkStartSalary2">เงินเดือนเริ่มต้น
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkStartSalary2"
                                                                                id="WorkStartSalary2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkStopSalary2">เงินเดือนล่าสุด
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkStopSalary2"
                                                                                id="WorkStopSalary2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkPosition2">ตำแหน่ง :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkPosition2" id="WorkPosition2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkDetail2">ลักษณะงาน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkDetail2" id="WorkDetail2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkReason2">สาเหตุที่ออก
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkReason2" id="WorkReason2">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- ส่วนที่wk 3 -->
                                                            <div class="tab-pane fade show " id="nav-com3"
                                                                role="tabpanel" aria-labelledby="nav-com3-tab">
                                                                <div class=" tab-pane" id="com3">
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkName3">ชื่อบริษัท :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkName3" id="WorkName3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label
                                                                                for="WorkStartSalary3">เงินเดือนเริ่มต้น
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkStartSalary3"
                                                                                id="WorkStartSalary3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkStopSalary3">เงินเดือนล่าสุด
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkStopSalary3"
                                                                                id="WorkStopSalary3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkPosition3">ตำแหน่ง :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkPosition3" id="WorkPosition3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkDetail3">ลักษณะงาน :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkDetail3" id="WorkDetail3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="WorkReason3">สาเหตุที่ออก
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                name="WorkReason3" id="WorkReason3">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <hr style="border-top: 1px solid #ccc;">
                                                <div id="CancleEmp">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="checkEmpEnd">ยกเลิกการใช้งาน : </label>
                                                        <input type="checkbox" class="flat-red" id="checkEmpEnd"
                                                            name="checkEmpEnd">
                                                        <input type="date" class="form-control" name="EmpEnd"
                                                            id="EmpEnd">
                                                    </div>

                                                    <div id="divreasonend">
                                                        <div class="col-md-3 mb-3">
                                                            <label for="ReasonEnd">เหตุผล :</label>
                                                            <select class="custom-select" name="ReasonEnd"
                                                                id="ReasonEnd">
                                                                <option value=""></option>
                                                                <option value="ลาออก">ลาออก</option>
                                                                <option value="ปลดออก">ปลดออก</option>
                                                                <option value="ไม่ผ่านทดลองงาน">ไม่ผ่านทดลองงาน
                                                                </option>
                                                                <option value="จบฝึกงาน">จบฝึกงาน</option>
                                                            </select><br><br>
                                                            <textarea class="form-control col-md-12 mb-12"
                                                                id="RemarkEnd" name="RemarkEnd"></textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                                <button type="submit" id="btnSubmit" form="frmEmployee"
                                                    style="float:right;" class="btn btn-primary">ยืนยัน</button>

                                                <input id="btnEdit" class="btn btn-primary" style="float:right;"
                                                    value="แก้ไข" type="button"></input>
                                            </div>
                                        </form>
                                    </div>
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