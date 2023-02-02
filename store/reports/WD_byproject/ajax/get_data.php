<?php
	header('Content-Type: application/json');
	include('../../../../conn.php');

	$sql = "SELECT c.projectname,sum(amount*cost) as total ";
	$sql .= "FROM wddetail as a inner join wdmaster as b on(a.wdcode=b.wdcode) inner join project  as c on (b.projectcode=c.projectcode) ";   
    $sql .= "group by c.projectcode order by c.projectcode; ";

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "projectname" => array(),
		"total" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['projectname'],$row["projectname"]);
			array_push($json_result['total'],$row["total"]);
        }
        echo json_encode($json_result);



?>