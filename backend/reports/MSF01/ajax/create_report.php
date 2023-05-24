<?php
	header('Content-Type: application/json');
	include('../../../conn.php');

	// $_POST['stcode'] = '100001';
	// $_POST['year'] = '2023';	

	$json_result=array(
		"stname1" => array(),
        "cJan" => array(),
		"cFeb" => array(),
		"cMar" => array(),
		"cApr" => array(),
		"cMay" => array(),
		"cJun" => array(),
		"cJul" => array(),		
		"cAug" => array(),
		"cSep" => array(),
		"cOct" => array(),		
		"cNov" => array(),
		"cDec" => array(),
		"sJan" => array(),
		"sFeb" => array(),
		"sMar" => array(),
		"sApr" => array(),
		"sMay" => array(),
		"sJun" => array(),
		"sJul" => array(),		
		"sAug" => array(),
		"sSep" => array(),
		"sOct" => array(),		
		"sNov" => array(),
		"sDec" => array()
		
        );

	$sql = "SELECT stname1 ";
	$sql .= "FROM stock  ";  
	$sql .= " where stcode = '".$_POST['stcode']."' ";  

	$query = mysqli_query($conn,$sql);

	$row = $query->fetch_assoc();
	array_push($json_result['stname1'],$row["stname1"]);

	$strSQL = "SELECT IFNULL(sum(cJan),0) as cJan,IFNULL(sum(cFeb),0) as cFeb,IFNULL(sum(cMar),0) as cMar,  ";
	$strSQL .= " IFNULL(sum(cApr),0) as cApr,IFNULL(sum(cMay),0) as cMay,IFNULL(sum(cJun),0) as cJun,  ";
	$strSQL .= " IFNULL(sum(cJul),0) as cJul,IFNULL(sum(cAug),0) as cAug,IFNULL(sum(cSep),0) as cSep,  ";
	$strSQL .= " IFNULL(sum(cOct),0) as cOct,IFNULL(sum(cNov),0) as cNov,IFNULL(sum(cDec),0) as cDec  ";
	$strSQL .= " FROM ( ";
	$strSQL .= "SELECT case when MONTH(b.wodate)=1 then a.amount end as cJan, ";
	$strSQL .= "case when MONTH(b.wodate)=2 then a.amount end as cFeb, ";
	$strSQL .= "case when MONTH(b.wodate)=3 then a.amount end as cMar, ";
	$strSQL .= "case when MONTH(b.wodate)=4 then a.amount end as cApr, ";
	$strSQL .= "case when MONTH(b.wodate)=5 then a.amount end as cMay, ";
	$strSQL .= "case when MONTH(b.wodate)=6 then a.amount end as cJun, ";
	$strSQL .= "case when MONTH(b.wodate)=7 then a.amount end as cJul, ";
	$strSQL .= "case when MONTH(b.wodate)=8 then a.amount end as cAug, ";
	$strSQL .= "case when MONTH(b.wodate)=9 then a.amount end as cSep, ";
	$strSQL .= "case when MONTH(b.wodate)=10 then a.amount end as cOct, ";
	$strSQL .= "case when MONTH(b.wodate)=11 then a.amount end as cNov, ";
	$strSQL .= "case when MONTH(b.wodate)=12 then a.amount end as cDec ";
	$strSQL .= "FROM wodetail as a inner join womaster  as b on (a.wocode=b.wocode) ";
	$strSQL .= " where a.stcode = '".$_POST['stcode']."' and YEAR(b.wodate) = '".$_POST['year']."'";
	$strSQL .= " ) a ";
	

	// echo $strSQL;
	$query = mysqli_query($conn,$strSQL);

	while($row = $query->fetch_assoc()) {
		array_push($json_result['cJan'],$row["cJan"]);
		array_push($json_result['cFeb'],$row["cFeb"]);
		array_push($json_result['cMar'],$row["cMar"]);
		array_push($json_result['cApr'],$row["cApr"]);
		array_push($json_result['cMay'],$row["cMay"]);
		array_push($json_result['cJun'],$row["cJun"]);
		array_push($json_result['cJul'],$row["cJul"]);
		array_push($json_result['cAug'],$row["cAug"]);
		array_push($json_result['cSep'],$row["cSep"]);
		array_push($json_result['cOct'],$row["cOct"]);
		array_push($json_result['cNov'],$row["cNov"]);
		array_push($json_result['cDec'],$row["cDec"]);
	}

	$strSQL = "SELECT IFNULL(sum(sJan),0) as sJan,IFNULL(sum(sFeb),0) as sFeb,IFNULL(sum(sMar),0) as sMar,  ";
	$strSQL .= " IFNULL(sum(sApr),0) as sApr,IFNULL(sum(sMay),0) as sMay,IFNULL(sum(sJun),0) as sJun,  ";
	$strSQL .= " IFNULL(sum(sJul),0) as sJul,IFNULL(sum(sAug),0) as sAug,IFNULL(sum(sSep),0) as sSep,  ";
	$strSQL .= " IFNULL(sum(sOct),0) as sOct,IFNULL(sum(sNov),0) as sNov,IFNULL(sum(sDec),0) as sDec  ";
	$strSQL .= " FROM ( ";
	$strSQL .= "SELECT case when SUBSTRING(b.sfdate, 6, 2)=1 then a.amount end as sJan, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=2 then a.amount end as sFeb, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=3 then a.amount end as sMar, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=4 then a.amount end as sApr, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=5 then a.amount end as sMay, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=6 then a.amount end as sJun, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=7 then a.amount end as sJul, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=8 then a.amount end as sAug, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=9 then a.amount end as sSep, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=10 then a.amount end as sOct, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=11 then a.amount end as sNov, ";
	$strSQL .= "case when SUBSTRING(b.sfdate, 6, 2)=12 then a.amount end as sDec ";
	$strSQL .= "FROM sfdetail as a inner join sfmaster  as b on (a.socode=b.socode) ";
	$strSQL .= " where a.stcode = '".$_POST['stcode']."' and SUBSTRING(b.sfdate, 1, 4) = '".$_POST['year']."'";
	$strSQL .= " ) a ";
	// $strSQL .= "GROUP by MONTH(b.sodate) ";

	// echo $strSQL;
	$query = mysqli_query($conn,$strSQL);

	while($row = $query->fetch_assoc()) {
		array_push($json_result['sJan'],$row["sJan"]);
		array_push($json_result['sFeb'],$row["sFeb"]);
		array_push($json_result['sMar'],$row["sMar"]);
		array_push($json_result['sApr'],$row["sApr"]);
		array_push($json_result['sMay'],$row["sMay"]);
		array_push($json_result['sJun'],$row["sJun"]);
		array_push($json_result['sJul'],$row["sJul"]);
		array_push($json_result['sAug'],$row["sAug"]);
		array_push($json_result['sSep'],$row["sSep"]);
		array_push($json_result['sOct'],$row["sOct"]);
		array_push($json_result['sNov'],$row["sNov"]);
		array_push($json_result['sDec'],$row["sDec"]);
	}

        echo json_encode($json_result);



?>