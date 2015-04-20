<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/karyawan_variables.php");
include('include/xtempl.php');
include('classes/viewpage.php');
include("classes/searchclause.php");

add_nocache_headers();

//	check if logged in
if(!isLogged() || CheckPermissionsEvent($strTableName, 'S') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$layout = new TLayout("view2","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["top"] = array();
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";
$layout->containers["view"] = array();

$layout->containers["view"][] = array("name"=>"viewheader","block"=>"","substyle"=>2);


$layout->containers["view"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"viewfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"viewbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["view"] = "1";
$layout->blocks["top"][] = "view";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["karyawan_view"] = $layout;




//$cipherer = new RunnerCipherer($strTableName);
	
$xt = new Xtempl();

$query = $gQuery->Copy();

$filename = "";	
$message = "";
$key = array();
$next = array();
$prev = array();
$all = postvalue("all");
$pdf = postvalue("pdf");
$mypage = 1;

//Show view page as popUp or not
$inlineview = (postvalue("onFly") ? true : false);

//If show view as popUp, get parent Id
if($inlineview)
	$parId = postvalue("parId");
else
	$parId = 0;

//Set page id	
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;

//$isNeedSettings = true;//($inlineview && postvalue("isNeedSettings") == 'true') || (!$inlineview);	
	
// assign an id
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_VIEW, "id" => $id, "tName" => $strTableName);
$params["xt"] = &$xt;
$params["all"] = $all;

//Get array of tabs for edit page
$params['useTabsOnView'] = $gSettings->useTabsOnView();
if($params['useTabsOnView'])
	$params['arrViewTabs'] = $gSettings->getViewTabs();
$pageObject = new ViewPage($params);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

// proccess big google maps

// add button events if exist
$pageObject->addButtonHandlers();

//For show detail tables on master page view
$dpParams = array();
if($pageObject->isShowDetailTables && !isMobile())
{
	$ids = $id;
	$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array();
}

//	Before Process event
if($eventObj->exists("BeforeProcessView"))
	$eventObj->BeforeProcessView($conn, $pageObject);
	
//	read current values from the database
$data = $pageObject->getCurrentRecordInternal();

if (!sizeof($data)) {
	header("Location: karyawan_list.php?a=return");
	exit();
}

$out = "";
$first = true;
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
$arr = array();
$arr['fName'] = "id_login";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_login");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "id_pelatihan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_pelatihan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "id_penghasilan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_penghasilan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "id_penilaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_penilaian");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "id_absensi";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_absensi");
$fieldsArr[] = $arr;

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("nip", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["nip"]));

////////////////////////////////////////////
//nip - 
	
	$value = $pageObject->showDBValue("nip", $data, $keylink);
	if($mainTableOwnerID=="nip")
		$ownerIdValue=$value;
	$xt->assign("nip_value",$value);
	if(!$pageObject->isAppearOnTabs("nip"))
		$xt->assign("nip_fieldblock",true);
	else
		$xt->assign("nip_tabfieldblock",true);
////////////////////////////////////////////
//nama - 
	
	$value = $pageObject->showDBValue("nama", $data, $keylink);
	if($mainTableOwnerID=="nama")
		$ownerIdValue=$value;
	$xt->assign("nama_value",$value);
	if(!$pageObject->isAppearOnTabs("nama"))
		$xt->assign("nama_fieldblock",true);
	else
		$xt->assign("nama_tabfieldblock",true);
////////////////////////////////////////////
//jenis_kelamin - 
	
	$value = $pageObject->showDBValue("jenis_kelamin", $data, $keylink);
	if($mainTableOwnerID=="jenis_kelamin")
		$ownerIdValue=$value;
	$xt->assign("jenis_kelamin_value",$value);
	if(!$pageObject->isAppearOnTabs("jenis_kelamin"))
		$xt->assign("jenis_kelamin_fieldblock",true);
	else
		$xt->assign("jenis_kelamin_tabfieldblock",true);
////////////////////////////////////////////
//tempat_lahir - 
	
	$value = $pageObject->showDBValue("tempat_lahir", $data, $keylink);
	if($mainTableOwnerID=="tempat_lahir")
		$ownerIdValue=$value;
	$xt->assign("tempat_lahir_value",$value);
	if(!$pageObject->isAppearOnTabs("tempat_lahir"))
		$xt->assign("tempat_lahir_fieldblock",true);
	else
		$xt->assign("tempat_lahir_tabfieldblock",true);
////////////////////////////////////////////
//tanggal_lahir - Short Date
	
	$value = $pageObject->showDBValue("tanggal_lahir", $data, $keylink);
	if($mainTableOwnerID=="tanggal_lahir")
		$ownerIdValue=$value;
	$xt->assign("tanggal_lahir_value",$value);
	if(!$pageObject->isAppearOnTabs("tanggal_lahir"))
		$xt->assign("tanggal_lahir_fieldblock",true);
	else
		$xt->assign("tanggal_lahir_tabfieldblock",true);
////////////////////////////////////////////
//golongan_darah - 
	
	$value = $pageObject->showDBValue("golongan_darah", $data, $keylink);
	if($mainTableOwnerID=="golongan_darah")
		$ownerIdValue=$value;
	$xt->assign("golongan_darah_value",$value);
	if(!$pageObject->isAppearOnTabs("golongan_darah"))
		$xt->assign("golongan_darah_fieldblock",true);
	else
		$xt->assign("golongan_darah_tabfieldblock",true);
////////////////////////////////////////////
//agama - 
	
	$value = $pageObject->showDBValue("agama", $data, $keylink);
	if($mainTableOwnerID=="agama")
		$ownerIdValue=$value;
	$xt->assign("agama_value",$value);
	if(!$pageObject->isAppearOnTabs("agama"))
		$xt->assign("agama_fieldblock",true);
	else
		$xt->assign("agama_tabfieldblock",true);
////////////////////////////////////////////
//status_pernikahan - 
	
	$value = $pageObject->showDBValue("status_pernikahan", $data, $keylink);
	if($mainTableOwnerID=="status_pernikahan")
		$ownerIdValue=$value;
	$xt->assign("status_pernikahan_value",$value);
	if(!$pageObject->isAppearOnTabs("status_pernikahan"))
		$xt->assign("status_pernikahan_fieldblock",true);
	else
		$xt->assign("status_pernikahan_tabfieldblock",true);
////////////////////////////////////////////
//alamat_lengkap - 
	
	$value = $pageObject->showDBValue("alamat_lengkap", $data, $keylink);
	if($mainTableOwnerID=="alamat_lengkap")
		$ownerIdValue=$value;
	$xt->assign("alamat_lengkap_value",$value);
	if(!$pageObject->isAppearOnTabs("alamat_lengkap"))
		$xt->assign("alamat_lengkap_fieldblock",true);
	else
		$xt->assign("alamat_lengkap_tabfieldblock",true);
////////////////////////////////////////////
//telepon_rumah - 
	
	$value = $pageObject->showDBValue("telepon_rumah", $data, $keylink);
	if($mainTableOwnerID=="telepon_rumah")
		$ownerIdValue=$value;
	$xt->assign("telepon_rumah_value",$value);
	if(!$pageObject->isAppearOnTabs("telepon_rumah"))
		$xt->assign("telepon_rumah_fieldblock",true);
	else
		$xt->assign("telepon_rumah_tabfieldblock",true);
////////////////////////////////////////////
//ponsel - 
	
	$value = $pageObject->showDBValue("ponsel", $data, $keylink);
	if($mainTableOwnerID=="ponsel")
		$ownerIdValue=$value;
	$xt->assign("ponsel_value",$value);
	if(!$pageObject->isAppearOnTabs("ponsel"))
		$xt->assign("ponsel_fieldblock",true);
	else
		$xt->assign("ponsel_tabfieldblock",true);
////////////////////////////////////////////
//email - 
	
	$value = $pageObject->showDBValue("email", $data, $keylink);
	if($mainTableOwnerID=="email")
		$ownerIdValue=$value;
	$xt->assign("email_value",$value);
	if(!$pageObject->isAppearOnTabs("email"))
		$xt->assign("email_fieldblock",true);
	else
		$xt->assign("email_tabfieldblock",true);
////////////////////////////////////////////
//hobi - 
	
	$value = $pageObject->showDBValue("hobi", $data, $keylink);
	if($mainTableOwnerID=="hobi")
		$ownerIdValue=$value;
	$xt->assign("hobi_value",$value);
	if(!$pageObject->isAppearOnTabs("hobi"))
		$xt->assign("hobi_fieldblock",true);
	else
		$xt->assign("hobi_tabfieldblock",true);
////////////////////////////////////////////
//pendidikan - 
	
	$value = $pageObject->showDBValue("pendidikan", $data, $keylink);
	if($mainTableOwnerID=="pendidikan")
		$ownerIdValue=$value;
	$xt->assign("pendidikan_value",$value);
	if(!$pageObject->isAppearOnTabs("pendidikan"))
		$xt->assign("pendidikan_fieldblock",true);
	else
		$xt->assign("pendidikan_tabfieldblock",true);
////////////////////////////////////////////
//tanggal_masuk - Short Date
	
	$value = $pageObject->showDBValue("tanggal_masuk", $data, $keylink);
	if($mainTableOwnerID=="tanggal_masuk")
		$ownerIdValue=$value;
	$xt->assign("tanggal_masuk_value",$value);
	if(!$pageObject->isAppearOnTabs("tanggal_masuk"))
		$xt->assign("tanggal_masuk_fieldblock",true);
	else
		$xt->assign("tanggal_masuk_tabfieldblock",true);
////////////////////////////////////////////
//status_kerja - 
	
	$value = $pageObject->showDBValue("status_kerja", $data, $keylink);
	if($mainTableOwnerID=="status_kerja")
		$ownerIdValue=$value;
	$xt->assign("status_kerja_value",$value);
	if(!$pageObject->isAppearOnTabs("status_kerja"))
		$xt->assign("status_kerja_fieldblock",true);
	else
		$xt->assign("status_kerja_tabfieldblock",true);
////////////////////////////////////////////
//departemen - 
	
	$value = $pageObject->showDBValue("departemen", $data, $keylink);
	if($mainTableOwnerID=="departemen")
		$ownerIdValue=$value;
	$xt->assign("departemen_value",$value);
	if(!$pageObject->isAppearOnTabs("departemen"))
		$xt->assign("departemen_fieldblock",true);
	else
		$xt->assign("departemen_tabfieldblock",true);
////////////////////////////////////////////
//organisasi - 
	
	$value = $pageObject->showDBValue("organisasi", $data, $keylink);
	if($mainTableOwnerID=="organisasi")
		$ownerIdValue=$value;
	$xt->assign("organisasi_value",$value);
	if(!$pageObject->isAppearOnTabs("organisasi"))
		$xt->assign("organisasi_fieldblock",true);
	else
		$xt->assign("organisasi_tabfieldblock",true);
////////////////////////////////////////////
//golongan - 
	
	$value = $pageObject->showDBValue("golongan", $data, $keylink);
	if($mainTableOwnerID=="golongan")
		$ownerIdValue=$value;
	$xt->assign("golongan_value",$value);
	if(!$pageObject->isAppearOnTabs("golongan"))
		$xt->assign("golongan_fieldblock",true);
	else
		$xt->assign("golongan_tabfieldblock",true);
////////////////////////////////////////////
//jabatan - 
	
	$value = $pageObject->showDBValue("jabatan", $data, $keylink);
	if($mainTableOwnerID=="jabatan")
		$ownerIdValue=$value;
	$xt->assign("jabatan_value",$value);
	if(!$pageObject->isAppearOnTabs("jabatan"))
		$xt->assign("jabatan_fieldblock",true);
	else
		$xt->assign("jabatan_tabfieldblock",true);
////////////////////////////////////////////
//no_ktp - 
	
	$value = $pageObject->showDBValue("no_ktp", $data, $keylink);
	if($mainTableOwnerID=="no_ktp")
		$ownerIdValue=$value;
	$xt->assign("no_ktp_value",$value);
	if(!$pageObject->isAppearOnTabs("no_ktp"))
		$xt->assign("no_ktp_fieldblock",true);
	else
		$xt->assign("no_ktp_tabfieldblock",true);
////////////////////////////////////////////
//no_sim - 
	
	$value = $pageObject->showDBValue("no_sim", $data, $keylink);
	if($mainTableOwnerID=="no_sim")
		$ownerIdValue=$value;
	$xt->assign("no_sim_value",$value);
	if(!$pageObject->isAppearOnTabs("no_sim"))
		$xt->assign("no_sim_fieldblock",true);
	else
		$xt->assign("no_sim_tabfieldblock",true);
////////////////////////////////////////////
//no_paspor - 
	
	$value = $pageObject->showDBValue("no_paspor", $data, $keylink);
	if($mainTableOwnerID=="no_paspor")
		$ownerIdValue=$value;
	$xt->assign("no_paspor_value",$value);
	if(!$pageObject->isAppearOnTabs("no_paspor"))
		$xt->assign("no_paspor_fieldblock",true);
	else
		$xt->assign("no_paspor_tabfieldblock",true);
////////////////////////////////////////////
//no_npwp - 
	
	$value = $pageObject->showDBValue("no_npwp", $data, $keylink);
	if($mainTableOwnerID=="no_npwp")
		$ownerIdValue=$value;
	$xt->assign("no_npwp_value",$value);
	if(!$pageObject->isAppearOnTabs("no_npwp"))
		$xt->assign("no_npwp_fieldblock",true);
	else
		$xt->assign("no_npwp_tabfieldblock",true);
////////////////////////////////////////////
//no_jamsostek - 
	
	$value = $pageObject->showDBValue("no_jamsostek", $data, $keylink);
	if($mainTableOwnerID=="no_jamsostek")
		$ownerIdValue=$value;
	$xt->assign("no_jamsostek_value",$value);
	if(!$pageObject->isAppearOnTabs("no_jamsostek"))
		$xt->assign("no_jamsostek_fieldblock",true);
	else
		$xt->assign("no_jamsostek_tabfieldblock",true);
////////////////////////////////////////////
//no_asuransi - 
	
	$value = $pageObject->showDBValue("no_asuransi", $data, $keylink);
	if($mainTableOwnerID=="no_asuransi")
		$ownerIdValue=$value;
	$xt->assign("no_asuransi_value",$value);
	if(!$pageObject->isAppearOnTabs("no_asuransi"))
		$xt->assign("no_asuransi_fieldblock",true);
	else
		$xt->assign("no_asuransi_tabfieldblock",true);
////////////////////////////////////////////
//no_pensiun - 
	
	$value = $pageObject->showDBValue("no_pensiun", $data, $keylink);
	if($mainTableOwnerID=="no_pensiun")
		$ownerIdValue=$value;
	$xt->assign("no_pensiun_value",$value);
	if(!$pageObject->isAppearOnTabs("no_pensiun"))
		$xt->assign("no_pensiun_fieldblock",true);
	else
		$xt->assign("no_pensiun_tabfieldblock",true);
////////////////////////////////////////////
//pensiun - Checkbox
	
	$value = $pageObject->showDBValue("pensiun", $data, $keylink);
	if($mainTableOwnerID=="pensiun")
		$ownerIdValue=$value;
	$xt->assign("pensiun_value",$value);
	if(!$pageObject->isAppearOnTabs("pensiun"))
		$xt->assign("pensiun_fieldblock",true);
	else
		$xt->assign("pensiun_tabfieldblock",true);
////////////////////////////////////////////
//tanggal_pensiun - Short Date
	
	$value = $pageObject->showDBValue("tanggal_pensiun", $data, $keylink);
	if($mainTableOwnerID=="tanggal_pensiun")
		$ownerIdValue=$value;
	$xt->assign("tanggal_pensiun_value",$value);
	if(!$pageObject->isAppearOnTabs("tanggal_pensiun"))
		$xt->assign("tanggal_pensiun_fieldblock",true);
	else
		$xt->assign("tanggal_pensiun_tabfieldblock",true);
////////////////////////////////////////////
//foto - 
	
	$value = $pageObject->showDBValue("foto", $data, $keylink);
	if($mainTableOwnerID=="foto")
		$ownerIdValue=$value;
	$xt->assign("foto_value",$value);
	if(!$pageObject->isAppearOnTabs("foto"))
		$xt->assign("foto_fieldblock",true);
	else
		$xt->assign("foto_tabfieldblock",true);
////////////////////////////////////////////
//sk_tambahan - 
	
	$value = $pageObject->showDBValue("sk_tambahan", $data, $keylink);
	if($mainTableOwnerID=="sk_tambahan")
		$ownerIdValue=$value;
	$xt->assign("sk_tambahan_value",$value);
	if(!$pageObject->isAppearOnTabs("sk_tambahan"))
		$xt->assign("sk_tambahan_fieldblock",true);
	else
		$xt->assign("sk_tambahan_tabfieldblock",true);
////////////////////////////////////////////
//keterangan - 
	
	$value = $pageObject->showDBValue("keterangan", $data, $keylink);
	if($mainTableOwnerID=="keterangan")
		$ownerIdValue=$value;
	$xt->assign("keterangan_value",$value);
	if(!$pageObject->isAppearOnTabs("keterangan"))
		$xt->assign("keterangan_fieldblock",true);
	else
		$xt->assign("keterangan_tabfieldblock",true);
////////////////////////////////////////////
//id_login - 
	
	$value = $pageObject->showDBValue("id_login", $data, $keylink);
	if($mainTableOwnerID=="id_login")
		$ownerIdValue=$value;
	$xt->assign("id_login_value",$value);
	if(!$pageObject->isAppearOnTabs("id_login"))
		$xt->assign("id_login_fieldblock",true);
	else
		$xt->assign("id_login_tabfieldblock",true);
////////////////////////////////////////////
//id_pelatihan - 
	
	$value = $pageObject->showDBValue("id_pelatihan", $data, $keylink);
	if($mainTableOwnerID=="id_pelatihan")
		$ownerIdValue=$value;
	$xt->assign("id_pelatihan_value",$value);
	if(!$pageObject->isAppearOnTabs("id_pelatihan"))
		$xt->assign("id_pelatihan_fieldblock",true);
	else
		$xt->assign("id_pelatihan_tabfieldblock",true);
////////////////////////////////////////////
//id_penghasilan - 
	
	$value = $pageObject->showDBValue("id_penghasilan", $data, $keylink);
	if($mainTableOwnerID=="id_penghasilan")
		$ownerIdValue=$value;
	$xt->assign("id_penghasilan_value",$value);
	if(!$pageObject->isAppearOnTabs("id_penghasilan"))
		$xt->assign("id_penghasilan_fieldblock",true);
	else
		$xt->assign("id_penghasilan_tabfieldblock",true);
////////////////////////////////////////////
//id_penilaian - 
	
	$value = $pageObject->showDBValue("id_penilaian", $data, $keylink);
	if($mainTableOwnerID=="id_penilaian")
		$ownerIdValue=$value;
	$xt->assign("id_penilaian_value",$value);
	if(!$pageObject->isAppearOnTabs("id_penilaian"))
		$xt->assign("id_penilaian_fieldblock",true);
	else
		$xt->assign("id_penilaian_tabfieldblock",true);
////////////////////////////////////////////
//id_absensi - 
	
	$value = $pageObject->showDBValue("id_absensi", $data, $keylink);
	if($mainTableOwnerID=="id_absensi")
		$ownerIdValue=$value;
	$xt->assign("id_absensi_value",$value);
	if(!$pageObject->isAppearOnTabs("id_absensi"))
		$xt->assign("id_absensi_fieldblock",true);
	else
		$xt->assign("id_absensi_tabfieldblock",true);

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && !isMobile())
{
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
	}
	
	$dControlsMap = array();
	$dViewControlsMap = array();
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$options = array();
		//array of params for classes
		$options["mode"] = LIST_DETAILS;
		$options["pageType"] = PAGE_LIST;
		$options["masterPageType"] = PAGE_VIEW;
		$options["mainMasterPageType"] = PAGE_VIEW;
		$options['masterTable'] = "karyawan";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "karyawan";
			continue;
		}
		
		$layout = GetPageLayout(GoodFieldName($strTableName), PAGE_LIST);
		if($layout)
		{
			$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
			$xt->cssFiles[] = array("stylepath" => "styles/".$layout->style.'/style'.$rtl.".css"
				, "pagestylepath" => "pagestyles/".$layout->name.$rtl.".css");
			$xt->IEcssFiles[] = array("stylepathIE" => "styles/".$layout->style.'/styleIE'.".css");
		}
		
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $pageObject->genId()+1;
		$mkr = 1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		// show page
		if($listPageObject->permis[$strTableName]['search'] && $listPageObject->rowsFound)
		{
			//set page events
			foreach($listPageObject->eventsObject->events as $event => $name)
				$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
			
			//add detail settings to master settings
			$listPageObject->addControlsJSAndCSS();
			$listPageObject->fillSetCntrlMaps();
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];
			$dControlsMap[$strTableName] = $listPageObject->controlsMap;
			$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
			foreach($listPageObject->jsSettings['global']['shortTNames'] as $keySet=>$val)
			{
				if(!array_key_exists($keySet,$pageObject->settingsMap["globalSettings"]['shortTNames']))
					$pageObject->settingsMap["globalSettings"]['shortTNames'][$keySet] = $val;
			}
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		
			$xtParams = array("method"=>'showPage', "params"=> false);
			$xtParams['object'] = $listPageObject;
			$xt->assign("displayDetailTable_".GoodFieldName($listPageObject->tName), $xtParams);
		
			$pageObject->controlsMap['dpTablesParams'][] = array('tName'=>$strTableName, 'id'=>$options['id']);
		}
	}
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap; 
	$strTableName = "karyawan";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin prepare for Next Prev button
if(!@$_SESSION[$strTableName."_noNextPrev"] && !$inlineview && !$pdf)
{
	$pageObject->getNextPrevRecordKeys($data,"Search",$next,$prev);
}
//End prepare for Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($pageObject->googleMapCfg['isUseGoogleMap'])
{
	$pageObject->initGmaps();
}

$pageObject->addCommonJs();

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

if(!$inlineview)
{
	$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/loadfirst.js\"></script>\r\n";
		$pageObject->body["begin"].= "<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";		
	
	$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $pageObject->jsKeys;
	$pageObject->jsSettings['tableSettings'][$strTableName]['keyFields'] = $pageObject->keyFields;
	$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
	$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
	
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
	$xt->assign("pdflink_block",false);
	
	$pageObject->fillSetCntrlMaps();
	
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;
}
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);

$editlink="";
$editkeys=array();
	$editkeys["editid1"]=postvalue("editid1");
foreach($editkeys as $key=>$val)
{
	if($editlink)
		$editlink.="&";
	$editlink.=$key."=".$val;
}
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='karyawan_edit.php?".$editlink."'\"");

$strPerm = GetUserPermissions($strTableName);
if(CheckSecurity($ownerIdValue,"Edit") && !$inlineview && strpos($strPerm, "E")!==false)
	$xt->assign("edit_button",true);
else
	$xt->assign("edit_button",false);

if(!$pdf && !$all && !$inlineview)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin show Next Prev button
	$nextlink=$prevlink="";
	if(count($next))
	{
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1-1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\"");
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1-1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\"");
	}
	else 
		$xt->assign("prev_button",false);
//End show Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
}

$oldtemplatefile = $pageObject->templatefile;

if(!$all)
{
	if($eventObj->exists("BeforeShowView"))
	{
		$templatefile = $pageObject->templatefile;
		$eventObj->BeforeShowView($xt,$templatefile,$data, $pageObject);
		$pageObject->templatefile = $templatefile;
	}
	if(!$pdf)
	{
		if(!$inlineview)
			$xt->display($pageObject->templatefile);
		else{
				$xt->load_template($pageObject->templatefile);
				$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
				if(count($pageObject->includes_css))
					$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
				if(count($pageObject->includes_cssIE))
					$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);				
				$returnJSON['idStartFrom'] = $id+1;
				$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
				echo (my_json_encode($returnJSON)); 
			}
	}
	break;
}
}


?>
