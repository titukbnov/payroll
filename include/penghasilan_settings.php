<?php
require_once(getabspath("classes/cipherer.php"));
$tdatapenghasilan = array();
	$tdatapenghasilan[".NumberOfChars"] = 80; 
	$tdatapenghasilan[".ShortName"] = "penghasilan";
	$tdatapenghasilan[".OwnerID"] = "";
	$tdatapenghasilan[".OriginalTable"] = "penghasilan";

//	field labels
$fieldLabelspenghasilan = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelspenghasilan["English"] = array();
	$fieldToolTipspenghasilan["English"] = array();
	$fieldLabelspenghasilan["English"]["id_penghasilan"] = "Id Penghasilan";
	$fieldToolTipspenghasilan["English"]["id_penghasilan"] = "";
	$fieldLabelspenghasilan["English"]["nip"] = "Nip";
	$fieldToolTipspenghasilan["English"]["nip"] = "";
	$fieldLabelspenghasilan["English"]["gaji_pokok"] = "Gaji Pokok";
	$fieldToolTipspenghasilan["English"]["gaji_pokok"] = "";
	$fieldLabelspenghasilan["English"]["tunjangan"] = "Tunjangan";
	$fieldToolTipspenghasilan["English"]["tunjangan"] = "";
	$fieldLabelspenghasilan["English"]["insentif"] = "Insentif";
	$fieldToolTipspenghasilan["English"]["insentif"] = "";
	$fieldLabelspenghasilan["English"]["bonus"] = "Bonus";
	$fieldToolTipspenghasilan["English"]["bonus"] = "";
	$fieldLabelspenghasilan["English"]["thr"] = "Thr";
	$fieldToolTipspenghasilan["English"]["thr"] = "";
	$fieldLabelspenghasilan["English"]["pajak"] = "Pajak";
	$fieldToolTipspenghasilan["English"]["pajak"] = "";
	$fieldLabelspenghasilan["English"]["pinjaman"] = "Pinjaman";
	$fieldToolTipspenghasilan["English"]["pinjaman"] = "";
	$fieldLabelspenghasilan["English"]["gaji_bersih"] = "Gaji Bersih";
	$fieldToolTipspenghasilan["English"]["gaji_bersih"] = "";
	$fieldLabelspenghasilan["English"]["cara_bayar"] = "Cara Bayar";
	$fieldToolTipspenghasilan["English"]["cara_bayar"] = "";
	$fieldLabelspenghasilan["English"]["tanggal_bayar"] = "Tanggal Bayar";
	$fieldToolTipspenghasilan["English"]["tanggal_bayar"] = "";
	$fieldLabelspenghasilan["English"]["tanggal_transfer"] = "Tanggal Transfer";
	$fieldToolTipspenghasilan["English"]["tanggal_transfer"] = "";
	$fieldLabelspenghasilan["English"]["nama_bank"] = "Nama Bank";
	$fieldToolTipspenghasilan["English"]["nama_bank"] = "";
	$fieldLabelspenghasilan["English"]["nama_rekening"] = "Nama Rekening";
	$fieldToolTipspenghasilan["English"]["nama_rekening"] = "";
	$fieldLabelspenghasilan["English"]["no_rekening"] = "No Rekening";
	$fieldToolTipspenghasilan["English"]["no_rekening"] = "";
	$fieldLabelspenghasilan["English"]["sk_penghasilan"] = "Sk Penghasilan";
	$fieldToolTipspenghasilan["English"]["sk_penghasilan"] = "";
	if (count($fieldToolTipspenghasilan["English"]))
		$tdatapenghasilan[".isUseToolTips"] = true;
}
	
	
	$tdatapenghasilan[".NCSearch"] = true;



$tdatapenghasilan[".shortTableName"] = "penghasilan";
$tdatapenghasilan[".nSecOptions"] = 0;
$tdatapenghasilan[".recsPerRowList"] = 1;
$tdatapenghasilan[".mainTableOwnerID"] = "";
$tdatapenghasilan[".moveNext"] = 1;
$tdatapenghasilan[".nType"] = 0;

$tdatapenghasilan[".strOriginalTableName"] = "penghasilan";




$tdatapenghasilan[".showAddInPopup"] = true;

$tdatapenghasilan[".showEditInPopup"] = true;

$tdatapenghasilan[".showViewInPopup"] = true;

$tdatapenghasilan[".fieldsForRegister"] = array();

if (!isMobile())
	$tdatapenghasilan[".listAjax"] = true;
else 
	$tdatapenghasilan[".listAjax"] = false;

	$tdatapenghasilan[".audit"] = false;

	$tdatapenghasilan[".locking"] = false;

$tdatapenghasilan[".listIcons"] = true;
$tdatapenghasilan[".edit"] = true;
$tdatapenghasilan[".inlineEdit"] = true;
$tdatapenghasilan[".inlineAdd"] = true;
$tdatapenghasilan[".view"] = true;

$tdatapenghasilan[".exportTo"] = true;

$tdatapenghasilan[".printFriendly"] = true;

$tdatapenghasilan[".delete"] = true;

$tdatapenghasilan[".showSimpleSearchOptions"] = true;

$tdatapenghasilan[".showSearchPanel"] = true;

if (isMobile())
	$tdatapenghasilan[".isUseAjaxSuggest"] = false;
else 
	$tdatapenghasilan[".isUseAjaxSuggest"] = true;

$tdatapenghasilan[".rowHighlite"] = true;

// button handlers file names

$tdatapenghasilan[".addPageEvents"] = false;

// use timepicker for search panel
$tdatapenghasilan[".isUseTimeForSearch"] = false;




$tdatapenghasilan[".allSearchFields"] = array();

$tdatapenghasilan[".allSearchFields"][] = "id_penghasilan";
$tdatapenghasilan[".allSearchFields"][] = "nip";
$tdatapenghasilan[".allSearchFields"][] = "gaji_pokok";
$tdatapenghasilan[".allSearchFields"][] = "tunjangan";
$tdatapenghasilan[".allSearchFields"][] = "insentif";
$tdatapenghasilan[".allSearchFields"][] = "bonus";
$tdatapenghasilan[".allSearchFields"][] = "thr";
$tdatapenghasilan[".allSearchFields"][] = "pajak";
$tdatapenghasilan[".allSearchFields"][] = "pinjaman";
$tdatapenghasilan[".allSearchFields"][] = "gaji_bersih";
$tdatapenghasilan[".allSearchFields"][] = "cara_bayar";
$tdatapenghasilan[".allSearchFields"][] = "tanggal_bayar";
$tdatapenghasilan[".allSearchFields"][] = "tanggal_transfer";
$tdatapenghasilan[".allSearchFields"][] = "nama_bank";
$tdatapenghasilan[".allSearchFields"][] = "nama_rekening";
$tdatapenghasilan[".allSearchFields"][] = "no_rekening";
$tdatapenghasilan[".allSearchFields"][] = "sk_penghasilan";

$tdatapenghasilan[".googleLikeFields"][] = "id_penghasilan";
$tdatapenghasilan[".googleLikeFields"][] = "nip";
$tdatapenghasilan[".googleLikeFields"][] = "gaji_pokok";
$tdatapenghasilan[".googleLikeFields"][] = "tunjangan";
$tdatapenghasilan[".googleLikeFields"][] = "insentif";
$tdatapenghasilan[".googleLikeFields"][] = "bonus";
$tdatapenghasilan[".googleLikeFields"][] = "thr";
$tdatapenghasilan[".googleLikeFields"][] = "pajak";
$tdatapenghasilan[".googleLikeFields"][] = "pinjaman";
$tdatapenghasilan[".googleLikeFields"][] = "gaji_bersih";
$tdatapenghasilan[".googleLikeFields"][] = "cara_bayar";
$tdatapenghasilan[".googleLikeFields"][] = "tanggal_bayar";
$tdatapenghasilan[".googleLikeFields"][] = "tanggal_transfer";
$tdatapenghasilan[".googleLikeFields"][] = "nama_bank";
$tdatapenghasilan[".googleLikeFields"][] = "nama_rekening";
$tdatapenghasilan[".googleLikeFields"][] = "no_rekening";
$tdatapenghasilan[".googleLikeFields"][] = "sk_penghasilan";


$tdatapenghasilan[".advSearchFields"][] = "id_penghasilan";
$tdatapenghasilan[".advSearchFields"][] = "nip";
$tdatapenghasilan[".advSearchFields"][] = "gaji_pokok";
$tdatapenghasilan[".advSearchFields"][] = "tunjangan";
$tdatapenghasilan[".advSearchFields"][] = "insentif";
$tdatapenghasilan[".advSearchFields"][] = "bonus";
$tdatapenghasilan[".advSearchFields"][] = "thr";
$tdatapenghasilan[".advSearchFields"][] = "pajak";
$tdatapenghasilan[".advSearchFields"][] = "pinjaman";
$tdatapenghasilan[".advSearchFields"][] = "gaji_bersih";
$tdatapenghasilan[".advSearchFields"][] = "cara_bayar";
$tdatapenghasilan[".advSearchFields"][] = "tanggal_bayar";
$tdatapenghasilan[".advSearchFields"][] = "tanggal_transfer";
$tdatapenghasilan[".advSearchFields"][] = "nama_bank";
$tdatapenghasilan[".advSearchFields"][] = "nama_rekening";
$tdatapenghasilan[".advSearchFields"][] = "no_rekening";
$tdatapenghasilan[".advSearchFields"][] = "sk_penghasilan";

$tdatapenghasilan[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatapenghasilan[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatapenghasilan[".strOrderBy"] = $tstrOrderBy;

$tdatapenghasilan[".orderindexes"] = array();

$tdatapenghasilan[".sqlHead"] = "SELECT id_penghasilan,   nip,   gaji_pokok,   tunjangan,   insentif,   bonus,   thr,   pajak,   pinjaman,   gaji_bersih,   cara_bayar,   tanggal_bayar,   tanggal_transfer,   nama_bank,   nama_rekening,   no_rekening,   sk_penghasilan";
$tdatapenghasilan[".sqlFrom"] = "FROM penghasilan";
$tdatapenghasilan[".sqlWhereExpr"] = "";
$tdatapenghasilan[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatapenghasilan[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatapenghasilan[".arrGroupsPerPage"] = $arrGPP;

$tableKeyspenghasilan = array();
$tableKeyspenghasilan[] = "id_penghasilan";
$tdatapenghasilan[".Keys"] = $tableKeyspenghasilan;

$tdatapenghasilan[".listFields"] = array();
$tdatapenghasilan[".listFields"][] = "nip";
$tdatapenghasilan[".listFields"][] = "gaji_bersih";
$tdatapenghasilan[".listFields"][] = "cara_bayar";
$tdatapenghasilan[".listFields"][] = "tanggal_bayar";
$tdatapenghasilan[".listFields"][] = "tanggal_transfer";

$tdatapenghasilan[".viewFields"] = array();
$tdatapenghasilan[".viewFields"][] = "id_penghasilan";
$tdatapenghasilan[".viewFields"][] = "nip";
$tdatapenghasilan[".viewFields"][] = "gaji_pokok";
$tdatapenghasilan[".viewFields"][] = "tunjangan";
$tdatapenghasilan[".viewFields"][] = "insentif";
$tdatapenghasilan[".viewFields"][] = "bonus";
$tdatapenghasilan[".viewFields"][] = "thr";
$tdatapenghasilan[".viewFields"][] = "pajak";
$tdatapenghasilan[".viewFields"][] = "pinjaman";
$tdatapenghasilan[".viewFields"][] = "gaji_bersih";
$tdatapenghasilan[".viewFields"][] = "cara_bayar";
$tdatapenghasilan[".viewFields"][] = "tanggal_bayar";
$tdatapenghasilan[".viewFields"][] = "tanggal_transfer";
$tdatapenghasilan[".viewFields"][] = "nama_bank";
$tdatapenghasilan[".viewFields"][] = "nama_rekening";
$tdatapenghasilan[".viewFields"][] = "no_rekening";
$tdatapenghasilan[".viewFields"][] = "sk_penghasilan";

$tdatapenghasilan[".addFields"] = array();
$tdatapenghasilan[".addFields"][] = "nip";
$tdatapenghasilan[".addFields"][] = "gaji_pokok";
$tdatapenghasilan[".addFields"][] = "tunjangan";
$tdatapenghasilan[".addFields"][] = "insentif";
$tdatapenghasilan[".addFields"][] = "bonus";
$tdatapenghasilan[".addFields"][] = "thr";
$tdatapenghasilan[".addFields"][] = "pajak";
$tdatapenghasilan[".addFields"][] = "pinjaman";
$tdatapenghasilan[".addFields"][] = "gaji_bersih";
$tdatapenghasilan[".addFields"][] = "cara_bayar";
$tdatapenghasilan[".addFields"][] = "tanggal_bayar";
$tdatapenghasilan[".addFields"][] = "tanggal_transfer";
$tdatapenghasilan[".addFields"][] = "nama_bank";
$tdatapenghasilan[".addFields"][] = "nama_rekening";
$tdatapenghasilan[".addFields"][] = "no_rekening";
$tdatapenghasilan[".addFields"][] = "sk_penghasilan";

$tdatapenghasilan[".inlineAddFields"] = array();
$tdatapenghasilan[".inlineAddFields"][] = "nip";
$tdatapenghasilan[".inlineAddFields"][] = "gaji_bersih";
$tdatapenghasilan[".inlineAddFields"][] = "cara_bayar";
$tdatapenghasilan[".inlineAddFields"][] = "tanggal_bayar";
$tdatapenghasilan[".inlineAddFields"][] = "tanggal_transfer";

$tdatapenghasilan[".editFields"] = array();
$tdatapenghasilan[".editFields"][] = "nip";
$tdatapenghasilan[".editFields"][] = "gaji_pokok";
$tdatapenghasilan[".editFields"][] = "tunjangan";
$tdatapenghasilan[".editFields"][] = "insentif";
$tdatapenghasilan[".editFields"][] = "bonus";
$tdatapenghasilan[".editFields"][] = "thr";
$tdatapenghasilan[".editFields"][] = "pajak";
$tdatapenghasilan[".editFields"][] = "pinjaman";
$tdatapenghasilan[".editFields"][] = "gaji_bersih";
$tdatapenghasilan[".editFields"][] = "cara_bayar";
$tdatapenghasilan[".editFields"][] = "tanggal_bayar";
$tdatapenghasilan[".editFields"][] = "tanggal_transfer";
$tdatapenghasilan[".editFields"][] = "nama_bank";
$tdatapenghasilan[".editFields"][] = "nama_rekening";
$tdatapenghasilan[".editFields"][] = "no_rekening";
$tdatapenghasilan[".editFields"][] = "sk_penghasilan";

$tdatapenghasilan[".inlineEditFields"] = array();
$tdatapenghasilan[".inlineEditFields"][] = "nip";
$tdatapenghasilan[".inlineEditFields"][] = "gaji_bersih";
$tdatapenghasilan[".inlineEditFields"][] = "cara_bayar";
$tdatapenghasilan[".inlineEditFields"][] = "tanggal_bayar";
$tdatapenghasilan[".inlineEditFields"][] = "tanggal_transfer";

$tdatapenghasilan[".exportFields"] = array();
$tdatapenghasilan[".exportFields"][] = "id_penghasilan";
$tdatapenghasilan[".exportFields"][] = "nip";
$tdatapenghasilan[".exportFields"][] = "gaji_pokok";
$tdatapenghasilan[".exportFields"][] = "tunjangan";
$tdatapenghasilan[".exportFields"][] = "insentif";
$tdatapenghasilan[".exportFields"][] = "bonus";
$tdatapenghasilan[".exportFields"][] = "thr";
$tdatapenghasilan[".exportFields"][] = "pajak";
$tdatapenghasilan[".exportFields"][] = "pinjaman";
$tdatapenghasilan[".exportFields"][] = "gaji_bersih";
$tdatapenghasilan[".exportFields"][] = "cara_bayar";
$tdatapenghasilan[".exportFields"][] = "tanggal_bayar";
$tdatapenghasilan[".exportFields"][] = "tanggal_transfer";
$tdatapenghasilan[".exportFields"][] = "nama_bank";
$tdatapenghasilan[".exportFields"][] = "nama_rekening";
$tdatapenghasilan[".exportFields"][] = "no_rekening";
$tdatapenghasilan[".exportFields"][] = "sk_penghasilan";

$tdatapenghasilan[".printFields"] = array();
$tdatapenghasilan[".printFields"][] = "id_penghasilan";
$tdatapenghasilan[".printFields"][] = "nip";
$tdatapenghasilan[".printFields"][] = "gaji_pokok";
$tdatapenghasilan[".printFields"][] = "tunjangan";
$tdatapenghasilan[".printFields"][] = "insentif";
$tdatapenghasilan[".printFields"][] = "bonus";
$tdatapenghasilan[".printFields"][] = "thr";
$tdatapenghasilan[".printFields"][] = "pajak";
$tdatapenghasilan[".printFields"][] = "pinjaman";
$tdatapenghasilan[".printFields"][] = "gaji_bersih";
$tdatapenghasilan[".printFields"][] = "cara_bayar";
$tdatapenghasilan[".printFields"][] = "tanggal_bayar";
$tdatapenghasilan[".printFields"][] = "tanggal_transfer";
$tdatapenghasilan[".printFields"][] = "nama_bank";
$tdatapenghasilan[".printFields"][] = "nama_rekening";
$tdatapenghasilan[".printFields"][] = "no_rekening";
$tdatapenghasilan[".printFields"][] = "sk_penghasilan";

//	id_penghasilan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "id_penghasilan";
	$fdata["GoodName"] = "id_penghasilan";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Id Penghasilan"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_penghasilan"; 
		$fdata["FullName"] = "id_penghasilan";
	
		
		
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
	
		
		
	$tdatapenghasilan["id_penghasilan"] = $fdata;
//	nip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "nip";
	$fdata["GoodName"] = "nip";
	$fdata["ownerTable"] = "penghasilan";
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
	
		
		
	$tdatapenghasilan["nip"] = $fdata;
//	gaji_pokok
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "gaji_pokok";
	$fdata["GoodName"] = "gaji_pokok";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Gaji Pokok"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "gaji_pokok"; 
		$fdata["FullName"] = "gaji_pokok";
	
		
		
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
	
		
		
	$tdatapenghasilan["gaji_pokok"] = $fdata;
//	tunjangan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "tunjangan";
	$fdata["GoodName"] = "tunjangan";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Tunjangan"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tunjangan"; 
		$fdata["FullName"] = "tunjangan";
	
		
		
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
	
		
		
	$tdatapenghasilan["tunjangan"] = $fdata;
//	insentif
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "insentif";
	$fdata["GoodName"] = "insentif";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Insentif"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "insentif"; 
		$fdata["FullName"] = "insentif";
	
		
		
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
	
		
		
	$tdatapenghasilan["insentif"] = $fdata;
//	bonus
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "bonus";
	$fdata["GoodName"] = "bonus";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Bonus"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "bonus"; 
		$fdata["FullName"] = "bonus";
	
		
		
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
	
		
		
	$tdatapenghasilan["bonus"] = $fdata;
//	thr
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "thr";
	$fdata["GoodName"] = "thr";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Thr"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "thr"; 
		$fdata["FullName"] = "thr";
	
		
		
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
	
		
		
	$tdatapenghasilan["thr"] = $fdata;
//	pajak
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "pajak";
	$fdata["GoodName"] = "pajak";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Pajak"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "pajak"; 
		$fdata["FullName"] = "pajak";
	
		
		
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
	
		
		
	$tdatapenghasilan["pajak"] = $fdata;
//	pinjaman
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "pinjaman";
	$fdata["GoodName"] = "pinjaman";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Pinjaman"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "pinjaman"; 
		$fdata["FullName"] = "pinjaman";
	
		
		
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
	
		
		
	$tdatapenghasilan["pinjaman"] = $fdata;
//	gaji_bersih
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "gaji_bersih";
	$fdata["GoodName"] = "gaji_bersih";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Gaji Bersih"; 
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
	
		$fdata["strField"] = "gaji_bersih"; 
		$fdata["FullName"] = "gaji_bersih";
	
		
		
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
	
		
		
	$tdatapenghasilan["gaji_bersih"] = $fdata;
//	cara_bayar
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "cara_bayar";
	$fdata["GoodName"] = "cara_bayar";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Cara Bayar"; 
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
	
		$fdata["strField"] = "cara_bayar"; 
		$fdata["FullName"] = "cara_bayar";
	
		
		
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
	$edata["LookupValues"][] = "Transfer";
	$edata["LookupValues"][] = "Tunai";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatapenghasilan["cara_bayar"] = $fdata;
//	tanggal_bayar
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "tanggal_bayar";
	$fdata["GoodName"] = "tanggal_bayar";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Tanggal Bayar"; 
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
	
		$fdata["strField"] = "tanggal_bayar"; 
		$fdata["FullName"] = "tanggal_bayar";
	
		
		
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
	
		
		
	$tdatapenghasilan["tanggal_bayar"] = $fdata;
//	tanggal_transfer
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "tanggal_transfer";
	$fdata["GoodName"] = "tanggal_transfer";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Tanggal Transfer"; 
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
	
		$fdata["strField"] = "tanggal_transfer"; 
		$fdata["FullName"] = "tanggal_transfer";
	
		
		
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
	
		
		
	$tdatapenghasilan["tanggal_transfer"] = $fdata;
//	nama_bank
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "nama_bank";
	$fdata["GoodName"] = "nama_bank";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Nama Bank"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "nama_bank"; 
		$fdata["FullName"] = "nama_bank";
	
		
		
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
	
		
		
	$tdatapenghasilan["nama_bank"] = $fdata;
//	nama_rekening
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "nama_rekening";
	$fdata["GoodName"] = "nama_rekening";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Nama Rekening"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "nama_rekening"; 
		$fdata["FullName"] = "nama_rekening";
	
		
		
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
	
		
		
	$tdatapenghasilan["nama_rekening"] = $fdata;
//	no_rekening
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "no_rekening";
	$fdata["GoodName"] = "no_rekening";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "No Rekening"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_rekening"; 
		$fdata["FullName"] = "no_rekening";
	
		
		
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
	
		
		
	$tdatapenghasilan["no_rekening"] = $fdata;
//	sk_penghasilan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "sk_penghasilan";
	$fdata["GoodName"] = "sk_penghasilan";
	$fdata["ownerTable"] = "penghasilan";
	$fdata["Label"] = "Sk Penghasilan"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "sk_penghasilan"; 
		$fdata["FullName"] = "sk_penghasilan";
	
		
		
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
	
		
		
	$tdatapenghasilan["sk_penghasilan"] = $fdata;

	
$tables_data["penghasilan"]=&$tdatapenghasilan;
$field_labels["penghasilan"] = &$fieldLabelspenghasilan;
$fieldToolTips["penghasilan"] = &$fieldToolTipspenghasilan;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["penghasilan"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["penghasilan"] = array();

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
	$masterTablesData["penghasilan"][$mIndex] = $masterParams;	
		$masterTablesData["penghasilan"][$mIndex]["masterKeys"][]="nip";
		$masterTablesData["penghasilan"][$mIndex]["detailKeys"][]="nip";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_penghasilan()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_penghasilan,   nip,   gaji_pokok,   tunjangan,   insentif,   bonus,   thr,   pajak,   pinjaman,   gaji_bersih,   cara_bayar,   tanggal_bayar,   tanggal_transfer,   nama_bank,   nama_rekening,   no_rekening,   sk_penghasilan";
$proto0["m_strFrom"] = "FROM penghasilan";
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
	"m_strName" => "id_penghasilan",
	"m_strTable" => "penghasilan"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "nip",
	"m_strTable" => "penghasilan"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "gaji_pokok",
	"m_strTable" => "penghasilan"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "tunjangan",
	"m_strTable" => "penghasilan"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "insentif",
	"m_strTable" => "penghasilan"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "bonus",
	"m_strTable" => "penghasilan"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "thr",
	"m_strTable" => "penghasilan"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "pajak",
	"m_strTable" => "penghasilan"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "pinjaman",
	"m_strTable" => "penghasilan"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "gaji_bersih",
	"m_strTable" => "penghasilan"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "cara_bayar",
	"m_strTable" => "penghasilan"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "tanggal_bayar",
	"m_strTable" => "penghasilan"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "tanggal_transfer",
	"m_strTable" => "penghasilan"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "nama_bank",
	"m_strTable" => "penghasilan"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "nama_rekening",
	"m_strTable" => "penghasilan"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "no_rekening",
	"m_strTable" => "penghasilan"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "sk_penghasilan",
	"m_strTable" => "penghasilan"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto39=array();
$proto39["m_link"] = "SQLL_MAIN";
			$proto40=array();
$proto40["m_strName"] = "penghasilan";
$proto40["m_columns"] = array();
$proto40["m_columns"][] = "id_penghasilan";
$proto40["m_columns"][] = "nip";
$proto40["m_columns"][] = "gaji_pokok";
$proto40["m_columns"][] = "tunjangan";
$proto40["m_columns"][] = "insentif";
$proto40["m_columns"][] = "bonus";
$proto40["m_columns"][] = "thr";
$proto40["m_columns"][] = "pajak";
$proto40["m_columns"][] = "pinjaman";
$proto40["m_columns"][] = "gaji_bersih";
$proto40["m_columns"][] = "cara_bayar";
$proto40["m_columns"][] = "tanggal_bayar";
$proto40["m_columns"][] = "tanggal_transfer";
$proto40["m_columns"][] = "nama_bank";
$proto40["m_columns"][] = "nama_rekening";
$proto40["m_columns"][] = "no_rekening";
$proto40["m_columns"][] = "sk_penghasilan";
$obj = new SQLTable($proto40);

$proto39["m_table"] = $obj;
$proto39["m_alias"] = "";
$proto41=array();
$proto41["m_sql"] = "";
$proto41["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto41["m_column"]=$obj;
$proto41["m_contained"] = array();
$proto41["m_strCase"] = "";
$proto41["m_havingmode"] = "0";
$proto41["m_inBrackets"] = "0";
$proto41["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto41);

$proto39["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto39);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_penghasilan = createSqlQuery_penghasilan();
																	$tdatapenghasilan[".sqlquery"] = $queryData_penghasilan;
	
if(isset($tdatapenghasilan["field2"])){
	$tdatapenghasilan["field2"]["LookupTable"] = "carscars_view";
	$tdatapenghasilan["field2"]["LookupOrderBy"] = "name";
	$tdatapenghasilan["field2"]["LookupType"] = 4;
	$tdatapenghasilan["field2"]["LinkField"] = "email";
	$tdatapenghasilan["field2"]["DisplayField"] = "name";
	$tdatapenghasilan[".hasCustomViewField"] = true;
}

$tableEvents["penghasilan"] = new eventsBase;
$tdatapenghasilan[".hasEvents"] = false;

$cipherer = new RunnerCipherer("penghasilan");

?>