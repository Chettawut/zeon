<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $cost = explode(',', $_POST['cost']);
    

    $code;
    $wdcode;
    $yearwdcode;
    $sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=(sprintf("%03s", $row["maxwdcode"]));
            $yearwdcode=$row["year"];
			$wdcode= $yearwdcode.'/'.($code+1);
        }

    $StrSQL = "INSERT INTO wdmaster (wdcode,wddate,wdtime,empcode,projectcode,remark,s_date ,s_time , s_user";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$wdcode."','".$_POST["add_wddate"]."','".$_POST["add_wdtime"]."','100001','".$_POST["add_projectcode"]."' ";
    $StrSQL .= ", '".$_POST["add_remark"]."' , '".date("Y-m-d")."','".date("H:i:s")."' , 'tester' ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxwdcode='".($code)."' ";
        $strSQL .= "WHERE year= ".$yearwdcode." ";
        $query = mysqli_query($conn,$strSQL);
        foreach ($stcode as $key=> $value) {
            $StrSQL = "INSERT INTO wddetail (wdcode , stcode , cost , unit , amount , status ,s_date ,s_time , s_user ";

            //wdno ต้องอยู่ท้ายตลอด
            $StrSQL .= ", wdno)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$wdcode."', '". $stcode[$key] ."', '". $cost[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , '03' ";            
            $StrSQL .= ", '".date("Y-m-d")."','".date("H:i:s")."' , 'tester' ";
            $StrSQL .= ", '". ++$key ."' ) ";
            $query = mysqli_query($conn,$StrSQL);
            }
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบเบิก '. $wdcode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>