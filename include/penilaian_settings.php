<?php
require_once(getabspath("classes/cipherer.php"));
$tdatapenilaian = array();
	$tdatapenilaian[".NumberOfChars"] = 80; 
	$tdatapenilaian[".ShortName"] = "penilaian";
	$tdatapenilaian[".OwnerID"] = "";
	$tdatapenilaian[".OriginalTable"] = "penilaian";

//	field labels
$fieldLabelspenilaian = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelspenilaian["English"] = array();
	$fieldToolTipspenilaian["English"] = array();
	$fieldLabelspenilaian["English"]["id_penilaian"] = "Id Penilaian";
	$fieldToolTipspenilaian["English"]["id_penilaian"] = "";
	$fieldLabelspenilaian["English"]["nip"] = "Nip";
	$fieldToolTipspenilaian["English"]["nip"] = "";
	$fieldLabelspenilaian["English"]["sk_penilaian"] = "Sk Penilaian";
	$fieldToolTipspenilaian["English"]["sk_penilaian"] = "";
	$fieldLabelspenilaian["English"]["periode_penilaian"] = "Periode Penilaian";
	$fieldToolTipspenilaian["English"]["periode_penilaian"] = "";
	$fieldLabelspenilaian["English"]["judul_penilaian"] = "Judul Penilaian";
	$fieldToolTipspenilaian["English"]["judul_penilaian"] = "";
	$fieldLabelspenilaian["English"]["indikator_a"] = "Indikator A";
	$fieldToolTipspenilaian["English"]["indikator_a"] = "";
	$fieldLabelspenilaian["English"]["indikator_b"] = "Indikator B";
	$fieldToolTipspenilaian["English"]["indikator_b"] = "";
	$fieldLabelspenilaian["English"]["indikator_c"] = "Indikator C";
	$fieldToolTipspenilaian["English"]["indikator_c"] = "";
	$fieldLabelspenilaian["English"]["indikator_d"] = "Indikator D";
	$fieldToolTipspenilaian["English"]["indikator_d"] = "";
	$fieldLabelspenilaian["English"]["indikator_e"] = "Indikator E";
	$fieldToolTipspenilaian["English"]["indikator_e"] = "";
	$fieldLabelspenilaian["English"]["satuan"] = "Satuan";
	$fieldToolTipspenilaian["English"]["satuan"] = "";
	$fieldLabelspenilaian["English"]["sasaran"] = "Sasaran";
	$fieldToolTipspenilaian["English"]["sasaran"] = "";
	$fieldLabelspenilaian["English"]["pencapaian"] = "Pencapaian";
	$fieldToolTipspenilaian["English"]["pencapaian"] = "";
	$fieldLabelspenilaian["English"]["hasil_penilaian"] = "Hasil Penilaian";
	$fieldToolTipspenilaian["English"]["hasil_penilaian"] = "";
	if (count($fieldToolTipspenilaian["English"]))
		$tdatapenilaian[".isUseToolTips"] = true;
}
	
	
	$tdatapenilaian[".NCSearch"] = true;



$tdatapenilaian[".shortTableName"] = "penilaian";
$tdatapenilaian[".nSecOptions"] = 0;
$tdatapenilaian[".recsPerRowList"] = 1;
$tdatapenilaian[".mainTableOwnerID"] = "";
$tdatapenilaian[".moveNext"] = 1;
$tdatapenilaian[".nType"] = 0;

$tdatapenilaian[".strOriginalTableName"] = "penilaian";




$tdatapenilaian[".showAddInPopup"] = true;

$tdatapenilaian[".showEditInPopup"] = true;

$tdatapenilaian[".showViewInPopup"] = true;

$tdatapenilaian[".fieldsForRegister"] = array();

if (!isMobile())
	$tdatapenilaian[".listAjax"] = true;
else 
	$tdatapenilaian[".listAjax"] = false;

	$tdatapenilaian[".audit"] = false;

	$tdatapenilaian[".locking"] = false;

$tdatapenilaian[".listIcons"] = true;
$tdatapenilaian[".edit"] = true;
$tdatapenilaian[".inlineEdit"] = true;
$tdatapenilaian[".inlineAdd"] = true;
$tdatapenilaian[".view"] = true;

$tdatapenilaian[".exportTo"] = true;

$tdatapenilaian[".printFriendly"] = true;

$tdatapenilaian[".delete"] = true;

$tdatapenilaian[".showSimpleSearchOptions"] = true;

$tdatapenilaian[".showSearchPanel"] = true;

if (isMobile())
	$tdatapenilaian[".isUseAjaxSuggest"] = false;
else 
	$tdatapenilaian[".isUseAjaxSuggest"] = true;

$tdatapenilaian[".rowHighlite"] = true;

// button handlers file names

$tdatapenilaian[".addPageEvents"] = false;

// use timepicker for search panel
$tdatapenilaian[".isUseTimeForSearch"] = false;




$tdatapenilaian[".allSearchFields"] = array();

$tdatapenilaian[".allSearchFields"][] = "id_penilaian";
$tdatapenilaian[".allSearchFields"][] = "nip";
$tdatapenilaian[".allSearchFields"][] = "sk_penilaian";
$tdatapenilaian[".allSearchFields"][] = "periode_penilaian";
$tdatapenilaian[".allSearchFields"][] = "judul_penilaian";
$tdatapenilaian[".allSearchFields"][] = "indikator_a";
$tdatapenilaian[".allSearchFields"][] = "indikator_b";
$tdatapenilaian[".allSearchFields"][] = "indikator_c";
$tdatapenilaian[".allSearchFields"][] = "indikator_d";
$tdatapenilaian[".allSearchFields"][] = "indikator_e";
$tdatapenilaian[".allSearchFields"][] = "satuan";
$tdatapenilaian[".allSearchFields"][] = "sasaran";
$tdatapenilaian[".allSearchFields"][] = "pencapaian";
$tdatapenilaian[".allSearchFields"][] = "hasil_penilaian";

$tdatapenilaian[".googleLikeFields"][] = "id_penilaian";
$tdatapenilaian[".googleLikeFields"][] = "nip";
$tdatapenilaian[".googleLikeFields"][] = "sk_penilaian";
$tdatapenilaian[".googleLikeFields"][] = "periode_penilaian";
$tdatapenilaian[".googleLikeFields"][] = "judul_penilaian";
$tdatapenilaian[".googleLikeFields"][] = "indikator_a";
$tdatapenilaian[".googleLikeFields"][] = "indikator_b";
$tdatapenilaian[".googleLikeFields"][] = "indikator_c";
$tdatapenilaian[".googleLikeFields"][] = "indikator_d";
$tdatapenilaian[".googleLikeFields"][] = "indikator_e";
$tdatapenilaian[".googleLikeFields"][] = "satuan";
$tdatapenilaian[".googleLikeFields"][] = "sasaran";
$tdatapenilaian[".googleLikeFields"][] = "pencapaian";
$tdatapenilaian[".googleLikeFields"][] = "hasil_penilaian";


$tdatapenilaian[".advSearchFields"][] = "id_penilaian";
$tdatapenilaian[".advSearchFields"][] = "nip";
$tdatapenilaian[".advSearchFields"][] = "sk_penilaian";
$tdatapenilaian[".advSearchFields"][] = "periode_penilaian";
$tdatapenilaian[".advSearchFields"][] = "judul_penilaian";
$tdatapenilaian[".advSearchFields"][] = "indikator_a";
$tdatapenilaian[".advSearchFields"][] = "indikator_b";
$tdatapenilaian[".advSearchFields"][] = "indikator_c";
$tdatapenilaian[".advSearchFields"][] = "indikator_d";
$tdatapenilaian[".advSearchFields"][] = "indikator_e";
$tdatapenilaian[".advSearchFields"][] = "satuan";
$tdatapenilaian[".advSearchFields"][] = "sasaran";
$tdatapenilaian[".advSearchFields"][] = "pencapaian";
$tdatapenilaian[".advSearchFields"][] = "hasil_penilaian";

$tdatapenilaian[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatapenilaian[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatapenilaian[".strOrderBy"] = $tstrOrderBy;

$tdatapenilaian[".orderindexes"] = array();

$tdatapenilaian[".sqlHead"] = "SELECT id_penilaian,   nip,   sk_penilaian,   periode_penilaian,   judul_penilaian,   indikator_a,   indikator_b,   indikator_c,   indikator_d,   indikator_e,   satuan,   sasaran,   pencapaian,   hasil_penilaian";
$tdatapenilaian[".sqlFrom"] = "FROM penilaian";
$tdatapenilaian[".sqlWhereExpr"] = "";
$tdatapenilaian[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatapenilaian[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatapenilaian[".arrGroupsPerPage"] = $arrGPP;

$tableKeyspenilaian = array();
$tableKeyspenilaian[] = "id_penilaian";
$tdatapenilaian[".Keys"] = $tableKeyspenilaian;

$tdatapenilaian[".listFields"] = array();
$tdatapenilaian[".listFields"][] = "nip";
$tdatapenilaian[".listFields"][] = "periode_penilaian";
$tdatapenilaian[".listFields"][] = "judul_penilaian";
$tdatapenilaian[".listFields"][] = "hasil_penilaian";

$tdatapenilaian[".viewFields"] = array();
$tdatapenilaian[".viewFields"][] = "id_penilaian";
$tdatapenilaian[".viewFields"][] = "nip";
$tdatapenilaian[".viewFields"][] = "sk_penilaian";
$tdatapenilaian[".viewFields"][] = "periode_penilaian";
$tdatapenilaian[".viewFields"][] = "judul_penilaian";
$tdatapenilaian[".viewFields"][] = "indikator_a";
$tdatapenilaian[".viewFields"][] = "indikator_b";
$tdatapenilaian[".viewFields"][] = "indikator_c";
$tdatapenilaian[".viewFields"][] = "indikator_d";
$tdatapenilaian[".viewFields"][] = "indikator_e";
$tdatapenilaian[".viewFields"][] = "satuan";
$tdatapenilaian[".viewFields"][] = "sasaran";
$tdatapenilaian[".viewFields"][] = "pencapaian";
$tdatapenilaian[".viewFields"][] = "hasil_penilaian";

$tdatapenilaian[".addFields"] = array();
$tdatapenilaian[".addFields"][] = "nip";
$tdatapenilaian[".addFields"][] = "sk_penilaian";
$tdatapenilaian[".addFields"][] = "periode_penilaian";
$tdatapenilaian[".addFields"][] = "judul_penilaian";
$tdatapenilaian[".addFields"][] = "indikator_a";
$tdatapenilaian[".addFields"][] = "indikator_b";
$tdatapenilaian[".addFields"][] = "indikator_c";
$tdatapenilaian[".addFields"][] = "indikator_d";
$tdatapenilaian[".addFields"][] = "indikator_e";
$tdatapenilaian[".addFields"][] = "satuan";
$tdatapenilaian[".addFields"][] = "sasaran";
$tdatapenilaian[".addFields"][] = "pencapaian";
$tdatapenilaian[".addFields"][] = "hasil_penilaian";

$tdatapenilaian[".inlineAddFields"] = array();
$tdatapenilaian[".inlineAddFields"][] = "nip";
$tdatapenilaian[".inlineAddFields"][] = "periode_penilaian";
$tdatapenilaian[".inlineAddFields"][] = "judul_penilaian";
$tdatapenilaian[".inlineAddFields"][] = "hasil_penilaian";

$tdatapenilaian[".editFields"] = array();
$tdatapenilaian[".editFields"][] = "nip";
$tdatapenilaian[".editFields"][] = "sk_penilaian";
$tdatapenilaian[".editFields"][] = "periode_penilaian";
$tdatapenilaian[".editFields"][] = "judul_penilaian";
$tdatapenilaian[".editFields"][] = "indikator_a";
$tdatapenilaian[".editFields"][] = "indikator_b";
$tdatapenilaian[".editFields"][] = "indikator_c";
$tdatapenilaian[".editFields"][] = "indikator_d";
$tdatapenilaian[".editFields"][] = "indikator_e";
$tdatapenilaian[".editFields"][] = "satuan";
$tdatapenilaian[".editFields"][] = "sasaran";
$tdatapenilaian[".editFields"][] = "pencapaian";
$tdatapenilaian[".editFields"][] = "hasil_penilaian";

$tdatapenilaian[".inlineEditFields"] = array();
$tdatapenilaian[".inlineEditFields"][] = "nip";
$tdatapenilaian[".inlineEditFields"][] = "periode_penilaian";
$tdatapenilaian[".inlineEditFields"][] = "judul_penilaian";
$tdatapenilaian[".inlineEditFields"][] = "hasil_penilaian";

$tdatapenilaian[".exportFields"] = array();
$tdatapenilaian[".exportFields"][] = "id_penilaian";
$tdatapenilaian[".exportFields"][] = "nip";
$tdatapenilaian[".exportFields"][] = "sk_penilaian";
$tdatapenilaian[".exportFields"][] = "periode_penilaian";
$tdatapenilaian[".exportFields"][] = "judul_penilaian";
$tdatapenilaian[".exportFields"][] = "indikator_a";
$tdatapenilaian[".exportFields"][] = "indikator_b";
$tdatapenilaian[".exportFields"][] = "indikator_c";
$tdatapenilaian[".exportFields"][] = "indikator_d";
$tdatapenilaian[".exportFields"][] = "indikator_e";
$tdatapenilaian[".exportFields"][] = "satuan";
$tdatapenilaian[".exportFields"][] = "sasaran";
$tdatapenilaian[".exportFields"][] = "pencapaian";
$tdatapenilaian[".exportFields"][] = "hasil_penilaian";

$tdatapenilaian[".printFields"] = array();
$tdatapenilaian[".printFields"][] = "id_penilaian";
$tdatapenilaian[".printFields"][] = "nip";
$tdatapenilaian[".printFields"][] = "sk_penilaian";
$tdatapenilaian[".printFields"][] = "periode_penilaian";
$tdatapenilaian[".printFields"][] = "judul_penilaian";
$tdatapenilaian[".printFields"][] = "indikator_a";
$tdatapenilaian[".printFields"][] = "indikator_b";
$tdatapenilaian[".printFields"][] = "indikator_c";
$tdatapenilaian[".printFields"][] = "indikator_d";
$tdatapenilaian[".printFields"][] = "indikator_e";
$tdatapenilaian[".printFields"][] = "satuan";
$tdatapenilaian[".printFields"][] = "sasaran";
$tdatapenilaian[".printFields"][] = "pencapaian";
$tdatapenilaian[".printFields"][] = "hasil_penilaian";

//	id_penilaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id_penilaian";
	$fdata["GoodName"] = "id_penilaian";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Id Penilaian"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_penilaian"; 
		$fdata["FullName"] = "id_penilaian";
	
		
		
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
	
		
		
	$tdatapenilaian["id_penilaian"] = $fdata;
//	nip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "nip";
	$fdata["GoodName"] = "nip";
	$fdata["ownerTable"] = "penilaian";
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
	
		
		
	$tdatapenilaian["nip"] = $fdata;
//	sk_penilaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "sk_penilaian";
	$fdata["GoodName"] = "sk_penilaian";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Sk Penilaian"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "sk_penilaian"; 
		$fdata["FullName"] = "sk_penilaian";
	
		
		
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
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["sk_penilaian"] = $fdata;
//	periode_penilaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "periode_penilaian";
	$fdata["GoodName"] = "periode_penilaian";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Periode Penilaian"; 
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
	
		$fdata["strField"] = "periode_penilaian"; 
		$fdata["FullName"] = "periode_penilaian";
	
		
		
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
	
		
		
	$tdatapenilaian["periode_penilaian"] = $fdata;
//	judul_penilaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "judul_penilaian";
	$fdata["GoodName"] = "judul_penilaian";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Judul Penilaian"; 
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
	
		$fdata["strField"] = "judul_penilaian"; 
		$fdata["FullName"] = "judul_penilaian";
	
		
		
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
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["judul_penilaian"] = $fdata;
//	indikator_a
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "indikator_a";
	$fdata["GoodName"] = "indikator_a";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Indikator A"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "indikator_a"; 
		$fdata["FullName"] = "indikator_a";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["indikator_a"] = $fdata;
//	indikator_b
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "indikator_b";
	$fdata["GoodName"] = "indikator_b";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Indikator B"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "indikator_b"; 
		$fdata["FullName"] = "indikator_b";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["indikator_b"] = $fdata;
//	indikator_c
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "indikator_c";
	$fdata["GoodName"] = "indikator_c";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Indikator C"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "indikator_c"; 
		$fdata["FullName"] = "indikator_c";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["indikator_c"] = $fdata;
//	indikator_d
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "indikator_d";
	$fdata["GoodName"] = "indikator_d";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Indikator D"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "indikator_d"; 
		$fdata["FullName"] = "indikator_d";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["indikator_d"] = $fdata;
//	indikator_e
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "indikator_e";
	$fdata["GoodName"] = "indikator_e";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Indikator E"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "indikator_e"; 
		$fdata["FullName"] = "indikator_e";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["indikator_e"] = $fdata;
//	satuan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "satuan";
	$fdata["GoodName"] = "satuan";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Satuan"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "satuan"; 
		$fdata["FullName"] = "satuan";
	
		
		
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
			$edata["EditParams"].= " maxlength=10";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["satuan"] = $fdata;
//	sasaran
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "sasaran";
	$fdata["GoodName"] = "sasaran";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Sasaran"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "sasaran"; 
		$fdata["FullName"] = "sasaran";
	
		
		
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
			$edata["EditParams"].= " maxlength=10";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["sasaran"] = $fdata;
//	pencapaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "pencapaian";
	$fdata["GoodName"] = "pencapaian";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Pencapaian"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "pencapaian"; 
		$fdata["FullName"] = "pencapaian";
	
		
		
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
			$edata["EditParams"].= " maxlength=10";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenilaian["pencapaian"] = $fdata;
//	hasil_penilaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "hasil_penilaian";
	$fdata["GoodName"] = "hasil_penilaian";
	$fdata["ownerTable"] = "penilaian";
	$fdata["Label"] = "Hasil Penilaian"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "hasil_penilaian"; 
		$fdata["FullName"] = "hasil_penilaian";
	
		
		
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
	
		
		
	$tdatapenilaian["hasil_penilaian"] = $fdata;

	
$tables_data["penilaian"]=&$tdatapenilaian;
$field_labels["penilaian"] = &$fieldLabelspenilaian;
$fieldToolTips["penilaian"] = &$fieldToolTipspenilaian;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["penilaian"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["penilaian"] = array();

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
	$masterTablesData["penilaian"][$mIndex] = $masterParams;	
		$masterTablesData["penilaian"][$mIndex]["masterKeys"][]="nip";
		$masterTablesData["penilaian"][$mIndex]["detailKeys"][]="nip";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_penilaian()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_penilaian,   nip,   sk_penilaian,   periode_penilaian,   judul_penilaian,   indikator_a,   indikator_b,   indikator_c,   indikator_d,   indikator_e,   satuan,   sasaran,   pencapaian,   hasil_penilaian";
$proto0["m_strFrom"] = "FROM penilaian";
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
	"m_strName" => "id_penilaian",
	"m_strTable" => "penilaian"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "nip",
	"m_strTable" => "penilaian"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "sk_penilaian",
	"m_strTable" => "penilaian"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "periode_penilaian",
	"m_strTable" => "penilaian"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "judul_penilaian",
	"m_strTable" => "penilaian"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "indikator_a",
	"m_strTable" => "penilaian"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "indikator_b",
	"m_strTable" => "penilaian"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "indikator_c",
	"m_strTable" => "penilaian"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "indikator_d",
	"m_strTable" => "penilaian"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "indikator_e",
	"m_strTable" => "penilaian"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "satuan",
	"m_strTable" => "penilaian"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "sasaran",
	"m_strTable" => "penilaian"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "pencapaian",
	"m_strTable" => "penilaian"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "hasil_penilaian",
	"m_strTable" => "penilaian"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto33=array();
$proto33["m_link"] = "SQLL_MAIN";
			$proto34=array();
$proto34["m_strName"] = "penilaian";
$proto34["m_columns"] = array();
$proto34["m_columns"][] = "id_penilaian";
$proto34["m_columns"][] = "nip";
$proto34["m_columns"][] = "sk_penilaian";
$proto34["m_columns"][] = "periode_penilaian";
$proto34["m_columns"][] = "judul_penilaian";
$proto34["m_columns"][] = "indikator_a";
$proto34["m_columns"][] = "indikator_b";
$proto34["m_columns"][] = "indikator_c";
$proto34["m_columns"][] = "indikator_d";
$proto34["m_columns"][] = "indikator_e";
$proto34["m_columns"][] = "satuan";
$proto34["m_columns"][] = "sasaran";
$proto34["m_columns"][] = "pencapaian";
$proto34["m_columns"][] = "hasil_penilaian";
$obj = new SQLTable($proto34);

$proto33["m_table"] = $obj;
$proto33["m_alias"] = "";
$proto35=array();
$proto35["m_sql"] = "";
$proto35["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto35["m_column"]=$obj;
$proto35["m_contained"] = array();
$proto35["m_strCase"] = "";
$proto35["m_havingmode"] = "0";
$proto35["m_inBrackets"] = "0";
$proto35["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto35);

$proto33["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto33);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_penilaian = createSqlQuery_penilaian();
														$tdatapenilaian[".sqlquery"] = $queryData_penilaian;
	
if(isset($tdatapenilaian["field2"])){
	$tdatapenilaian["field2"]["LookupTable"] = "carscars_view";
	$tdatapenilaian["field2"]["LookupOrderBy"] = "name";
	$tdatapenilaian["field2"]["LookupType"] = 4;
	$tdatapenilaian["field2"]["LinkField"] = "email";
	$tdatapenilaian["field2"]["DisplayField"] = "name";
	$tdatapenilaian[".hasCustomViewField"] = true;
}

$tableEvents["penilaian"] = new eventsBase;
$tdatapenilaian[".hasEvents"] = false;

$cipherer = new RunnerCipherer("penilaian");

?>