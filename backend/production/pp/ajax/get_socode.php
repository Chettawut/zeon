<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "ppcode" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%03s", ($row["maxppcode"]+1));
            $yearsocode=substr( $row["year"], -2);
			$monthsocode=date("m");
            array_push($json_result['ppcode'],'PP'.$yearsocode.$monthsocode.$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>