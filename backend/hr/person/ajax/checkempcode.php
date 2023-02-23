<?php
include_once('../../../const.php');
header('Content-Type: text/html; charset=tis-620');

    if(isset($_POST["checkEmpCode"])){
        $strSQL = "select top 1 * from [RWI_DATACENTER].[dbo].[Au_EmpMaster] where EMPCODE = '".$_POST['checkEmpCode']."'";
        $oRs=odbc_exec(sql_connect(),$strSQL);

        odbc_fetch_row($oRs);

        if( (odbc_result($oRs, "EMPCODE")==""))
            echo 1;
        else
            echo 0;
    }
?>