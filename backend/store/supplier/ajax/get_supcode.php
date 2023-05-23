<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	$sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "supcode" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%04s", ($row["maxsupcode"]+1));
            $yearsocode=substr( $row["year"], -2);
			$monthsocode=date("m");
            array_push($json_result['supcode'],$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>