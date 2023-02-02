<?php
	header('Content-Type: application/json');
	include_once('../../../const.php');
	$conn= sql_pdo();

    $strSQL = " INSERT INTO Au_EmpMaster (EMPCODE,ETitleName,ETitleNameEN,EmpName,LastName,EmpNameEN";
	$strSQL .= ",LastNameEN,DepCode,SECODE,WorkAt,EmpPosition,EmpTestDate,EmpEnd) ";
	$strSQL .= " VALUES ('".$_POST["txtCode"]."','".$_POST["ETitleName"]."','".$_POST["ETitleNameEN"]."'";
	$strSQL .= ",'".$_POST['EmpName']."','".$_POST['LastName']."','".$_POST["EmpNameEN"]."'";
	$strSQL .= ",'".$_POST["LastNameEN"]."','".$_POST["DepCode"]."','".$_POST["SECODE"]."'";
	$strSQL .= ",'".$_POST["WorkAt"]."','".$_POST["EmpPosition"]."' ";
	$strSQL .= ",'".$_POST["EmpTestDate"]."','') ";

	$strSQL .= " INSERT INTO Au_EmpDetail (EMPCODE,EmpNickName,Sex,EmpStatus,EmpLevel,EmpBirth";
	$strSQL .= ",EmpPublicCode,AbilityComputer,Hobbies,Sports,TypingTH,TypingEN,LicenceMotorcy,LicenceCar,Ability";
	$strSQL .= ",MemberFamily,ChildFamily,Son,Daughter,EmpBirthPlace,Citizen,Weight,Height,Nationality,Religion,Blood,Mobile";
	$strSQL .= ",TaxCode,SocialCode,Conscripted) ";
	$strSQL .= " VALUES ('".$_POST["txtCode"]."','".$_POST['EmpNickName']."','".$_POST['Sex']."','".$_POST["EmpStatus"]."' ";
	$strSQL .= ",'".$_POST["EmpLevel"]."','".$_POST["EmpBirth"]."' ";
	$strSQL .= ",'".$_POST["EmpPublicCode"]."' ";
	$strSQL .= ",'".$_POST["AbilityComputer"]."','".$_POST['Hobbies']."','".$_POST["Sports"]."','".$_POST["TypingTH"]."' ";
	$strSQL .= ",'".$_POST["TypingEN"]."','".$_POST['LicenceMotorcy']."','".$_POST["LicenceCar"]."','".$_POST["Ability"]."' ";
	$strSQL .= ",'".$_POST["MemberFamily"]."','".$_POST['ChildFamily']."','".$_POST["Son"]."','".$_POST["Daughter"]."' ";
	$strSQL .= ",'".$_POST["EmpBirthPlace"]."','".$_POST["Citizen"]."','".$_POST["Weight"]."','".$_POST["Height"]."' ";
	$strSQL .= ",'".$_POST["Nationality"]."','".$_POST["Religion"]."','".$_POST["Blood"]."','".$_POST["Mobile"]."' ";
	$strSQL .= ",'".$_POST["TaxCode"]."','".$_POST["SocialCode"]."','".$_POST["Conscripted"]."' )";
	$strSQL .= " INSERT INTO Au_EmpLanguage (EMPCODE,LanguageName,Speak,[Read],Write)";
	$strSQL .= " VALUES ('".$_POST["txtCode"]."','Thai','".$_POST["SpeakTH"]."','".$_POST["ReadTH"]."','".$_POST["WriteTH"]."' ) ";
	$strSQL .= " INSERT INTO Au_EmpLanguage (EMPCODE,LanguageName,Speak,[Read],Write)";
	$strSQL .= " VALUES ('".$_POST["txtCode"]."','English','".$_POST["SpeakEN"]."','".$_POST["ReadEN"]."','".$_POST["WriteEN"]."' ) ";

	for($count = 1 ; $count<7 ; $count++ )
	{
		if($count<3)
		{
		$strSQL .= " INSERT INTO Au_EmpAddress (EMPCODE,AddType,AddID,AddAlley,AddRoad,AddSubDistrict,AddDistrict";
		$strSQL .= ",AddProvince,AddZip,AddPhone) ";
		$strSQL .= " VALUES ('".$_POST["txtCode"]."','0".$count."','".$_POST["AddID".$count.""]."','".$_POST["AddAlley".$count.""]."','".$_POST["AddRoad".$count.""]."'  ";
		$strSQL .= ",'".$_POST["AddSubDistrict".$count.""]."','".$_POST["AddDistrict".$count.""]."','".$_POST["AddProvince".$count.""]."'";
		$strSQL .= ",'".$_POST["AddZip".$count.""]."','".$_POST["AddPhone".$count.""]."' ) ";
		}

		if($count>2)
		{
			$strSQL .= " INSERT INTO Au_EmpFamily (EMPCODE,FamilyCode,FirstName,LastName,Occupation,Mobile) ";
			$strSQL .= " VALUES ('".$_POST["txtCode"]."','0".$count."','".$_POST["FirstName".$count.""]."','".$_POST["LastName".$count.""]."','".$_POST["Occupation".$count.""]."'  ";
			$strSQL .= ",'".$_POST["Mobile".$count.""]."' ) ";
		}

		if($count<5)
		{
			$strSQL .= " INSERT INTO Au_EmpEdocation (EMPCODE,EdoNo,EdoName,EdoBackground,EdoDepartment,EdoAvgGrade,EdoYearIn,EdoYearOut) ";
			$strSQL .= " VALUES ('".$_POST["txtCode"]."','0".$count."','".$_POST["EdoName".$count.""]."','".$_POST["EdoBackground".$count.""]."','".$_POST["EdoDepartment".$count.""]."'  ";
			$strSQL .= ",'".$_POST["EdoAvgGrade".$count.""]."','".$_POST["EdoYearIn".$count.""]."','".$_POST["EdoYearOut".$count.""]."' ) ";
		}

		if($count<4)
		{
			$strSQL .= " INSERT INTO Au_EmpHistoryWork (EMPCODE,WorkNo,WorkName,WorkStartSalary,WorkStopSalary,WorkPosition,WorkDetail,WorkReason) ";
			$strSQL .= " VALUES ('".$_POST["txtCode"]."','0".$count."','".$_POST["WorkName".$count.""]."','".$_POST["WorkStartSalary".$count.""]."','".$_POST["WorkStopSalary".$count.""]."'  ";
			$strSQL .= ",'".$_POST["WorkPosition".$count.""]."','".$_POST["WorkDetail".$count.""]."','".$_POST["WorkReason".$count.""]."' ) ";
		}
	}
	// $emp = array("610718001", "430425001", "601009001","380403002");

	// $strSQL4 = " SELECT count(alertcode) as row FROM Au_Alert ";
	// $oRs4=odbc_exec($conn,iconv("UTF-8","tis-620",$strSQL4));

	// $strSQL2 = " INSERT INTO Au_Alert (alertcode,typecode,keyalert,date,time) ";
	// $strSQL2 .= " VALUES ('".odbc_result($oRs4, "row")."','001','".$_POST["txtCode"]."','".date("Y-m-d"). "','".date("H:i:s"). "' ) ";
	// $oRs2=odbc_exec($conn,iconv("UTF-8","tis-620",$strSQL2));

	// for($x = 0; $x < count($emp); $x++) {
	// 	$strSQL3 = " INSERT INTO Au_AlertDetail (alertcode,empcode,alertread,alertshow,date,time) ";
	// 	$strSQL3 .= " VALUES ('".odbc_result($oRs4, "row")."','".$emp[$x]."','0','0','".date("Y-m-d"). "','".date("H:i:s"). "' ) ";
	// 	$oRs3=odbc_exec($conn,iconv("UTF-8","tis-620",$strSQL3));
	// }

	
				
	// echo $strSQL;	
	$obj = $conn->prepare($strSQL);
    $obj->execute();  
    
	if($obj) 
		echo json_encode(array('status' => '1','message'=> $_POST["txtCode"] ));
	else
		echo json_encode(array('status' => '0','message'=> 'Error insert data!'));

?>