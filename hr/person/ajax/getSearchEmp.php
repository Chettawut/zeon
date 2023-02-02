<?php
	header('Content-Type: application/json');
    include('/../../const.php');
    $conn= sql_connect() ;
    $key = $_POST["idcode"];
    // $key = '610718001';
    $strSQL = "SELECT A.EmpCode,[EmpName],[LastName],[ETitleName],[EmpNameEN],[LastNameEN],[ETitleNameEN]";
    $strSQL .= ",[EmpEnd],B.EmpNickName   FROM [RWI_DATACENTER].[dbo].[Au_EmpMaster] as A inner join Au_EmpDetail as B ";
    $strSQL .= " on A.EmpCode = B.Empcode where A.EmpCode like '%".$key."%' or EmpName like '%".$key."%' ";
    $strSQL .= " or LastName like '%".$key."%' or EmpNameEN like '%".$key."%' or LastNameEN like '%".$key."%' ";
    $strSQL .= " or B.EmpNickName = '".$key."' and EmpEnd = '' "; 

    // echo  $strSQL;
    $strSQL = iconv("UTF-8","tis-620",$strSQL);
    $obj=odbc_exec($conn,$strSQL) ;

    $json_result=array(
        "EmpCode" => array(),
        "EmpName" => array(),
        "LastName" => array(),
        "ETitleName" => array(),
        "EmpNameEN" => array(),
        "LastNameEN" => array(),
        "ETitleNameEN" => array(),
        "EmpNickName" => array()

        );

    
    while(odbc_fetch_array($obj))
    {
        array_push($json_result['EmpCode'], odbc_result($obj, "EmpCode"));
        array_push($json_result['EmpName'], iconv("tis-620","UTF-8",odbc_result($obj, "EmpName")));
        array_push($json_result['LastName'], iconv("tis-620","UTF-8",odbc_result($obj, "LastName")));
        array_push($json_result['ETitleName'], iconv("tis-620","UTF-8",odbc_result($obj, "ETitleName")));
        array_push($json_result['EmpNameEN'], odbc_result($obj, "EmpNameEN"));
        array_push($json_result['LastNameEN'], odbc_result($obj, "LastNameEN"));
        array_push($json_result['ETitleNameEN'], odbc_result($obj, "ETitleNameEN"));
        array_push($json_result['EmpNickName'], iconv("tis-620","UTF-8",odbc_result($obj, "EmpNickName")));
        
           
    }

    

    echo json_encode($json_result);
        
        odbc_close_all();
?>