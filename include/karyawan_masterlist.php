<?php
include_once(getabspath("include/karyawan_settings.php"));

function DisplayMasterTableInfo_karyawan($params)
{
	$detailtable = $params["detailtable"];
	$keys = $params["keys"];
	$detailPageObj = $params["detailPageObj"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	$oldTableName = $strTableName;
	$strTableName = "karyawan";
	
	$settings = new ProjectSettings($strTableName, PAGE_LIST);
	$cipherer = new RunnerCipherer($strTableName);
	
	$masterQuery = $settings->getSQLQuery();
	
	$viewControls = new ViewControlsContainer($settings, PAGE_LIST);

$where = "";
$mKeys = array();
$showKeys = "";

global $page_styles, $page_layouts, $page_layout_names, $container_styles;

$layout = new TLayout("masterlist","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"masterlistheader","block"=>"","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["mastergrid"] = array();

$layout->containers["mastergrid"][] = array("name"=>"masterlistfields","block"=>"","substyle"=>1);


$layout->skins["mastergrid"] = "grid";
$layout->blocks["bare"][] = "mastergrid";$page_layouts["karyawan_masterlist"] = $layout;


if($detailtable == "absensi")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "pelatihan")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "penghasilan")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "penilaian")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
	if(!$where)
	{
		$strTableName = $oldTableName;
		return;
	}
	$str = SecuritySQL("Search");
	if(strlen($str))
		$where.= " and ".$str;

	$strWhere = whereAdd($masterQuery->WhereToSql(),$where);
	if(strlen($strWhere))
		$strWhere = " where ".$strWhere." ";
	$strSQL = $masterQuery->HeadToSql().' '.$masterQuery->FromToSql().$strWhere.$masterQuery->TailToSql();

//	$strSQL = AddWhere($strSQL,$where);
	LogInfo($strSQL);
	$rs = db_query($strSQL,$conn);
	$data = $cipherer->DecryptFetchedArray($rs);
	if(!$data)
	{
		$strTableName = $oldTableName;
		return;
	}
	$keylink = "";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["nip"]));
	

//	nip - 
			$value="";

					$xt->assign("nip_mastervalue", $viewControls->showDBValue("nip", $data, $keylink));

//	nama - 
			$value="";

					$xt->assign("nama_mastervalue", $viewControls->showDBValue("nama", $data, $keylink));

//	jenis_kelamin - 
			$value="";

					$xt->assign("jenis_kelamin_mastervalue", $viewControls->showDBValue("jenis_kelamin", $data, $keylink));

//	tempat_lahir - 
			$value="";

					$xt->assign("tempat_lahir_mastervalue", $viewControls->showDBValue("tempat_lahir", $data, $keylink));

//	tanggal_lahir - Short Date
			$value="";

					$xt->assign("tanggal_lahir_mastervalue", $viewControls->showDBValue("tanggal_lahir", $data, $keylink));

//	golongan_darah - 
			$value="";

					$xt->assign("golongan_darah_mastervalue", $viewControls->showDBValue("golongan_darah", $data, $keylink));

//	agama - 
			$value="";

					$xt->assign("agama_mastervalue", $viewControls->showDBValue("agama", $data, $keylink));

//	status_pernikahan - 
			$value="";

					$xt->assign("status_pernikahan_mastervalue", $viewControls->showDBValue("status_pernikahan", $data, $keylink));

//	alamat_lengkap - 
			$value="";

					$xt->assign("alamat_lengkap_mastervalue", $viewControls->showDBValue("alamat_lengkap", $data, $keylink));

//	telepon_rumah - 
			$value="";

					$xt->assign("telepon_rumah_mastervalue", $viewControls->showDBValue("telepon_rumah", $data, $keylink));

//	ponsel - 
			$value="";

					$xt->assign("ponsel_mastervalue", $viewControls->showDBValue("ponsel", $data, $keylink));

//	email - 
			$value="";

					$xt->assign("email_mastervalue", $viewControls->showDBValue("email", $data, $keylink));

//	hobi - 
			$value="";

					$xt->assign("hobi_mastervalue", $viewControls->showDBValue("hobi", $data, $keylink));

//	pendidikan - 
			$value="";

					$xt->assign("pendidikan_mastervalue", $viewControls->showDBValue("pendidikan", $data, $keylink));

//	tanggal_masuk - Short Date
			$value="";

					$xt->assign("tanggal_masuk_mastervalue", $viewControls->showDBValue("tanggal_masuk", $data, $keylink));

//	status_kerja - 
			$value="";

					$xt->assign("status_kerja_mastervalue", $viewControls->showDBValue("status_kerja", $data, $keylink));

//	departemen - 
			$value="";

					$xt->assign("departemen_mastervalue", $viewControls->showDBValue("departemen", $data, $keylink));

//	organisasi - 
			$value="";

					$xt->assign("organisasi_mastervalue", $viewControls->showDBValue("organisasi", $data, $keylink));

//	golongan - 
			$value="";

					$xt->assign("golongan_mastervalue", $viewControls->showDBValue("golongan", $data, $keylink));

//	jabatan - 
			$value="";

					$xt->assign("jabatan_mastervalue", $viewControls->showDBValue("jabatan", $data, $keylink));

//	no_ktp - 
			$value="";

					$xt->assign("no_ktp_mastervalue", $viewControls->showDBValue("no_ktp", $data, $keylink));

//	no_sim - 
			$value="";

					$xt->assign("no_sim_mastervalue", $viewControls->showDBValue("no_sim", $data, $keylink));

//	no_paspor - 
			$value="";

					$xt->assign("no_paspor_mastervalue", $viewControls->showDBValue("no_paspor", $data, $keylink));

//	no_npwp - 
			$value="";

					$xt->assign("no_npwp_mastervalue", $viewControls->showDBValue("no_npwp", $data, $keylink));

//	no_jamsostek - 
			$value="";

					$xt->assign("no_jamsostek_mastervalue", $viewControls->showDBValue("no_jamsostek", $data, $keylink));

//	no_asuransi - 
			$value="";

					$xt->assign("no_asuransi_mastervalue", $viewControls->showDBValue("no_asuransi", $data, $keylink));

//	no_pensiun - 
			$value="";

					$xt->assign("no_pensiun_mastervalue", $viewControls->showDBValue("no_pensiun", $data, $keylink));

//	pensiun - Checkbox
			$value="";

					$xt->assign("pensiun_mastervalue", $viewControls->showDBValue("pensiun", $data, $keylink));

//	tanggal_pensiun - Short Date
			$value="";

					$xt->assign("tanggal_pensiun_mastervalue", $viewControls->showDBValue("tanggal_pensiun", $data, $keylink));

//	foto - 
			$value="";

					$xt->assign("foto_mastervalue", $viewControls->showDBValue("foto", $data, $keylink));

//	sk_tambahan - 
			$value="";

					$xt->assign("sk_tambahan_mastervalue", $viewControls->showDBValue("sk_tambahan", $data, $keylink));

//	keterangan - 
			$value="";

					$xt->assign("keterangan_mastervalue", $viewControls->showDBValue("keterangan", $data, $keylink));

	$viewControls->addControlsJSAndCSS();
	$detailPageObj->viewControlsMap['mViewControlsMap'] = $viewControls->viewControlsMap;

	$layout = GetPageLayout("karyawan", 'masterlist');
	if($layout)
		$xt->assign("pageattrs", 'class="'.$layout->style." page-".$layout->name.'"');
	
	$xt->display("karyawan_masterlist.htm");
	
	$strTableName=$oldTableName;
}

?>