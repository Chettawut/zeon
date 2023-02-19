<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	// $_POST['idcode']= '107091';
	$sql = "SELECT a.code,a.stcodemain,a.stcode,b.stname1,a.stno,a.amount,a.unit ";
	$sql .= " FROM bom a ";  
	$sql .= " INNER JOIN stock b ";
	$sql .= " ON a.stcode = b.stcode ";  
	$sql .= " where stcodemain = '".$_POST['idcode']."' ";  
	

	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "code" => array(),
		"stcodemain" => array(),
		"stnamemain" => array(),
		"unitmain" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"stno" => array(),
		"amount" => array(),
		"unit" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['code'],$row["code"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['stno'],$row["stno"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			
        }

		$sql2 = "SELECT * FROM `stock` ";
		$sql2 .= " where stcode = '".$_POST['idcode']."' ";  
		$query2 = mysqli_query($conn,$sql2);

		while($row2 = $query2->fetch_assoc()) {
			array_push($json_result['stcodemain'],$row2["stcode"]);
            array_push($json_result['stnamemain'],$row2["stname1"]);
			array_push($json_result['unitmain'],$row2["unit"]);
        }
        
        echo json_encode($json_result);



?>