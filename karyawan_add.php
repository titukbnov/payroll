<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

add_nocache_headers();
include("include/karyawan_variables.php");
include('include/xtempl.php');
include('classes/addpage.php');

global $globalEvents;

//	check if logged in
if(!isLogged() || CheckPermissionsEvent($strTableName, 'A') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	
	header("Location: login.php?message=expired"); 
	return;
}

if ((sizeof($_POST)==0) && (postvalue('ferror'))){
	if (postvalue("inline")){
		$returnJSON['success'] = false;
		$returnJSON['message'] = "Error occurred";
		$returnJSON['fatalError'] = true;
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}
	else if (postvalue("fly")){
		echo -1;
		exit();
	}
	else {
		$_SESSION["message_add"] = "<< "."Error occurred"." >>";
	}
}

$layout = new TLayout("add2","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["top"] = array();
$layout->containers["add"] = array();

$layout->containers["add"][] = array("name"=>"addheader","block"=>"","substyle"=>2);


$layout->containers["add"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->containers["add"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"addfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"legend","block"=>"legend","substyle"=>3);


$layout->containers["fields"][] = array("name"=>"addbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["add"] = "1";
$layout->blocks["top"][] = "add";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["karyawan_add"] = $layout;



$filename = "";
$status = "";
$message = "";
$mesClass = "";
$usermessage = "";
$error_happened = false;
$readavalues = false;

$keys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$popUpSave = false;

$sessionPrefix = $strTableName;

$onFly = false;
if(postvalue("onFly"))
	$onFly = true;

if(@$_REQUEST["editType"]=="inline")
	$inlineadd = ADD_INLINE;
elseif(@$_REQUEST["editType"]==ADD_POPUP)
{
	$inlineadd = ADD_POPUP;
	if(@$_POST["a"]=="added" && postvalue("field")=="" && postvalue("category")=="")
		$popUpSave = true;	
}
elseif(@$_REQUEST["editType"]==ADD_MASTER)
	$inlineadd = ADD_MASTER;
elseif($onFly)
{
	$inlineadd = ADD_ONTHEFLY;
	$sessionPrefix = $strTableName."_add";
}
else
	$inlineadd = ADD_SIMPLE;

if($inlineadd == ADD_INLINE)
	$templatefile = "karyawan_inline_add.htm";
else
	$templatefile = "karyawan_add.htm";

$id = postvalue("id");
if(intval($id)==0)
	$id = 1;

//If undefined session value for mastet table, but exist post value master table, than take second
//It may be happen only when use dpInline mode on page add
if(!@$_SESSION[$sessionPrefix."_mastertable"] && postvalue("mastertable"))
	$_SESSION[$sessionPrefix."_mastertable"] = postvalue("mastertable");
	
$xt = new Xtempl();
	
// assign an id
$xt->assign("id",$id);
	
$auditObj = GetAuditObject($strTableName);

//array of params for classes
$params = array("pageType" => PAGE_ADD,"id" => $id,"mode" => $inlineadd);


$params['xt'] = &$xt;
$params['tName'] = $strTableName;
$params['includes_js'] = $includes_js;
$params['locale_info'] = $locale_info;
$params['includes_css'] = $includes_css;
$params['useTabsOnAdd'] = $gSettings->useTabsOnAdd();
$params['templatefile'] = $templatefile;
$params['includes_jsreq'] = $includes_jsreq;
$params['pageAddLikeInline'] = ($inlineadd==ADD_INLINE);
$params['needSearchClauseObj'] = false;
$params['strOriginalTableName'] = $strOriginalTableName;

if($params['useTabsOnAdd'])
	$params['arrAddTabs'] = $gSettings->getAddTabs();
	
$pageObject = new AddPage($params);

if(isset($_REQUEST['afteradd'])){
		header('Location: karyawan_add.php');
	if($eventObj->exists("AfterAdd") && isset($_SESSION['after_add_data'][$_REQUEST['afteradd']])){
	
		$data = $_SESSION['after_add_data'][$_REQUEST['afteradd']];
		$eventObj->AfterAdd($data['avalues'], $data['keys'],$data['inlineadd'], $pageObject);
	
	}
	unset($_SESSION['after_add_data'][$_REQUEST['afteradd']]);
	
	foreach (is_array($_SESSION['after_add_data']) ? $_SESSION['after_add_data'] : array() as $k=>$v){
		if (!is_array($v) or !array_key_exists('time',$v)) {
			unset($_SESSION['after_add_data'][$k]);
			continue;
		}
		if ($v['time'] < time() - 3600){
			unset($_SESSION['after_add_data'][$k]);
		}
	}
		exit;
}

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;

//Array of fields, which appear on add page
$addFields = $pageObject->getFieldsByPageType();

// add button events if exist
if ($inlineadd==ADD_SIMPLE)
	$pageObject->addButtonHandlers();

$url_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//For show detail tables on master page add
if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{
	$dpParams = array();
	if($pageObject->isShowDetailTables  && !isMobile())
	{
		$ids = $id;
		$countDetailsIsShow = 0;
						$pageObject->jsSettings['tableSettings'][$strTableName]['isShowDetails'] = $countDetailsIsShow > 0 ? true : false;
		$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	}
}

//	Before Process event
if($eventObj->exists("BeforeProcessAdd"))
	$eventObj->BeforeProcessAdd($conn, $pageObject);

// proccess captcha
if ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();
	
// insert new record if we have to
if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
//	processing nip - start
	$inlineAddOption = true;
	if($inlineAddOption)
	{
		$control_nip = $pageObject->getControl("nip", $id);
		$control_nip->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing nip - end
//	processing nama - start
	$inlineAddOption = true;
	if($inlineAddOption)
	{
		$control_nama = $pageObject->getControl("nama", $id);
		$control_nama->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing nama - end
//	processing jenis_kelamin - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_jenis_kelamin = $pageObject->getControl("jenis_kelamin", $id);
		$control_jenis_kelamin->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing jenis_kelamin - end
//	processing tempat_lahir - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_tempat_lahir = $pageObject->getControl("tempat_lahir", $id);
		$control_tempat_lahir->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing tempat_lahir - end
//	processing tanggal_lahir - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_tanggal_lahir = $pageObject->getControl("tanggal_lahir", $id);
		$control_tanggal_lahir->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing tanggal_lahir - end
//	processing golongan_darah - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_golongan_darah = $pageObject->getControl("golongan_darah", $id);
		$control_golongan_darah->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing golongan_darah - end
//	processing agama - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_agama = $pageObject->getControl("agama", $id);
		$control_agama->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing agama - end
//	processing status_pernikahan - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_status_pernikahan = $pageObject->getControl("status_pernikahan", $id);
		$control_status_pernikahan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing status_pernikahan - end
//	processing alamat_lengkap - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_alamat_lengkap = $pageObject->getControl("alamat_lengkap", $id);
		$control_alamat_lengkap->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing alamat_lengkap - end
//	processing telepon_rumah - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_telepon_rumah = $pageObject->getControl("telepon_rumah", $id);
		$control_telepon_rumah->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing telepon_rumah - end
//	processing ponsel - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_ponsel = $pageObject->getControl("ponsel", $id);
		$control_ponsel->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing ponsel - end
//	processing email - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_email = $pageObject->getControl("email", $id);
		$control_email->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing email - end
//	processing hobi - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_hobi = $pageObject->getControl("hobi", $id);
		$control_hobi->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing hobi - end
//	processing pendidikan - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_pendidikan = $pageObject->getControl("pendidikan", $id);
		$control_pendidikan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing pendidikan - end
//	processing tanggal_masuk - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_tanggal_masuk = $pageObject->getControl("tanggal_masuk", $id);
		$control_tanggal_masuk->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing tanggal_masuk - end
//	processing status_kerja - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_status_kerja = $pageObject->getControl("status_kerja", $id);
		$control_status_kerja->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing status_kerja - end
//	processing departemen - start
	$inlineAddOption = true;
	if($inlineAddOption)
	{
		$control_departemen = $pageObject->getControl("departemen", $id);
		$control_departemen->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing departemen - end
//	processing organisasi - start
	$inlineAddOption = true;
	if($inlineAddOption)
	{
		$control_organisasi = $pageObject->getControl("organisasi", $id);
		$control_organisasi->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing organisasi - end
//	processing golongan - start
	$inlineAddOption = true;
	if($inlineAddOption)
	{
		$control_golongan = $pageObject->getControl("golongan", $id);
		$control_golongan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing golongan - end
//	processing jabatan - start
	$inlineAddOption = true;
	if($inlineAddOption)
	{
		$control_jabatan = $pageObject->getControl("jabatan", $id);
		$control_jabatan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing jabatan - end
//	processing no_ktp - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_ktp = $pageObject->getControl("no_ktp", $id);
		$control_no_ktp->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_ktp - end
//	processing no_sim - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_sim = $pageObject->getControl("no_sim", $id);
		$control_no_sim->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_sim - end
//	processing no_paspor - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_paspor = $pageObject->getControl("no_paspor", $id);
		$control_no_paspor->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_paspor - end
//	processing no_npwp - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_npwp = $pageObject->getControl("no_npwp", $id);
		$control_no_npwp->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_npwp - end
//	processing no_jamsostek - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_jamsostek = $pageObject->getControl("no_jamsostek", $id);
		$control_no_jamsostek->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_jamsostek - end
//	processing no_asuransi - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_asuransi = $pageObject->getControl("no_asuransi", $id);
		$control_no_asuransi->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_asuransi - end
//	processing no_pensiun - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_no_pensiun = $pageObject->getControl("no_pensiun", $id);
		$control_no_pensiun->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing no_pensiun - end
//	processing pensiun - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_pensiun = $pageObject->getControl("pensiun", $id);
		$control_pensiun->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing pensiun - end
//	processing tanggal_pensiun - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_tanggal_pensiun = $pageObject->getControl("tanggal_pensiun", $id);
		$control_tanggal_pensiun->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing tanggal_pensiun - end
//	processing foto - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_foto = $pageObject->getControl("foto", $id);
		$control_foto->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing foto - end
//	processing sk_tambahan - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_sk_tambahan = $pageObject->getControl("sk_tambahan", $id);
		$control_sk_tambahan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing sk_tambahan - end
//	processing keterangan - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_keterangan = $pageObject->getControl("keterangan", $id);
		$control_keterangan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing keterangan - end
//	processing id_login - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_id_login = $pageObject->getControl("id_login", $id);
		$control_id_login->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing id_login - end
//	processing id_pelatihan - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_id_pelatihan = $pageObject->getControl("id_pelatihan", $id);
		$control_id_pelatihan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing id_pelatihan - end
//	processing id_penghasilan - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_id_penghasilan = $pageObject->getControl("id_penghasilan", $id);
		$control_id_penghasilan->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing id_penghasilan - end
//	processing id_penilaian - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_id_penilaian = $pageObject->getControl("id_penilaian", $id);
		$control_id_penilaian->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing id_penilaian - end
//	processing id_absensi - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_id_absensi = $pageObject->getControl("id_absensi", $id);
		$control_id_absensi->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing id_absensi - end




	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if($eventObj->exists("BeforeAdd"))
		$retval = $eventObj->BeforeAdd($avalues,$usermessage,(bool)$inlineadd, $pageObject);
	if($retval && $pageObject->isCaptchaOk)
	{
		//add or set updated lat-lng values for all map fileds with 'UpdateLatLng' ticked
		setUpdatedLatLng($avalues, $pageObject->cipherer->pSet);
		
		$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields,$id,$pageObject, $pageObject->cipherer))
		{
			$IsSaved=true;
//	after edit event
			if($auditObj || $eventObj->exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
			}
			
			if($auditObj)
				$auditObj->LogAdd($strTableName,$avalues,$keys);
				
// Give possibility to all edit controls to clean their data				
//	processing nip - start
			$inlineAddOption = true;
			if($inlineAddOption)
			{
				$control_nip->afterSuccessfulSave();
			}
//	processing nip - end
//	processing nama - start
			$inlineAddOption = true;
			if($inlineAddOption)
			{
				$control_nama->afterSuccessfulSave();
			}
//	processing nama - end
//	processing jenis_kelamin - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_jenis_kelamin->afterSuccessfulSave();
			}
//	processing jenis_kelamin - end
//	processing tempat_lahir - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_tempat_lahir->afterSuccessfulSave();
			}
//	processing tempat_lahir - end
//	processing tanggal_lahir - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_tanggal_lahir->afterSuccessfulSave();
			}
//	processing tanggal_lahir - end
//	processing golongan_darah - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_golongan_darah->afterSuccessfulSave();
			}
//	processing golongan_darah - end
//	processing agama - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_agama->afterSuccessfulSave();
			}
//	processing agama - end
//	processing status_pernikahan - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_status_pernikahan->afterSuccessfulSave();
			}
//	processing status_pernikahan - end
//	processing alamat_lengkap - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_alamat_lengkap->afterSuccessfulSave();
			}
//	processing alamat_lengkap - end
//	processing telepon_rumah - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_telepon_rumah->afterSuccessfulSave();
			}
//	processing telepon_rumah - end
//	processing ponsel - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_ponsel->afterSuccessfulSave();
			}
//	processing ponsel - end
//	processing email - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_email->afterSuccessfulSave();
			}
//	processing email - end
//	processing hobi - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_hobi->afterSuccessfulSave();
			}
//	processing hobi - end
//	processing pendidikan - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_pendidikan->afterSuccessfulSave();
			}
//	processing pendidikan - end
//	processing tanggal_masuk - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_tanggal_masuk->afterSuccessfulSave();
			}
//	processing tanggal_masuk - end
//	processing status_kerja - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_status_kerja->afterSuccessfulSave();
			}
//	processing status_kerja - end
//	processing departemen - start
			$inlineAddOption = true;
			if($inlineAddOption)
			{
				$control_departemen->afterSuccessfulSave();
			}
//	processing departemen - end
//	processing organisasi - start
			$inlineAddOption = true;
			if($inlineAddOption)
			{
				$control_organisasi->afterSuccessfulSave();
			}
//	processing organisasi - end
//	processing golongan - start
			$inlineAddOption = true;
			if($inlineAddOption)
			{
				$control_golongan->afterSuccessfulSave();
			}
//	processing golongan - end
//	processing jabatan - start
			$inlineAddOption = true;
			if($inlineAddOption)
			{
				$control_jabatan->afterSuccessfulSave();
			}
//	processing jabatan - end
//	processing no_ktp - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_ktp->afterSuccessfulSave();
			}
//	processing no_ktp - end
//	processing no_sim - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_sim->afterSuccessfulSave();
			}
//	processing no_sim - end
//	processing no_paspor - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_paspor->afterSuccessfulSave();
			}
//	processing no_paspor - end
//	processing no_npwp - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_npwp->afterSuccessfulSave();
			}
//	processing no_npwp - end
//	processing no_jamsostek - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_jamsostek->afterSuccessfulSave();
			}
//	processing no_jamsostek - end
//	processing no_asuransi - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_asuransi->afterSuccessfulSave();
			}
//	processing no_asuransi - end
//	processing no_pensiun - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_no_pensiun->afterSuccessfulSave();
			}
//	processing no_pensiun - end
//	processing pensiun - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_pensiun->afterSuccessfulSave();
			}
//	processing pensiun - end
//	processing tanggal_pensiun - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_tanggal_pensiun->afterSuccessfulSave();
			}
//	processing tanggal_pensiun - end
//	processing foto - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_foto->afterSuccessfulSave();
			}
//	processing foto - end
//	processing sk_tambahan - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_sk_tambahan->afterSuccessfulSave();
			}
//	processing sk_tambahan - end
//	processing keterangan - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_keterangan->afterSuccessfulSave();
			}
//	processing keterangan - end
//	processing id_login - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_id_login->afterSuccessfulSave();
			}
//	processing id_login - end
//	processing id_pelatihan - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_id_pelatihan->afterSuccessfulSave();
			}
//	processing id_pelatihan - end
//	processing id_penghasilan - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_id_penghasilan->afterSuccessfulSave();
			}
//	processing id_penghasilan - end
//	processing id_penilaian - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_id_penilaian->afterSuccessfulSave();
			}
//	processing id_penilaian - end
//	processing id_absensi - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_id_absensi->afterSuccessfulSave();
			}
//	processing id_absensi - end

			$afterAdd_id = '';	
			if($eventObj->exists("AfterAdd") && $inlineadd!=ADD_MASTER){
				$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd, $pageObject);
			} else if ($eventObj->exists("AfterAdd") && $inlineadd==ADD_MASTER){
				if($onFly)
					$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd, $pageObject);
				else{
					$afterAdd_id = generatePassword(20);	
				
					$_SESSION['after_add_data'][$afterAdd_id] = array(
						'avalues'=>$avalues,
						'keys'=>$keys,
						'inlineadd'=>(bool)$inlineadd,
						'time' => time()
					);	
				}
			}
				
			if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
			{
				$permis = array();
				$keylink = "";$k = 0;
				foreach($keys as $idx=>$val)
				{
					if($k!=0)
						$keylink .="&";
					$keylink .="editid".(++$k)."=".htmlspecialchars(rawurlencode(@$val));
				}
				$permis = $pageObject->getPermissions();				
				if (count($keys))
				{
					$message .="</br>";
					if($pageObject->pSet->hasEditPage() && $permis['edit'])
						$message .='&nbsp;<a href=\'karyawan_edit.php?'.$keylink.'\'>'."Edit".'</a>&nbsp;';
					if($pageObject->pSet->hasViewPage() && $permis['search'])
						$message .='&nbsp;<a href=\'karyawan_view.php?'.$keylink.'\'>'."View".'</a>&nbsp;';
				}
				$mesClass = "mes_ok";	
			}
		}
		elseif($inlineadd!=ADD_INLINE)
			$mesClass = "mes_not";	
	}
	else
	{
		$message = $usermessage;
		$status = "DECLINED";
		$readavalues = true;
	}
}
if($message)
	$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if (no_output_done() && $inlineadd==ADD_SIMPLE && $IsSaved)
{
	// saving message
	$_SESSION["message_add"] = ($message ? $message : "");
	// redirect
	header("Location: karyawan_".$pageObject->getPageType().".php");
	// turned on output buffering, so we need to stop script
	exit();
}

if($inlineadd==ADD_MASTER && $IsSaved)
	$_SESSION["message_add"] = ($message ? $message : "");
	
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if($inlineadd==ADD_SIMPLE && isset($_SESSION["message_add"]))
{
	$message = $_SESSION["message_add"];
	unset($_SESSION["message_add"]);
}

$defvalues=array();

//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["nip"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["nip"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = $gQuery->gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs = db_query($strSQL,$conn);
	$defvalues = $pageObject->cipherer->DecryptFetchedArray($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["nip"]="";
//call CopyOnLoad event
	if($eventObj->exists("CopyOnLoad"))
		$eventObj->CopyOnLoad($defvalues,$strWhere, $pageObject);
}
else
{
}



if($readavalues)
{
	$defvalues["nip"]=@$avalues["nip"];
	$defvalues["nama"]=@$avalues["nama"];
	$defvalues["jenis_kelamin"]=@$avalues["jenis_kelamin"];
	$defvalues["tempat_lahir"]=@$avalues["tempat_lahir"];
	$defvalues["tanggal_lahir"]=@$avalues["tanggal_lahir"];
	$defvalues["golongan_darah"]=@$avalues["golongan_darah"];
	$defvalues["agama"]=@$avalues["agama"];
	$defvalues["status_pernikahan"]=@$avalues["status_pernikahan"];
	$defvalues["alamat_lengkap"]=@$avalues["alamat_lengkap"];
	$defvalues["telepon_rumah"]=@$avalues["telepon_rumah"];
	$defvalues["ponsel"]=@$avalues["ponsel"];
	$defvalues["email"]=@$avalues["email"];
	$defvalues["hobi"]=@$avalues["hobi"];
	$defvalues["pendidikan"]=@$avalues["pendidikan"];
	$defvalues["tanggal_masuk"]=@$avalues["tanggal_masuk"];
	$defvalues["status_kerja"]=@$avalues["status_kerja"];
	$defvalues["departemen"]=@$avalues["departemen"];
	$defvalues["organisasi"]=@$avalues["organisasi"];
	$defvalues["golongan"]=@$avalues["golongan"];
	$defvalues["jabatan"]=@$avalues["jabatan"];
	$defvalues["no_ktp"]=@$avalues["no_ktp"];
	$defvalues["no_sim"]=@$avalues["no_sim"];
	$defvalues["no_paspor"]=@$avalues["no_paspor"];
	$defvalues["no_npwp"]=@$avalues["no_npwp"];
	$defvalues["no_jamsostek"]=@$avalues["no_jamsostek"];
	$defvalues["no_asuransi"]=@$avalues["no_asuransi"];
	$defvalues["no_pensiun"]=@$avalues["no_pensiun"];
	$defvalues["pensiun"]=@$avalues["pensiun"];
	$defvalues["tanggal_pensiun"]=@$avalues["tanggal_pensiun"];
	$defvalues["foto"]=@$avalues["foto"];
	$defvalues["sk_tambahan"]=@$avalues["sk_tambahan"];
	$defvalues["keterangan"]=@$avalues["keterangan"];
	$defvalues["id_login"]=@$avalues["id_login"];
	$defvalues["id_pelatihan"]=@$avalues["id_pelatihan"];
	$defvalues["id_penghasilan"]=@$avalues["id_penghasilan"];
	$defvalues["id_penilaian"]=@$avalues["id_penilaian"];
	$defvalues["id_absensi"]=@$avalues["id_absensi"];
}

if($eventObj->exists("ProcessValuesAdd"))
	$eventObj->ProcessValuesAdd($defvalues, $pageObject);


//for basic files
$includes="";

if($inlineadd!=ADD_INLINE)
{
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$includes .="<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
				$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";
		if (!isMobile())
			$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
	
	if(!$pageObject->isAppearOnTabs("nip"))
		$xt->assign("nip_fieldblock",true);
	else
		$xt->assign("nip_tabfieldblock",true);
	$xt->assign("nip_label",true);
	if(isEnableSection508())
		$xt->assign_section("nip_label","<label for=\"".GetInputElementId("nip", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("nama"))
		$xt->assign("nama_fieldblock",true);
	else
		$xt->assign("nama_tabfieldblock",true);
	$xt->assign("nama_label",true);
	if(isEnableSection508())
		$xt->assign_section("nama_label","<label for=\"".GetInputElementId("nama", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("jenis_kelamin"))
		$xt->assign("jenis_kelamin_fieldblock",true);
	else
		$xt->assign("jenis_kelamin_tabfieldblock",true);
	$xt->assign("jenis_kelamin_label",true);
	if(isEnableSection508())
		$xt->assign_section("jenis_kelamin_label","<label for=\"".GetInputElementId("jenis_kelamin", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("tempat_lahir"))
		$xt->assign("tempat_lahir_fieldblock",true);
	else
		$xt->assign("tempat_lahir_tabfieldblock",true);
	$xt->assign("tempat_lahir_label",true);
	if(isEnableSection508())
		$xt->assign_section("tempat_lahir_label","<label for=\"".GetInputElementId("tempat_lahir", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("tanggal_lahir"))
		$xt->assign("tanggal_lahir_fieldblock",true);
	else
		$xt->assign("tanggal_lahir_tabfieldblock",true);
	$xt->assign("tanggal_lahir_label",true);
	if(isEnableSection508())
		$xt->assign_section("tanggal_lahir_label","<label for=\"".GetInputElementId("tanggal_lahir", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("golongan_darah"))
		$xt->assign("golongan_darah_fieldblock",true);
	else
		$xt->assign("golongan_darah_tabfieldblock",true);
	$xt->assign("golongan_darah_label",true);
	if(isEnableSection508())
		$xt->assign_section("golongan_darah_label","<label for=\"".GetInputElementId("golongan_darah", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("agama"))
		$xt->assign("agama_fieldblock",true);
	else
		$xt->assign("agama_tabfieldblock",true);
	$xt->assign("agama_label",true);
	if(isEnableSection508())
		$xt->assign_section("agama_label","<label for=\"".GetInputElementId("agama", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("status_pernikahan"))
		$xt->assign("status_pernikahan_fieldblock",true);
	else
		$xt->assign("status_pernikahan_tabfieldblock",true);
	$xt->assign("status_pernikahan_label",true);
	if(isEnableSection508())
		$xt->assign_section("status_pernikahan_label","<label for=\"".GetInputElementId("status_pernikahan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("alamat_lengkap"))
		$xt->assign("alamat_lengkap_fieldblock",true);
	else
		$xt->assign("alamat_lengkap_tabfieldblock",true);
	$xt->assign("alamat_lengkap_label",true);
	if(isEnableSection508())
		$xt->assign_section("alamat_lengkap_label","<label for=\"".GetInputElementId("alamat_lengkap", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("telepon_rumah"))
		$xt->assign("telepon_rumah_fieldblock",true);
	else
		$xt->assign("telepon_rumah_tabfieldblock",true);
	$xt->assign("telepon_rumah_label",true);
	if(isEnableSection508())
		$xt->assign_section("telepon_rumah_label","<label for=\"".GetInputElementId("telepon_rumah", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("ponsel"))
		$xt->assign("ponsel_fieldblock",true);
	else
		$xt->assign("ponsel_tabfieldblock",true);
	$xt->assign("ponsel_label",true);
	if(isEnableSection508())
		$xt->assign_section("ponsel_label","<label for=\"".GetInputElementId("ponsel", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("email"))
		$xt->assign("email_fieldblock",true);
	else
		$xt->assign("email_tabfieldblock",true);
	$xt->assign("email_label",true);
	if(isEnableSection508())
		$xt->assign_section("email_label","<label for=\"".GetInputElementId("email", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("hobi"))
		$xt->assign("hobi_fieldblock",true);
	else
		$xt->assign("hobi_tabfieldblock",true);
	$xt->assign("hobi_label",true);
	if(isEnableSection508())
		$xt->assign_section("hobi_label","<label for=\"".GetInputElementId("hobi", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("pendidikan"))
		$xt->assign("pendidikan_fieldblock",true);
	else
		$xt->assign("pendidikan_tabfieldblock",true);
	$xt->assign("pendidikan_label",true);
	if(isEnableSection508())
		$xt->assign_section("pendidikan_label","<label for=\"".GetInputElementId("pendidikan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("tanggal_masuk"))
		$xt->assign("tanggal_masuk_fieldblock",true);
	else
		$xt->assign("tanggal_masuk_tabfieldblock",true);
	$xt->assign("tanggal_masuk_label",true);
	if(isEnableSection508())
		$xt->assign_section("tanggal_masuk_label","<label for=\"".GetInputElementId("tanggal_masuk", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("status_kerja"))
		$xt->assign("status_kerja_fieldblock",true);
	else
		$xt->assign("status_kerja_tabfieldblock",true);
	$xt->assign("status_kerja_label",true);
	if(isEnableSection508())
		$xt->assign_section("status_kerja_label","<label for=\"".GetInputElementId("status_kerja", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("departemen"))
		$xt->assign("departemen_fieldblock",true);
	else
		$xt->assign("departemen_tabfieldblock",true);
	$xt->assign("departemen_label",true);
	if(isEnableSection508())
		$xt->assign_section("departemen_label","<label for=\"".GetInputElementId("departemen", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("organisasi"))
		$xt->assign("organisasi_fieldblock",true);
	else
		$xt->assign("organisasi_tabfieldblock",true);
	$xt->assign("organisasi_label",true);
	if(isEnableSection508())
		$xt->assign_section("organisasi_label","<label for=\"".GetInputElementId("organisasi", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("golongan"))
		$xt->assign("golongan_fieldblock",true);
	else
		$xt->assign("golongan_tabfieldblock",true);
	$xt->assign("golongan_label",true);
	if(isEnableSection508())
		$xt->assign_section("golongan_label","<label for=\"".GetInputElementId("golongan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("jabatan"))
		$xt->assign("jabatan_fieldblock",true);
	else
		$xt->assign("jabatan_tabfieldblock",true);
	$xt->assign("jabatan_label",true);
	if(isEnableSection508())
		$xt->assign_section("jabatan_label","<label for=\"".GetInputElementId("jabatan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_ktp"))
		$xt->assign("no_ktp_fieldblock",true);
	else
		$xt->assign("no_ktp_tabfieldblock",true);
	$xt->assign("no_ktp_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_ktp_label","<label for=\"".GetInputElementId("no_ktp", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_sim"))
		$xt->assign("no_sim_fieldblock",true);
	else
		$xt->assign("no_sim_tabfieldblock",true);
	$xt->assign("no_sim_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_sim_label","<label for=\"".GetInputElementId("no_sim", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_paspor"))
		$xt->assign("no_paspor_fieldblock",true);
	else
		$xt->assign("no_paspor_tabfieldblock",true);
	$xt->assign("no_paspor_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_paspor_label","<label for=\"".GetInputElementId("no_paspor", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_npwp"))
		$xt->assign("no_npwp_fieldblock",true);
	else
		$xt->assign("no_npwp_tabfieldblock",true);
	$xt->assign("no_npwp_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_npwp_label","<label for=\"".GetInputElementId("no_npwp", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_jamsostek"))
		$xt->assign("no_jamsostek_fieldblock",true);
	else
		$xt->assign("no_jamsostek_tabfieldblock",true);
	$xt->assign("no_jamsostek_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_jamsostek_label","<label for=\"".GetInputElementId("no_jamsostek", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_asuransi"))
		$xt->assign("no_asuransi_fieldblock",true);
	else
		$xt->assign("no_asuransi_tabfieldblock",true);
	$xt->assign("no_asuransi_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_asuransi_label","<label for=\"".GetInputElementId("no_asuransi", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("no_pensiun"))
		$xt->assign("no_pensiun_fieldblock",true);
	else
		$xt->assign("no_pensiun_tabfieldblock",true);
	$xt->assign("no_pensiun_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_pensiun_label","<label for=\"".GetInputElementId("no_pensiun", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("pensiun"))
		$xt->assign("pensiun_fieldblock",true);
	else
		$xt->assign("pensiun_tabfieldblock",true);
	$xt->assign("pensiun_label",true);
	if(isEnableSection508())
		$xt->assign_section("pensiun_label","<label for=\"".GetInputElementId("pensiun", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("tanggal_pensiun"))
		$xt->assign("tanggal_pensiun_fieldblock",true);
	else
		$xt->assign("tanggal_pensiun_tabfieldblock",true);
	$xt->assign("tanggal_pensiun_label",true);
	if(isEnableSection508())
		$xt->assign_section("tanggal_pensiun_label","<label for=\"".GetInputElementId("tanggal_pensiun", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("foto"))
		$xt->assign("foto_fieldblock",true);
	else
		$xt->assign("foto_tabfieldblock",true);
	$xt->assign("foto_label",true);
	if(isEnableSection508())
		$xt->assign_section("foto_label","<label for=\"".GetInputElementId("foto", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("sk_tambahan"))
		$xt->assign("sk_tambahan_fieldblock",true);
	else
		$xt->assign("sk_tambahan_tabfieldblock",true);
	$xt->assign("sk_tambahan_label",true);
	if(isEnableSection508())
		$xt->assign_section("sk_tambahan_label","<label for=\"".GetInputElementId("sk_tambahan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("keterangan"))
		$xt->assign("keterangan_fieldblock",true);
	else
		$xt->assign("keterangan_tabfieldblock",true);
	$xt->assign("keterangan_label",true);
	if(isEnableSection508())
		$xt->assign_section("keterangan_label","<label for=\"".GetInputElementId("keterangan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("id_login"))
		$xt->assign("id_login_fieldblock",true);
	else
		$xt->assign("id_login_tabfieldblock",true);
	$xt->assign("id_login_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_login_label","<label for=\"".GetInputElementId("id_login", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("id_pelatihan"))
		$xt->assign("id_pelatihan_fieldblock",true);
	else
		$xt->assign("id_pelatihan_tabfieldblock",true);
	$xt->assign("id_pelatihan_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_pelatihan_label","<label for=\"".GetInputElementId("id_pelatihan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("id_penghasilan"))
		$xt->assign("id_penghasilan_fieldblock",true);
	else
		$xt->assign("id_penghasilan_tabfieldblock",true);
	$xt->assign("id_penghasilan_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_penghasilan_label","<label for=\"".GetInputElementId("id_penghasilan", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("id_penilaian"))
		$xt->assign("id_penilaian_fieldblock",true);
	else
		$xt->assign("id_penilaian_tabfieldblock",true);
	$xt->assign("id_penilaian_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_penilaian_label","<label for=\"".GetInputElementId("id_penilaian", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("id_absensi"))
		$xt->assign("id_absensi_fieldblock",true);
	else
		$xt->assign("id_absensi_tabfieldblock",true);
	$xt->assign("id_absensi_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_absensi_label","<label for=\"".GetInputElementId("id_absensi", $id, PAGE_ADD)."\">","</label>");
	
	
	
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$pageObject->body["begin"] .= $includes;
				$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
		$xt->assign("back_button",true);
	}
	else
	{		
		$xt->assign("cancelbutton_attrs", "id=\"cancelButton".$id."\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
	}
	$xt->assign("save_button",true);
}
$xt->assign("savebutton_attrs","id=\"saveButton".$id."\"");
$xt->assign("message_block",true);
$xt->assign("message",$message);
if(!strlen($message))
{
	$xt->displayBrickHidden("message");
}

//	show readonly fields
$linkdata="";

$i = 0;
$jsKeys = array();
$keyFields = array();
foreach($keys as $field=>$value)
{
	$keyFields[$i] = $field;
	$jsKeys[$i++] = $value;
}

if(@$_POST["a"]=="added" && $inlineadd==ADD_ONTHEFLY)
{
	if( !$error_happened && $status!="DECLINED")
	{
		$addedData = GetAddedDataLookupQuery($pageObject, $keys, false);
		$data =& $addedData[0];	
		
		if($data)
		{
			$respData = array($addedData[1]["linkField"] => @$data[$addedData[1]["linkFieldIndex"]], $addedData[1]["displayField"] => @$data[$addedData[1]["displayFieldIndex"]]);
		}
		else
		{
			$respData = array($addedData[1]["linkField"] => @$avalues[$addedData[1]["linkField"]], $addedData[1]["displayField"] => @$avalues[$addedData[1]["displayField"]]);
		}		
		$returnJSON['success'] = true;
		$returnJSON['keys'] = $jsKeys;
		$returnJSON['keyFields'] = $keyFields;
		$returnJSON['vals'] = $respData;
		$returnJSON['fields'] = $showFields;
	}
	else
	{
		$returnJSON['success'] = false;
		$returnJSON['message'] = $message;
	}
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
}

if(@$_POST["a"]=="added" && ($inlineadd == ADD_INLINE || $inlineadd == ADD_MASTER || $inlineadd==ADD_POPUP)) 
{
	//Preparation   view values
	//	get current values and show edit controls
	$dispFieldAlias = "";
	$data=0;
	$linkAndDispVals = array();
	if(count($keys))
	{
		$where=KeyWhere($keys);
			
		$forLookup = postvalue('forLookup');
		if ($forLookup)
		{
			$addedData = GetAddedDataLookupQuery($pageObject, $keys, true);
			$data =& $addedData[0];
			$linkAndDispVals = array('linkField' => $addedData[0][$addedData[1]["linkField"]], 'displayField' => $addedData[0][$addedData[1]["displayField"]]);
		}
		else
		{
			$strSQL = $gQuery->gSQLWhere_having_fromQuery('', $where, '');		
		
			LogInfo($strSQL);
			$rs=db_query($strSQL,$conn);
			$data = $pageObject->cipherer->DecryptFetchedArray($rs);
		}
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}
	//check if correct values added
	$showDetailKeys["absensi"]["masterkey1"] = $data["nip"];	
	$showDetailKeys["pelatihan"]["masterkey1"] = $data["nip"];	
	$showDetailKeys["penghasilan"]["masterkey1"] = $data["nip"];	
	$showDetailKeys["penilaian"]["masterkey1"] = $data["nip"];	

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["nip"]));
	
////////////////////////////////////////////
//	nip
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("nip", $data, $keylink);
		$showValues["nip"] = $value;
		$showFields[] = "nip";
	}	
//	nama
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("nama", $data, $keylink);
		$showValues["nama"] = $value;
		$showFields[] = "nama";
	}	
//	jenis_kelamin
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("jenis_kelamin", $data, $keylink);
		$showValues["jenis_kelamin"] = $value;
		$showFields[] = "jenis_kelamin";
	}	
//	tempat_lahir
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("tempat_lahir", $data, $keylink);
		$showValues["tempat_lahir"] = $value;
		$showFields[] = "tempat_lahir";
	}	
//	tanggal_lahir
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("tanggal_lahir", $data, $keylink);
		$showValues["tanggal_lahir"] = $value;
		$showFields[] = "tanggal_lahir";
	}	
//	golongan_darah
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("golongan_darah", $data, $keylink);
		$showValues["golongan_darah"] = $value;
		$showFields[] = "golongan_darah";
	}	
//	agama
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("agama", $data, $keylink);
		$showValues["agama"] = $value;
		$showFields[] = "agama";
	}	
//	status_pernikahan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("status_pernikahan", $data, $keylink);
		$showValues["status_pernikahan"] = $value;
		$showFields[] = "status_pernikahan";
	}	
//	alamat_lengkap
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("alamat_lengkap", $data, $keylink);
		$showValues["alamat_lengkap"] = $value;
		$showFields[] = "alamat_lengkap";
	}	
//	telepon_rumah
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("telepon_rumah", $data, $keylink);
		$showValues["telepon_rumah"] = $value;
		$showFields[] = "telepon_rumah";
	}	
//	ponsel
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("ponsel", $data, $keylink);
		$showValues["ponsel"] = $value;
		$showFields[] = "ponsel";
	}	
//	email
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("email", $data, $keylink);
		$showValues["email"] = $value;
		$showFields[] = "email";
	}	
//	hobi
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("hobi", $data, $keylink);
		$showValues["hobi"] = $value;
		$showFields[] = "hobi";
	}	
//	pendidikan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("pendidikan", $data, $keylink);
		$showValues["pendidikan"] = $value;
		$showFields[] = "pendidikan";
	}	
//	tanggal_masuk
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("tanggal_masuk", $data, $keylink);
		$showValues["tanggal_masuk"] = $value;
		$showFields[] = "tanggal_masuk";
	}	
//	status_kerja
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("status_kerja", $data, $keylink);
		$showValues["status_kerja"] = $value;
		$showFields[] = "status_kerja";
	}	
//	departemen
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("departemen", $data, $keylink);
		$showValues["departemen"] = $value;
		$showFields[] = "departemen";
	}	
//	organisasi
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("organisasi", $data, $keylink);
		$showValues["organisasi"] = $value;
		$showFields[] = "organisasi";
	}	
//	golongan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("golongan", $data, $keylink);
		$showValues["golongan"] = $value;
		$showFields[] = "golongan";
	}	
//	jabatan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("jabatan", $data, $keylink);
		$showValues["jabatan"] = $value;
		$showFields[] = "jabatan";
	}	
//	no_ktp
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_ktp", $data, $keylink);
		$showValues["no_ktp"] = $value;
		$showFields[] = "no_ktp";
	}	
//	no_sim
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_sim", $data, $keylink);
		$showValues["no_sim"] = $value;
		$showFields[] = "no_sim";
	}	
//	no_paspor
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_paspor", $data, $keylink);
		$showValues["no_paspor"] = $value;
		$showFields[] = "no_paspor";
	}	
//	no_npwp
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_npwp", $data, $keylink);
		$showValues["no_npwp"] = $value;
		$showFields[] = "no_npwp";
	}	
//	no_jamsostek
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_jamsostek", $data, $keylink);
		$showValues["no_jamsostek"] = $value;
		$showFields[] = "no_jamsostek";
	}	
//	no_asuransi
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_asuransi", $data, $keylink);
		$showValues["no_asuransi"] = $value;
		$showFields[] = "no_asuransi";
	}	
//	no_pensiun
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("no_pensiun", $data, $keylink);
		$showValues["no_pensiun"] = $value;
		$showFields[] = "no_pensiun";
	}	
//	pensiun
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("pensiun", $data, $keylink);
		$showValues["pensiun"] = $value;
		$showFields[] = "pensiun";
	}	
//	tanggal_pensiun
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("tanggal_pensiun", $data, $keylink);
		$showValues["tanggal_pensiun"] = $value;
		$showFields[] = "tanggal_pensiun";
	}	
//	foto
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("foto", $data, $keylink);
		$showValues["foto"] = $value;
		$showFields[] = "foto";
	}	
//	sk_tambahan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("sk_tambahan", $data, $keylink);
		$showValues["sk_tambahan"] = $value;
		$showFields[] = "sk_tambahan";
	}	
//	keterangan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("keterangan", $data, $keylink);
		$showValues["keterangan"] = $value;
		$showFields[] = "keterangan";
	}	
//	id_login
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("id_login", $data, $keylink);
		$showValues["id_login"] = $value;
		$showFields[] = "id_login";
	}	
//	id_pelatihan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("id_pelatihan", $data, $keylink);
		$showValues["id_pelatihan"] = $value;
		$showFields[] = "id_pelatihan";
	}	
//	id_penghasilan
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("id_penghasilan", $data, $keylink);
		$showValues["id_penghasilan"] = $value;
		$showFields[] = "id_penghasilan";
	}	
//	id_penilaian
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("id_penilaian", $data, $keylink);
		$showValues["id_penilaian"] = $value;
		$showFields[] = "id_penilaian";
	}	
//	id_absensi
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("id_absensi", $data, $keylink);
		$showValues["id_absensi"] = $value;
		$showFields[] = "id_absensi";
	}	
		$showRawValues["nip"] = substr($data["nip"],0,100);
		$showRawValues["nama"] = substr($data["nama"],0,100);
		$showRawValues["jenis_kelamin"] = substr($data["jenis_kelamin"],0,100);
		$showRawValues["tempat_lahir"] = substr($data["tempat_lahir"],0,100);
		$showRawValues["tanggal_lahir"] = substr($data["tanggal_lahir"],0,100);
		$showRawValues["golongan_darah"] = substr($data["golongan_darah"],0,100);
		$showRawValues["agama"] = substr($data["agama"],0,100);
		$showRawValues["status_pernikahan"] = substr($data["status_pernikahan"],0,100);
		$showRawValues["alamat_lengkap"] = substr($data["alamat_lengkap"],0,100);
		$showRawValues["telepon_rumah"] = substr($data["telepon_rumah"],0,100);
		$showRawValues["ponsel"] = substr($data["ponsel"],0,100);
		$showRawValues["email"] = substr($data["email"],0,100);
		$showRawValues["hobi"] = substr($data["hobi"],0,100);
		$showRawValues["pendidikan"] = substr($data["pendidikan"],0,100);
		$showRawValues["tanggal_masuk"] = substr($data["tanggal_masuk"],0,100);
		$showRawValues["status_kerja"] = substr($data["status_kerja"],0,100);
		$showRawValues["departemen"] = substr($data["departemen"],0,100);
		$showRawValues["organisasi"] = substr($data["organisasi"],0,100);
		$showRawValues["golongan"] = substr($data["golongan"],0,100);
		$showRawValues["jabatan"] = substr($data["jabatan"],0,100);
		$showRawValues["no_ktp"] = substr($data["no_ktp"],0,100);
		$showRawValues["no_sim"] = substr($data["no_sim"],0,100);
		$showRawValues["no_paspor"] = substr($data["no_paspor"],0,100);
		$showRawValues["no_npwp"] = substr($data["no_npwp"],0,100);
		$showRawValues["no_jamsostek"] = substr($data["no_jamsostek"],0,100);
		$showRawValues["no_asuransi"] = substr($data["no_asuransi"],0,100);
		$showRawValues["no_pensiun"] = substr($data["no_pensiun"],0,100);
		$showRawValues["pensiun"] = substr($data["pensiun"],0,100);
		$showRawValues["tanggal_pensiun"] = substr($data["tanggal_pensiun"],0,100);
		$showRawValues["foto"] = substr($data["foto"],0,100);
		$showRawValues["sk_tambahan"] = substr($data["sk_tambahan"],0,100);
		$showRawValues["keterangan"] = substr($data["keterangan"],0,100);
		$showRawValues["id_login"] = substr($data["id_login"],0,100);
		$showRawValues["id_pelatihan"] = substr($data["id_pelatihan"],0,100);
		$showRawValues["id_penghasilan"] = substr($data["id_penghasilan"],0,100);
		$showRawValues["id_penilaian"] = substr($data["id_penilaian"],0,100);
		$showRawValues["id_absensi"] = substr($data["id_absensi"],0,100);
	
	// for custom expression for display field
	if ($dispFieldAlias)
	{
		$showValues[] = $data[$dispFieldAlias];	
		$showFields[] = $dispFieldAlias;
		$showRawValues[] = substr($data[$dispFieldAlias],0,100);
	}
	
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_POPUP)
	{	
		if($IsSaved && count($showValues))
		{
			$returnJSON['success'] = true;
			if($HaveData){
				$returnJSON['noKeys'] = false;
			}else{
				$returnJSON['noKeys'] = true;
			}
			
			$returnJSON['keys'] = $jsKeys;
			$returnJSON['keyFields'] = $keyFields;
			$returnJSON['vals'] = $showValues;
			$returnJSON['fields'] = $showFields;
			$returnJSON['rawVals'] = $showRawValues;
			$returnJSON['detKeys'] = $showDetailKeys;
			$returnJSON['userMess'] = $usermessage;
			$returnJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
			// add link and display value if list page is lookup with search
			if(array_key_exists('linkField', $linkAndDispVals))
			{
				$returnJSON['linkValue'] = $linkAndDispVals['linkField'];
				$returnJSON['displayValue'] = $linkAndDispVals['displayField'];
			}
			if($globalEvents->exists("IsRecordEditable", $strTableName))
			{ 
				if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
					$returnJSON['nonEditable'] = true;
			}
			
			if($inlineadd==ADD_POPUP && isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
				$returnJSON['hideCaptcha'] = true;
		}
		else
		{
			$returnJSON['success'] = false;
			$returnJSON['message'] = $message;
			if(!$pageObject->isCaptchaOk)
				$returnJSON['captcha'] = false;
		}
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}
} 

/////////////////////////////////////////////////////////////
if($inlineadd==ADD_MASTER)
{
	$respJSON = array();
	if(($_POST["a"]=="added" && $IsSaved))
	{
		$respJSON['afterAddId'] = $afterAdd_id;
		$respJSON['success'] = true;
		$respJSON['fields'] = $showFields;
		$respJSON['vals'] = $showValues;
		if($onFly){
			if($HaveData)
				$respJSON['noKeys'] = false;
			else
				$respJSON['noKeys'] = true;
			$respJSON['keys'] = $jsKeys;
			$respJSON['keyFields'] = $keyFields;
			$respJSON['rawVals'] = $showRawValues;
			$respJSON['detKeys'] = $showDetailKeys;
			$respJSON['userMess'] = $usermessage;
			$respJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
			if($globalEvents->exists("IsRecordEditable", $strTableName))
			{
				if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
					$respJSON['nonEditable'] = true;
			}
		}
		$respJSON['mKeys'] = array();
		for($i=0;$i<count($dpParams['ids']);$i++)
		{
			$data=0;
			if(count($keys))
			{
				$where=KeyWhere($keys);
							$strSQL = $gQuery->gSQLWhere($where);
				LogInfo($strSQL);
				$rs = db_query($strSQL,$conn);
				$data = $pageObject->cipherer->DecryptFetchedArray($rs);
			}
			if(!$data)
				$data=$avalues;
			
			$mKeyId = 1;
			foreach($mKeys[$dpParams['strTableNames'][$i]] as $mk)
			{
				if($data[$mk])
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = $data[$mk];
				else
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = '';
			}
		}
		if(isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
			$respJSON['hidecaptcha'] = true;
	}
	else{
			$respJSON['success'] = false;
			if(!$pageObject->isCaptchaOk)
				$respJSON['captcha'] = false;
			else
				$respJSON['error'] = $message;
			if($onFly)
				$respJSON['message'] = $message;
		}
	echo "<textarea>".htmlspecialchars(my_json_encode($respJSON))."</textarea>";
	exit();
}

/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////

//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
$control = array();

foreach($addFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))
	{
		$control[$gfName] = array();
		$control[$gfName]["func"] = "xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"] = $id;
		$control[$gfName]["params"]["ptype"] = PAGE_ADD;
		$control[$gfName]["params"]["field"] = $fName;
		$control[$gfName]["params"]["value"] = @$defvalues[$fName];
		$control[$gfName]["params"]["pageObj"] = $pageObject;
		if($pageObject->pSet->isUseRTE($fName))
			$_SESSION[$strTableName."_".$fName."_rte"] = @$defvalues[$fName];
		
		//	Begin Add validation
		$arrValidate = $pageObject->pSet->getValidation($fName);
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	//if richEditor for field
	if($pageObject->pSet->isUseRTE($fName))
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))
			$control[$gfName]["params"]["mode"]="add";
		$controls["controls"]['mode'] = "add";
	}
	else
	{
		if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="inline_add";
			$controls["controls"]['mode'] = "inline_add";
		}
		else
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="add";
			$controls["controls"]['mode'] = "add";
		}
	}
	
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$defvalues[$fName];
	
	// category control field
	$strCategoryControl = $pageObject->isDependOnField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $addFields))
		$vals = array($fName => @$defvalues[$fName], $strCategoryControl => @$defvalues[$strCategoryControl]);
	else
		$vals = array($fName => @$defvalues[$fName]);
	
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
	{
		$controls["controls"]['preloadData'] = $preload;
		if(!@$defvalues[$fName] && count($preload["vals"])>0)
			$defvalues[$fName] = $preload["vals"][0];
	}
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker
	if($pageObject->pSet->getEditFormat($fName) == 'Time')
		$pageObject->fillTimePickSettings($fName, @$defvalues[$fName]);
	
	if((($detailKeys && in_array($fName, $detailKeys)) || $fName == postvalue("category")) && array_key_exists($fName, $defvalues))
	{
		$value = $pageObject->showDBValue($fName, $defvalues);
		
		$xt->assign($gfName."_editcontrol", $value);
	}
}

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_POPUP) && !isMobile())
{
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		include("classes/searchclause.php");
	}
	
	$dControlsMap = array();
	$dViewControlsMap = array();
		
	$flyId = $ids+1;
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$options = array();
		//array of params for classes
		$options["mode"] = LIST_DETAILS;
		$options["pageType"] = PAGE_LIST;
		$options["masterPageType"] = PAGE_ADD;
		$options["mainMasterPageType"] = PAGE_ADD;
		$options['masterTable'] = "karyawan";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		
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
		$options['flyId'] = $flyId++;
		$mkr = 1;
		
		foreach($mKeys[$strTableName] as $mk)
		{
			if($defvalues[$mk])
				$options['masterKeysReq'][$mkr++] = $defvalues[$mk];
			else
				$options['masterKeysReq'][$mkr++] = '';
		}
		$listPageObject = ListPage::createListPage($strTableName,$options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		
		//set page events
		foreach($listPageObject->eventsObject->events as $event => $name)
			$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
		
		//add detail settings to master settings
		$listPageObject->addControlsJSAndCSS();
		$listPageObject->fillSetCntrlMaps();
		$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];

		$dControlsMap[$strTableName] = $listPageObject->controlsMap;
		$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
		
		foreach($listPageObject->jsSettings["global"]["shortTNames"] as $tName => $shortTName){
			$pageObject->settingsMap["globalSettings"]["shortTNames"][$tName] = $shortTName;
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
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap;
	$strTableName = "karyawan";
}
/////////////////////////////////////////////////////////////
//fill jsSettings and ControlsHTMLMap
$pageObject->fillSetCntrlMaps();

$pageObject->addCommonJs();

//For mobile version in apple device

if($inlineadd == ADD_SIMPLE)
{
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	$xt->assign("body", $pageObject->body);
	$xt->assign("flybody",true);
}

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{ 
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("flybody", $pageObject->body);
	$xt->assign("body",true);
}	

$xt->assign("style_block",true);
$pageObject->xt->assign("legend", true);

if($eventObj->exists("BeforeShowAdd"))
	$eventObj->BeforeShowAdd($xt, $templatefile, $pageObject);
	
if($inlineadd != ADD_SIMPLE)
{
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
	if(count($pageObject->includes_css))
		$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
	if(count($pageObject->includes_cssIE))
		$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON['idStartFrom'] = $id+1;	
	echo (my_json_encode($returnJSON)); 
}
elseif ($inlineadd == ADD_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($addFields as $fName)
	{
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");	
	}	
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON["additionalCSS"] = $pageObject->grabAllCSSFiles();
	echo (my_json_encode($returnJSON)); 
}
else
	$xt->display($templatefile);

function GetAddedDataLookupQuery($pageObject, $keys, $forLookup)
{
	global $conn, $strTableName, $strOriginalTableName;
	
	$LookupSQL = "";
	$linkfield = "";
	$dispfield = "";
	$noBlobReplace = false;
	$lookupFieldName = "";
	
	if($LookupSQL && $nLookupType != LT_QUERY)
		$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);
		
	$data = 0;
	$lookupIndexes = array("linkFieldIndex" => 0, "displayFieldIndex" => 0);
	if(count($keys))
	{
		$where = KeyWhere($keys);
		if($nLookupType == LT_QUERY){
			$LookupSQL = $lookupQueryObj->toSql(whereAdd($lookupQueryObj->m_where->toSql($lookupQueryObj), $where));
		}else 
			$LookupSQL.=" where ".$where;
		$lookupIndexes = GetLookupFieldsIndexes($lookupPSet, $lookupFieldName);
		LogInfo($LookupSQL);
		if($forLookup){
			$rs=db_query($LookupSQL,$conn);
			$data = $pageObject->cipherer->DecryptFetchedArray($rs);
		}else if($LookupSQL)
		{
			$rs = db_query($LookupSQL,$conn);
			$data = db_fetch_numarray($rs);
			$data[$lookupIndexes["linkFieldIndex"]] = $pageObject->cipherer->DecryptField($linkFieldName, $data[$lookupIndexes["linkFieldIndex"]]);
			if($nLookupType == LT_QUERY)
				$data[$lookupIndexes["displayFieldIndex"]] = $pageObject->cipherer->DecryptField($dispfield, $data[$lookupIndexes["displayFieldIndex"]]);		
		}
	}

	return array($data, array("linkField" => $linkFieldName, "displayField" => $dispfield
		, "linkFieldIndex" => $lookupIndexes["linkFieldIndex"], "displayFieldIndex" => $lookupIndexes["displayFieldIndex"]));
}	
	
?>
