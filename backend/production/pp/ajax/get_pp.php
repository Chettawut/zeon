<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.socode,a.sfdate,c.stcode,c.stname1,a.cuscode,d.cusname,b.supstatus,b.amount,b.unit FROM `ppmaster` as a inner join ppdetail as b on (a.socode=b.socode) inner join stock as c on (c.stcode=b.stcode) left outer join customer as d on (a.cuscode=d.cuscode) ";
	// $sql .= " where b.supstatus = '01'";
	$sql .= " where b.giveaway = 0 ";
	$sql .= " ORDER BY sodate desc,socode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "socode" => array(),
		"sfdate" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"cusname" => array(),
		"amount" => array(),
		"unit" => array(),
		"supstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['socode'],$row["socode"]);
            array_push($json_result['sfdate'],$row["sfdate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['cusname'],$row["cuscode"].' '.$row["cusname"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>