<?php
	header('Content-Type: application/json');
    include('/../../../const.php');
    $conn= sql_connect() ;
        
    $strSQL = "select EmpCode,EmpName,LastName from Au_EmpMaster where EmpCode = '".($_POST["idcode"])."'";

    $obj=odbc_exec($conn,$strSQL) ;

    $json_result=array(
        "EmpCode" => array(),
        "EmpName" => array(),
        "LastName" => array()

        );

    while(odbc_fetch_array($obj))
    {
        array_push($json_result['EmpCode'], odbc_result($obj, "EmpCode"));
        array_push($json_result['EmpName'], iconv("tis-620","UTF-8",odbc_result($obj, "EmpName")));
        array_push($json_result['LastName'], iconv("tis-620","UTF-8",odbc_result($obj, "LastName")));
        
           
    }

    echo json_encode($json_result);
        
        odbc_close_all();
?>