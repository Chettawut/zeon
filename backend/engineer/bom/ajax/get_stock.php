<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	
	$sql = "SELECT * FROM stock ";
	$sql .= " where status = 'Y' and type != 'FG' order by stcode";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "code" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>