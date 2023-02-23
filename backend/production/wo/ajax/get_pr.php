<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.prcode,a.prdate,c.stcode,c.stname1,b.amount,b.supstatus FROM `prmaster` as a inner join prdetail as b on (a.prcode=b.prcode) inner join stock as c on (c.stcode=b.stcode) ";
	$sql .= "order by a.prcode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "prcode" => array(),
		"prdate" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"supstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['prcode'],$row["prcode"]);
            array_push($json_result['prdate'],$row["prdate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>