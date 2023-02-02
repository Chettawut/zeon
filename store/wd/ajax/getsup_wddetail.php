<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	// $_POST['idcode'] = '100001';
	$sql = "SELECT a.wdcode,b.wddate,a.wdno,a.stcode,e.stname1,a.amount,a.unit,d.projectname,a.status FROM `wddetail` as a inner join `wdmaster` as b on (a.wdcode=b.wdcode)  left outer join employee as c on (b.empcode=c.empcode) left outer join project as d on (b.projectcode=d.projectcode) left outer join stock as e on (a.stcode=e.stcode)   ";
	$sql .= "where a.wdcode = '".$_POST['idcode']."'  order by wdno";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "wdcode" => array(),
		"wddate" => array(),
		"wdno" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['wdcode'],$row["wdcode"]);
			array_push($json_result['wddate'],$row["wddate"]);
			array_push($json_result['wdno'],$row["wdno"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);			
			array_push($json_result['status'],$row["status"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>