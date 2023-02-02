<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.code,a.stcodemain,a.stcode,b.stname1,a.stno,a.amount,a.unit ";
	$sql .= " FROM bom a ";  
	$sql .= " INNER JOIN stock b ";
	$sql .= " ON a.stcode = b.stcode ";  
	$sql .= " where stcodemain = '".$_POST['idcode']."' ";  
	

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "code" => array(),
		"stcodemain" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"stno" => array(),
		"amount" => array(),
		"unit" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcodemain'],$row["stcodemain"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['stno'],$row["stno"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			
        }
        echo json_encode($json_result);



?>