<?php
	header('Content-Type: application/json');
    include('/../../../const.php');
    $conn= sql_connect() ;
        
    $strSQL = "select top 1 logcode,EmpCode,date,time from Au_Logforfood where EmpCode = '".($_POST["idcode"])."' and date = '".date("Y-m-d"). "' order by date desc";
    // $strSQL = "select logcode,EmpCode,date,time from Au_Logforfood where EmpCode = '610718001' and date = '2019-04-01' ";

    $obj=odbc_exec($conn,$strSQL) ;

    $json_result=array(
        "logcode" => array(),
        "EmpCode" => array(),
        "date" => array(),
        "time" => array()

        );

    while(odbc_fetch_array($obj))
    {
        array_push($json_result['logcode'], odbc_result($obj, "logcode"));
        array_push($json_result['EmpCode'], odbc_result($obj, "EmpCode"));
        array_push($json_result['date'], odbc_result($obj, "date"));
        array_push($json_result['time'], odbc_result($obj, "time"));
        
           
    }

    

    echo json_encode($json_result);
        
        odbc_close_all();
?>