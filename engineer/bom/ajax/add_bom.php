<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $sql = "SELECT stcodemain,stno FROM bom ";
    $sql .= " where stcodemain = '".$_POST["stcodemain"]."' ";
    $sql .= " order by stno desc LIMIT 1";
    $query = mysqli_query($conn,$sql);

            while($row = $query->fetch_assoc()) {
                $stno=($row["stno"]+1);
            }

    $StrSQL = "INSERT INTO bom (`stcode`, `stcodemain`, `amount`, `unit`,`stno`,`s_date`,`s_time`) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["stcode"]."','".$_POST["stcodemain"]."','1','".$_POST["unit"]."','".$stno."' ";
    $StrSQL .= ",'".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    

    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'Success'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>