<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT ppcode,ppdate,ppstart,ppstop,ppsum,ppnet,status ";
	$sql .= "FROM ppmaster  ";   

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "ppcode" => array(),
		"ppdate" => array(),
		"ppstart" => array(),
		"ppstop" => array(),
		"ppsum" => array(),
		"ppnet" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['ppcode'],$row["ppcode"]);
			array_push($json_result['ppdate'],$row["ppdate"]);
			array_push($json_result['ppstart'],$row["ppstart"]);
			array_push($json_result['ppstop'],$row["ppstop"]);
			array_push($json_result['ppsum'],$row["ppsum"]);
			array_push($json_result['ppnet'],$row["ppnet"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>