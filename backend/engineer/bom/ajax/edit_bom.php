<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    $code = explode(',', $_POST['code']);
    $amount = explode(',', $_POST['amount']);
    $unit = explode(',', $_POST['unit']);

    foreach ($code as $key=> $value) {

        $strSQL = "UPDATE bom SET amount ='". $amount[$key] ."', unit ='". $unit[$key] ."'  ";
        $strSQL .= ",s_date='".date("Y-m-d")."',s_time='".date("H:i:s")."'";
        $strSQL .= "WHERE code= '".$code[$key]."'  ";
        
        $query = mysqli_query($conn,$strSQL);
        }
	
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไข BOM สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>