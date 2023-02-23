<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    
    if($_POST["vat"]=='Y')
    $places = 1;
    else
    $places = 2;


    $code='';
    $warehouse=array("","A","B","C");
    $socode;
    $yearsocode;
    $check = 1;
    $current_amount=0;
    $current_price=0;
    $current_amtprice=0;

    foreach ($stcode as $key=> $value) {
        $sql = "SELECT amount FROM stock_level ";
        $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places ."' ";
        $query = mysqli_query($conn,$sql);
        while($row = $query->fetch_assoc()) {

            $radio=1;

            if($unit[$key]=='ลัง')
            {
                $sql = "SELECT ratio FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) ";
                $sql .= " WHERE a.stcode = '". $stcode[$key] ."' ";
                $query = mysqli_query($conn,$sql);
                $row2 = $query->fetch_assoc();
                $radio=$row2["ratio"];
            }
        
            if($row["amount"]<($amount[$key]*$radio))
            {
                $code .= 'ยอดสต๊อกรหัส '.$stcode[$key].' สต๊อก '.$warehouse[$places].' ไม่เพียงพอ                                                    ';
                $check = 0;
            }
        }

        // $code++;
        
    }        

    if($check==1)
    {

        //ตัดสต๊อกสินค้า 
        foreach ($stcode as $key=> $value) {

            $radio=1;

            
                $sql = "SELECT b.ratio,c.amount,c.price,c.amtprice FROM `stock` as a INNER join storage_unit as b on (a.storage_id=b.storage_id) INNER join stock_level as c on (a.stcode=c.stcode)";
                $sql .= " WHERE a.stcode = '". $stcode[$key] ."' and c.places = '". $places ."'";
                $query = mysqli_query($conn,$sql);
                $row2 = $query->fetch_assoc();
                if($unit[$key]=='ลัง')
                $radio=$row2["ratio"];
                $current_amount=$row2["amount"]- ((int)$amount[$key]*$radio) ;
                
                if($current_amount!=0)
                {
                    $current_price=$row2["price"]-($row2["amtprice"]*($amount[$key]*$radio));                
                    $current_amtprice=$current_price/$current_amount;
                }
                else
                {
                    $current_price=0;
                    $current_amtprice=0;
                }
                
                
            

            $sql = "UPDATE stock_level SET amount = ".$current_amount." ,price = ".$current_price.",amtprice= ".$current_amtprice." ";
            $sql .= " WHERE stcode = '". $stcode[$key] ."' and places = '". $places ."' ";
            $query = mysqli_query($conn,$sql);

            if(!$query) 
            {
                $code .= $stcode[$key].' ';
                $check = 0;
            }
        }

        
        $sql = "SELECT * FROM options order by year desc LIMIT 1";
        $query = mysqli_query($conn,$sql);

            while($row = $query->fetch_assoc()) {
                $code=sprintf("%03s", ($row["maxsocode"]+1));
                $yearsocode=$row["year"];            
                $socode= $yearsocode.'JR'.$code;
            }

        $StrSQL = "INSERT INTO somaster (socode,cuscode,sodate,deldate,paydate,paydate2,payment,paystatus,currency,vat,remark,salecode,date,time";
        $StrSQL .= ")";
        $StrSQL .= "VALUES (";
        $StrSQL .= "'".$socode."','".$_POST["cuscode"]."','".$_POST["sodate"]."','".$_POST["deldate"]."','".$_POST["paydate"]."','".$_POST["paydate2"]."','".$_POST["payment"]."','ยังไม่ปิดจ่าย' ";
        $StrSQL .= ", '".$_POST["currency"]."' , '".$_POST["vat"]."', '".$_POST["remark"]."', '".$_POST["salecode"]."' , '".date("Y-m-d")."','".date("H:i:s")."' ";
        $StrSQL .= ") ";
        $query = mysqli_query($conn,$StrSQL);

        if($query) {
            
            foreach ($stcode as $key=> $value) {
                $StrSQL = "INSERT INTO sodetail (socode , stcode , price , unit , amount , supstatus , discount, giveaway, places ";

                //pono ต้องอยู่ท้ายตลอด
                $StrSQL .= ", sono)";
                $StrSQL .= "VALUES (";
                $StrSQL .= "'".$socode."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , '01', '". $discount[$key] ."', '0', '". $places ."' ";            
                $StrSQL .= ", '". ++$key ."' ) ";
                $query = mysqli_query($conn,$StrSQL);
                }

            $strSQL = "UPDATE options SET ";
            $strSQL .= "maxsocode='".$code."' ";
            $strSQL .= "WHERE year= ".$yearsocode." ";
            $query = mysqli_query($conn,$strSQL);
        }

        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบสั่งขาย '. $socode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
        
    }
    else
    echo json_encode(array('status' => '0','message'=> $code));
    
    // echo $StrSQL;

    
        
?>