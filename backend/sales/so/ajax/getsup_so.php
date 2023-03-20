<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT a.socode,a.sfdate,a.remark ";
	$sql .= "FROM `sfmaster` as a inner join sfdetail as b on (a.socode=b.socode) inner join stock as c on (c.stcode=b.stcode)  ";
	$sql .= "where a.socode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "sfcode" => array(),
		"sfdate" => array(),
		"remark" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['sfcode'],$row["socode"]);
			array_push($json_result['sfdate'],$row["sfdate"]);
			array_push($json_result['remark'],$row["remark"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>