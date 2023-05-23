<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);

    $socode;
    $year;    
        $sql = "SELECT * FROM options order by year desc LIMIT 1";
        $query = mysqli_query($conn,$sql);

            while($row = $query->fetch_assoc()) {
                $code=sprintf("%03s", ($row["maxppcode"]+1));
                $yearsocode=substr( $row["year"], -2);
                $year=$row["year"];
                $monthsocode=date("m");
                $socode = 'PP'.$yearsocode.$monthsocode.$code;
            }

        $StrSQL = "INSERT INTO ppmaster (socode,sfdate,remark,date,time";
        $StrSQL .= ")";
        $StrSQL .= "VALUES (";
        $StrSQL .= "'".$socode."','".$_POST["sfdate"]."' ";
        $StrSQL .= ", '".$_POST["remark"]."' , '".date("Y-m-d")."','".date("H:i:s")."' ";
        $StrSQL .= ") ";
        $query = mysqli_query($conn,$StrSQL);

        if($query) {
            
            foreach ($stcode as $key=> $value) {
                $StrSQL = "INSERT INTO ppdetail (socode , stcode , unit , amount , supstatus , giveaway, places ";

                //pono ต้องอยู่ท้ายตลอด
                $StrSQL .= ", sono)";
                $StrSQL .= "VALUES (";
                $StrSQL .= "'".$socode."', '". $stcode[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , 'Active', '0', '1' ";            
                $StrSQL .= ", '". ++$key ."' ) ";
                $query = mysqli_query($conn,$StrSQL);
                }

            $strSQL = "UPDATE options SET ";
            $strSQL .= "maxppcode='".$code."' ";
            $strSQL .= "WHERE year= '".$year."' ";
            $query = mysqli_query($conn,$strSQL);
        }

        if($query) {
            echo json_encode(array('status' => '1','message'=> 'Add '. $socode.' Success'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
        
    
    
    // echo $StrSQL;

    
        
?>