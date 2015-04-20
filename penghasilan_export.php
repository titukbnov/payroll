<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/penghasilan_variables.php");

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
$layout->blocks["top"][] = "export";$page_layouts["penghasilan_export"] = $layout;


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
			$keys["id_penghasilan"] = refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
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
			$keys["id_penghasilan"] = urldecode($arr[0]);
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

$xt->display("penghasilan_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=penghasilan.xls");

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
	header("Content-Disposition: attachment;Filename=penghasilan.doc");

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
	header("Content-Disposition: attachment;Filename=penghasilan.xml");
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
			$values["id_penghasilan"] = $pageObject->showDBValue("id_penghasilan", $row);
			$values["nip"] = $pageObject->showDBValue("nip", $row);
			$values["gaji_pokok"] = $pageObject->showDBValue("gaji_pokok", $row);
			$values["tunjangan"] = $pageObject->showDBValue("tunjangan", $row);
			$values["insentif"] = $pageObject->showDBValue("insentif", $row);
			$values["bonus"] = $pageObject->showDBValue("bonus", $row);
			$values["thr"] = $pageObject->showDBValue("thr", $row);
			$values["pajak"] = $pageObject->showDBValue("pajak", $row);
			$values["pinjaman"] = $pageObject->showDBValue("pinjaman", $row);
			$values["gaji_bersih"] = $pageObject->showDBValue("gaji_bersih", $row);
			$values["cara_bayar"] = $pageObject->showDBValue("cara_bayar", $row);
			$values["tanggal_bayar"] = $pageObject->showDBValue("tanggal_bayar", $row);
			$values["tanggal_transfer"] = $pageObject->showDBValue("tanggal_transfer", $row);
			$values["nama_bank"] = $pageObject->showDBValue("nama_bank", $row);
			$values["nama_rekening"] = $pageObject->showDBValue("nama_rekening", $row);
			$values["no_rekening"] = $pageObject->showDBValue("no_rekening", $row);
			$values["sk_penghasilan"] = $pageObject->showDBValue("sk_penghasilan", $row);
		
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
	header("Content-Disposition: attachment;Filename=penghasilan.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"id_penghasilan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"nip\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"gaji_pokok\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tunjangan\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"insentif\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"bonus\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"thr\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"pajak\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"pinjaman\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"gaji_bersih\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"cara_bayar\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tanggal_bayar\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tanggal_transfer\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"nama_bank\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"nama_rekening\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"no_rekening\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"sk_penghasilan\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["id_penghasilan"] = $pageObject->getViewControl("id_penghasilan")->showDBValue($row, "");
			$values["nip"] = $pageObject->getViewControl("nip")->showDBValue($row, "");
			$values["gaji_pokok"] = $pageObject->getViewControl("gaji_pokok")->showDBValue($row, "");
			$values["tunjangan"] = $pageObject->getViewControl("tunjangan")->showDBValue($row, "");
			$values["insentif"] = $pageObject->getViewControl("insentif")->showDBValue($row, "");
			$values["bonus"] = $pageObject->getViewControl("bonus")->showDBValue($row, "");
			$values["thr"] = $pageObject->getViewControl("thr")->showDBValue($row, "");
			$values["pajak"] = $pageObject->getViewControl("pajak")->showDBValue($row, "");
			$values["pinjaman"] = $pageObject->getViewControl("pinjaman")->showDBValue($row, "");
			$values["gaji_bersih"] = $pageObject->getViewControl("gaji_bersih")->showDBValue($row, "");
			$values["cara_bayar"] = $pageObject->getViewControl("cara_bayar")->showDBValue($row, "");
			$values["tanggal_bayar"] = $pageObject->getViewControl("tanggal_bayar")->showDBValue($row, "");
			$values["tanggal_transfer"] = $pageObject->getViewControl("tanggal_transfer")->showDBValue($row, "");
			$values["nama_bank"] = $pageObject->getViewControl("nama_bank")->showDBValue($row, "");
			$values["nama_rekening"] = $pageObject->getViewControl("nama_rekening")->showDBValue($row, "");
			$values["no_rekening"] = $pageObject->getViewControl("no_rekening")->showDBValue($row, "");
			$values["sk_penghasilan"] = $pageObject->getViewControl("sk_penghasilan")->showDBValue($row, "");

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
			$outstr.='"'.str_replace('"', '""', $values["id_penghasilan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["nip"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["gaji_pokok"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tunjangan"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["insentif"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["bonus"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["thr"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["pajak"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["pinjaman"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["gaji_bersih"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["cara_bayar"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tanggal_bayar"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tanggal_transfer"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["nama_bank"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["nama_rekening"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["no_rekening"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["sk_penghasilan"]).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Id Penghasilan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Nip").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Gaji Pokok").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tunjangan").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Insentif").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Bonus").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Thr").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Pajak").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Pinjaman").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Gaji Bersih").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Cara Bayar").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tanggal Bayar").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tanggal Transfer").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Nama Bank").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Nama Rekening").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("No Rekening").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Sk Penghasilan").'</td>';	
	}
	else
	{
		echo "<td>"."Id Penghasilan"."</td>";
		echo "<td>"."Nip"."</td>";
		echo "<td>"."Gaji Pokok"."</td>";
		echo "<td>"."Tunjangan"."</td>";
		echo "<td>"."Insentif"."</td>";
		echo "<td>"."Bonus"."</td>";
		echo "<td>"."Thr"."</td>";
		echo "<td>"."Pajak"."</td>";
		echo "<td>"."Pinjaman"."</td>";
		echo "<td>"."Gaji Bersih"."</td>";
		echo "<td>"."Cara Bayar"."</td>";
		echo "<td>"."Tanggal Bayar"."</td>";
		echo "<td>"."Tanggal Transfer"."</td>";
		echo "<td>"."Nama Bank"."</td>";
		echo "<td>"."Nama Rekening"."</td>";
		echo "<td>"."No Rekening"."</td>";
		echo "<td>"."Sk Penghasilan"."</td>";
	}
	echo "</tr>";
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["id_penghasilan"] = $pageObject->getViewControl("id_penghasilan")->showDBValue($row, "");
					$values["nip"] = $pageObject->getViewControl("nip")->showDBValue($row, "");
					$values["gaji_pokok"] = $pageObject->getViewControl("gaji_pokok")->showDBValue($row, "");
					$values["tunjangan"] = $pageObject->getViewControl("tunjangan")->showDBValue($row, "");
					$values["insentif"] = $pageObject->getViewControl("insentif")->showDBValue($row, "");
					$values["bonus"] = $pageObject->getViewControl("bonus")->showDBValue($row, "");
					$values["thr"] = $pageObject->getViewControl("thr")->showDBValue($row, "");
					$values["pajak"] = $pageObject->getViewControl("pajak")->showDBValue($row, "");
					$values["pinjaman"] = $pageObject->getViewControl("pinjaman")->showDBValue($row, "");
					$values["gaji_bersih"] = $pageObject->getViewControl("gaji_bersih")->showDBValue($row, "");
					$values["cara_bayar"] = $pageObject->getViewControl("cara_bayar")->showDBValue($row, "");
					$values["tanggal_bayar"] = $pageObject->getViewControl("tanggal_bayar")->showDBValue($row, "");
					$values["tanggal_transfer"] = $pageObject->getViewControl("tanggal_transfer")->showDBValue($row, "");
					$values["nama_bank"] = $pageObject->getViewControl("nama_bank")->showDBValue($row, "");
					$values["nama_rekening"] = $pageObject->getViewControl("nama_rekening")->showDBValue($row, "");
					$values["no_rekening"] = $pageObject->getViewControl("no_rekening")->showDBValue($row, "");
					$values["sk_penghasilan"] = $pageObject->getViewControl("sk_penghasilan")->showDBValue($row, "");
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";
		
							echo '<td>';
			
									echo $values["id_penghasilan"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
				
								if($_REQUEST["type"]=="excel")
					echo PrepareForExcel($values["nip"]);
				else
					echo $values["nip"];//echo htmlspecialchars($values["nip"]); commented for bug #6823
					
			echo '</td>';
							echo '<td>';
			
									echo $values["gaji_pokok"];
			echo '</td>';
							echo '<td>';
			
									echo $values["tunjangan"];
			echo '</td>';
							echo '<td>';
			
									echo $values["insentif"];
			echo '</td>';
							echo '<td>';
			
									echo $values["bonus"];
			echo '</td>';
							echo '<td>';
			
									echo $values["thr"];
			echo '</td>';
							echo '<td>';
			
									echo $values["pajak"];
			echo '</td>';
							echo '<td>';
			
									echo $values["pinjaman"];
			echo '</td>';
							echo '<td>';
			
									echo $values["gaji_bersih"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["cara_bayar"]);
					else
						echo $values["cara_bayar"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tanggal_bayar"]);
					else
						echo $values["tanggal_bayar"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tanggal_transfer"]);
					else
						echo $values["tanggal_transfer"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["nama_bank"]);
					else
						echo $values["nama_bank"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["nama_rekening"]);
					else
						echo $values["nama_rekening"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["no_rekening"]);
					else
						echo $values["no_rekening"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["sk_penghasilan"]);
					else
						echo $values["sk_penghasilan"];
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
