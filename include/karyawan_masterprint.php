<?php
include_once(getabspath("include/karyawan_settings.php"));

function DisplayMasterTableInfo_karyawan($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="karyawan";

//$strSQL = "SELECT nip,   nama,   jenis_kelamin,   tempat_lahir,   tanggal_lahir,   golongan_darah,   agama,   status_pernikahan,   alamat_lengkap,   telepon_rumah,   ponsel,   email,   hobi,   pendidikan,   tanggal_masuk,   status_kerja,   departemen,   organisasi,   golongan,   jabatan,   no_ktp,   no_sim,   no_paspor,   no_npwp,   no_jamsostek,   no_asuransi,   no_pensiun,   pensiun,   tanggal_pensiun,   foto,   sk_tambahan,   keterangan,   id_login,   id_pelatihan,   id_penghasilan,   id_penilaian,   id_absensi  FROM karyawan ";

	$cipherer = new RunnerCipherer($strTableName);
	$settings = new ProjectSettings($strTableName, PAGE_PRINT);
	
	$masterQuery = $settings->getSQLQuery();
	$viewControls = new ViewControlsContainer($settings, PAGE_PRINT);

$where="";

global $pageObject, $page_styles, $page_layouts, $page_layout_names, $container_styles;
$layout = new TLayout("masterprint","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"masterprintheader","block"=>"","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["mastergrid"] = array();

$layout->containers["mastergrid"][] = array("name"=>"masterprintfields","block"=>"","substyle"=>1);


$layout->skins["mastergrid"] = "grid";
$layout->blocks["bare"][] = "mastergrid";$page_layouts["karyawan_masterprint"] = $layout;


$showKeys = "";
if($detailtable=="absensi")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="pelatihan")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="penghasilan")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="penilaian")
{
		$where.= GetFullFieldName("nip", "", false)."=".$cipherer->MakeDBValue("nip",$keys[1-1], "", "", true);
	$showKeys .= " "."Nip".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if(!$where)
{
	$strTableName=$oldTableName;
	return;
}
	$str = SecuritySQL("Export");
	if(strlen($str))
		$where.=" and ".$str;
	
	$strWhere = whereAdd($masterQuery->m_where->toSql($masterQuery),$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL = $masterQuery->HeadToSql().' '.$masterQuery->FromToSql().$strWhere.$masterQuery->TailToSql();

//	$strSQL=AddWhere($strSQL,$where);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data = $cipherer->DecryptFetchedArray($rs);
	if(!$data)
	{
		$strTableName=$oldTableName;
		return;
	}
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["nip"]));
	

//	nip - 
			$xt->assign("nip_mastervalue", $viewControls->showDBValue("nip", $data, $keylink));

//	nama - 
			$xt->assign("nama_mastervalue", $viewControls->showDBValue("nama", $data, $keylink));

//	jenis_kelamin - 
			$xt->assign("jenis_kelamin_mastervalue", $viewControls->showDBValue("jenis_kelamin", $data, $keylink));

//	tempat_lahir - 
			$xt->assign("tempat_lahir_mastervalue", $viewControls->showDBValue("tempat_lahir", $data, $keylink));

//	tanggal_lahir - Short Date
			$xt->assign("tanggal_lahir_mastervalue", $viewControls->showDBValue("tanggal_lahir", $data, $keylink));

//	golongan_darah - 
			$xt->assign("golongan_darah_mastervalue", $viewControls->showDBValue("golongan_darah", $data, $keylink));

//	agama - 
			$xt->assign("agama_mastervalue", $viewControls->showDBValue("agama", $data, $keylink));

//	status_pernikahan - 
			$xt->assign("status_pernikahan_mastervalue", $viewControls->showDBValue("status_pernikahan", $data, $keylink));

//	alamat_lengkap - 
			$xt->assign("alamat_lengkap_mastervalue", $viewControls->showDBValue("alamat_lengkap", $data, $keylink));

//	telepon_rumah - 
			$xt->assign("telepon_rumah_mastervalue", $viewControls->showDBValue("telepon_rumah", $data, $keylink));

//	ponsel - 
			$xt->assign("ponsel_mastervalue", $viewControls->showDBValue("ponsel", $data, $keylink));

//	email - 
			$xt->assign("email_mastervalue", $viewControls->showDBValue("email", $data, $keylink));

//	hobi - 
			$xt->assign("hobi_mastervalue", $viewControls->showDBValue("hobi", $data, $keylink));

//	pendidikan - 
			$xt->assign("pendidikan_mastervalue", $viewControls->showDBValue("pendidikan", $data, $keylink));

//	tanggal_masuk - Short Date
			$xt->assign("tanggal_masuk_mastervalue", $viewControls->showDBValue("tanggal_masuk", $data, $keylink));

//	status_kerja - 
			$xt->assign("status_kerja_mastervalue", $viewControls->showDBValue("status_kerja", $data, $keylink));

//	departemen - 
			$xt->assign("departemen_mastervalue", $viewControls->showDBValue("departemen", $data, $keylink));

//	organisasi - 
			$xt->assign("organisasi_mastervalue", $viewControls->showDBValue("organisasi", $data, $keylink));

//	golongan - 
			$xt->assign("golongan_mastervalue", $viewControls->showDBValue("golongan", $data, $keylink));

//	jabatan - 
			$xt->assign("jabatan_mastervalue", $viewControls->showDBValue("jabatan", $data, $keylink));

//	no_ktp - 
			$xt->assign("no_ktp_mastervalue", $viewControls->showDBValue("no_ktp", $data, $keylink));

//	no_sim - 
			$xt->assign("no_sim_mastervalue", $viewControls->showDBValue("no_sim", $data, $keylink));

//	no_paspor - 
			$xt->assign("no_paspor_mastervalue", $viewControls->showDBValue("no_paspor", $data, $keylink));

//	no_npwp - 
			$xt->assign("no_npwp_mastervalue", $viewControls->showDBValue("no_npwp", $data, $keylink));

//	no_jamsostek - 
			$xt->assign("no_jamsostek_mastervalue", $viewControls->showDBValue("no_jamsostek", $data, $keylink));

//	no_asuransi - 
			$xt->assign("no_asuransi_mastervalue", $viewControls->showDBValue("no_asuransi", $data, $keylink));

//	no_pensiun - 
			$xt->assign("no_pensiun_mastervalue", $viewControls->showDBValue("no_pensiun", $data, $keylink));

//	pensiun - Checkbox
			$xt->assign("pensiun_mastervalue", $viewControls->showDBValue("pensiun", $data, $keylink));

//	tanggal_pensiun - Short Date
			$xt->assign("tanggal_pensiun_mastervalue", $viewControls->showDBValue("tanggal_pensiun", $data, $keylink));

//	foto - 
			$xt->assign("foto_mastervalue", $viewControls->showDBValue("foto", $data, $keylink));

//	sk_tambahan - 
			$xt->assign("sk_tambahan_mastervalue", $viewControls->showDBValue("sk_tambahan", $data, $keylink));

//	keterangan - 
			$xt->assign("keterangan_mastervalue", $viewControls->showDBValue("keterangan", $data, $keylink));
	$xt->display("karyawan_masterprint.htm");
	$strTableName=$oldTableName;

}

?>