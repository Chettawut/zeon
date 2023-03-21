<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT stcode,stname1 ";
	$sql .= " FROM stock  ";
	$sql .= " where type = 'FG' or type = 'SFG' ";  
	

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"stcode" => array(),
		"stname1" => array()

		// ,
		// "stcode" => array(),
		
		// "stno" => array(),
		// "amount" => array(),
		// "unit" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			
        }
        echo json_encode($json_result);



?>