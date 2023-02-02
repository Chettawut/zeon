<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    

    $strSQL = "UPDATE project SET ";
    $strSQL .= "projectcode='".$_POST["projectcode"]."',projectname='".$_POST["projectname"]."',status='".$_POST["status"]."' ";
    $strSQL .= ",s_date= '".date("Y-m-d")."',s_time= '".date("H:i:s")."',s_user='chayapat' ";
    $strSQL .= "WHERE projectcode= '".$_POST["projectcode"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขโปรเจ็ค'.$_POST["projectname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>