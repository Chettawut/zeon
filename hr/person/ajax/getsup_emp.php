<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.empcode,a.firstname,a.lastname,a.etitlename,a.dpcode FROM `employee` as a ";	
	$sql .= " where a.empcode = '".$_POST['empcode']."'  ";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "empcode" => array(),
		"firstname" => array(),
		"lastname" => array(),
		"etitlename" => array(),
		"dpcode" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['empcode'],$row["empcode"]);
            array_push($json_result['firstname'],$row["firstname"]);
			array_push($json_result['lastname'],$row["lastname"]);
			array_push($json_result['etitlename'],$row["etitlename"]);
			array_push($json_result['dpcode'],$row["dpcode"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
?>