<?php
require_once(getabspath("classes/cipherer.php"));
$tdataabsensi = array();
	$tdataabsensi[".NumberOfChars"] = 80; 
	$tdataabsensi[".ShortName"] = "absensi";
	$tdataabsensi[".OwnerID"] = "";
	$tdataabsensi[".OriginalTable"] = "absensi";

//	field labels
$fieldLabelsabsensi = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsabsensi["English"] = array();
	$fieldToolTipsabsensi["English"] = array();
	$fieldLabelsabsensi["English"]["id_absensi"] = "Id Absensi";
	$fieldToolTipsabsensi["English"]["id_absensi"] = "";
	$fieldLabelsabsensi["English"]["nip"] = "Nip";
	$fieldToolTipsabsensi["English"]["nip"] = "";
	$fieldLabelsabsensi["English"]["tanggal_absen"] = "Tanggal Absen";
	$fieldToolTipsabsensi["English"]["tanggal_absen"] = "";
	$fieldLabelsabsensi["English"]["jam_masuk"] = "Jam Masuk";
	$fieldToolTipsabsensi["English"]["jam_masuk"] = "";
	$fieldLabelsabsensi["English"]["jam_keluar"] = "Jam Keluar";
	$fieldToolTipsabsensi["English"]["jam_keluar"] = "";
	$fieldLabelsabsensi["English"]["status_masuk"] = "Status Masuk";
	$fieldToolTipsabsensi["English"]["status_masuk"] = "";
	$fieldLabelsabsensi["English"]["status_keluar"] = "Status Keluar";
	$fieldToolTipsabsensi["English"]["status_keluar"] = "";
	$fieldLabelsabsensi["English"]["ket"] = "Ket";
	$fieldToolTipsabsensi["English"]["ket"] = "";
	$fieldLabelsabsensi["English"]["terlambat"] = "Terlambat";
	$fieldToolTipsabsensi["English"]["terlambat"] = "";
	if (count($fieldToolTipsabsensi["English"]))
		$tdataabsensi[".isUseToolTips"] = true;
}
	
	
	$tdataabsensi[".NCSearch"] = true;



$tdataabsensi[".shortTableName"] = "absensi";
$tdataabsensi[".nSecOptions"] = 0;
$tdataabsensi[".recsPerRowList"] = 1;
$tdataabsensi[".mainTableOwnerID"] = "";
$tdataabsensi[".moveNext"] = 1;
$tdataabsensi[".nType"] = 0;

$tdataabsensi[".strOriginalTableName"] = "absensi";




$tdataabsensi[".showAddInPopup"] = true;

$tdataabsensi[".showEditInPopup"] = true;

$tdataabsensi[".showViewInPopup"] = true;

$tdataabsensi[".fieldsForRegister"] = array();

if (!isMobile())
	$tdataabsensi[".listAjax"] = true;
else 
	$tdataabsensi[".listAjax"] = false;

	$tdataabsensi[".audit"] = false;

	$tdataabsensi[".locking"] = false;

$tdataabsensi[".listIcons"] = true;
$tdataabsensi[".edit"] = true;
$tdataabsensi[".inlineEdit"] = true;
$tdataabsensi[".inlineAdd"] = true;
$tdataabsensi[".view"] = true;

$tdataabsensi[".exportTo"] = true;

$tdataabsensi[".printFriendly"] = true;

$tdataabsensi[".delete"] = true;

$tdataabsensi[".showSimpleSearchOptions"] = true;

$tdataabsensi[".showSearchPanel"] = true;

if (isMobile())
	$tdataabsensi[".isUseAjaxSuggest"] = false;
else 
	$tdataabsensi[".isUseAjaxSuggest"] = true;

$tdataabsensi[".rowHighlite"] = true;

// button handlers file names

$tdataabsensi[".addPageEvents"] = false;

// use timepicker for search panel
$tdataabsensi[".isUseTimeForSearch"] = false;




$tdataabsensi[".allSearchFields"] = array();

$tdataabsensi[".allSearchFields"][] = "id_absensi";
$tdataabsensi[".allSearchFields"][] = "nip";
$tdataabsensi[".allSearchFields"][] = "tanggal_absen";
$tdataabsensi[".allSearchFields"][] = "jam_masuk";
$tdataabsensi[".allSearchFields"][] = "jam_keluar";
$tdataabsensi[".allSearchFields"][] = "status_masuk";
$tdataabsensi[".allSearchFields"][] = "status_keluar";
$tdataabsensi[".allSearchFields"][] = "ket";
$tdataabsensi[".allSearchFields"][] = "terlambat";

$tdataabsensi[".googleLikeFields"][] = "id_absensi";
$tdataabsensi[".googleLikeFields"][] = "nip";
$tdataabsensi[".googleLikeFields"][] = "tanggal_absen";
$tdataabsensi[".googleLikeFields"][] = "jam_masuk";
$tdataabsensi[".googleLikeFields"][] = "jam_keluar";
$tdataabsensi[".googleLikeFields"][] = "status_masuk";
$tdataabsensi[".googleLikeFields"][] = "status_keluar";
$tdataabsensi[".googleLikeFields"][] = "ket";
$tdataabsensi[".googleLikeFields"][] = "terlambat";


$tdataabsensi[".advSearchFields"][] = "id_absensi";
$tdataabsensi[".advSearchFields"][] = "nip";
$tdataabsensi[".advSearchFields"][] = "tanggal_absen";
$tdataabsensi[".advSearchFields"][] = "jam_masuk";
$tdataabsensi[".advSearchFields"][] = "jam_keluar";
$tdataabsensi[".advSearchFields"][] = "status_masuk";
$tdataabsensi[".advSearchFields"][] = "status_keluar";
$tdataabsensi[".advSearchFields"][] = "ket";
$tdataabsensi[".advSearchFields"][] = "terlambat";

$tdataabsensi[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdataabsensi[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdataabsensi[".strOrderBy"] = $tstrOrderBy;

$tdataabsensi[".orderindexes"] = array();

$tdataabsensi[".sqlHead"] = "SELECT id_absensi,  nip,  tanggal_absen,  jam_masuk,  jam_keluar,  status_masuk,  status_keluar,  ket,  terlambat";
$tdataabsensi[".sqlFrom"] = "FROM absensi";
$tdataabsensi[".sqlWhereExpr"] = "";
$tdataabsensi[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataabsensi[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataabsensi[".arrGroupsPerPage"] = $arrGPP;

$tableKeysabsensi = array();
$tableKeysabsensi[] = "id_absensi";
$tdataabsensi[".Keys"] = $tableKeysabsensi;

$tdataabsensi[".listFields"] = array();
$tdataabsensi[".listFields"][] = "id_absensi";
$tdataabsensi[".listFields"][] = "nip";
$tdataabsensi[".listFields"][] = "tanggal_absen";
$tdataabsensi[".listFields"][] = "jam_masuk";
$tdataabsensi[".listFields"][] = "jam_keluar";
$tdataabsensi[".listFields"][] = "status_masuk";
$tdataabsensi[".listFields"][] = "status_keluar";

$tdataabsensi[".viewFields"] = array();
$tdataabsensi[".viewFields"][] = "id_absensi";
$tdataabsensi[".viewFields"][] = "nip";
$tdataabsensi[".viewFields"][] = "tanggal_absen";
$tdataabsensi[".viewFields"][] = "jam_masuk";
$tdataabsensi[".viewFields"][] = "jam_keluar";
$tdataabsensi[".viewFields"][] = "status_masuk";
$tdataabsensi[".viewFields"][] = "status_keluar";
$tdataabsensi[".viewFields"][] = "ket";
$tdataabsensi[".viewFields"][] = "terlambat";

$tdataabsensi[".addFields"] = array();
$tdataabsensi[".addFields"][] = "nip";
$tdataabsensi[".addFields"][] = "tanggal_absen";
$tdataabsensi[".addFields"][] = "jam_masuk";
$tdataabsensi[".addFields"][] = "jam_keluar";
$tdataabsensi[".addFields"][] = "status_masuk";
$tdataabsensi[".addFields"][] = "status_keluar";
$tdataabsensi[".addFields"][] = "ket";
$tdataabsensi[".addFields"][] = "terlambat";

$tdataabsensi[".inlineAddFields"] = array();
$tdataabsensi[".inlineAddFields"][] = "nip";
$tdataabsensi[".inlineAddFields"][] = "tanggal_absen";
$tdataabsensi[".inlineAddFields"][] = "jam_masuk";
$tdataabsensi[".inlineAddFields"][] = "jam_keluar";
$tdataabsensi[".inlineAddFields"][] = "status_masuk";
$tdataabsensi[".inlineAddFields"][] = "status_keluar";

$tdataabsensi[".editFields"] = array();
$tdataabsensi[".editFields"][] = "nip";
$tdataabsensi[".editFields"][] = "tanggal_absen";
$tdataabsensi[".editFields"][] = "jam_masuk";
$tdataabsensi[".editFields"][] = "jam_keluar";
$tdataabsensi[".editFields"][] = "status_masuk";
$tdataabsensi[".editFields"][] = "status_keluar";
$tdataabsensi[".editFields"][] = "ket";
$tdataabsensi[".editFields"][] = "terlambat";

$tdataabsensi[".inlineEditFields"] = array();
$tdataabsensi[".inlineEditFields"][] = "nip";
$tdataabsensi[".inlineEditFields"][] = "tanggal_absen";
$tdataabsensi[".inlineEditFields"][] = "jam_masuk";
$tdataabsensi[".inlineEditFields"][] = "jam_keluar";
$tdataabsensi[".inlineEditFields"][] = "status_masuk";
$tdataabsensi[".inlineEditFields"][] = "status_keluar";

$tdataabsensi[".exportFields"] = array();
$tdataabsensi[".exportFields"][] = "id_absensi";
$tdataabsensi[".exportFields"][] = "nip";
$tdataabsensi[".exportFields"][] = "tanggal_absen";
$tdataabsensi[".exportFields"][] = "jam_masuk";
$tdataabsensi[".exportFields"][] = "jam_keluar";
$tdataabsensi[".exportFields"][] = "status_masuk";
$tdataabsensi[".exportFields"][] = "status_keluar";
$tdataabsensi[".exportFields"][] = "ket";
$tdataabsensi[".exportFields"][] = "terlambat";

$tdataabsensi[".printFields"] = array();
$tdataabsensi[".printFields"][] = "id_absensi";
$tdataabsensi[".printFields"][] = "nip";
$tdataabsensi[".printFields"][] = "tanggal_absen";
$tdataabsensi[".printFields"][] = "jam_masuk";
$tdataabsensi[".printFields"][] = "jam_keluar";
$tdataabsensi[".printFields"][] = "status_masuk";
$tdataabsensi[".printFields"][] = "status_keluar";
$tdataabsensi[".printFields"][] = "ket";
$tdataabsensi[".printFields"][] = "terlambat";

//	id_absensi
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id_absensi";
	$fdata["GoodName"] = "id_absensi";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Id Absensi"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_absensi"; 
		$fdata["FullName"] = "id_absensi";
	
		
		
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
	
		
		
	$tdataabsensi["id_absensi"] = $fdata;
//	nip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "nip";
	$fdata["GoodName"] = "nip";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Nip"; 
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
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			
	$edata["LinkField"] = "nip";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "nip";
	
		
	$edata["LookupTable"] = "karyawan";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
				
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["nip"] = $fdata;
//	tanggal_absen
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "tanggal_absen";
	$fdata["GoodName"] = "tanggal_absen";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Tanggal Absen"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tanggal_absen"; 
		$fdata["FullName"] = "tanggal_absen";
	
		
		
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
	
		
		
	$tdataabsensi["tanggal_absen"] = $fdata;
//	jam_masuk
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "jam_masuk";
	$fdata["GoodName"] = "jam_masuk";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Jam Masuk"; 
	$fdata["FieldType"] = 134;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "jam_masuk"; 
		$fdata["FullName"] = "jam_masuk";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Time");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Time");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
				$hours = 24;
	$edata["FormatTimeAttrs"] = array("useTimePicker" => 0,
									  "hours" => $hours,
									  "minutes" => 1,
									  "showSeconds" => 0);
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["jam_masuk"] = $fdata;
//	jam_keluar
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "jam_keluar";
	$fdata["GoodName"] = "jam_keluar";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Jam Keluar"; 
	$fdata["FieldType"] = 134;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "jam_keluar"; 
		$fdata["FullName"] = "jam_keluar";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Time");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Time");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
				$hours = 24;
	$edata["FormatTimeAttrs"] = array("useTimePicker" => 0,
									  "hours" => $hours,
									  "minutes" => 1,
									  "showSeconds" => 0);
	$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["jam_keluar"] = $fdata;
//	status_masuk
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "status_masuk";
	$fdata["GoodName"] = "status_masuk";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Status Masuk"; 
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
	
		$fdata["strField"] = "status_masuk"; 
		$fdata["FullName"] = "status_masuk";
	
		
		
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
	$edata["LookupValues"][] = "Y";
	$edata["LookupValues"][] = "N";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["status_masuk"] = $fdata;
//	status_keluar
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "status_keluar";
	$fdata["GoodName"] = "status_keluar";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Status Keluar"; 
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
	
		$fdata["strField"] = "status_keluar"; 
		$fdata["FullName"] = "status_keluar";
	
		
		
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
	$edata["LookupValues"][] = "Y";
	$edata["LookupValues"][] = "N";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["status_keluar"] = $fdata;
//	ket
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "ket";
	$fdata["GoodName"] = "ket";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Ket"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ket"; 
		$fdata["FullName"] = "ket";
	
		
		
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
			$edata["EditParams"].= " maxlength=2";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["ket"] = $fdata;
//	terlambat
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "terlambat";
	$fdata["GoodName"] = "terlambat";
	$fdata["ownerTable"] = "absensi";
	$fdata["Label"] = "Terlambat"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "terlambat"; 
		$fdata["FullName"] = "terlambat";
	
		
		
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
	$edata["LookupValues"][] = "Y";
	$edata["LookupValues"][] = "N";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataabsensi["terlambat"] = $fdata;

	
$tables_data["absensi"]=&$tdataabsensi;
$field_labels["absensi"] = &$fieldLabelsabsensi;
$fieldToolTips["absensi"] = &$fieldToolTipsabsensi;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["absensi"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["absensi"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="karyawan";
	$masterParams["mDataSourceTable"]="karyawan";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "karyawan";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "0";
	$masterParams["dispInfo"]= "1";
	$masterParams["previewOnList"]= 1;
	$masterParams["previewOnAdd"]= 0;
	$masterParams["previewOnEdit"]= 0;
	$masterParams["previewOnView"]= 0;
	$masterTablesData["absensi"][$mIndex] = $masterParams;	
		$masterTablesData["absensi"][$mIndex]["masterKeys"][]="nip";
		$masterTablesData["absensi"][$mIndex]["detailKeys"][]="nip";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_absensi()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_absensi,  nip,  tanggal_absen,  jam_masuk,  jam_keluar,  status_masuk,  status_keluar,  ket,  terlambat";
$proto0["m_strFrom"] = "FROM absensi";
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
	"m_strName" => "id_absensi",
	"m_strTable" => "absensi"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "nip",
	"m_strTable" => "absensi"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "tanggal_absen",
	"m_strTable" => "absensi"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "jam_masuk",
	"m_strTable" => "absensi"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "jam_keluar",
	"m_strTable" => "absensi"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "status_masuk",
	"m_strTable" => "absensi"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "status_keluar",
	"m_strTable" => "absensi"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "ket",
	"m_strTable" => "absensi"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "terlambat",
	"m_strTable" => "absensi"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto23=array();
$proto23["m_link"] = "SQLL_MAIN";
			$proto24=array();
$proto24["m_strName"] = "absensi";
$proto24["m_columns"] = array();
$proto24["m_columns"][] = "id_absensi";
$proto24["m_columns"][] = "nip";
$proto24["m_columns"][] = "tanggal_absen";
$proto24["m_columns"][] = "jam_masuk";
$proto24["m_columns"][] = "jam_keluar";
$proto24["m_columns"][] = "status_masuk";
$proto24["m_columns"][] = "status_keluar";
$proto24["m_columns"][] = "ket";
$proto24["m_columns"][] = "terlambat";
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
$queryData_absensi = createSqlQuery_absensi();
									$tdataabsensi[".sqlquery"] = $queryData_absensi;
	
if(isset($tdataabsensi["field2"])){
	$tdataabsensi["field2"]["LookupTable"] = "carscars_view";
	$tdataabsensi["field2"]["LookupOrderBy"] = "name";
	$tdataabsensi["field2"]["LookupType"] = 4;
	$tdataabsensi["field2"]["LinkField"] = "email";
	$tdataabsensi["field2"]["DisplayField"] = "name";
	$tdataabsensi[".hasCustomViewField"] = true;
}

$tableEvents["absensi"] = new eventsBase;
$tdataabsensi[".hasEvents"] = false;

$cipherer = new RunnerCipherer("absensi");

?>