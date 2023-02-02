<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    
	// $strSQL = "UPDATE user SET ";
    // $strSQL .= "username='".$_POST["editusername"]."',password='".$_POST["editpassword"]."',firstname='".$_POST["editfirstname"]."',lastname='".$_POST["editlastname"]."',tel='".$_POST["edittel"]."' ";
    // $strSQL .= ",email='".$_POST["editemail"]."',type='".$_POST["edittype"]."',bankcode='".$_POST["editbankcode"]."',bankname='".$_POST["editbankname"]."',date='' ";
    // $strSQL .= "WHERE username= '".$_POST["editusername"]."' ";

    $strSQL = "UPDATE stock SET ";
    $strSQL .= "stcode='".$_POST["stcode"]."',stname1='".$_POST["stname1"]."',unit='".$_POST["unit"]."',stmin1='".$_POST["stmin1"]."' ";
    $strSQL .= ",stmin2='".$_POST["stmin2"]."',sellprice='".$_POST["sellprice"]."',status='".$_POST["status"]."',s_date='".date("Y-m-d")."',s_time='".date("H:i:s")."'";
    $strSQL .= "WHERE code= '".$_POST["code"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขรหัสสินค้า '.$_POST["stcode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>