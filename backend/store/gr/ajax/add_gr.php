<?php
	header('Content-Type: application/json');
    include_once('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    

    $code;
    $grcode;
    $yeargrcode;
    
    $sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=sprintf("%04s", ($row["maxgrcode"]+1));
            $yeargrcode=substr( $row["year"], -2);
			$grcode= 'GR'.$yeargrcode.'/'.$code;
            
        }

    $StrSQL = "INSERT INTO grmaster (grcode,lotno,grdate,invcode,invdate ,date , time";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$grcode."','".$_POST["add_lotno"]."','".$_POST["add_grdate"]."','".$_POST["add_invcode"]."','".$_POST["add_invdate"]."' ";
    $StrSQL .= " , '".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxgrcode='".$code."' ";
        $strSQL .= "WHERE year= ".date("Y")." ";
        $query = mysqli_query($conn,$strSQL);

        foreach ($stcode as $key=> $value) {
            $strSQL2 = "UPDATE product_level SET ";
            $strSQL2 .= " amount= amount+'".$amount[$key]."' ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and places = '1' ";
            $query2 = mysqli_query($conn,$strSQL2);
            
            $StrSQL = "INSERT INTO grdetail (grcode , stcode  , unit , amount  , grstatus, places  ";
        
            //grno ต้องอยู่ท้ายตลอด
            $StrSQL .= ", grno)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$grcode."', '". $stcode[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."', 'รับสินค้าแล้ว', '1' ";            
            $StrSQL .= ", '". ++$key ."' ) ";
            $query3 = mysqli_query($conn,$StrSQL);
        }
            
        
    }
    
    // echo $StrSQL;

    
        if($query3) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบรับสินค้า '. $grcode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>