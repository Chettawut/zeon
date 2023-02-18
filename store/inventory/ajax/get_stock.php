<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT b.amount as amount1,a.type,a.stcode,a.stname1,a.unit,a.status,a.code ";
	$sql .= "FROM stock a inner join stock_level as b on (a.stcode=b.stcode) ";  
	$sql .= " where b.places = 1 ";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "code" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount1" => array(),
		"type" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount1'],$row["amount1"]);
			array_push($json_result['type'],$row["type"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>