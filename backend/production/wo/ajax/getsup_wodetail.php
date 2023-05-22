<?php
	header('Content-Type: application/json');
	include_once('../../../conn.php');

	// $_POST['idcode'] = 'GR23/0001';
	$sql = "SELECT b.wocode,b.wono,c.stcode,c.stname1,b.amount ,b.unit,b.price,b.wostatus ";
	$sql .= "FROM wodetail as b inner join stock as c on (c.stcode=b.stcode)  ";
	$sql .= "where b.wocode = '".$_POST['idcode']."' order by b.wono  ";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"wocode" => array(),
		"wono" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),
		"price" => array(),	
		"wostatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['wocode'],$row["wocode"]);
			array_push($json_result['wono'],$row["wono"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);		
			array_push($json_result['wostatus'],$row["wostatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>