<?php
	header('Content-Type: application/json');
	include_once('../../../conn.php');

	// $_POST['idcode'] = 'GR23/0001';
	$sql = "SELECT a.wocode,a.wodate,a.shift,a.location,a.remark ";
	$sql .= "FROM `womaster` as a ";
	$sql .= "where a.wocode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	
	$json_result=array(
        "wocode" => array(),
		"wodate" => array(),
		"shift" => array(),
		"location" => array(),
		"remark" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {

            array_push($json_result['wocode'],$row["wocode"]);
			array_push($json_result['wodate'],$row["wodate"]);
			array_push($json_result['shift'],$row["shift"]);
			array_push($json_result['location'],$row["location"]);
			array_push($json_result['remark'],$row["remark"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>