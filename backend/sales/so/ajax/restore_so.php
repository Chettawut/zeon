<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");
    
    $status = "Active";
    $so_code = $_POST["socode"];
        
        $StrSQL = "UPDATE sfdetail SET supstatus = '$status' WHERE socode = '$so_code'";
        $query = mysqli_query($conn,$StrSQL);  
            

        if($query) {            
            echo json_encode(array('status' => '1','message'=> $status . ' Sale Forcast '. $so_code.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
?>