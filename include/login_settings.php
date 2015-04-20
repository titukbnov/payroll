<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalogin = array();
	$tdatalogin[".NumberOfChars"] = 80; 
	$tdatalogin[".ShortName"] = "login";
	$tdatalogin[".OwnerID"] = "";
	$tdatalogin[".OriginalTable"] = "login";

//	field labels
$fieldLabelslogin = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslogin["English"] = array();
	$fieldToolTipslogin["English"] = array();
	$fieldLabelslogin["English"]["id_login"] = "Id Login";
	$fieldToolTipslogin["English"]["id_login"] = "";
	$fieldLabelslogin["English"]["username"] = "Username";
	$fieldToolTipslogin["English"]["username"] = "";
	$fieldLabelslogin["English"]["email"] = "Email";
	$fieldToolTipslogin["English"]["email"] = "";
	$fieldLabelslogin["English"]["password"] = "Password";
	$fieldToolTipslogin["English"]["password"] = "";
	$fieldLabelslogin["English"]["nip"] = "Nip";
	$fieldToolTipslogin["English"]["nip"] = "";
	$fieldLabelslogin["English"]["user_level"] = "User Level";
	$fieldToolTipslogin["English"]["user_level"] = "";
	$fieldLabelslogin["English"]["last_login"] = "Last Login";
	$fieldToolTipslogin["English"]["last_login"] = "";
	$fieldLabelslogin["English"]["last_update"] = "Last Update";
	$fieldToolTipslogin["English"]["last_update"] = "";
	$fieldLabelslogin["English"]["created"] = "Created";
	$fieldToolTipslogin["English"]["created"] = "";
	if (count($fieldToolTipslogin["English"]))
		$tdatalogin[".isUseToolTips"] = true;
}
	
	
	$tdatalogin[".NCSearch"] = true;



$tdatalogin[".shortTableName"] = "login";
$tdatalogin[".nSecOptions"] = 0;
$tdatalogin[".recsPerRowList"] = 1;
$tdatalogin[".mainTableOwnerID"] = "";
$tdatalogin[".moveNext"] = 1;
$tdatalogin[".nType"] = 0;

$tdatalogin[".strOriginalTableName"] = "login";




$tdatalogin[".showAddInPopup"] = true;

$tdatalogin[".showEditInPopup"] = true;

$tdatalogin[".showViewInPopup"] = true;

$tdatalogin[".fieldsForRegister"] = array();

if (!isMobile())
	$tdatalogin[".listAjax"] = true;
else 
	$tdatalogin[".listAjax"] = false;

	$tdatalogin[".audit"] = false;

	$tdatalogin[".locking"] = false;

$tdatalogin[".listIcons"] = true;
$tdatalogin[".edit"] = true;
$tdatalogin[".inlineEdit"] = true;
$tdatalogin[".inlineAdd"] = true;
$tdatalogin[".view"] = true;

$tdatalogin[".exportTo"] = true;

$tdatalogin[".printFriendly"] = true;

$tdatalogin[".delete"] = true;

$tdatalogin[".showSimpleSearchOptions"] = true;

$tdatalogin[".showSearchPanel"] = true;

if (isMobile())
	$tdatalogin[".isUseAjaxSuggest"] = false;
else 
	$tdatalogin[".isUseAjaxSuggest"] = true;

$tdatalogin[".rowHighlite"] = true;

// button handlers file names

$tdatalogin[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalogin[".isUseTimeForSearch"] = false;




$tdatalogin[".allSearchFields"] = array();

$tdatalogin[".allSearchFields"][] = "id_login";
$tdatalogin[".allSearchFields"][] = "username";
$tdatalogin[".allSearchFields"][] = "email";
$tdatalogin[".allSearchFields"][] = "password";
$tdatalogin[".allSearchFields"][] = "nip";
$tdatalogin[".allSearchFields"][] = "user_level";
$tdatalogin[".allSearchFields"][] = "last_login";
$tdatalogin[".allSearchFields"][] = "last_update";
$tdatalogin[".allSearchFields"][] = "created";

$tdatalogin[".googleLikeFields"][] = "id_login";
$tdatalogin[".googleLikeFields"][] = "username";
$tdatalogin[".googleLikeFields"][] = "email";
$tdatalogin[".googleLikeFields"][] = "password";
$tdatalogin[".googleLikeFields"][] = "nip";
$tdatalogin[".googleLikeFields"][] = "user_level";
$tdatalogin[".googleLikeFields"][] = "last_login";
$tdatalogin[".googleLikeFields"][] = "last_update";
$tdatalogin[".googleLikeFields"][] = "created";


$tdatalogin[".advSearchFields"][] = "id_login";
$tdatalogin[".advSearchFields"][] = "username";
$tdatalogin[".advSearchFields"][] = "email";
$tdatalogin[".advSearchFields"][] = "password";
$tdatalogin[".advSearchFields"][] = "nip";
$tdatalogin[".advSearchFields"][] = "user_level";
$tdatalogin[".advSearchFields"][] = "last_login";
$tdatalogin[".advSearchFields"][] = "last_update";
$tdatalogin[".advSearchFields"][] = "created";

$tdatalogin[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalogin[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalogin[".strOrderBy"] = $tstrOrderBy;

$tdatalogin[".orderindexes"] = array();

$tdatalogin[".sqlHead"] = "SELECT id_login,   username,   email,   password,   nip,   user_level,   last_login,   last_update,   created";
$tdatalogin[".sqlFrom"] = "FROM login";
$tdatalogin[".sqlWhereExpr"] = "";
$tdatalogin[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalogin[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalogin[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslogin = array();
$tableKeyslogin[] = "id_login";
$tdatalogin[".Keys"] = $tableKeyslogin;

$tdatalogin[".listFields"] = array();
$tdatalogin[".listFields"][] = "id_login";
$tdatalogin[".listFields"][] = "username";
$tdatalogin[".listFields"][] = "email";
$tdatalogin[".listFields"][] = "nip";
$tdatalogin[".listFields"][] = "user_level";

$tdatalogin[".viewFields"] = array();
$tdatalogin[".viewFields"][] = "id_login";
$tdatalogin[".viewFields"][] = "username";
$tdatalogin[".viewFields"][] = "email";
$tdatalogin[".viewFields"][] = "password";
$tdatalogin[".viewFields"][] = "nip";
$tdatalogin[".viewFields"][] = "user_level";
$tdatalogin[".viewFields"][] = "last_login";
$tdatalogin[".viewFields"][] = "last_update";
$tdatalogin[".viewFields"][] = "created";

$tdatalogin[".addFields"] = array();
$tdatalogin[".addFields"][] = "username";
$tdatalogin[".addFields"][] = "email";
$tdatalogin[".addFields"][] = "password";
$tdatalogin[".addFields"][] = "nip";
$tdatalogin[".addFields"][] = "user_level";
$tdatalogin[".addFields"][] = "last_login";
$tdatalogin[".addFields"][] = "last_update";
$tdatalogin[".addFields"][] = "created";

$tdatalogin[".inlineAddFields"] = array();
$tdatalogin[".inlineAddFields"][] = "username";
$tdatalogin[".inlineAddFields"][] = "email";
$tdatalogin[".inlineAddFields"][] = "nip";
$tdatalogin[".inlineAddFields"][] = "user_level";

$tdatalogin[".editFields"] = array();
$tdatalogin[".editFields"][] = "username";
$tdatalogin[".editFields"][] = "email";
$tdatalogin[".editFields"][] = "password";
$tdatalogin[".editFields"][] = "nip";
$tdatalogin[".editFields"][] = "user_level";
$tdatalogin[".editFields"][] = "last_login";
$tdatalogin[".editFields"][] = "last_update";
$tdatalogin[".editFields"][] = "created";

$tdatalogin[".inlineEditFields"] = array();
$tdatalogin[".inlineEditFields"][] = "username";
$tdatalogin[".inlineEditFields"][] = "email";
$tdatalogin[".inlineEditFields"][] = "nip";
$tdatalogin[".inlineEditFields"][] = "user_level";

$tdatalogin[".exportFields"] = array();
$tdatalogin[".exportFields"][] = "id_login";
$tdatalogin[".exportFields"][] = "username";
$tdatalogin[".exportFields"][] = "email";
$tdatalogin[".exportFields"][] = "password";
$tdatalogin[".exportFields"][] = "nip";
$tdatalogin[".exportFields"][] = "user_level";
$tdatalogin[".exportFields"][] = "last_login";
$tdatalogin[".exportFields"][] = "last_update";
$tdatalogin[".exportFields"][] = "created";

$tdatalogin[".printFields"] = array();
$tdatalogin[".printFields"][] = "id_login";
$tdatalogin[".printFields"][] = "username";
$tdatalogin[".printFields"][] = "email";
$tdatalogin[".printFields"][] = "password";
$tdatalogin[".printFields"][] = "nip";
$tdatalogin[".printFields"][] = "user_level";
$tdatalogin[".printFields"][] = "last_login";
$tdatalogin[".printFields"][] = "last_update";
$tdatalogin[".printFields"][] = "created";

//	id_login
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id_login";
	$fdata["GoodName"] = "id_login";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Id Login"; 
	$fdata["FieldType"] = 20;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_login"; 
		$fdata["FullName"] = "id_login";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["id_login"] = $fdata;
//	username
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "username";
	$fdata["GoodName"] = "username";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Username"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "username"; 
		$fdata["FullName"] = "username";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["username"] = $fdata;
//	email
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "email";
	$fdata["GoodName"] = "email";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Email"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "email"; 
		$fdata["FullName"] = "email";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["email"] = $fdata;
//	password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "password";
	$fdata["GoodName"] = "password";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Password"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "password"; 
		$fdata["FullName"] = "password";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["password"] = $fdata;
//	nip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "nip";
	$fdata["GoodName"] = "nip";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Nip"; 
	$fdata["FieldType"] = 20;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "nip"; 
		$fdata["FullName"] = "nip";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["nip"] = $fdata;
//	user_level
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "user_level";
	$fdata["GoodName"] = "user_level";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "User Level"; 
	$fdata["FieldType"] = 129;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "user_level"; 
		$fdata["FullName"] = "user_level";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "Kontrak";
	$edata["LookupValues"][] = "Honorer";
	$edata["LookupValues"][] = "Tetap";
	$edata["LookupValues"][] = "Outsource";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["user_level"] = $fdata;
//	last_login
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "last_login";
	$fdata["GoodName"] = "last_login";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Last Login"; 
	$fdata["FieldType"] = 135;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "last_login"; 
		$fdata["FullName"] = "last_login";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["last_login"] = $fdata;
//	last_update
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "last_update";
	$fdata["GoodName"] = "last_update";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Last Update"; 
	$fdata["FieldType"] = 135;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "last_update"; 
		$fdata["FullName"] = "last_update";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["last_update"] = $fdata;
//	created
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "created";
	$fdata["GoodName"] = "created";
	$fdata["ownerTable"] = "login";
	$fdata["Label"] = "Created"; 
	$fdata["FieldType"] = 135;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "created"; 
		$fdata["FullName"] = "created";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalogin["created"] = $fdata;

	
$tables_data["login"]=&$tdatalogin;
$field_labels["login"] = &$fieldLabelslogin;
$fieldToolTips["login"] = &$fieldToolTipslogin;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["login"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["login"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_login()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_login,   username,   email,   password,   nip,   user_level,   last_login,   last_update,   created";
$proto0["m_strFrom"] = "FROM login";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = null;
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "id_login",
	"m_strTable" => "login"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "username",
	"m_strTable" => "login"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "email",
	"m_strTable" => "login"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "password",
	"m_strTable" => "login"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "nip",
	"m_strTable" => "login"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "user_level",
	"m_strTable" => "login"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "last_login",
	"m_strTable" => "login"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "last_update",
	"m_strTable" => "login"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "created",
	"m_strTable" => "login"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto23=array();
$proto23["m_link"] = "SQLL_MAIN";
			$proto24=array();
$proto24["m_strName"] = "login";
$proto24["m_columns"] = array();
$proto24["m_columns"][] = "id_login";
$proto24["m_columns"][] = "username";
$proto24["m_columns"][] = "email";
$proto24["m_columns"][] = "password";
$proto24["m_columns"][] = "nip";
$proto24["m_columns"][] = "user_level";
$proto24["m_columns"][] = "last_login";
$proto24["m_columns"][] = "last_update";
$proto24["m_columns"][] = "created";
$obj = new SQLTable($proto24);

$proto23["m_table"] = $obj;
$proto23["m_alias"] = "";
$proto25=array();
$proto25["m_sql"] = "";
$proto25["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto25["m_column"]=$obj;
$proto25["m_contained"] = array();
$proto25["m_strCase"] = "";
$proto25["m_havingmode"] = "0";
$proto25["m_inBrackets"] = "0";
$proto25["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto25);

$proto23["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto23);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_login = createSqlQuery_login();
									$tdatalogin[".sqlquery"] = $queryData_login;
	
if(isset($tdatalogin["field2"])){
	$tdatalogin["field2"]["LookupTable"] = "carscars_view";
	$tdatalogin["field2"]["LookupOrderBy"] = "name";
	$tdatalogin["field2"]["LookupType"] = 4;
	$tdatalogin["field2"]["LinkField"] = "email";
	$tdatalogin["field2"]["DisplayField"] = "name";
	$tdatalogin[".hasCustomViewField"] = true;
}

$tableEvents["login"] = new eventsBase;
$tdatalogin[".hasEvents"] = false;

$cipherer = new RunnerCipherer("login");

?>