<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $sql = "SELECT unit,stname1 FROM `stock` ";
    $sql .= " WHERE stcode = '". $_POST["stcode"] ."'  ";
    $query = mysqli_query($conn,$sql);
    $row = $query->fetch_assoc();

    $sql = "SELECT a.sono FROM `sfdetail` as a  ";
    $sql .= " WHERE a.socode='".$_POST["socode"]."' order by a.sono desc LIMIT 1 ";
    $query = mysqli_query($conn,$sql);
    $row2 = $query->fetch_assoc();


        $StrSQL = "INSERT INTO sfdetail (socode , stcode , unit , amount , supstatus, giveaway, places  ";
                
       //sono ต้องอยู่ท้ายตลอด
        $StrSQL .= ", sono)";
        $StrSQL .= "VALUES (";
        $StrSQL .= "'".$_POST['socode']."', '". $_POST['stcode'] ."', '".$row["unit"]."' , '1', '01', '0', '1' ";            
        $StrSQL .= ", '".($row2["sono"]+1)."' ) ";
        $query = mysqli_query($conn,$StrSQL);

        
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มรายการขายรหัสสำเร็จ','unit'=> $row["unit"],'stname1'=> $row["stname1"]));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
                   
               

    
    // echo $StrSQL;

    
        
?>