<?php

    header('Content-Type: application/json');
	include('/../../../const.php');
	$conn= sql_connect() ;
	date_default_timezone_set("Asia/Bangkok");
	$strSQL = "SELECT logcode FROM [RWI_DATACENTER].[dbo].[Au_Logforfood] ";

	$rs=odbc_exec($conn,$strSQL) ;

    $strSQL = " INSERT INTO Au_Logforfood (logcode,empcode,date,time,status) VALUES ('".odbc_num_rows($rs)."','".$_POST["idcode"]."','".date("Y-m-d"). "','".date("H:i:s"). "','01')";

    // echo $strSQL;
	$oRs=odbc_exec($conn,iconv("UTF-8","tis-620",$strSQL)) or die ("Error Execute [".$strSQL."]");

	$strSQL2 = "SELECT * FROM [RWI_DATACENTER].[dbo].[Au_EmpMaster] where empcode ='".$_POST["idcode"]."' ";

    // echo $strSQL;
	$oRs2=odbc_exec($conn,iconv("UTF-8","tis-620",$strSQL2)) or die ("Error Execute [".$strSQL2."]");
    
	if($oRs) 
		echo json_encode(array('status' => '1','message'=> 'ใช้สิทธิ์ '.$_POST["idcode"],'empcode'=> $_POST["idcode"],'date'=> date("Y-m-d"),'time'=> date("H:i:s"),'empname'=> iconv("tis-620","UTF-8",odbc_result($oRs2, "empname")),'lastname'=> iconv("tis-620","UTF-8",odbc_result($oRs2, "lastname")) ));
	else
		echo json_encode(array('status' => '0','message'=> 'Error insert data!'));

	odbc_close_all();	
?>