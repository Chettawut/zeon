<?php
session_start();

if(isset($_GET["year"]))
$year= $_GET["year"];
else
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปยอดเบิกแยก Project</title>

    <?php 
    include_once('css.php'); 
    include_once('../../../config.php');
    include_once ROOT .'/func.php';
    include_once ROOT .'/import_css.php';
    include_once ROOT .'/conn.php';
    ?>
</head>

<body class="pace-primary">
    <div class="row">
        <div class="col-lg-12 col-12">
            <?php 
            // $dt= job_history('job_reset_dinvoice_datacenter');
            date_default_timezone_set("Asia/Bangkok");
            ?>

            <!-- Data as of Date : <?php
            echo date("d/m/Y");
            ?>
            </H6>
            <H6 class="text-left">
                Current Date/Print Date :
                <?php
            echo date("d/m/Y H:i:s");
            ?>
            </H6> -->
            <H3 class="text-right"><img src="<?php echo PATH_CSS; ?>/img/logo1.png" width="80" height="50">
            </H3>
            <H4 class="text-center" style="display:none;">รายงานสรุปยอดเบิกแยก Project </H4>
            <!-- <H5 class="text-right">บาท -->
                <!-- ล้านบาท -->
            </H5>
            <table id="tableData" width="100%" align="center"  class="table table-bordered table-hover">
                <thead>
                    <tr bgcolor="#3c8536">
                        <td class="table03" bgcolor="#cecece" align="center">Products</td>                        
                        <td class="table03" align="right" bgcolor="#c2f8be">
                            <a target="_blank">มูลค่า</a>
                        </td>
                        <td class="table03" align="right" bgcolor="#c2f8be">
                            <a target="_blank">VAT</a>
                        </td>
                        <td class="table03" align="right" bgcolor="#c2f8be">
                            <a target="_blank">มูลค่า + VAT</a>
                        </td>                        
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>

    </div>

    <?php
    include_once ROOT . '/import_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>