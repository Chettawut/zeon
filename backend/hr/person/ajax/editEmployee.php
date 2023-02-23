<?php
	header('Content-Type: application/json');
	include_once('../../../const.php');
	$conn= sql_pdo();

    $strSQL = " UPDATE Au_EmpMaster SET ETitleName = '".$_POST["ETitleName"]."'  ";
    $strSQL .= ",ETitleNameEN = '".$_POST["ETitleNameEN"]."',EmpName = '".$_POST["EmpName"]."' ";
    $strSQL .= ",LastName = '".$_POST["LastName"]."',EmpNameEN = '".$_POST["EmpNameEN"]."' ";
    $strSQL .= ",LastNameEN = '".$_POST["LastNameEN"]."',DepCode = '".$_POST["DepCode"]."' ";
    $strSQL .= ",SECODE = '".$_POST["SECODE"]."',WorkAt = '".$_POST["WorkAt"]."' ";
    $strSQL .= ",EmpPosition = '".$_POST["EmpPosition"]."',EmpTestDate = '".$_POST["EmpTestDate"]."' ";
    if($_POST["EmpEnd"]!='')
    $strSQL .= ",EmpEnd = '".$_POST["EmpEnd"]."' ";
    $strSQL .= ",ReasonEnd = '".$_POST["ReasonEnd"]."',RemarkEnd = '".$_POST["RemarkEnd"]."' ";
    $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' ";

       
    $strSQL .= " UPDATE Au_EmpDetail SET EmpNickName = '".$_POST["EmpNickName"]."'  ";
    $strSQL .= ",Sex = '".$_POST["Sex"]."',EmpStatus = '".$_POST["EmpStatus"]."' ";
    $strSQL .= ",EmpLevel = '".$_POST["EmpLevel"]."',EmpBirth = '".$_POST["EmpBirth"]."' ";
    $strSQL .= ",EmpPublicCode = '".$_POST["EmpPublicCode"]."',AbilityComputer = '".$_POST["AbilityComputer"]."' ";
    $strSQL .= ",Hobbies = '".$_POST["Hobbies"]."',Sports = '".$_POST["Sports"]."' ";
    $strSQL .= ",TypingTH = '".$_POST["TypingTH"]."',TypingEN = '".$_POST["TypingEN"]."' ";
    $strSQL .= ",LicenceMotorcy = '".$_POST["LicenceMotorcy"]."',LicenceCar = '".$_POST["LicenceCar"]."' ";
    $strSQL .= ",MemberFamily = '".$_POST["MemberFamily"]."',Ability = '".$_POST["Ability"]."' ";
    $strSQL .= ",ChildFamily = '".$_POST["ChildFamily"]."',Son = '".$_POST["Son"]."' ";
    $strSQL .= ",Daughter = '".$_POST["Daughter"]."',EmpBirthPlace = '".$_POST["EmpBirthPlace"]."' ";
    $strSQL .= ",Citizen = '".$_POST["Citizen"]."',Weight = '".$_POST["Weight"]."' ";
    $strSQL .= ",Height = '".$_POST["Height"]."',Nationality = '".$_POST["Nationality"]."' ";
    $strSQL .= ",Religion = '".$_POST["Religion"]."',Blood = '".$_POST["Blood"]."' ";
    $strSQL .= ",Mobile = '".$_POST["Mobile"]."',TaxCode = '".$_POST["TaxCode"]."' ";
    $strSQL .= ",SocialCode = '".$_POST["SocialCode"]."',Conscripted = '".$_POST["Conscripted"]."' ";
    $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' ";
    
    $strSQL .= " UPDATE Au_EmpLanguage SET Speak = '".$_POST["SpeakTH"]."' ";
    $strSQL .= ",[Read] = '".$_POST["ReadTH"]."' ";
    $strSQL .= ",Write = '".$_POST["WriteTH"]."' ";
    $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' and LanguageName = 'Thai' ";

    $strSQL .= " UPDATE Au_EmpLanguage SET  Speak = '".$_POST["SpeakEN"]."' ";
    $strSQL .= ",[Read] = '".$_POST["ReadEN"]."' ";
    $strSQL .= ",Write = '".$_POST["WriteEN"]."' ";
    $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' and LanguageName = 'English' ";

    for($count = 1 ; $count<7 ; $count++ )
	{
		if($count<3)
		{
        $strSQL .= " UPDATE Au_EmpAddress SET AddID = '".$_POST["AddID".$count.""]."'  ";
        $strSQL .= ",AddAlley = '".$_POST["AddAlley".$count.""]."',AddRoad = '".$_POST["AddRoad".$count.""]."' ";
        $strSQL .= ",AddSubDistrict = '".$_POST["AddSubDistrict".$count.""]."',AddDistrict = '".$_POST["AddDistrict".$count.""]."' ";
        $strSQL .= ",AddProvince = '".$_POST["AddProvince".$count.""]."',AddZip = '".$_POST["AddZip".$count.""]."' ";
        $strSQL .= ",AddPhone = '".$_POST["AddPhone".$count.""]."' ";
        $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' and AddType = '0".$count."' ";
        }
        
        if($count>2)
		{
            $strSQL .= " UPDATE Au_EmpFamily SET FirstName = '".$_POST["FirstName".$count.""]."'  ";
            $strSQL .= ",LastName = '".$_POST["LastName".$count.""]."' ,Occupation = '".$_POST["Occupation".$count.""]."' ";
            $strSQL .= ",Mobile = '".$_POST["Mobile".$count.""]."' ";
            $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' and FamilyCode = '0".$count."' ";
		}

        if($count<5)
		{
            $strSQL .= " UPDATE Au_EmpEdocation SET EdoName = '".$_POST["EdoName".$count.""]."'  ";
            $strSQL .= ",EdoBackground = '".$_POST["EdoBackground".$count.""]."' ,EdoDepartment = '".$_POST["EdoDepartment".$count.""]."' ";
            $strSQL .= ",EdoYearIn = '".$_POST["EdoYearIn".$count.""]."' ,EdoYearOut = '".$_POST["EdoYearOut".$count.""]."' ";
            $strSQL .= ",EdoAvgGrade = '".$_POST["EdoAvgGrade".$count.""]."' ";
            $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' and EdoNo = '0".$count."' ";
        }
        
        if($count<4)
		{
            $strSQL .= " UPDATE Au_EmpHistoryWork SET WorkName = '".$_POST["WorkName".$count.""]."'  ";
            $strSQL .= ",WorkStartSalary = '".$_POST["WorkStartSalary".$count.""]."' ,WorkStopSalary = '".$_POST["WorkStopSalary".$count.""]."' ";
            $strSQL .= ",WorkPosition = '".$_POST["WorkPosition".$count.""]."' ,WorkDetail = '".$_POST["WorkDetail".$count.""]."' ";
            $strSQL .= ",WorkReason = '".$_POST["WorkReason".$count.""]."' ";
            $strSQL .= "where EmpCode = '".$_POST["txtCode"]."' and WorkNo = '0".$count."' ";
		}
	}

	
    // echo $strSQL;
    
    $obj = $conn->prepare($strSQL);
    $obj->execute();  
    
    
	if($obj) 
		echo json_encode(array('status' => '1','message'=> $_POST["txtCode"] ));
	else
		echo json_encode(array('status' => '0','message'=> 'Error update data!'));

?>