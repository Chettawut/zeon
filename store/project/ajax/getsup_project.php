<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
	
	$strSQL = "SELECT projectcode,projectname,status,s_date,s_time,s_user from project";
	$strSQL .= " where projectcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
        "projectcode" => array(),
		"projectname" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['projectcode'],$row["projectcode"]);
			array_push($json_result['projectname'],$row["projectname"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>