<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    
    // $code = $_POST['code'];

    $StrSQL = "DELETE FROM sfdetail ";
    $StrSQL .= "WHERE codedetail = '".$_POST['code']."' ";

    
	$query = mysqli_query($conn,$StrSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'ลบ รายการสำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>