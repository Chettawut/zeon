<?php
	header('Content-Type: application/json');
	include_once('../../../conn.php');

	// $_POST['idcode'] = 'GR23/0001';
	$sql = "SELECT b.grcode,b.grno,c.stcode,c.stname1,b.amount ,b.pocode,b.unit,b.price,b.discount,b.grstatus ";
	$sql .= "FROM grdetail as b inner join stock as c on (c.stcode=b.stcode)  ";
	$sql .= "where b.grcode = '".$_POST['idcode']."' order by b.grno  ";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"grcode" => array(),
		"grno" => array(),
		"stcode" => array(),
		"pocode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),
		"price" => array(),
		"discount" => array(),		
		"grstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['grcode'],$row["grcode"]);
			array_push($json_result['grno'],$row["grno"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['discount'],$row["discount"]);			
			array_push($json_result['grstatus'],$row["grstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>