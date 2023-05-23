<?php
	header('Content-Type: application/json');
    include_once('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);    
    $unit = explode(',', $_POST['unit']);

    // $amount = array(2, 2, 2, 2, 2);
    // $stcode = array("106676", "107120", "107353", "100001", "103101");
    
    $checkstcode=1;
    
    $array = implode("','",$stcode);

        $sql = "SELECT b.stcodemain,a.stcode  ,SUM(b.amount) as amountneed ,c.amount,a.stname1,a.unit,a.type ";
        $sql .= "FROM stock a inner join bom as b on (a.stcode=b.stcode) inner join stock_level as c on (a.stcode=c.stcode)  ";
        // $sql .= "where b.stcodemain = '".$stcode[$key]."' ";
        $sql .= "where b.stcodemain IN ('".$array."') ";
        
        $sql .= " group by a.stcode  order by a.stcode ";
        $query = mysqli_query($conn,$sql);

        // echo $sql;

        while($row = $query->fetch_assoc()) {
            if($checkstcode)
            {
                
                if(($row["amountneed"]*$amount[array_search($row["stcodemain"],$stcode)])>$row["amount"])
                {
                    // echo $row["stcodemain"].' '.$row["stcode"].' '.$row["amountneed"].' '.$row["amount"].' '.$row["amount"]*$amount[array_search($row["stcodemain"],$stcode)]."\n";
                echo json_encode(array('status' => '0','message'=> 'รหัสสินค้า '.$row["stcode"].' '.$row["stname1"].' มี '.$row["amount"].' แต่ต้องใช้ '.$row["amountneed"]*$amount[array_search($row["stcodemain"],$stcode)]));
                
                $checkstcode=0;
                }
            }
        }
    

    
    // if(false)
    if($checkstcode)
    {
        $query = mysqli_query($conn,$sql);
        while($row = $query->fetch_assoc()) {

            $strSQL2 = "UPDATE stock_level SET ";
            $strSQL2 .= " amount = amount-'".$row["amountneed"]*$amount[array_search($row["stcodemain"],$stcode)]."' ";
            $strSQL2 .= "WHERE stcode = '".$row["stcode"]."' and places = '1' ";

            // echo $strSQL2."\n";
            $query2 = mysqli_query($conn,$strSQL2);

        }

        if($query2)
        {
            $code;
            $wocode;
            $yearwocode;

            $sql = "SELECT * FROM options order by year desc LIMIT 1";
            $query = mysqli_query($conn,$sql);

                while($row = $query->fetch_assoc()) {
                    $code=sprintf("%04s", ($row["maxwocode"]+1));
                    $yearwocode=substr( $row["year"], -2);
                    $wocode= 'WO'.$yearwocode.'/'.$code;
                    
                }

            $StrSQL = "INSERT INTO womaster (wocode,wodate,shift,location,date , time";
            $StrSQL .= ")";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$wocode."','".$_POST["add_wodate"]."','".$_POST["add_shift"]."','".$_POST["add_location"]."' ";
            $StrSQL .= " , '".date("Y-m-d")."','".date("H:i:s")."' ";
            $StrSQL .= ") ";
            $query = mysqli_query($conn,$StrSQL);

            if($query) {
                $strSQL = "UPDATE options SET ";
                $strSQL .= "maxwocode='".$code."' ";
                $strSQL .= "WHERE year= ".date("Y")." ";
                $query = mysqli_query($conn,$strSQL);

                foreach ($stcode as $key=> $value) {
                    $strSQL2 = "UPDATE stock_level SET ";
                    $strSQL2 .= " amount = amount+'".$amount[$key]."' ";
                    $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and places = '1' ";
                    $query2 = mysqli_query($conn,$strSQL2);
                    
                    $StrSQL = "INSERT INTO wodetail (wocode , stcode  , unit , amount  , wostatus  ";
                
                    //grno ต้องอยู่ท้ายตลอด
                    $StrSQL .= ", wono)";
                    $StrSQL .= "VALUES (";
                    $StrSQL .= "'".$wocode."', '". $stcode[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."', 'ผลิตสำเร็จ' ";            
                    $StrSQL .= ", '". ++$key ."' ) ";
                    $query3 = mysqli_query($conn,$StrSQL);

                    if($query3) {
                        echo json_encode(array('status' => '1','message'=> 'เพิ่มใบรับสินค้า '. $wocode.' สำเร็จ'));
                    }
                    else
                    {
                        echo json_encode(array('status' => '0','message'=> $StrSQL));
                    }
                }
                    
                
            }
        }
    }
    // echo $StrSQL;

    
        
    
        mysqli_close($conn);
?>