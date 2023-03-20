<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	// $_POST['sfdate']='2023-03';

	$sql = "SELECT a.socode ,b.amount as amount1,b.stcode,c.stname1,b.unit ";
	$sql .= "FROM sfmaster a inner join sfdetail as b on (a.socode=b.socode) inner join stock as c on (b.stcode=c.stcode) ";  
	$sql .= " where a.sfdate = '".$_POST['sfdate']."' ";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"socode" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount1" => array(),
		"unit" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount1'],$row["amount1"]);
			array_push($json_result['unit'],$row["unit"]);
        }
        echo json_encode($json_result);



?>