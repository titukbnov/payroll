<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/karyawan_variables.php");

if(!isLogged())
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(CheckPermissionsEvent($strTableName, 'P') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Export"))
{
	echo "<p>"."You don't have permissions to access this table"."<a href=\"login.php\">"."Back to login page"."</a></p>";
	return;
}

$layout = new TLayout("export","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["top"] = array();
$layout->containers["export"] = array();

$layout->containers["export"][] = array("name"=>"exportheader","block"=>"","substyle"=>2);


$layout->containers["export"][] = array("name"=>"exprange_header","block"=>"rangeheader_block","substyle"=>3);


$layout->containers["export"][] = array("name"=>"exprange","block"=>"range_block","substyle"=>1);


$layout->containers["export"][] = array("name"=>"expoutput_header","block"=>"","substyle"=>3);


$layout->containers["export"][] = array("name"=>"expoutput","block"=>"","substyle"=>1);


$layout->containers["export"][] = array("name"=>"expbuttons","block"=>"","substyle"=>2);


$layout->skins["export"] = "fields";
$layout->blocks["top"][] = "export";$page_layouts["karyawan_export"] = $layout;


// Modify query: remove blob fields from fieldlist.
// Blob fields on an export page are shown using imager.php (for example).
// They don't need to be selected from DB in export.php itself.
//$gQuery->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());

$cipherer = new RunnerCipherer($strTableName);

$strWhereClause = "";
$strHavingClause = "";
$strSearchCriteria = "and";
$selected_recs = array();
$options = "1";

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();
$id = postvalue("id") != "" ? postvalue("id") : 1;

$phpVersion = (int)substr(phpversion(), 0, 1); 
if($phpVersion > 4)
{
	include("include/export_functions.php");
	$xt->assign("groupExcel", true);
}
else
	$xt->assign("excel", true);

//array of params for classes
$params = array("pageType" => PAGE_EXPORT, "id" => $id, "tName" => $strTableName);
$params["xt"] = &$xt;
if(!$eventObj->exists("ListGetRowCount") && !$eventObj->exists("ListQuery"))
	$params["needSearchClauseObj"] = false;
$pageObject = new RunnerPage($params);

//	Before Process event
if($eventObj->exists("BeforeProcessExport"))
	$eventObj->BeforeProcessExport($conn, $pageObject);

if (@$_REQUEST["a"]!="")
{
	$options = "";
	$sWhere = "1=0";	

//	process selection
	$selected_recs = array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["nip"] = refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[] = $keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys = array();
			$keys["nip"] = urldecode($arr[0]);
			$selected_recs[] = $keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}


	$strSQL = $gQuery->gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
	$_SESSION[$strTableName."_SelectedRecords"] = $selected_recs;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause = @$_SESSION[$strTableName."_SelectedWhere"];
	$selected_recs = $_SESSION[$strTableName."_SelectedRecords"];
}
else
{
	$strWhereClause = @$_SESSION[$strTableName."_where"];
	$strHavingClause = @$_SESSION[$strTableName."_having"];
	$strSearchCriteria = @$_SESSION[$strTableName."_criteria"];
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
}

$mypage = 1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy = $_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy = $gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if($eventObj->exists("BeforeQueryExport"))
		$eventObj->BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy, $pageObject);
//	Rebuild SQL if needed
	if($strSQL!=$strSQLbak)
	{
//	changed $strSQL - old style	
		$numrows=GetRowCount($strSQL);
	}
	else
	{
		$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
		$strSQL.=" ".trim($strOrderBy);
		$rowcount=false;
		if($eventObj->exists("ListGetRowCount"))
		{
			$masterKeysReq=array();
			for($i = 0; $i < count($pageObject->detailKeysByM); $i ++)
				$masterKeysReq[] = $_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount = $eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs, $pageObject);
		}
		if($rowcount !== false)
			$numrows = $rowcount;
		else
			$numrows = $gQuery->gSQLRowCount($strWhereClause,$strHavingClause,$strSearchCriteria);
	}
	LogInfo($strSQL);

//	 Pagination:

	$nPageSize = 0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage = (integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize = (integer)@$_SESSION[$strTableName."_pagesize"];
		
		if(!$nPageSize)
			$nPageSize = $gSettings->getInitialPageSize();
				
		if($nPageSize<0)
			$nPageSize = 0;
			
		if($nPageSize>0)
		{
			if($numrows<=($mypage-1)*$nPageSize)
				$mypage = ceil($numrows/$nPageSize);
		
			if(!$mypage)
				$mypage = 1;
			
					$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
		}
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
	{
		$arrFieldForSort = array();
		$arrHowFieldSort = array();
		require_once getabspath('classes/orderclause.php');
		$fieldList = unserialize($_SESSION[$strTableName."_orderFieldsList"]);
		for($i = 0; $i < count($fieldList); $i++)
		{
			$arrFieldForSort[] = $fieldList[$i]->fieldIndex; 
			$arrHowFieldSort[] = $fieldList[$i]->orderDirection; 
		}
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort,
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $nPageSize, $mypage, $pageObject);
	}
	if($listarray!==false)
		$rs = $listarray;
	elseif($nPageSize>0)
	{
					$rs = db_query($strSQL,$conn);
	}
	else
		$rs = db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(substr(@$_REQUEST["type"],0,5)=="excel")
	{
//	remove grouping
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SMONGROUPING"]="0";
				if($phpVersion > 4)
			ExportToExcel($cipherer, $pageObject);
		else
			ExportToExcel_old($cipherer);
	}
	else if(@$_REQUEST["type"]=="word")
	{
		ExportToWord($cipherer);
	}
	else if(@$_REQUEST["type"]=="xml")
	{
		ExportToXML($cipherer);
	}
	else if(@$_REQUEST["type"]=="csv")
	{
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SDECIMAL"]=".";
		$locale_info["LOCALE_SMONGROUPING"]="0";
		$locale_info["LOCALE_SMONDECIMALSEP"]=".";
		ExportToCSV($cipherer);
	}
	db_close($conn);
	return;
}

// add button events if exist
$pageObject->addButtonHandlers();

if($options)
{
	$xt->assign("rangeheader_block",true);
	$xt->assign("range_block",true);
}

$xt->assign("exportlink_attrs", 'id="saveButton'.$pageObject->id.'"');

$pageObject->body["begin"] .="<script type=\"text/javascript\" src=\"include/loadfirst.js\"></script>\r\n";
$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";

$pageObject->fillSetCntrlMaps();
$pageObject->body['end'] .= '<script>';
$pageObject->body['end'] .= "window.controlsMap = ".my_json_encode($pageObject->controlsHTMLMap).";";
$pageObject->body['end'] .= "window.viewControlsMap = ".my_json_encode($pageObject->viewControlsHTMLMap).";";
$pageObject->body['end'] .= "window.settings = ".my_json_encode($pageObject->jsSettings).";";
$pageObject->body['end'] .= '</script>';
$pageObject->body["end"] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerAll.js\"></script>\r\n";
$pageObject->addCommonJs();

$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";
$xt->assignbyref("body",$pageObject->body);

$xt->display("karyawan_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=karyawan.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData($cipherer);

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=karyawan.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData($cipherer);

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML($cipherer)
{
	global $nPageSize,$rs,$strTableName,$conn,$eventObj, $pageObject;
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;Filename=karyawan.xml");
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);	
	//if(!$row)
	//	return;
		
	global $cCharset;
	
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i = 0;
	$pageObject->viewControls->forExport = "xml";
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		$values = array();
			$values["nip"] = $pageObject->showDBValue("nip", $row);
			$values["nama"] = $pageObject->showDBValue("nama", $row);
			$values["jenis_kelamin"] = $pageObject->showDBValue("jenis_kelamin", $row);
			$values["tempat_lahir"] = $pageObject->showDBValue("tempat_lahir", $row);
			$values["tanggal_lahir"] = $pageObject->showDBValue("tanggal_lahir", $row);
			$values["golongan_darah"] = $pageObject->showDBValue("golongan_darah", $row);
			$values["agama"] = $pageObject->showDBValue("agama", $row);
			$values["status_pernikahan"] = $pageObject->showDBValue("status_pernikahan", $row);
			$values["alamat_lengkap"] = $pageObject->showDBValue("alamat_lengkap", $row);
			$values["telepon_rumah"] = $pageObject->showDBValue("telepon_rumah", $row);
			$values["ponsel"] = $pageObject->showDBValue("ponsel", $row);
			$values["email"] = $pageObject->showDBValue("email", $row);
			$values["hobi"] = $pageObject->showDBValue("hobi", $row);
			$values["pendidikan"] = $pageObject->showDBValue("pendidikan", $row);
			$values["tanggal_masuk"] = $pageObject->showDBValue("tanggal_masuk", $row);
			$values["status_kerja"] = $pageObject->showDBValue("status_kerja", $row);
			$values["departemen"] = $pageObject->showDBValue("departemen", $row);
			$values["organisasi"] = $pageObject->showDBValue("organisasi", $row);
			$values["golongan"] = $pageObject->showDBValue("golongan", $row);
			$values["jabatan"] = $pageObject->showDBValue("jabatan", $row);
			$values["no_ktp"] = $pageObject->showDBValue("no_ktp", $row);
			$values["no_sim"] = $pageObject->showDBValue("no_sim", $row);
			$values["no_paspor"] = $pageObject->showDBValue("no_paspor", $row);
			$values["no_npwp"] = $pageObject->showDBValue("no_npwp", $row);
			$values["no_jamsostek"] = $pageObject->showDBValue("no_jamsostek", $row);
			$values["no_asuransi"] = $pageObject->showDBValue("no_asuransi", $row);
			$values["no_pensiun"] = $pageObject->showDBValue("no_pensiun", $row);
			$values["pensiun"] = $pageObject->showDBValue("pensiun", $row);
			$values["tanggal_pensiun"] = $pageObject->showDBValue("tanggal_pensiun", $row);
			$values["foto"] = $pageObject->showDBValue("foto", $row);
			$values["sk_tambahan"] = $pageObject->showDBValue("sk_tambahan", $row);
			$values["keterangan"] = $pageObject->showDBValue("keterangan", $row);
			$values["id_login"] = $pageObject->showDBValue("id_login", $row);
			$values["id_pelatihan"] = $pageObject->showDBValue("id_pelatihan", $row);
			$values["id_penghasilan"] = $pageObject->showDBValue("id_penghasilan", $row);
			$values["id_penilaian"] = $pageObject->showDBValue("id_penilaian", $row);
			$values["id_absensi"] = $pageObject->showDBValue("id_absensi", $row);
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		
		if ($eventRes)
		{
			$i++;
			echo "<row>\r\n";
			foreach ($values as $fName => $val)
			{
				$field = htmlspecialchars(XMLNameEncode($fName));
				echo "<".$field.">";
				echo $values[$fName];
				echo "</".$field.">\r\n";
			}
			echo "</row>\r\n";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	echo "</table>\r\n";
}

function ExportToCSV($cipherer)
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj, $pageObject;
	header("Content-Type: application/csv");
	header("Content-Disposition: attachment;Filename=karyawan.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"nip\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"nama\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"jenis_kelamin\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tempat_lahir\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tanggal_lahir\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"golongan_darah\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"agama\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"status_pernikahan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"alamat_lengkap\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"telepon_rumah\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"ponsel\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"email\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"hobi\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"pendidikan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tanggal_masuk\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"status_kerja\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"departemen\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"organisasi\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"golongan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"jabatan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_ktp\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_sim\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_paspor\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_npwp\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_jamsostek\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_asuransi\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_pensiun\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"pensiun\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tanggal_pensiun\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"foto\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"sk_tambahan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"keterangan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"id_login\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"id_pelatihan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"id_penghasilan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"id_penilaian\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"id_absensi\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["nip"] = $pageObject->getViewControl("nip")->showDBValue($row, "");
			$values["nama"] = $pageObject->getViewControl("nama")->showDBValue($row, "");
			$values["jenis_kelamin"] = $pageObject->getViewControl("jenis_kelamin")->showDBValue($row, "");
			$values["tempat_lahir"] = $pageObject->getViewControl("tempat_lahir")->showDBValue($row, "");
			$values["tanggal_lahir"] = $pageObject->getViewControl("tanggal_lahir")->showDBValue($row, "");
			$values["golongan_darah"] = $pageObject->getViewControl("golongan_darah")->showDBValue($row, "");
			$values["agama"] = $pageObject->getViewControl("agama")->showDBValue($row, "");
			$values["status_pernikahan"] = $pageObject->getViewControl("status_pernikahan")->showDBValue($row, "");
			$values["alamat_lengkap"] = $pageObject->getViewControl("alamat_lengkap")->showDBValue($row, "");
			$values["telepon_rumah"] = $pageObject->getViewControl("telepon_rumah")->showDBValue($row, "");
			$values["ponsel"] = $pageObject->getViewControl("ponsel")->showDBValue($row, "");
			$values["email"] = $pageObject->getViewControl("email")->showDBValue($row, "");
			$values["hobi"] = $pageObject->getViewControl("hobi")->showDBValue($row, "");
			$values["pendidikan"] = $pageObject->getViewControl("pendidikan")->showDBValue($row, "");
			$values["tanggal_masuk"] = $pageObject->getViewControl("tanggal_masuk")->showDBValue($row, "");
			$values["status_kerja"] = $pageObject->getViewControl("status_kerja")->showDBValue($row, "");
			$values["departemen"] = $pageObject->getViewControl("departemen")->showDBValue($row, "");
			$values["organisasi"] = $pageObject->getViewControl("organisasi")->showDBValue($row, "");
			$values["golongan"] = $pageObject->getViewControl("golongan")->showDBValue($row, "");
			$values["jabatan"] = $pageObject->getViewControl("jabatan")->showDBValue($row, "");
			$values["no_ktp"] = $pageObject->getViewControl("no_ktp")->showDBValue($row, "");
			$values["no_sim"] = $pageObject->getViewControl("no_sim")->showDBValue($row, "");
			$values["no_paspor"] = $pageObject->getViewControl("no_paspor")->showDBValue($row, "");
			$values["no_npwp"] = $pageObject->getViewControl("no_npwp")->showDBValue($row, "");
			$values["no_jamsostek"] = $pageObject->getViewControl("no_jamsostek")->showDBValue($row, "");
			$values["no_asuransi"] = $pageObject->getViewControl("no_asuransi")->showDBValue($row, "");
			$values["no_pensiun"] = $pageObject->getViewControl("no_pensiun")->showDBValue($row, "");
			$values["pensiun"] = $pageObject->getViewControl("pensiun")->showDBValue($row, "");
			$values["tanggal_pensiun"] = $pageObject->getViewControl("tanggal_pensiun")->showDBValue($row, "");
			$values["foto"] = $pageObject->getViewControl("foto")->showDBValue($row, "");
			$values["sk_tambahan"] = $pageObject->getViewControl("sk_tambahan")->showDBValue($row, "");
			$values["keterangan"] = $pageObject->getViewControl("keterangan")->showDBValue($row, "");
			$values["id_login"] = $pageObject->getViewControl("id_login")->showDBValue($row, "");
			$values["id_pelatihan"] = $pageObject->getViewControl("id_pelatihan")->showDBValue($row, "");
			$values["id_penghasilan"] = $pageObject->getViewControl("id_penghasilan")->showDBValue($row, "");
			$values["id_penilaian"] = $pageObject->getViewControl("id_penilaian")->showDBValue($row, "");
			$values["id_absensi"] = $pageObject->getViewControl("id_absensi")->showDBValue($row, "");

		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row,$values, $pageObject);
		}
		if ($eventRes)
		{
			$outstr="";
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["nip"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["nama"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["jenis_kelamin"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tempat_lahir"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tanggal_lahir"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["golongan_darah"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["agama"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["status_pernikahan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["alamat_lengkap"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["telepon_rumah"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["ponsel"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["email"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["hobi"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["pendidikan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tanggal_masuk"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["status_kerja"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["departemen"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["organisasi"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["golongan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["jabatan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_ktp"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_sim"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_paspor"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_npwp"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_jamsostek"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_asuransi"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_pensiun"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["pensiun"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tanggal_pensiun"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["foto"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["sk_tambahan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["keterangan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["id_login"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["id_pelatihan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["id_penghasilan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["id_penilaian"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["id_absensi"]).'"';
			echo $outstr;
		}
		
		$iNumberOfRows++;
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
			
		if(((!$nPageSize || $iNumberOfRows<$nPageSize) && $row) && $eventRes)
			echo "\r\n";
	}
}

function WriteTableData($cipherer)
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj, $pageObject;
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);
//	if(!$row)
//		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Nip").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Nama").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Jenis Kelamin").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tempat Lahir").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tanggal Lahir").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Golongan Darah").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Agama").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Status Pernikahan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Alamat Lengkap").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Telepon Rumah").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Ponsel").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Email").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Hobi").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Pendidikan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tanggal Masuk").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Status Kerja").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Departemen").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Organisasi").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Golongan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Jabatan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Ktp").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Sim").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Paspor").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Npwp").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Jamsostek").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Asuransi").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Pensiun").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Pensiun").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tanggal Pensiun").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Foto").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Sk Tambahan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Keterangan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Id Login").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Id Pelatihan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Id Penghasilan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Id Penilaian").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Id Absensi").'</td>';	
	}
	else
	{
		echo "<td>"."Nip"."</td>";
		echo "<td>"."Nama"."</td>";
		echo "<td>"."Jenis Kelamin"."</td>";
		echo "<td>"."Tempat Lahir"."</td>";
		echo "<td>"."Tanggal Lahir"."</td>";
		echo "<td>"."Golongan Darah"."</td>";
		echo "<td>"."Agama"."</td>";
		echo "<td>"."Status Pernikahan"."</td>";
		echo "<td>"."Alamat Lengkap"."</td>";
		echo "<td>"."Telepon Rumah"."</td>";
		echo "<td>"."Ponsel"."</td>";
		echo "<td>"."Email"."</td>";
		echo "<td>"."Hobi"."</td>";
		echo "<td>"."Pendidikan"."</td>";
		echo "<td>"."Tanggal Masuk"."</td>";
		echo "<td>"."Status Kerja"."</td>";
		echo "<td>"."Departemen"."</td>";
		echo "<td>"."Organisasi"."</td>";
		echo "<td>"."Golongan"."</td>";
		echo "<td>"."Jabatan"."</td>";
		echo "<td>"."No Ktp"."</td>";
		echo "<td>"."No Sim"."</td>";
		echo "<td>"."No Paspor"."</td>";
		echo "<td>"."No Npwp"."</td>";
		echo "<td>"."No Jamsostek"."</td>";
		echo "<td>"."No Asuransi"."</td>";
		echo "<td>"."No Pensiun"."</td>";
		echo "<td>"."Pensiun"."</td>";
		echo "<td>"."Tanggal Pensiun"."</td>";
		echo "<td>"."Foto"."</td>";
		echo "<td>"."Sk Tambahan"."</td>";
		echo "<td>"."Keterangan"."</td>";
		echo "<td>"."Id Login"."</td>";
		echo "<td>"."Id Pelatihan"."</td>";
		echo "<td>"."Id Penghasilan"."</td>";
		echo "<td>"."Id Penilaian"."</td>";
		echo "<td>"."Id Absensi"."</td>";
	}
	echo "</tr>";
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["nip"] = $pageObject->getViewControl("nip")->showDBValue($row, "");
					$values["nama"] = $pageObject->getViewControl("nama")->showDBValue($row, "");
					$values["jenis_kelamin"] = $pageObject->getViewControl("jenis_kelamin")->showDBValue($row, "");
					$values["tempat_lahir"] = $pageObject->getViewControl("tempat_lahir")->showDBValue($row, "");
					$values["tanggal_lahir"] = $pageObject->getViewControl("tanggal_lahir")->showDBValue($row, "");
					$values["golongan_darah"] = $pageObject->getViewControl("golongan_darah")->showDBValue($row, "");
					$values["agama"] = $pageObject->getViewControl("agama")->showDBValue($row, "");
					$values["status_pernikahan"] = $pageObject->getViewControl("status_pernikahan")->showDBValue($row, "");
					$values["alamat_lengkap"] = $pageObject->getViewControl("alamat_lengkap")->showDBValue($row, "");
					$values["telepon_rumah"] = $pageObject->getViewControl("telepon_rumah")->showDBValue($row, "");
					$values["ponsel"] = $pageObject->getViewControl("ponsel")->showDBValue($row, "");
					$values["email"] = $pageObject->getViewControl("email")->showDBValue($row, "");
					$values["hobi"] = $pageObject->getViewControl("hobi")->showDBValue($row, "");
					$values["pendidikan"] = $pageObject->getViewControl("pendidikan")->showDBValue($row, "");
					$values["tanggal_masuk"] = $pageObject->getViewControl("tanggal_masuk")->showDBValue($row, "");
					$values["status_kerja"] = $pageObject->getViewControl("status_kerja")->showDBValue($row, "");
					$values["departemen"] = $pageObject->getViewControl("departemen")->showDBValue($row, "");
					$values["organisasi"] = $pageObject->getViewControl("organisasi")->showDBValue($row, "");
					$values["golongan"] = $pageObject->getViewControl("golongan")->showDBValue($row, "");
					$values["jabatan"] = $pageObject->getViewControl("jabatan")->showDBValue($row, "");
					$values["no_ktp"] = $pageObject->getViewControl("no_ktp")->showDBValue($row, "");
					$values["no_sim"] = $pageObject->getViewControl("no_sim")->showDBValue($row, "");
					$values["no_paspor"] = $pageObject->getViewControl("no_paspor")->showDBValue($row, "");
					$values["no_npwp"] = $pageObject->getViewControl("no_npwp")->showDBValue($row, "");
					$values["no_jamsostek"] = $pageObject->getViewControl("no_jamsostek")->showDBValue($row, "");
					$values["no_asuransi"] = $pageObject->getViewControl("no_asuransi")->showDBValue($row, "");
					$values["no_pensiun"] = $pageObject->getViewControl("no_pensiun")->showDBValue($row, "");
					$values["pensiun"] = $pageObject->getViewControl("pensiun")->showDBValue($row, "");
					$values["tanggal_pensiun"] = $pageObject->getViewControl("tanggal_pensiun")->showDBValue($row, "");
					$values["foto"] = $pageObject->getViewControl("foto")->showDBValue($row, "");
					$values["sk_tambahan"] = $pageObject->getViewControl("sk_tambahan")->showDBValue($row, "");
					$values["keterangan"] = $pageObject->getViewControl("keterangan")->showDBValue($row, "");
					$values["id_login"] = $pageObject->getViewControl("id_login")->showDBValue($row, "");
					$values["id_pelatihan"] = $pageObject->getViewControl("id_pelatihan")->showDBValue($row, "");
					$values["id_penghasilan"] = $pageObject->getViewControl("id_penghasilan")->showDBValue($row, "");
					$values["id_penilaian"] = $pageObject->getViewControl("id_penilaian")->showDBValue($row, "");
					$values["id_absensi"] = $pageObject->getViewControl("id_absensi")->showDBValue($row, "");
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";
		
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["nip"]);
					else
						echo $values["nip"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["nama"]);
					else
						echo $values["nama"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["jenis_kelamin"]);
					else
						echo $values["jenis_kelamin"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tempat_lahir"]);
					else
						echo $values["tempat_lahir"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tanggal_lahir"]);
					else
						echo $values["tanggal_lahir"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["golongan_darah"]);
					else
						echo $values["golongan_darah"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["agama"]);
					else
						echo $values["agama"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["status_pernikahan"]);
					else
						echo $values["status_pernikahan"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["alamat_lengkap"]);
					else
						echo $values["alamat_lengkap"];
			echo '</td>';
							echo '<td>';
			
									echo $values["telepon_rumah"];
			echo '</td>';
							echo '<td>';
			
									echo $values["ponsel"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["email"]);
					else
						echo $values["email"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["hobi"]);
					else
						echo $values["hobi"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["pendidikan"]);
					else
						echo $values["pendidikan"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tanggal_masuk"]);
					else
						echo $values["tanggal_masuk"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["status_kerja"]);
					else
						echo $values["status_kerja"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["departemen"]);
					else
						echo $values["departemen"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["organisasi"]);
					else
						echo $values["organisasi"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["golongan"]);
					else
						echo $values["golongan"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["jabatan"]);
					else
						echo $values["jabatan"];
			echo '</td>';
							echo '<td>';
			
									echo $values["no_ktp"];
			echo '</td>';
							echo '<td>';
			
									echo $values["no_sim"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["no_paspor"]);
					else
						echo $values["no_paspor"];
			echo '</td>';
							echo '<td>';
			
									echo $values["no_npwp"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["no_jamsostek"]);
					else
						echo $values["no_jamsostek"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["no_asuransi"]);
					else
						echo $values["no_asuransi"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["no_pensiun"]);
					else
						echo $values["no_pensiun"];
			echo '</td>';
							echo '<td>';
			
									echo $values["pensiun"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tanggal_pensiun"]);
					else
						echo $values["tanggal_pensiun"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["foto"]);
					else
						echo $values["foto"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["sk_tambahan"]);
					else
						echo $values["sk_tambahan"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["keterangan"]);
					else
						echo $values["keterangan"];
			echo '</td>';
							echo '<td>';
			
									echo $values["id_login"];
			echo '</td>';
							echo '<td>';
			
									echo $values["id_pelatihan"];
			echo '</td>';
							echo '<td>';
			
									echo $values["id_penghasilan"];
			echo '</td>';
							echo '<td>';
			
									echo $values["id_penilaian"];
			echo '</td>';
							echo '<td>';
			
									echo $values["id_absensi"];
			echo '</td>';
			echo "</tr>";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	
}

function XMLNameEncode($strValue)
{
	$search = array(" ","#","'","/","\\","(",")",",","[");
	$ret = str_replace($search,"",$strValue);
	$search = array("]","+","\"","-","_","|","}","{","=");
	$ret = str_replace($search,"",$ret);
	return $ret;
}

function PrepareForExcel($ret)
{
	//$ret = htmlspecialchars($str); commented for bug #6823
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}

function countTotals(&$totals, $totalsFields, $data)
{
	for($i = 0; $i < count($totalsFields); $i ++) 
	{
		if($totalsFields[$i]['totalsType'] == 'COUNT') 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]!= "");
		else if($totalsFields[$i]['viewFormat'] == "Time") 
		{
			$time = GetTotalsForTime($data[$totalsFields[$i]['fName']]);
			$totals[$totalsFields[$i]['fName']]["value"] += $time[2]+$time[1]*60 + $time[0]*3600;
		} 
		else 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]+ 0);
		
		if($totalsFields[$i]['totalsType'] == 'AVERAGE')
		{
			if(!is_null($data[$totalsFields[$i]['fName']]) && $data[$totalsFields[$i]['fName']]!=="")
				$totals[$totalsFields[$i]['fName']]['numRows']++;
		}
	}
}
?>
