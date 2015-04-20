<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/penghasilan_variables.php");

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
$layout->blocks["bare"][] = "detailspreviewgrid";$page_layouts["penghasilan_detailspreview"] = $layout;


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
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_penghasilan"]));

	
	//	id_penghasilan - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("id_penghasilan", $data, $keylink);
			$row["id_penghasilan_value"] = $value;
	//	nip - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("nip", $data, $keylink);
			$row["nip_value"] = $value;
	//	gaji_pokok - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("gaji_pokok", $data, $keylink);
			$row["gaji_pokok_value"] = $value;
	//	tunjangan - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("tunjangan", $data, $keylink);
			$row["tunjangan_value"] = $value;
	//	insentif - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("insentif", $data, $keylink);
			$row["insentif_value"] = $value;
	//	bonus - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("bonus", $data, $keylink);
			$row["bonus_value"] = $value;
	//	thr - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("thr", $data, $keylink);
			$row["thr_value"] = $value;
	//	pajak - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("pajak", $data, $keylink);
			$row["pajak_value"] = $value;
	//	pinjaman - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("pinjaman", $data, $keylink);
			$row["pinjaman_value"] = $value;
	//	gaji_bersih - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("gaji_bersih", $data, $keylink);
			$row["gaji_bersih_value"] = $value;
	//	cara_bayar - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("cara_bayar", $data, $keylink);
			$row["cara_bayar_value"] = $value;
	//	tanggal_bayar - Short Date
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("tanggal_bayar", $data, $keylink);
			$row["tanggal_bayar_value"] = $value;
	//	tanggal_transfer - Short Date
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("tanggal_transfer", $data, $keylink);
			$row["tanggal_transfer_value"] = $value;
	//	nama_bank - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("nama_bank", $data, $keylink);
			$row["nama_bank_value"] = $value;
	//	nama_rekening - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("nama_rekening", $data, $keylink);
			$row["nama_rekening_value"] = $value;
	//	no_rekening - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("no_rekening", $data, $keylink);
			$row["no_rekening_value"] = $value;
	//	sk_penghasilan - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("sk_penghasilan", $data, $keylink);
			$row["sk_penghasilan_value"] = $value;
		$rowinfo[] = $row;
		$data = $cipherer->DecryptFetchedArray($rs);
	}
	$xt->assign_loopsection("details_row",$rowinfo);
}
$returnJSON = array("success" => true);
$xt->load_template("penghasilan_detailspreview.htm");
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