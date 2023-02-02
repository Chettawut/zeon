<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	// $_POST['idcode'] = '100001';
	$sql = "SELECT a.wdcode,b.wddate,b.wdtime,a.wdno,a.stcode,a.amount,a.unit,d.projectname,a.status,b.remark ";
	$sql .= "FROM `wddetail` as a inner join `wdmaster` as b on (a.wdcode=b.wdcode)  left outer join project as d on (b.projectcode=d.projectcode)  ";
	$sql .= "where a.wdcode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "wdcode" => array(),
		"wddate" => array(),
		"wdtime" => array(),
		"wdno" => array(),
		"stcode" => array(),
		"amount" => array(),
		"remark" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['wdcode'],$row["wdcode"]);
			array_push($json_result['wddate'],$row["wddate"]);
			array_push($json_result['wdtime'],$row["wdtime"]);
			array_push($json_result['wdno'],$row["wdno"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['remark'],$row["remark"]);			
			array_push($json_result['unit'],$row["unit"]);			
			array_push($json_result['status'],$row["status"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>