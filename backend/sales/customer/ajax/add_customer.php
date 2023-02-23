<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $StrSQL = "INSERT INTO customer (`cuscode`, `cusname`, `idno`, `road`, `subdistrict`, `district` ";
    $StrSQL .= ",`province`, `zipcode`, `tel`, `fax`, `taxnumber`, `email`, `status`) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["add_cuscode"]."','".$_POST["add_cusname"]."','".$_POST["add_idno"]."','".$_POST["add_road"]."' ";
    $StrSQL .= ",'".$_POST["add_subdistrict"]."','".$_POST["add_district"]."','".$_POST["add_province"]."','".$_POST["add_zipcode"]."' ";
    $StrSQL .= ",'".$_POST["add_tel"]."','".$_POST["add_fax"]."','".$_POST["add_taxnumber"]."','".$_POST["add_email"]."','Y' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    

    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มลูกค้า '.$_POST["add_cusname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>