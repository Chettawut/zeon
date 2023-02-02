<?php
	header('Content-Type: application/json');
    include_once('../../const.php');
    $conn= sql_connect() ;
    $result='';
    $strSQL = "SELECT [DepID],[DepName],[iddep] FROM [RWI_DATACENTER].[dbo].[Au_Department] order by iddep";

    $obj=odbc_exec($conn,$strSQL) ;

    while($oRs = odbc_fetch_array($obj))
    {
        $strSQL2 = "SELECT [EmpCode],[EmpName],[LastName],[ETitleName],[DepCode],EmpEnd   FROM [RWI_DATACENTER].[dbo].[Au_EmpMaster] where DepCode = '".$oRs["DepID"]."' and EmpEnd = '' order by empname";

        $obj2=odbc_exec($conn,$strSQL2) ;
        $r = odbc_num_rows($obj2);
        $color;
        $result .= '<li id='.$oRs["DepID"].' class="treeview" style="margin: 10px;"><a href="#"><span>'.$oRs["DepName"].'</span><span class="label label-primary pull-right">'.$r.'</span><span class="pull-right-container">';
        // $result .= '<i class="fa fa-angle-left pull-right">';
        $result .= '</i></span></a>';
        $result .= '<ul class="treeview-menu" style=" overflow: auto">'; 
        

        

            while($oRs2 = odbc_fetch_array($obj2))
            {
            $result .= '<li class="treeview" style="margin: 0px;"><a href="#" onclick="onclickEditEmployee('.$oRs2["EmpCode"].');" ">';
            $result .= '<i class="fa fa-circle-o"></i>'.$oRs2["ETitleName"].' '.$oRs2["EmpName"].' '.$oRs2["LastName"].'</a></li>';
            }
        $result .= '</ul></li>';
           
    }

    
    
    
    $result = iconv("tis-620","UTF-8",$result);
    echo json_encode(array('status' => '1','message'=> $result ));
?>
                            