<?php
	header('Content-Type: application/json');
    include('/../../../const.php');
    $conn= sql_connect() ;
        
    $strSQL = "SELECT a.logcode,a.empcode,a.date,a.time,b.EmpName ,b.lastName FROM [RWI_DATACENTER].[dbo].[Au_Logforfood] as a inner join [RWI_DATACENTER].[dbo].[Au_EmpMaster] as b on a.empcode = b.empcode where date like '%".date("Y-m-d")."%' and status = '01'
    order by a.date desc,a.time desc";

    $obj=odbc_exec($conn,$strSQL) ;

    $json_result=array(
        "logcode" => array(),
        "empcode" => array(),
        "empname" => array(),
        "lastname" => array(),
		"date" => array(),
		"time" => array()
        );

    while(odbc_fetch_array($obj))
    {
        array_push($json_result['logcode'], odbc_result($obj, "logcode"));
        array_push($json_result['empcode'], odbc_result($obj, "empcode"));
        array_push($json_result['empname'], iconv("tis-620","UTF-8",odbc_result($obj, "empname")));
        array_push($json_result['lastname'], iconv("tis-620","UTF-8",odbc_result($obj, "lastname")));
        array_push($json_result['date'], odbc_result($obj, "date"));
        array_push($json_result['time'], odbc_result($obj, "time"));
           
    }

    echo json_encode($json_result);
        
        odbc_close_all();
?>