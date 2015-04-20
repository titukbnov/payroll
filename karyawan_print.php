<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

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

$layout = new TLayout("print","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["center"] = array();
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"printgrid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "empty";
$layout->blocks["center"][] = "grid";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";$page_layouts["karyawan_print"] = $layout;


include('include/xtempl.php');
include('classes/runnerpage.php');

$cipherer = new RunnerCipherer($strTableName);

$xt = new Xtempl();
$id = postvalue("id") != "" ? postvalue("id") : 1;
$all = postvalue("all");
$pageName = "print.php";

//array of params for classes
$params = array("id" => $id,
				"tName" => $strTableName,
				"pageType" => PAGE_PRINT);
$params["xt"] = &$xt;
			
$pageObject = new RunnerPage($params);

// add button events if exist
$pageObject->addButtonHandlers();

// Modify query: remove blob fields from fieldlist.
// Blob fields on a print page are shown using imager.php (for example).
// They don't need to be selected from DB in print.php itself.
$noBlobReplace = false;
if(!postvalue("pdf") && !$noBlobReplace)
	$gQuery->ReplaceFieldsWithDummies($pageObject->pSet->getBinaryFieldsIndices());

//	Before Process event
if($eventObj->exists("BeforeProcessPrint"))
	$eventObj->BeforeProcessPrint($conn, $pageObject);

$strWhereClause="";
$strHavingClause="";
$strSearchCriteria="and";

$selected_recs=array();
if (@$_REQUEST["a"]!="") 
{
	$sWhere = "1=0";	
	
//	process selection
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["nip"]=refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[]=$keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys=array();
			$keys["nip"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}
	$strSQL = $gQuery->gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strHavingClause=@$_SESSION[$strTableName."_having"];
	$strSearchCriteria=@$_SESSION[$strTableName."_criteria"];
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
}
if(postvalue("pdf"))
	$strWhereClause = @$_SESSION[$strTableName."_pdfwhere"];

$_SESSION[$strTableName."_pdfwhere"] = $strWhereClause;


$strOrderBy = $_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if($eventObj->exists("BeforeQueryPrint"))
	$eventObj->BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy, $pageObject);

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
			$masterKeysReq[]=$_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount=$eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs, $pageObject);
	}
	if($rowcount!==false)
		$numrows=$rowcount;
	else
	{
		$numrows = $gQuery->gSQLRowCount($strWhereClause, $strHavingClause, $strSearchCriteria);
	}
}

LogInfo($strSQL);

$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize = $pageObject->pSet->getInitialPageSize();

if($PageSize<0)
	$all = 1;	
	
$recno = 1;
$records = 0;	
$maxpages = 1;
$pageindex = 1;
$pageno=1;

// build arrays for sort (to support old code in user-defined events)
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
}

if(!$all)
{	
	if($numrows)
	{
		$maxRecords = $numrows;
		$maxpages = ceil($maxRecords/$PageSize);
					
		if($mypage > $maxpages)
			$mypage = $maxpages;
		
		if($mypage < 1) 
			$mypage = 1;
		
		$maxrecs = $PageSize;
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort, 
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $PageSize, $mypage, $pageObject);
	if($listarray!==false)
		$rs = $listarray;
	else
	{
			if($numrows)
		{
			$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
		}
		$rs = db_query($strSQL,$conn);
	}
	
	//	hide colunm headers if needed
	$recordsonpage = $numrows-($mypage-1)*$PageSize;
	if($recordsonpage>$PageSize)
		$recordsonpage = $PageSize;
		
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	$xt->assign("pageno",$mypage);
}
else
{
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray=$eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort,
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $PageSize, $mypage, $pageObject);
	if($listarray!==false)
		$rs = $listarray;
	else
		$rs = db_query($strSQL,$conn);
	$recordsonpage = $numrows;
	$maxpages = ceil($recordsonpage/30);
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
}


$fieldsArr = array();
$arr = array();
$arr['fName'] = "nip";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("nip");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "nama";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("nama");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "jenis_kelamin";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("jenis_kelamin");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tempat_lahir";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tempat_lahir");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tanggal_lahir";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tanggal_lahir");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "golongan_darah";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("golongan_darah");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "agama";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("agama");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "status_pernikahan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("status_pernikahan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "alamat_lengkap";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("alamat_lengkap");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "telepon_rumah";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("telepon_rumah");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "ponsel";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("ponsel");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "email";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("email");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "hobi";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("hobi");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "pendidikan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("pendidikan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tanggal_masuk";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tanggal_masuk");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "status_kerja";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("status_kerja");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "departemen";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("departemen");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "organisasi";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("organisasi");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "golongan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("golongan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "jabatan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("jabatan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_ktp";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_ktp");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_sim";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_sim");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_paspor";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_paspor");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_npwp";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_npwp");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_jamsostek";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_jamsostek");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_asuransi";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_asuransi");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_pensiun";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_pensiun");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "pensiun";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("pensiun");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tanggal_pensiun";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tanggal_pensiun");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "foto";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("foto");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "sk_tambahan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("sk_tambahan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "keterangan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("keterangan");
$fieldsArr[] = $arr;
$pageObject->setGoogleMapsParams($fieldsArr);

$colsonpage=1;
if($colsonpage>$recordsonpage)
	$colsonpage=$recordsonpage;
if($colsonpage<1)
	$colsonpage=1;


//	fill $rowinfo array
	$pages = array();
	$rowinfo = array();
	$rowinfo["data"] = array();
	if($eventObj->exists("ListFetchArray"))
		$data = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$data = $cipherer->DecryptFetchedArray($rs);

	while($data)
	{
		if($eventObj->exists("BeforeProcessRowPrint"))
		{
			if(!$eventObj->BeforeProcessRowPrint($data, $pageObject))
			{
				if($eventObj->exists("ListFetchArray"))
					$data = $eventObj->ListFetchArray($rs, $pageObject);
				else
					$data = $cipherer->DecryptFetchedArray($rs);
				continue;
			}
		}
		break;
	}
	
	while($data && ($all || $recno<=$PageSize))
	{
		$row = array();
		$row["grid_record"] = array();
		$row["grid_record"]["data"] = array();
		for($col=1;$data && ($all || $recno<=$PageSize) && $col<=1;$col++)
		{
			$record = array();
			$recno++;
			$records++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["nip"]));

//	nip - 
			$record["nip_value"] = $pageObject->showDBValue("nip", $data, $keylink);
			$record["nip_class"] = $pageObject->fieldClass("nip");
//	nama - 
			$record["nama_value"] = $pageObject->showDBValue("nama", $data, $keylink);
			$record["nama_class"] = $pageObject->fieldClass("nama");
//	jenis_kelamin - 
			$record["jenis_kelamin_value"] = $pageObject->showDBValue("jenis_kelamin", $data, $keylink);
			$record["jenis_kelamin_class"] = $pageObject->fieldClass("jenis_kelamin");
//	tempat_lahir - 
			$record["tempat_lahir_value"] = $pageObject->showDBValue("tempat_lahir", $data, $keylink);
			$record["tempat_lahir_class"] = $pageObject->fieldClass("tempat_lahir");
//	tanggal_lahir - Short Date
			$record["tanggal_lahir_value"] = $pageObject->showDBValue("tanggal_lahir", $data, $keylink);
			$record["tanggal_lahir_class"] = $pageObject->fieldClass("tanggal_lahir");
//	golongan_darah - 
			$record["golongan_darah_value"] = $pageObject->showDBValue("golongan_darah", $data, $keylink);
			$record["golongan_darah_class"] = $pageObject->fieldClass("golongan_darah");
//	agama - 
			$record["agama_value"] = $pageObject->showDBValue("agama", $data, $keylink);
			$record["agama_class"] = $pageObject->fieldClass("agama");
//	status_pernikahan - 
			$record["status_pernikahan_value"] = $pageObject->showDBValue("status_pernikahan", $data, $keylink);
			$record["status_pernikahan_class"] = $pageObject->fieldClass("status_pernikahan");
//	alamat_lengkap - 
			$record["alamat_lengkap_value"] = $pageObject->showDBValue("alamat_lengkap", $data, $keylink);
			$record["alamat_lengkap_class"] = $pageObject->fieldClass("alamat_lengkap");
//	telepon_rumah - 
			$record["telepon_rumah_value"] = $pageObject->showDBValue("telepon_rumah", $data, $keylink);
			$record["telepon_rumah_class"] = $pageObject->fieldClass("telepon_rumah");
//	ponsel - 
			$record["ponsel_value"] = $pageObject->showDBValue("ponsel", $data, $keylink);
			$record["ponsel_class"] = $pageObject->fieldClass("ponsel");
//	email - 
			$record["email_value"] = $pageObject->showDBValue("email", $data, $keylink);
			$record["email_class"] = $pageObject->fieldClass("email");
//	hobi - 
			$record["hobi_value"] = $pageObject->showDBValue("hobi", $data, $keylink);
			$record["hobi_class"] = $pageObject->fieldClass("hobi");
//	pendidikan - 
			$record["pendidikan_value"] = $pageObject->showDBValue("pendidikan", $data, $keylink);
			$record["pendidikan_class"] = $pageObject->fieldClass("pendidikan");
//	tanggal_masuk - Short Date
			$record["tanggal_masuk_value"] = $pageObject->showDBValue("tanggal_masuk", $data, $keylink);
			$record["tanggal_masuk_class"] = $pageObject->fieldClass("tanggal_masuk");
//	status_kerja - 
			$record["status_kerja_value"] = $pageObject->showDBValue("status_kerja", $data, $keylink);
			$record["status_kerja_class"] = $pageObject->fieldClass("status_kerja");
//	departemen - 
			$record["departemen_value"] = $pageObject->showDBValue("departemen", $data, $keylink);
			$record["departemen_class"] = $pageObject->fieldClass("departemen");
//	organisasi - 
			$record["organisasi_value"] = $pageObject->showDBValue("organisasi", $data, $keylink);
			$record["organisasi_class"] = $pageObject->fieldClass("organisasi");
//	golongan - 
			$record["golongan_value"] = $pageObject->showDBValue("golongan", $data, $keylink);
			$record["golongan_class"] = $pageObject->fieldClass("golongan");
//	jabatan - 
			$record["jabatan_value"] = $pageObject->showDBValue("jabatan", $data, $keylink);
			$record["jabatan_class"] = $pageObject->fieldClass("jabatan");
//	no_ktp - 
			$record["no_ktp_value"] = $pageObject->showDBValue("no_ktp", $data, $keylink);
			$record["no_ktp_class"] = $pageObject->fieldClass("no_ktp");
//	no_sim - 
			$record["no_sim_value"] = $pageObject->showDBValue("no_sim", $data, $keylink);
			$record["no_sim_class"] = $pageObject->fieldClass("no_sim");
//	no_paspor - 
			$record["no_paspor_value"] = $pageObject->showDBValue("no_paspor", $data, $keylink);
			$record["no_paspor_class"] = $pageObject->fieldClass("no_paspor");
//	no_npwp - 
			$record["no_npwp_value"] = $pageObject->showDBValue("no_npwp", $data, $keylink);
			$record["no_npwp_class"] = $pageObject->fieldClass("no_npwp");
//	no_jamsostek - 
			$record["no_jamsostek_value"] = $pageObject->showDBValue("no_jamsostek", $data, $keylink);
			$record["no_jamsostek_class"] = $pageObject->fieldClass("no_jamsostek");
//	no_asuransi - 
			$record["no_asuransi_value"] = $pageObject->showDBValue("no_asuransi", $data, $keylink);
			$record["no_asuransi_class"] = $pageObject->fieldClass("no_asuransi");
//	no_pensiun - 
			$record["no_pensiun_value"] = $pageObject->showDBValue("no_pensiun", $data, $keylink);
			$record["no_pensiun_class"] = $pageObject->fieldClass("no_pensiun");
//	pensiun - Checkbox
			$record["pensiun_value"] = $pageObject->showDBValue("pensiun", $data, $keylink);
			$record["pensiun_class"] = $pageObject->fieldClass("pensiun");
//	tanggal_pensiun - Short Date
			$record["tanggal_pensiun_value"] = $pageObject->showDBValue("tanggal_pensiun", $data, $keylink);
			$record["tanggal_pensiun_class"] = $pageObject->fieldClass("tanggal_pensiun");
//	foto - 
			$record["foto_value"] = $pageObject->showDBValue("foto", $data, $keylink);
			$record["foto_class"] = $pageObject->fieldClass("foto");
//	sk_tambahan - 
			$record["sk_tambahan_value"] = $pageObject->showDBValue("sk_tambahan", $data, $keylink);
			$record["sk_tambahan_class"] = $pageObject->fieldClass("sk_tambahan");
//	keterangan - 
			$record["keterangan_value"] = $pageObject->showDBValue("keterangan", $data, $keylink);
			$record["keterangan_class"] = $pageObject->fieldClass("keterangan");
			if($col<$colsonpage)
				$record["endrecord_block"] = true;
			$record["grid_recordheader"] = true;
			$record["grid_vrecord"] = true;
			
			if($eventObj->exists("BeforeMoveNextPrint"))
				$eventObj->BeforeMoveNextPrint($data,$row,$record, $pageObject);
				
			$row["grid_record"]["data"][] = $record;
			
			if($eventObj->exists("ListFetchArray"))
				$data = $eventObj->ListFetchArray($rs, $pageObject);
			else
				$data = $cipherer->DecryptFetchedArray($rs);
				
			while($data)
			{
				if($eventObj->exists("BeforeProcessRowPrint"))
				{
					if(!$eventObj->BeforeProcessRowPrint($data, $pageObject))
					{
						if($eventObj->exists("ListFetchArray"))
							$data = $eventObj->ListFetchArray($rs, $pageObject);
						else
							$data = $cipherer->DecryptFetchedArray($rs);
						continue;
					}
				}
				break;
			}
		}
		if($col <= $colsonpage)
		{
			$row["grid_record"]["data"][count($row["grid_record"]["data"])-1]["endrecord_block"] = false;
		}
		$row["grid_rowspace"]=true;
		$row["grid_recordspace"] = array("data"=>array());
		for($i=0;$i<$colsonpage*2-1;$i++)
			$row["grid_recordspace"]["data"][]=true;
		
		$rowinfo["data"][]=$row;
		
		if($all && $records>=30)
		{
			$page=array("grid_row" =>$rowinfo);
			$page["pageno"]=$pageindex;
			$pageindex++;
			$pages[] = $page;
			$records=0;
			$rowinfo=array();
		}
		
	}
	if(count($rowinfo))
	{
		$page=array("grid_row" =>$rowinfo);
		if($all)
			$page["pageno"]=$pageindex;
		$pages[] = $page;
	}
	
	for($i=0;$i<count($pages);$i++)
	{
	 	if($i<count($pages)-1)
			$pages[$i]["begin"]="<div name=page class=printpage>";
		else
		    $pages[$i]["begin"]="<div name=page>";
			
		$pages[$i]["end"]="</div>";
	}

	$page = array();
	$page["data"] = &$pages;
	$xt->assignbyref("page",$page);

	

$strSQL = $_SESSION[$strTableName."_sql"];

$isPdfView = false;
$hasEvents = false;
if ($pageObject->pSet->isUsebuttonHandlers() || $isPdfView || $hasEvents)
{
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
}


if ($pageObject->pSet->isUsebuttonHandlers() || $isPdfView || $hasEvents)
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";

$xt->assignbyref("body",$pageObject->body);
$xt->assign("grid_block",true);

$xt->assign("nip_fieldheadercolumn",true);
$xt->assign("nip_fieldheader",true);
$xt->assign("nip_fieldcolumn",true);
$xt->assign("nip_fieldfootercolumn",true);
$xt->assign("nama_fieldheadercolumn",true);
$xt->assign("nama_fieldheader",true);
$xt->assign("nama_fieldcolumn",true);
$xt->assign("nama_fieldfootercolumn",true);
$xt->assign("jenis_kelamin_fieldheadercolumn",true);
$xt->assign("jenis_kelamin_fieldheader",true);
$xt->assign("jenis_kelamin_fieldcolumn",true);
$xt->assign("jenis_kelamin_fieldfootercolumn",true);
$xt->assign("tempat_lahir_fieldheadercolumn",true);
$xt->assign("tempat_lahir_fieldheader",true);
$xt->assign("tempat_lahir_fieldcolumn",true);
$xt->assign("tempat_lahir_fieldfootercolumn",true);
$xt->assign("tanggal_lahir_fieldheadercolumn",true);
$xt->assign("tanggal_lahir_fieldheader",true);
$xt->assign("tanggal_lahir_fieldcolumn",true);
$xt->assign("tanggal_lahir_fieldfootercolumn",true);
$xt->assign("golongan_darah_fieldheadercolumn",true);
$xt->assign("golongan_darah_fieldheader",true);
$xt->assign("golongan_darah_fieldcolumn",true);
$xt->assign("golongan_darah_fieldfootercolumn",true);
$xt->assign("agama_fieldheadercolumn",true);
$xt->assign("agama_fieldheader",true);
$xt->assign("agama_fieldcolumn",true);
$xt->assign("agama_fieldfootercolumn",true);
$xt->assign("status_pernikahan_fieldheadercolumn",true);
$xt->assign("status_pernikahan_fieldheader",true);
$xt->assign("status_pernikahan_fieldcolumn",true);
$xt->assign("status_pernikahan_fieldfootercolumn",true);
$xt->assign("alamat_lengkap_fieldheadercolumn",true);
$xt->assign("alamat_lengkap_fieldheader",true);
$xt->assign("alamat_lengkap_fieldcolumn",true);
$xt->assign("alamat_lengkap_fieldfootercolumn",true);
$xt->assign("telepon_rumah_fieldheadercolumn",true);
$xt->assign("telepon_rumah_fieldheader",true);
$xt->assign("telepon_rumah_fieldcolumn",true);
$xt->assign("telepon_rumah_fieldfootercolumn",true);
$xt->assign("ponsel_fieldheadercolumn",true);
$xt->assign("ponsel_fieldheader",true);
$xt->assign("ponsel_fieldcolumn",true);
$xt->assign("ponsel_fieldfootercolumn",true);
$xt->assign("email_fieldheadercolumn",true);
$xt->assign("email_fieldheader",true);
$xt->assign("email_fieldcolumn",true);
$xt->assign("email_fieldfootercolumn",true);
$xt->assign("hobi_fieldheadercolumn",true);
$xt->assign("hobi_fieldheader",true);
$xt->assign("hobi_fieldcolumn",true);
$xt->assign("hobi_fieldfootercolumn",true);
$xt->assign("pendidikan_fieldheadercolumn",true);
$xt->assign("pendidikan_fieldheader",true);
$xt->assign("pendidikan_fieldcolumn",true);
$xt->assign("pendidikan_fieldfootercolumn",true);
$xt->assign("tanggal_masuk_fieldheadercolumn",true);
$xt->assign("tanggal_masuk_fieldheader",true);
$xt->assign("tanggal_masuk_fieldcolumn",true);
$xt->assign("tanggal_masuk_fieldfootercolumn",true);
$xt->assign("status_kerja_fieldheadercolumn",true);
$xt->assign("status_kerja_fieldheader",true);
$xt->assign("status_kerja_fieldcolumn",true);
$xt->assign("status_kerja_fieldfootercolumn",true);
$xt->assign("departemen_fieldheadercolumn",true);
$xt->assign("departemen_fieldheader",true);
$xt->assign("departemen_fieldcolumn",true);
$xt->assign("departemen_fieldfootercolumn",true);
$xt->assign("organisasi_fieldheadercolumn",true);
$xt->assign("organisasi_fieldheader",true);
$xt->assign("organisasi_fieldcolumn",true);
$xt->assign("organisasi_fieldfootercolumn",true);
$xt->assign("golongan_fieldheadercolumn",true);
$xt->assign("golongan_fieldheader",true);
$xt->assign("golongan_fieldcolumn",true);
$xt->assign("golongan_fieldfootercolumn",true);
$xt->assign("jabatan_fieldheadercolumn",true);
$xt->assign("jabatan_fieldheader",true);
$xt->assign("jabatan_fieldcolumn",true);
$xt->assign("jabatan_fieldfootercolumn",true);
$xt->assign("no_ktp_fieldheadercolumn",true);
$xt->assign("no_ktp_fieldheader",true);
$xt->assign("no_ktp_fieldcolumn",true);
$xt->assign("no_ktp_fieldfootercolumn",true);
$xt->assign("no_sim_fieldheadercolumn",true);
$xt->assign("no_sim_fieldheader",true);
$xt->assign("no_sim_fieldcolumn",true);
$xt->assign("no_sim_fieldfootercolumn",true);
$xt->assign("no_paspor_fieldheadercolumn",true);
$xt->assign("no_paspor_fieldheader",true);
$xt->assign("no_paspor_fieldcolumn",true);
$xt->assign("no_paspor_fieldfootercolumn",true);
$xt->assign("no_npwp_fieldheadercolumn",true);
$xt->assign("no_npwp_fieldheader",true);
$xt->assign("no_npwp_fieldcolumn",true);
$xt->assign("no_npwp_fieldfootercolumn",true);
$xt->assign("no_jamsostek_fieldheadercolumn",true);
$xt->assign("no_jamsostek_fieldheader",true);
$xt->assign("no_jamsostek_fieldcolumn",true);
$xt->assign("no_jamsostek_fieldfootercolumn",true);
$xt->assign("no_asuransi_fieldheadercolumn",true);
$xt->assign("no_asuransi_fieldheader",true);
$xt->assign("no_asuransi_fieldcolumn",true);
$xt->assign("no_asuransi_fieldfootercolumn",true);
$xt->assign("no_pensiun_fieldheadercolumn",true);
$xt->assign("no_pensiun_fieldheader",true);
$xt->assign("no_pensiun_fieldcolumn",true);
$xt->assign("no_pensiun_fieldfootercolumn",true);
$xt->assign("pensiun_fieldheadercolumn",true);
$xt->assign("pensiun_fieldheader",true);
$xt->assign("pensiun_fieldcolumn",true);
$xt->assign("pensiun_fieldfootercolumn",true);
$xt->assign("tanggal_pensiun_fieldheadercolumn",true);
$xt->assign("tanggal_pensiun_fieldheader",true);
$xt->assign("tanggal_pensiun_fieldcolumn",true);
$xt->assign("tanggal_pensiun_fieldfootercolumn",true);
$xt->assign("foto_fieldheadercolumn",true);
$xt->assign("foto_fieldheader",true);
$xt->assign("foto_fieldcolumn",true);
$xt->assign("foto_fieldfootercolumn",true);
$xt->assign("sk_tambahan_fieldheadercolumn",true);
$xt->assign("sk_tambahan_fieldheader",true);
$xt->assign("sk_tambahan_fieldcolumn",true);
$xt->assign("sk_tambahan_fieldfootercolumn",true);
$xt->assign("keterangan_fieldheadercolumn",true);
$xt->assign("keterangan_fieldheader",true);
$xt->assign("keterangan_fieldcolumn",true);
$xt->assign("keterangan_fieldfootercolumn",true);

	$record_header=array("data"=>array());
	$record_footer=array("data"=>array());
	for($i=0;$i<$colsonpage;$i++)
	{
		$rheader=array();
		$rfooter=array();
		if($i<$colsonpage-1)
		{
			$rheader["endrecordheader_block"]=true;
			$rfooter["endrecordheader_block"]=true;
		}
		$record_header["data"][]=$rheader;
		$record_footer["data"][]=$rfooter;
	}
	$xt->assignbyref("record_header",$record_header);
	$xt->assignbyref("record_footer",$record_footer);
	$xt->assign("grid_header",true);
	$xt->assign("grid_footer",true);

if($eventObj->exists("BeforeShowPrint"))
	$eventObj->BeforeShowPrint($xt,$pageObject->templatefile, $pageObject);

if(!postvalue("pdf"))
	$xt->display($pageObject->templatefile);
else
{
	$xt->load_template($pageObject->templatefile);
	$page = $xt->fetch_loaded();
	$pagewidth=postvalue("width")*1.05;
	$pageheight=postvalue("height")*1.05;
	$landscape=false;
		if($pagewidth>$pageheight)
		{
			$landscape=true;
			if($pagewidth/$pageheight<297/210)
				$pagewidth = 297/210*$pageheight;
		}
		else
		{
			if($pagewidth/$pageheight<210/297)
				$pagewidth = 210/297*$pageheight;
		}
}
?>
