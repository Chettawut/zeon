<?php
	header('Content-Type: application/json');
	include_once('../../../conn.php');
	
	// $_POST['idcode']='100001';
	$strSQL = "SELECT * FROM `stock`  where stcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
        "code" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"unit" => array()
		
        );

        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['unit'],$row["unit"]);
        }
        echo json_encode($json_result);



?>