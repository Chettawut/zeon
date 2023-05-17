<?php
	header('Content-Type: application/json');
	include_once('../../../conn.php');

	// $_POST['idcode'] = 'GR23/0001';
	$sql = "SELECT a.grcode,a.grdate,a.invcode,a.invdate,a.lotno,c.stcode,c.stname1,b.grstatus ";
	$sql .= "FROM `grmaster` as a inner join grdetail as b on (a.grcode=b.grcode) inner join stock as c on (c.stcode=b.stcode)  ";
	$sql .= "where a.grcode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	
	$json_result=array(
        "grcode" => array(),
		"grdate" => array(),
		"invcode" => array(),
		"invdate" => array(),
		"lotno" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"grstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {

            array_push($json_result['grcode'],$row["grcode"]);
			array_push($json_result['grdate'],$row["grdate"]);
			array_push($json_result['invcode'],$row["invcode"]);
			array_push($json_result['invdate'],$row["invdate"]);
			array_push($json_result['lotno'],$row["lotno"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['grstatus'],$row["grstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>