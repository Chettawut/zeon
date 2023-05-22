<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM `stock` where status = 'Y' and (type='FG' or type='SFG' ) ";
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"code" => array(),
        "stcode" => array(),
		"stname1" => array(),
		"type" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['code'],$row["code"]);
            array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['type'],$row["type"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>