<?php
require_once(getabspath("classes/cipherer.php"));
$tdatapelatihan = array();
	$tdatapelatihan[".NumberOfChars"] = 80; 
	$tdatapelatihan[".ShortName"] = "pelatihan";
	$tdatapelatihan[".OwnerID"] = "";
	$tdatapelatihan[".OriginalTable"] = "pelatihan";

//	field labels
$fieldLabelspelatihan = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelspelatihan["English"] = array();
	$fieldToolTipspelatihan["English"] = array();
	$fieldLabelspelatihan["English"]["id_pelatihan"] = "Id Pelatihan";
	$fieldToolTipspelatihan["English"]["id_pelatihan"] = "";
	$fieldLabelspelatihan["English"]["nip"] = "Nip";
	$fieldToolTipspelatihan["English"]["nip"] = "";
	$fieldLabelspelatihan["English"]["tgl_pelatihan"] = "Tgl Pelatihan";
	$fieldToolTipspelatihan["English"]["tgl_pelatihan"] = "";
	$fieldLabelspelatihan["English"]["sk_pelatihan"] = "Sk Pelatihan";
	$fieldToolTipspelatihan["English"]["sk_pelatihan"] = "";
	$fieldLabelspelatihan["English"]["topik_pelatihan"] = "Topik Pelatihan";
	$fieldToolTipspelatihan["English"]["topik_pelatihan"] = "";
	$fieldLabelspelatihan["English"]["penyelenggara"] = "Penyelenggara";
	$fieldToolTipspelatihan["English"]["penyelenggara"] = "";
	$fieldLabelspelatihan["English"]["hasil_pelatihan"] = "Hasil Pelatihan";
	$fieldToolTipspelatihan["English"]["hasil_pelatihan"] = "";
	if (count($fieldToolTipspelatihan["English"]))
		$tdatapelatihan[".isUseToolTips"] = true;
}
	
	
	$tdatapelatihan[".NCSearch"] = true;



$tdatapelatihan[".shortTableName"] = "pelatihan";
$tdatapelatihan[".nSecOptions"] = 0;
$tdatapelatihan[".recsPerRowList"] = 1;
$tdatapelatihan[".mainTableOwnerID"] = "";
$tdatapelatihan[".moveNext"] = 1;
$tdatapelatihan[".nType"] = 0;

$tdatapelatihan[".strOriginalTableName"] = "pelatihan";




$tdatapelatihan[".showAddInPopup"] = true;

$tdatapelatihan[".showEditInPopup"] = true;

$tdatapelatihan[".showViewInPopup"] = true;

$tdatapelatihan[".fieldsForRegister"] = array();

if (!isMobile())
	$tdatapelatihan[".listAjax"] = true;
else 
	$tdatapelatihan[".listAjax"] = false;

	$tdatapelatihan[".audit"] = false;

	$tdatapelatihan[".locking"] = false;

$tdatapelatihan[".listIcons"] = true;
$tdatapelatihan[".edit"] = true;
$tdatapelatihan[".inlineEdit"] = true;
$tdatapelatihan[".inlineAdd"] = true;
$tdatapelatihan[".view"] = true;

$tdatapelatihan[".exportTo"] = true;

$tdatapelatihan[".printFriendly"] = true;

$tdatapelatihan[".delete"] = true;

$tdatapelatihan[".showSimpleSearchOptions"] = true;

$tdatapelatihan[".showSearchPanel"] = true;

if (isMobile())
	$tdatapelatihan[".isUseAjaxSuggest"] = false;
else 
	$tdatapelatihan[".isUseAjaxSuggest"] = true;

$tdatapelatihan[".rowHighlite"] = true;

// button handlers file names

$tdatapelatihan[".addPageEvents"] = false;

// use timepicker for search panel
$tdatapelatihan[".isUseTimeForSearch"] = false;




$tdatapelatihan[".allSearchFields"] = array();

$tdatapelatihan[".allSearchFields"][] = "id_pelatihan";
$tdatapelatihan[".allSearchFields"][] = "nip";
$tdatapelatihan[".allSearchFields"][] = "tgl_pelatihan";
$tdatapelatihan[".allSearchFields"][] = "sk_pelatihan";
$tdatapelatihan[".allSearchFields"][] = "topik_pelatihan";
$tdatapelatihan[".allSearchFields"][] = "penyelenggara";
$tdatapelatihan[".allSearchFields"][] = "hasil_pelatihan";

$tdatapelatihan[".googleLikeFields"][] = "id_pelatihan";
$tdatapelatihan[".googleLikeFields"][] = "nip";
$tdatapelatihan[".googleLikeFields"][] = "tgl_pelatihan";
$tdatapelatihan[".googleLikeFields"][] = "sk_pelatihan";
$tdatapelatihan[".googleLikeFields"][] = "topik_pelatihan";
$tdatapelatihan[".googleLikeFields"][] = "penyelenggara";
$tdatapelatihan[".googleLikeFields"][] = "hasil_pelatihan";


$tdatapelatihan[".advSearchFields"][] = "id_pelatihan";
$tdatapelatihan[".advSearchFields"][] = "nip";
$tdatapelatihan[".advSearchFields"][] = "tgl_pelatihan";
$tdatapelatihan[".advSearchFields"][] = "sk_pelatihan";
$tdatapelatihan[".advSearchFields"][] = "topik_pelatihan";
$tdatapelatihan[".advSearchFields"][] = "penyelenggara";
$tdatapelatihan[".advSearchFields"][] = "hasil_pelatihan";

$tdatapelatihan[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatapelatihan[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatapelatihan[".strOrderBy"] = $tstrOrderBy;

$tdatapelatihan[".orderindexes"] = array();

$tdatapelatihan[".sqlHead"] = "SELECT id_pelatihan,   nip,   tgl_pelatihan,   sk_pelatihan,   topik_pelatihan,   penyelenggara,   hasil_pelatihan";
$tdatapelatihan[".sqlFrom"] = "FROM pelatihan";
$tdatapelatihan[".sqlWhereExpr"] = "";
$tdatapelatihan[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatapelatihan[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatapelatihan[".arrGroupsPerPage"] = $arrGPP;

$tableKeyspelatihan = array();
$tableKeyspelatihan[] = "id_pelatihan";
$tdatapelatihan[".Keys"] = $tableKeyspelatihan;

$tdatapelatihan[".listFields"] = array();
$tdatapelatihan[".listFields"][] = "id_pelatihan";
$tdatapelatihan[".listFields"][] = "nip";
$tdatapelatihan[".listFields"][] = "tgl_pelatihan";
$tdatapelatihan[".listFields"][] = "sk_pelatihan";
$tdatapelatihan[".listFields"][] = "topik_pelatihan";
$tdatapelatihan[".listFields"][] = "penyelenggara";
$tdatapelatihan[".listFields"][] = "hasil_pelatihan";

$tdatapelatihan[".viewFields"] = array();
$tdatapelatihan[".viewFields"][] = "id_pelatihan";
$tdatapelatihan[".viewFields"][] = "nip";
$tdatapelatihan[".viewFields"][] = "tgl_pelatihan";
$tdatapelatihan[".viewFields"][] = "sk_pelatihan";
$tdatapelatihan[".viewFields"][] = "topik_pelatihan";
$tdatapelatihan[".viewFields"][] = "penyelenggara";
$tdatapelatihan[".viewFields"][] = "hasil_pelatihan";

$tdatapelatihan[".addFields"] = array();
$tdatapelatihan[".addFields"][] = "nip";
$tdatapelatihan[".addFields"][] = "tgl_pelatihan";
$tdatapelatihan[".addFields"][] = "sk_pelatihan";
$tdatapelatihan[".addFields"][] = "topik_pelatihan";
$tdatapelatihan[".addFields"][] = "penyelenggara";
$tdatapelatihan[".addFields"][] = "hasil_pelatihan";

$tdatapelatihan[".inlineAddFields"] = array();
$tdatapelatihan[".inlineAddFields"][] = "nip";
$tdatapelatihan[".inlineAddFields"][] = "tgl_pelatihan";
$tdatapelatihan[".inlineAddFields"][] = "sk_pelatihan";
$tdatapelatihan[".inlineAddFields"][] = "topik_pelatihan";
$tdatapelatihan[".inlineAddFields"][] = "penyelenggara";
$tdatapelatihan[".inlineAddFields"][] = "hasil_pelatihan";

$tdatapelatihan[".editFields"] = array();
$tdatapelatihan[".editFields"][] = "nip";
$tdatapelatihan[".editFields"][] = "tgl_pelatihan";
$tdatapelatihan[".editFields"][] = "sk_pelatihan";
$tdatapelatihan[".editFields"][] = "topik_pelatihan";
$tdatapelatihan[".editFields"][] = "penyelenggara";
$tdatapelatihan[".editFields"][] = "hasil_pelatihan";

$tdatapelatihan[".inlineEditFields"] = array();
$tdatapelatihan[".inlineEditFields"][] = "nip";
$tdatapelatihan[".inlineEditFields"][] = "tgl_pelatihan";
$tdatapelatihan[".inlineEditFields"][] = "sk_pelatihan";
$tdatapelatihan[".inlineEditFields"][] = "topik_pelatihan";
$tdatapelatihan[".inlineEditFields"][] = "penyelenggara";
$tdatapelatihan[".inlineEditFields"][] = "hasil_pelatihan";

$tdatapelatihan[".exportFields"] = array();
$tdatapelatihan[".exportFields"][] = "id_pelatihan";
$tdatapelatihan[".exportFields"][] = "nip";
$tdatapelatihan[".exportFields"][] = "tgl_pelatihan";
$tdatapelatihan[".exportFields"][] = "sk_pelatihan";
$tdatapelatihan[".exportFields"][] = "topik_pelatihan";
$tdatapelatihan[".exportFields"][] = "penyelenggara";
$tdatapelatihan[".exportFields"][] = "hasil_pelatihan";

$tdatapelatihan[".printFields"] = array();
$tdatapelatihan[".printFields"][] = "id_pelatihan";
$tdatapelatihan[".printFields"][] = "nip";
$tdatapelatihan[".printFields"][] = "tgl_pelatihan";
$tdatapelatihan[".printFields"][] = "sk_pelatihan";
$tdatapelatihan[".printFields"][] = "topik_pelatihan";
$tdatapelatihan[".printFields"][] = "penyelenggara";
$tdatapelatihan[".printFields"][] = "hasil_pelatihan";

//	id_pelatihan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id_pelatihan";
	$fdata["GoodName"] = "id_pelatihan";
	$fdata["ownerTable"] = "pelatihan";
	$fdata["Label"] = "Id Pelatihan"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_pelatihan"; 
		$fdata["FullName"] = "id_pelatihan";
	
		
		
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
	
		
		
	$tdatapelatihan["id_pelatihan"] = $fdata;
//	nip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "nip";
	$fdata["GoodName"] = "nip";
	$fdata["ownerTable"] = "pelatihan";
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
	
		
		
	$tdatapelatihan["nip"] = $fdata;
//	tgl_pelatihan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "tgl_pelatihan";
	$fdata["GoodName"] = "tgl_pelatihan";
	$fdata["ownerTable"] = "pelatihan";
	$fdata["Label"] = "Tgl Pelatihan"; 
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
	
		$fdata["strField"] = "tgl_pelatihan"; 
		$fdata["FullName"] = "tgl_pelatihan";
	
		
		
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

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapelatihan["tgl_pelatihan"] = $fdata;
//	sk_pelatihan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "sk_pelatihan";
	$fdata["GoodName"] = "sk_pelatihan";
	$fdata["ownerTable"] = "pelatihan";
	$fdata["Label"] = "Sk Pelatihan"; 
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
	
		$fdata["strField"] = "sk_pelatihan"; 
		$fdata["FullName"] = "sk_pelatihan";
	
		
		
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
	
		
		
	$tdatapelatihan["sk_pelatihan"] = $fdata;
//	topik_pelatihan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "topik_pelatihan";
	$fdata["GoodName"] = "topik_pelatihan";
	$fdata["ownerTable"] = "pelatihan";
	$fdata["Label"] = "Topik Pelatihan"; 
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
	
		$fdata["strField"] = "topik_pelatihan"; 
		$fdata["FullName"] = "topik_pelatihan";
	
		
		
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
	
		
		
	$tdatapelatihan["topik_pelatihan"] = $fdata;
//	penyelenggara
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "penyelenggara";
	$fdata["GoodName"] = "penyelenggara";
	$fdata["ownerTable"] = "pelatihan";
	$fdata["Label"] = "Penyelenggara"; 
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
	
		$fdata["strField"] = "penyelenggara"; 
		$fdata["FullName"] = "penyelenggara";
	
		
		
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
	
		
		
	$tdatapelatihan["penyelenggara"] = $fdata;
//	hasil_pelatihan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "hasil_pelatihan";
	$fdata["GoodName"] = "hasil_pelatihan";
	$fdata["ownerTable"] = "pelatihan";
	$fdata["Label"] = "Hasil Pelatihan"; 
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
	
		$fdata["strField"] = "hasil_pelatihan"; 
		$fdata["FullName"] = "hasil_pelatihan";
	
		
		
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
	$edata["LookupValues"][] = "Memuaskan";
	$edata["LookupValues"][] = "Bai";
	$edata["LookupValues"][] = "ekali";
	$edata["LookupValues"][] = "Baik";
	$edata["LookupValues"][] = "Cukup";
	$edata["LookupValues"][] = "Kurang";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapelatihan["hasil_pelatihan"] = $fdata;

	
$tables_data["pelatihan"]=&$tdatapelatihan;
$field_labels["pelatihan"] = &$fieldLabelspelatihan;
$fieldToolTips["pelatihan"] = &$fieldToolTipspelatihan;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["pelatihan"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["pelatihan"] = array();

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
	$masterTablesData["pelatihan"][$mIndex] = $masterParams;	
		$masterTablesData["pelatihan"][$mIndex]["masterKeys"][]="nip";
		$masterTablesData["pelatihan"][$mIndex]["detailKeys"][]="nip";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_pelatihan()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_pelatihan,   nip,   tgl_pelatihan,   sk_pelatihan,   topik_pelatihan,   penyelenggara,   hasil_pelatihan";
$proto0["m_strFrom"] = "FROM pelatihan";
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
	"m_strName" => "id_pelatihan",
	"m_strTable" => "pelatihan"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "nip",
	"m_strTable" => "pelatihan"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "tgl_pelatihan",
	"m_strTable" => "pelatihan"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "sk_pelatihan",
	"m_strTable" => "pelatihan"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "topik_pelatihan",
	"m_strTable" => "pelatihan"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "penyelenggara",
	"m_strTable" => "pelatihan"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "hasil_pelatihan",
	"m_strTable" => "pelatihan"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto19=array();
$proto19["m_link"] = "SQLL_MAIN";
			$proto20=array();
$proto20["m_strName"] = "pelatihan";
$proto20["m_columns"] = array();
$proto20["m_columns"][] = "id_pelatihan";
$proto20["m_columns"][] = "nip";
$proto20["m_columns"][] = "tgl_pelatihan";
$proto20["m_columns"][] = "sk_pelatihan";
$proto20["m_columns"][] = "topik_pelatihan";
$proto20["m_columns"][] = "penyelenggara";
$proto20["m_columns"][] = "hasil_pelatihan";
$obj = new SQLTable($proto20);

$proto19["m_table"] = $obj;
$proto19["m_alias"] = "";
$proto21=array();
$proto21["m_sql"] = "";
$proto21["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto21["m_column"]=$obj;
$proto21["m_contained"] = array();
$proto21["m_strCase"] = "";
$proto21["m_havingmode"] = "0";
$proto21["m_inBrackets"] = "0";
$proto21["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto21);

$proto19["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto19);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_pelatihan = createSqlQuery_pelatihan();
							$tdatapelatihan[".sqlquery"] = $queryData_pelatihan;
	
if(isset($tdatapelatihan["field2"])){
	$tdatapelatihan["field2"]["LookupTable"] = "carscars_view";
	$tdatapelatihan["field2"]["LookupOrderBy"] = "name";
	$tdatapelatihan["field2"]["LookupType"] = 4;
	$tdatapelatihan["field2"]["LinkField"] = "email";
	$tdatapelatihan["field2"]["DisplayField"] = "name";
	$tdatapelatihan[".hasCustomViewField"] = true;
}

$tableEvents["pelatihan"] = new eventsBase;
$tdatapelatihan[".hasEvents"] = false;

$cipherer = new RunnerCipherer("pelatihan");

?>