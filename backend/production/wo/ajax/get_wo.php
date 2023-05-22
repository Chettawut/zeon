<?php
	header('Content-Type: application/json');
	include_once('../../../conn.php');

	$sql = "SELECT a.wocode,a.wodate,c.stcode,c.stname1,b.wostatus FROM `womaster` as a inner join wodetail as b on (a.wocode=b.wocode) left outer join stock as c on (c.stcode=b.stcode)  order by a.wocode desc";	
	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "wocode" => array(),
		"wodate" => array(),		
		"stcode" => array(),
		"stname1" => array(),
		"supname" => array(),
		"wostatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['wocode'],$row["wocode"]);
            array_push($json_result['wodate'],$row["wodate"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['wostatus'],$row["wostatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>