<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	// $_POST['sfdate']='2023-03';

	$sql = "SELECT sum(b.amount) as amount ,c.stcode,d.stname1,b.unit,d.type ";
	$sql .= "FROM sfmaster a inner join sfdetail as b on (a.socode=b.socode) inner join bom as c on (b.stcode=c.stcodemain) inner join stock as d on (c.stcode=d.stcode)  ";  
	$sql .= " where a.sfdate = '".$_POST['sfdate']."' and b.supstatus != 'Cancel' ";  
	$sql .= " GROUP by stcode ";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		// "socode" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),
		"type" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {

			if($row["type"]=='SFG')
			{
				
				$sql2 = "SELECT a.stcode ,b.amount ,a.stname1,a.unit,a.type ";
				$sql2 .= "FROM stock a inner join bom as b on (a.stcode=b.stcode)  ";  
				$sql2 .= " where b.stcodemain = '".$row["stcode"]."' ";  

				$query2 = mysqli_query($conn,$sql2);
				while($row2 =$query2->fetch_assoc()) {

					if($row2["type"]=='SFG')
					{

						$sql3 = "SELECT a.stcode ,b.amount ,a.stname1,a.unit,a.type ";
						$sql3 .= "FROM stock a inner join bom as b on (a.stcode=b.stcode)  ";  
						$sql3 .= " where b.stcodemain = '".$row2["stcode"]."' ";  

						$query3 = mysqli_query($conn,$sql3);
						while($row3 =$query3->fetch_assoc()) {

							array_push($json_result['stcode'],$row3["stcode"]);
							array_push($json_result['stname1'],$row3["stname1"]);
							array_push($json_result['amount'],(float)($row3["amount"]*(($row2["amount"]*$row["amount"]))));
							array_push($json_result['unit'],$row3["unit"]);
							array_push($json_result['type'],$row3["type"]);
							
						}

					}
					else
					{
					array_push($json_result['stcode'],$row2["stcode"]);
					array_push($json_result['stname1'],$row2["stname1"]);
					array_push($json_result['amount'],(float)($row2["amount"]*$row["amount"]));
					array_push($json_result['unit'],$row2["unit"]);
					array_push($json_result['type'],$row2["type"]);
					}
				}
			}
			else
			{
			// array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],(float)$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['type'],$row["type"]);
			}
        }
        echo json_encode($json_result);


?>