<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/penilaian_variables.php");

$mode = postvalue("mode");

if(!isLogged())
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

$cipherer = new RunnerCipherer($strTableName);


include('include/xtempl.php');
$xt = new Xtempl();

$layout = new TLayout("detailspreview","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["bare"] = array();
$layout->containers["dcount"] = array();

$layout->containers["dcount"][] = array("name"=>"detailspreviewheader","block"=>"","substyle"=>1);


$layout->containers["dcount"][] = array("name"=>"detailspreviewdetailsfount","block"=>"","substyle"=>1);


$layout->containers["dcount"][] = array("name"=>"detailspreviewdispfirst","block"=>"display_first","substyle"=>1);


$layout->skins["dcount"] = "empty";
$layout->blocks["bare"][] = "dcount";
$layout->containers["detailspreviewgrid"] = array();

$layout->containers["detailspreviewgrid"][] = array("name"=>"detailspreviewfields","block"=>"details_data","substyle"=>1);


$layout->skins["detailspreviewgrid"] = "grid";
$layout->blocks["bare"][] = "detailspreviewgrid";$page_layouts["penilaian_detailspreview"] = $layout;


$recordsCounter = 0;

//	process masterkey value
$mastertable = postvalue("mastertable");
$masterKeys = my_json_decode(postvalue("masterKeys"));
if($mastertable != "")
{
	$_SESSION[$strTableName."_mastertable"]=$mastertable;
//	copy keys to session
	$i = 1;
	if(is_array($masterKeys) && count($masterKeys) > 0)
	{
		while(array_key_exists ("masterkey".$i, $masterKeys))
		{
			$_SESSION[$strTableName."_masterkey".$i] = $masterKeys["masterkey".$i];
			$i++;
		}
	}
	if(isset($_SESSION[$strTableName."_masterkey".$i]))
		unset($_SESSION[$strTableName."_masterkey".$i]);
}
else
	$mastertable = $_SESSION[$strTableName."_mastertable"];

//$strSQL = $gstrSQL;

if($mastertable == "karyawan")
{
	$where = "";
		$where .= GetFullFieldName("nip", $strTableName, false)."=".make_db_value("nip",$_SESSION[$strTableName."_masterkey1"]);
}

$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = $gQuery->gSQLWhere($where);

$strSQL.=" ".$gstrOrderBy;

$rowcount = $gQuery->gSQLRowCount($where);

$xt->assign("row_count",$rowcount);
if($rowcount) {
	$xt->assign("details_data",true);
	$rs = db_query($strSQL,$conn);

	$display_count = 10;
	if($mode == "inline")
		$display_count*=2;
	if($rowcount>$display_count+2)
	{
		$xt->assign("display_first",true);
		$xt->assign("display_count",$display_count);
	}
	else
		$display_count = $rowcount;

	$rowinfo = array();
	
	$data = $cipherer->DecryptFetchedArray($rs);
	require_once getabspath('classes/controls/ViewControlsContainer.php');
	$pSet = new ProjectSettings($strTableName, PAGE_LIST);
	$viewContainer = new ViewControlsContainer($pSet, PAGE_LIST);
	while($data && $recordsCounter<$display_count) {
		$recordsCounter++;
		$row = array();
		$keylink = "";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_penilaian"]));

	
	//	id_penilaian - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("id_penilaian", $data, $keylink);
			$row["id_penilaian_value"] = $value;
	//	nip - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("nip", $data, $keylink);
			$row["nip_value"] = $value;
	//	sk_penilaian - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("sk_penilaian", $data, $keylink);
			$row["sk_penilaian_value"] = $value;
	//	periode_penilaian - Short Date
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("periode_penilaian", $data, $keylink);
			$row["periode_penilaian_value"] = $value;
	//	judul_penilaian - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("judul_penilaian", $data, $keylink);
			$row["judul_penilaian_value"] = $value;
	//	indikator_a - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("indikator_a", $data, $keylink);
			$row["indikator_a_value"] = $value;
	//	indikator_b - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("indikator_b", $data, $keylink);
			$row["indikator_b_value"] = $value;
	//	indikator_c - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("indikator_c", $data, $keylink);
			$row["indikator_c_value"] = $value;
	//	indikator_d - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("indikator_d", $data, $keylink);
			$row["indikator_d_value"] = $value;
	//	indikator_e - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("indikator_e", $data, $keylink);
			$row["indikator_e_value"] = $value;
	//	satuan - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("satuan", $data, $keylink);
			$row["satuan_value"] = $value;
	//	sasaran - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("sasaran", $data, $keylink);
			$row["sasaran_value"] = $value;
	//	pencapaian - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("pencapaian", $data, $keylink);
			$row["pencapaian_value"] = $value;
	//	hasil_penilaian - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("hasil_penilaian", $data, $keylink);
			$row["hasil_penilaian_value"] = $value;
		$rowinfo[] = $row;
		$data = $cipherer->DecryptFetchedArray($rs);
	}
	$xt->assign_loopsection("details_row",$rowinfo);
}
$returnJSON = array("success" => true);
$xt->load_template("penilaian_detailspreview.htm");
$returnJSON["body"] = $xt->fetch_loaded();

if($mode!="inline"){
	$returnJSON["counter"] = postvalue("counter");
	$layout = GetPageLayout(GoodFieldName($strTableName), 'detailspreview');
	if($layout)
	{
		$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
		$returnJSON["style"] = "styles/".$layout->style."/style".$rtl.".css";
		$returnJSON["pageStyle"] = "pagestyles/".$layout->name.$rtl.".css";
		$returnJSON["layout"] = $layout->style." page-".$layout->name.".css";
	}	
}	

echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
?>