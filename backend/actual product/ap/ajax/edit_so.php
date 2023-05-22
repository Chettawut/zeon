<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    
        
        
    foreach ($stcode as $key=> $value) {

            $StrSQL = "UPDATE sfdetail SET unit ='". $unit[$key] ."', amount ='". $amount[$key] ."' ";
            $StrSQL .= "WHERE codedetail='".$stcode[$key]."' ";
                    
            $query = mysqli_query($conn,$StrSQL);                             
                    
                    
    }
                
        
    if($query)
    {
        $StrSQL = "UPDATE sfmaster SET date = '".date("Y-m-d")."', time='".date("H:i:s")."' ";
        $StrSQL .= ",sfdate='".$_POST["editsfdate"]."',remark='".$_POST["editremark"]."' ";
        $StrSQL .= "WHERE socode='".$_POST["editsfcode"]."' ";
        $query = mysqli_query($conn,$StrSQL);
            if($query) {
                echo json_encode(array('status' => '1','message'=> 'แก้ไขใบแจ้งซื้อเรียบร้อยแล้ว '. $_POST["editsfcode"].' สำเร็จ','sql'=> $StrSQL));
            }
            else
            {
                echo json_encode(array('status' => '0','message'=> $StrSQL));
            }
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $error));
    }
    
    
        // mysqli_close($conn);
?>