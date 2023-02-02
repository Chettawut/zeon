<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.wdcode,b.wddate,a.stcode,e.stname1,a.amount,c.firstname,c.lastname,d.projectname,a.status FROM `wddetail` as a inner join `wdmaster` as b on (a.wdcode=b.wdcode) left outer join employee as c on (b.empcode=c.empcode) left outer join project as d on (b.projectcode=d.projectcode) left outer join stock as e on (a.stcode=e.stcode)  order by a.wdcode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "wdcode" => array(),
		"wddate" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"name" => array(),
		"projectname" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['wdcode'],$row["wdcode"]);
            array_push($json_result['wddate'],$row["wddate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['name'],$row["firstname"].' '.$row["lastname"]);
			array_push($json_result['projectname'],$row["projectname"]);
			array_push($json_result['status'],$row["status"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>