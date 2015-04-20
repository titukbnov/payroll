<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/karyawan_variables.php");
include('include/xtempl.php');
include('classes/editpage.php');
include("classes/searchclause.php");

add_nocache_headers();

global $globalEvents;

//	check if logged in
if(!isLogged() || CheckPermissionsEvent($strTableName, 'E') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired");
	return;
}

$layout = new TLayout("edit2","ExtravaganzaBlueWave","MobileBlueWave");
$layout->blocks["top"] = array();
$layout->containers["edit"] = array();

$layout->containers["edit"][] = array("name"=>"editheader","block"=>"","substyle"=>2);


$layout->containers["edit"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->containers["edit"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"editfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"legend","block"=>"legend","substyle"=>3);


$layout->containers["fields"][] = array("name"=>"editbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["edit"] = "1";
$layout->blocks["top"][] = "edit";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["karyawan_edit"] = $layout;




if ((sizeof($_POST)==0) && (postvalue('ferror')) && (!postvalue("editid1"))){
	$returnJSON['success'] = false;
	$returnJSON['message'] = "Error occurred";
	$returnJSON['fatalError'] = true;
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
}
else if ((sizeof($_POST)==0) && (postvalue('ferror')) && (postvalue("editid1"))){
	if (postvalue('fly')){
		echo -1;
		exit();
	}
	else {
		$_SESSION["message_edit"] = "<< "."Error occurred"." >>";
	}
}
/////////////////////////////////////////////////////////////
//init variables
/////////////////////////////////////////////////////////////
if(postvalue("editType")=="inline")
	$inlineedit = EDIT_INLINE;
elseif(postvalue("editType")==EDIT_POPUP)
	$inlineedit = EDIT_POPUP;
else
	$inlineedit = EDIT_SIMPLE;

$id = postvalue("id");
if(intval($id)==0)
	$id = 1;

$flyId = $id+1;
$xt = new Xtempl();

// assign an id
$xt->assign("id",$id);

$templatefile = ($inlineedit == EDIT_INLINE) ? "karyawan_inline_edit.htm" : "karyawan_edit.htm";

//array of params for classes
$params = array("pageType" => PAGE_EDIT,"id" => $id);


$params['tName'] = $strTableName;
$params['xt'] = &$xt;
$params['mode'] = $inlineedit;
$params['includes_js'] = $includes_js;
$params['includes_jsreq'] = $includes_jsreq;
$params['includes_css'] = $includes_css;
$params['locale_info'] = $locale_info;
$params['templatefile'] = $templatefile;
$params['pageEditLikeInline'] = ($inlineedit == EDIT_INLINE);
//Get array of tabs for edit page
$params['useTabsOnEdit'] = $gSettings->useTabsOnEdit();
if($params['useTabsOnEdit'])
	$params['arrEditTabs'] = $gSettings->getEditTabs();

$pageObject = new EditPage($params);

//	For ajax request 
if($_REQUEST["action"]!="")
{
	if($pageObject->lockingObj)
	{
		$arrkeys = explode("&",refine($_REQUEST["keys"]));
		foreach($arrkeys as $ind=>$val)
			$arrkeys[$ind]=urldecode($val);
		
		if($_REQUEST["action"]=="unlock")
		{
			$pageObject->lockingObj->UnlockRecord($strTableName,$arrkeys,$_REQUEST["sid"]);
			exit();	
		}
		else if($_REQUEST["action"]=="lockadmin" && (IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP))
		{
			$pageObject->lockingObj->UnlockAdmin($strTableName,$arrkeys,$_REQUEST["startEdit"]=="yes");
			if($_REQUEST["startEdit"]=="no")
				echo "unlock";
			else if($_REQUEST["startEdit"]=="yes")
				echo "lock";
			exit();	
		}
		else if($_REQUEST["action"]=="confirm")
		{
			if(!$pageObject->lockingObj->ConfirmLock($strTableName,$arrkeys,$message));
				echo $message;
			exit();	
		}
	}
	else
		exit();
}

$filename = $status = $message = $mesClass = $usermessage = $strWhereClause = $bodyonload = "";
$showValues = $showRawValues = $showFields = $showDetailKeys = $key = $next = $prev = array();
$HaveData = $enableCtrlsForEditing = true;
$error_happened = $readevalues = $IsSaved = false;

$auditObj = GetAuditObject($strTableName);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;


if($pageObject->lockingObj)
{
	$system_attrs = "style='display:none;'";
	$system_message = "";
}

if ($inlineedit!=EDIT_INLINE)
{
	// add button events if exist
	$pageObject->addButtonHandlers();
}

$url_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//	Before Process event
if($eventObj->exists("BeforeProcessEdit"))
	$eventObj->BeforeProcessEdit($conn, $pageObject);

$keys = array();
$skeys = "";
$savedKeys = array();
$keys["nip"] = urldecode(postvalue("editid1"));
$savedKeys["nip"] = urldecode(postvalue("editid1"));
$skeys.= rawurlencode(postvalue("editid1"))."&";

$pageObject->setKeys($keys);

if($skeys!="")
	$skeys = substr($skeys,0,-1);

//For show detail tables on master page edit
if($inlineedit!=EDIT_INLINE)
{
	$dpParams = array();
	if($pageObject->isShowDetailTables && !isMobile())
	{
		$ids = $id;
						$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	}
}
/////////////////////////////////////////////////////////////
//	process entered data, read and save
/////////////////////////////////////////////////////////////

// proccess captcha
if ($inlineedit!=EDIT_INLINE)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();

if(@$_POST["a"] == "edited")
{
	$strWhereClause = whereAdd($strWhereClause,KeyWhere($keys));
		$oldValuesRead = false;	
	if($eventObj->exists("AfterEdit") || $eventObj->exists("BeforeEdit") || $auditObj || isTableGeoUpdatable($pageObject->cipherer->pSet)
		|| $globalEvents->exists("IsRecordEditable", $strTableName))
	{
		//	read old values
		$rsold = db_query($gQuery->gSQLWhere($strWhereClause), $conn);
		$dataold = $pageObject->cipherer->DecryptFetchedArray($rsold);
		$oldValuesRead = true;
	}
	if($globalEvents->exists("IsRecordEditable", $strTableName))
	{
		if(!$globalEvents->IsRecordEditable($dataold, true, $strTableName))
			return SecurityRedirect($inlineedit);
	}
	$evalues = $efilename_values = $blobfields = array();
	

//	processing nip - begin
	$condition = 1;

	if($condition)
	{
		$control_nip = $pageObject->getControl("nip", $id);
		$control_nip->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		//	update key value
		if($control_nip->getWebValue()!==false)
			$keys["nip"] = $control_nip->getWebValue();
	}
//	processing nip - end
//	processing nama - begin
	$condition = 1;

	if($condition)
	{
		$control_nama = $pageObject->getControl("nama", $id);
		$control_nama->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing nama - end
//	processing jenis_kelamin - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_jenis_kelamin = $pageObject->getControl("jenis_kelamin", $id);
		$control_jenis_kelamin->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing jenis_kelamin - end
//	processing tempat_lahir - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_tempat_lahir = $pageObject->getControl("tempat_lahir", $id);
		$control_tempat_lahir->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing tempat_lahir - end
//	processing tanggal_lahir - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_tanggal_lahir = $pageObject->getControl("tanggal_lahir", $id);
		$control_tanggal_lahir->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing tanggal_lahir - end
//	processing golongan_darah - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_golongan_darah = $pageObject->getControl("golongan_darah", $id);
		$control_golongan_darah->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing golongan_darah - end
//	processing agama - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_agama = $pageObject->getControl("agama", $id);
		$control_agama->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing agama - end
//	processing status_pernikahan - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_status_pernikahan = $pageObject->getControl("status_pernikahan", $id);
		$control_status_pernikahan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing status_pernikahan - end
//	processing alamat_lengkap - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_alamat_lengkap = $pageObject->getControl("alamat_lengkap", $id);
		$control_alamat_lengkap->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing alamat_lengkap - end
//	processing telepon_rumah - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_telepon_rumah = $pageObject->getControl("telepon_rumah", $id);
		$control_telepon_rumah->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing telepon_rumah - end
//	processing ponsel - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_ponsel = $pageObject->getControl("ponsel", $id);
		$control_ponsel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing ponsel - end
//	processing email - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_email = $pageObject->getControl("email", $id);
		$control_email->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing email - end
//	processing hobi - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_hobi = $pageObject->getControl("hobi", $id);
		$control_hobi->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing hobi - end
//	processing pendidikan - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_pendidikan = $pageObject->getControl("pendidikan", $id);
		$control_pendidikan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing pendidikan - end
//	processing tanggal_masuk - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_tanggal_masuk = $pageObject->getControl("tanggal_masuk", $id);
		$control_tanggal_masuk->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing tanggal_masuk - end
//	processing status_kerja - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_status_kerja = $pageObject->getControl("status_kerja", $id);
		$control_status_kerja->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing status_kerja - end
//	processing departemen - begin
	$condition = 1;

	if($condition)
	{
		$control_departemen = $pageObject->getControl("departemen", $id);
		$control_departemen->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing departemen - end
//	processing organisasi - begin
	$condition = 1;

	if($condition)
	{
		$control_organisasi = $pageObject->getControl("organisasi", $id);
		$control_organisasi->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing organisasi - end
//	processing golongan - begin
	$condition = 1;

	if($condition)
	{
		$control_golongan = $pageObject->getControl("golongan", $id);
		$control_golongan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing golongan - end
//	processing jabatan - begin
	$condition = 1;

	if($condition)
	{
		$control_jabatan = $pageObject->getControl("jabatan", $id);
		$control_jabatan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing jabatan - end
//	processing no_ktp - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_ktp = $pageObject->getControl("no_ktp", $id);
		$control_no_ktp->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_ktp - end
//	processing no_sim - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_sim = $pageObject->getControl("no_sim", $id);
		$control_no_sim->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_sim - end
//	processing no_paspor - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_paspor = $pageObject->getControl("no_paspor", $id);
		$control_no_paspor->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_paspor - end
//	processing no_npwp - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_npwp = $pageObject->getControl("no_npwp", $id);
		$control_no_npwp->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_npwp - end
//	processing no_jamsostek - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_jamsostek = $pageObject->getControl("no_jamsostek", $id);
		$control_no_jamsostek->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_jamsostek - end
//	processing no_asuransi - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_asuransi = $pageObject->getControl("no_asuransi", $id);
		$control_no_asuransi->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_asuransi - end
//	processing no_pensiun - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_no_pensiun = $pageObject->getControl("no_pensiun", $id);
		$control_no_pensiun->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing no_pensiun - end
//	processing pensiun - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_pensiun = $pageObject->getControl("pensiun", $id);
		$control_pensiun->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing pensiun - end
//	processing tanggal_pensiun - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_tanggal_pensiun = $pageObject->getControl("tanggal_pensiun", $id);
		$control_tanggal_pensiun->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing tanggal_pensiun - end
//	processing foto - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_foto = $pageObject->getControl("foto", $id);
		$control_foto->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing foto - end
//	processing sk_tambahan - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_sk_tambahan = $pageObject->getControl("sk_tambahan", $id);
		$control_sk_tambahan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing sk_tambahan - end
//	processing keterangan - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_keterangan = $pageObject->getControl("keterangan", $id);
		$control_keterangan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing keterangan - end
//	processing id_login - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_id_login = $pageObject->getControl("id_login", $id);
		$control_id_login->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing id_login - end
//	processing id_pelatihan - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_id_pelatihan = $pageObject->getControl("id_pelatihan", $id);
		$control_id_pelatihan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing id_pelatihan - end
//	processing id_penghasilan - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_id_penghasilan = $pageObject->getControl("id_penghasilan", $id);
		$control_id_penghasilan->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing id_penghasilan - end
//	processing id_penilaian - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_id_penilaian = $pageObject->getControl("id_penilaian", $id);
		$control_id_penilaian->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing id_penilaian - end
//	processing id_absensi - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_id_absensi = $pageObject->getControl("id_absensi", $id);
		$control_id_absensi->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing id_absensi - end

	foreach($efilename_values as $ekey=>$value)
		$evalues[$ekey] = $value;
		
	if($pageObject->lockingObj)
	{
		$lockmessage = "";
		if(!$pageObject->lockingObj->ConfirmLock($strTableName,$savedKeys,$lockmessage))
		{
			$enableCtrlsForEditing = false;
			$system_attrs = "style='display:block;'";
			if($inlineedit == EDIT_INLINE)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$lockmessage = $pageObject->lockingObj->GetLockInfo($strTableName,$savedKeys,false,$id);
				
				$returnJSON['success'] = false;
				$returnJSON['message'] = $lockmessage;
				$returnJSON['enableCtrls'] = $enableCtrlsForEditing;
				$returnJSON['confirmTime'] = $pageObject->lockingObj->ConfirmTime;
				echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
				exit();
			}
			else
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$system_message = $pageObject->lockingObj->GetLockInfo($strTableName,$savedKeys,true,$id);
				else
					$system_message = $lockmessage;
			}
			$status = "DECLINED";
			$readevalues = true;
		}
	}
	
	if($readevalues==false)
	{
	//	do event
		$retval = true;
		if($eventObj->exists("BeforeEdit"))
			$retval=$eventObj->BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,(bool)$inlineedit, $pageObject);
	
		if($retval && $pageObject->isCaptchaOk)
		{		
			if($inlineedit!=EDIT_INLINE)
				$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
		
			//set updated lat-lng values for all map fileds with 'UpdateLatLng' ticked	
            if(isTableGeoUpdatable($pageObject->cipherer->pSet)) {			
				setUpdatedLatLng($evalues, $pageObject->cipherer->pSet, $dataold);
			}	
			
			if(DoUpdateRecord($strOriginalTableName,$evalues,$blobfields,$strWhereClause,$id,$pageObject, $pageObject->cipherer))
			{
				$IsSaved = true;

			// Give possibility to all edit controls to clean their data				
			//	processing nip - begin
							$condition = 1;
			
				if($condition)
				{
					$control_nip->afterSuccessfulSave();
				}
	//	processing nip - end
			//	processing nama - begin
							$condition = 1;
			
				if($condition)
				{
					$control_nama->afterSuccessfulSave();
				}
	//	processing nama - end
			//	processing jenis_kelamin - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_jenis_kelamin->afterSuccessfulSave();
				}
	//	processing jenis_kelamin - end
			//	processing tempat_lahir - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_tempat_lahir->afterSuccessfulSave();
				}
	//	processing tempat_lahir - end
			//	processing tanggal_lahir - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_tanggal_lahir->afterSuccessfulSave();
				}
	//	processing tanggal_lahir - end
			//	processing golongan_darah - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_golongan_darah->afterSuccessfulSave();
				}
	//	processing golongan_darah - end
			//	processing agama - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_agama->afterSuccessfulSave();
				}
	//	processing agama - end
			//	processing status_pernikahan - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_status_pernikahan->afterSuccessfulSave();
				}
	//	processing status_pernikahan - end
			//	processing alamat_lengkap - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_alamat_lengkap->afterSuccessfulSave();
				}
	//	processing alamat_lengkap - end
			//	processing telepon_rumah - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_telepon_rumah->afterSuccessfulSave();
				}
	//	processing telepon_rumah - end
			//	processing ponsel - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_ponsel->afterSuccessfulSave();
				}
	//	processing ponsel - end
			//	processing email - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_email->afterSuccessfulSave();
				}
	//	processing email - end
			//	processing hobi - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_hobi->afterSuccessfulSave();
				}
	//	processing hobi - end
			//	processing pendidikan - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_pendidikan->afterSuccessfulSave();
				}
	//	processing pendidikan - end
			//	processing tanggal_masuk - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_tanggal_masuk->afterSuccessfulSave();
				}
	//	processing tanggal_masuk - end
			//	processing status_kerja - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_status_kerja->afterSuccessfulSave();
				}
	//	processing status_kerja - end
			//	processing departemen - begin
							$condition = 1;
			
				if($condition)
				{
					$control_departemen->afterSuccessfulSave();
				}
	//	processing departemen - end
			//	processing organisasi - begin
							$condition = 1;
			
				if($condition)
				{
					$control_organisasi->afterSuccessfulSave();
				}
	//	processing organisasi - end
			//	processing golongan - begin
							$condition = 1;
			
				if($condition)
				{
					$control_golongan->afterSuccessfulSave();
				}
	//	processing golongan - end
			//	processing jabatan - begin
							$condition = 1;
			
				if($condition)
				{
					$control_jabatan->afterSuccessfulSave();
				}
	//	processing jabatan - end
			//	processing no_ktp - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_ktp->afterSuccessfulSave();
				}
	//	processing no_ktp - end
			//	processing no_sim - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_sim->afterSuccessfulSave();
				}
	//	processing no_sim - end
			//	processing no_paspor - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_paspor->afterSuccessfulSave();
				}
	//	processing no_paspor - end
			//	processing no_npwp - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_npwp->afterSuccessfulSave();
				}
	//	processing no_npwp - end
			//	processing no_jamsostek - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_jamsostek->afterSuccessfulSave();
				}
	//	processing no_jamsostek - end
			//	processing no_asuransi - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_asuransi->afterSuccessfulSave();
				}
	//	processing no_asuransi - end
			//	processing no_pensiun - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_no_pensiun->afterSuccessfulSave();
				}
	//	processing no_pensiun - end
			//	processing pensiun - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_pensiun->afterSuccessfulSave();
				}
	//	processing pensiun - end
			//	processing tanggal_pensiun - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_tanggal_pensiun->afterSuccessfulSave();
				}
	//	processing tanggal_pensiun - end
			//	processing foto - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_foto->afterSuccessfulSave();
				}
	//	processing foto - end
			//	processing sk_tambahan - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_sk_tambahan->afterSuccessfulSave();
				}
	//	processing sk_tambahan - end
			//	processing keterangan - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_keterangan->afterSuccessfulSave();
				}
	//	processing keterangan - end
			//	processing id_login - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_id_login->afterSuccessfulSave();
				}
	//	processing id_login - end
			//	processing id_pelatihan - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_id_pelatihan->afterSuccessfulSave();
				}
	//	processing id_pelatihan - end
			//	processing id_penghasilan - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_id_penghasilan->afterSuccessfulSave();
				}
	//	processing id_penghasilan - end
			//	processing id_penilaian - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_id_penilaian->afterSuccessfulSave();
				}
	//	processing id_penilaian - end
			//	processing id_absensi - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_id_absensi->afterSuccessfulSave();
				}
	//	processing id_absensi - end
				
				//	after edit event
				if($pageObject->lockingObj && $inlineedit == EDIT_INLINE)
					$pageObject->lockingObj->UnlockRecord($strTableName,$savedKeys,"");
				if($auditObj || $eventObj->exists("AfterEdit"))
				{
					foreach($dataold as $idx=>$val)
					{
						if(!array_key_exists($idx,$evalues))
							$evalues[$idx] = $val;
					}
				}

				if($auditObj)
					$auditObj->LogEdit($strTableName,$evalues,$dataold,$keys);
				if($eventObj->exists("AfterEdit"))
					$eventObj->AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,(bool)$inlineedit, $pageObject);
							
				$mesClass = "mes_ok";
			}
			elseif($inlineedit!=EDIT_INLINE)
				$mesClass = "mes_not";	
		}
		else
		{
			$message = $usermessage;
			$readevalues = true;
			$status = "DECLINED";
		}
	}
	if($readevalues)
		$keys = $savedKeys;
}
//else
{
	/////////////////////////
	//Locking recors
	/////////////////////////

	if($pageObject->lockingObj)
	{
		$enableCtrlsForEditing = $pageObject->lockingObj->LockRecord($strTableName,$keys);
		if(!$enableCtrlsForEditing)
		{
			if($inlineedit == EDIT_INLINE)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$lockmessage = $pageObject->lockingObj->GetLockInfo($strTableName,$keys,false,$id);
				else
					$lockmessage = $pageObject->lockingObj->LockUser;
				$returnJSON['success'] = false;
				$returnJSON['message'] = $lockmessage;
				$returnJSON['enableCtrls'] = $enableCtrlsForEditing;
				$returnJSON['confirmTime'] = $pageObject->lockingObj->ConfirmTime;
				echo my_json_encode($returnJSON);
				exit();
			}
			
			$system_attrs = "style='display:block;'";
			$system_message = $pageObject->lockingObj->LockUser;
			
			if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
			{
				$rb = $pageObject->lockingObj->GetLockInfo($strTableName,$keys,true,$id);
				if($rb!="")
					$system_message = $rb;
			}
		}
	}
}

if($pageObject->lockingObj && $inlineedit!=EDIT_INLINE)
	$pageObject->body["begin"] .='<div class="runner-locking" '.$system_attrs.'>'.$system_message.'</div>';

if($message)
	$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if ($IsSaved && no_output_done() && $inlineedit == EDIT_SIMPLE)
{
	// saving message
	$_SESSION["message_edit"] = ($message ? $message : "");
	// key get query
	$keyGetQ = "";
		$keyGetQ.="editid1=".rawurldecode($keys["nip"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: karyawan_".$pageObject->getPageType().".php?".$keyGetQ);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if ($inlineedit == EDIT_SIMPLE && isset($_SESSION["message_edit"]))
{
	$message = $_SESSION["message_edit"];
	unset($_SESSION["message_edit"]);
}


$pageObject->setKeys($keys);
$pageObject->readEditValues = $readevalues;
if($readevalues)
	$pageObject->editValues = $evalues;

//	read current values from the database
$data = $pageObject->getCurrentRecordInternal();
if(!$data)
{
	if($inlineedit == EDIT_SIMPLE)
	{
		header("Location: karyawan_list.php?a=return");
		exit();
	}
	else
		$data = array();
}

if($globalEvents->exists("IsRecordEditable", $strTableName))
{
	if(!$globalEvents->IsRecordEditable($data, true, $strTableName) && $inlineedit != EDIT_INLINE)
	{
		return SecurityRedirect($inlineedit);
	}
}


//global variable use in BuildEditControl function
//	show readonly fields

if($readevalues)
{
	$data["nip"] = $evalues["nip"];
	$data["nama"] = $evalues["nama"];
	$data["jenis_kelamin"] = $evalues["jenis_kelamin"];
	$data["tempat_lahir"] = $evalues["tempat_lahir"];
	$data["tanggal_lahir"] = $evalues["tanggal_lahir"];
	$data["golongan_darah"] = $evalues["golongan_darah"];
	$data["agama"] = $evalues["agama"];
	$data["status_pernikahan"] = $evalues["status_pernikahan"];
	$data["alamat_lengkap"] = $evalues["alamat_lengkap"];
	$data["telepon_rumah"] = $evalues["telepon_rumah"];
	$data["ponsel"] = $evalues["ponsel"];
	$data["email"] = $evalues["email"];
	$data["hobi"] = $evalues["hobi"];
	$data["pendidikan"] = $evalues["pendidikan"];
	$data["tanggal_masuk"] = $evalues["tanggal_masuk"];
	$data["status_kerja"] = $evalues["status_kerja"];
	$data["departemen"] = $evalues["departemen"];
	$data["organisasi"] = $evalues["organisasi"];
	$data["golongan"] = $evalues["golongan"];
	$data["jabatan"] = $evalues["jabatan"];
	$data["no_ktp"] = $evalues["no_ktp"];
	$data["no_sim"] = $evalues["no_sim"];
	$data["no_paspor"] = $evalues["no_paspor"];
	$data["no_npwp"] = $evalues["no_npwp"];
	$data["no_jamsostek"] = $evalues["no_jamsostek"];
	$data["no_asuransi"] = $evalues["no_asuransi"];
	$data["no_pensiun"] = $evalues["no_pensiun"];
	$data["pensiun"] = $evalues["pensiun"];
	$data["tanggal_pensiun"] = $evalues["tanggal_pensiun"];
	$data["foto"] = $evalues["foto"];
	$data["sk_tambahan"] = $evalues["sk_tambahan"];
	$data["keterangan"] = $evalues["keterangan"];
	$data["id_login"] = $evalues["id_login"];
	$data["id_pelatihan"] = $evalues["id_pelatihan"];
	$data["id_penghasilan"] = $evalues["id_penghasilan"];
	$data["id_penilaian"] = $evalues["id_penilaian"];
	$data["id_absensi"] = $evalues["id_absensi"];
}

/////////////////////////////////////////////////////////////
//	assign values to $xt class, prepare page for displaying
/////////////////////////////////////////////////////////////
//Basic includes js files
$includes = "";
//javascript code
	
if($inlineedit != EDIT_INLINE)
{
	if($inlineedit == EDIT_SIMPLE)
	{
		$includes.= "<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
				$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";
		
		if (!isMobile())
			$includes.= "<div id=\"search_suggest".$id."\"></div>\r\n";
			
		$pageObject->body["begin"].= $includes;
	}	

	if(!$pageObject->isAppearOnTabs("nip"))
		$xt->assign("nip_fieldblock",true);
	else
		$xt->assign("nip_tabfieldblock",true);
	$xt->assign("nip_label",true);
	if(isEnableSection508())
		$xt->assign_section("nip_label","<label for=\"".GetInputElementId("nip", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("nama"))
		$xt->assign("nama_fieldblock",true);
	else
		$xt->assign("nama_tabfieldblock",true);
	$xt->assign("nama_label",true);
	if(isEnableSection508())
		$xt->assign_section("nama_label","<label for=\"".GetInputElementId("nama", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("jenis_kelamin"))
		$xt->assign("jenis_kelamin_fieldblock",true);
	else
		$xt->assign("jenis_kelamin_tabfieldblock",true);
	$xt->assign("jenis_kelamin_label",true);
	if(isEnableSection508())
		$xt->assign_section("jenis_kelamin_label","<label for=\"".GetInputElementId("jenis_kelamin", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("tempat_lahir"))
		$xt->assign("tempat_lahir_fieldblock",true);
	else
		$xt->assign("tempat_lahir_tabfieldblock",true);
	$xt->assign("tempat_lahir_label",true);
	if(isEnableSection508())
		$xt->assign_section("tempat_lahir_label","<label for=\"".GetInputElementId("tempat_lahir", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("tanggal_lahir"))
		$xt->assign("tanggal_lahir_fieldblock",true);
	else
		$xt->assign("tanggal_lahir_tabfieldblock",true);
	$xt->assign("tanggal_lahir_label",true);
	if(isEnableSection508())
		$xt->assign_section("tanggal_lahir_label","<label for=\"".GetInputElementId("tanggal_lahir", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("golongan_darah"))
		$xt->assign("golongan_darah_fieldblock",true);
	else
		$xt->assign("golongan_darah_tabfieldblock",true);
	$xt->assign("golongan_darah_label",true);
	if(isEnableSection508())
		$xt->assign_section("golongan_darah_label","<label for=\"".GetInputElementId("golongan_darah", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("agama"))
		$xt->assign("agama_fieldblock",true);
	else
		$xt->assign("agama_tabfieldblock",true);
	$xt->assign("agama_label",true);
	if(isEnableSection508())
		$xt->assign_section("agama_label","<label for=\"".GetInputElementId("agama", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("status_pernikahan"))
		$xt->assign("status_pernikahan_fieldblock",true);
	else
		$xt->assign("status_pernikahan_tabfieldblock",true);
	$xt->assign("status_pernikahan_label",true);
	if(isEnableSection508())
		$xt->assign_section("status_pernikahan_label","<label for=\"".GetInputElementId("status_pernikahan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("alamat_lengkap"))
		$xt->assign("alamat_lengkap_fieldblock",true);
	else
		$xt->assign("alamat_lengkap_tabfieldblock",true);
	$xt->assign("alamat_lengkap_label",true);
	if(isEnableSection508())
		$xt->assign_section("alamat_lengkap_label","<label for=\"".GetInputElementId("alamat_lengkap", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("telepon_rumah"))
		$xt->assign("telepon_rumah_fieldblock",true);
	else
		$xt->assign("telepon_rumah_tabfieldblock",true);
	$xt->assign("telepon_rumah_label",true);
	if(isEnableSection508())
		$xt->assign_section("telepon_rumah_label","<label for=\"".GetInputElementId("telepon_rumah", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("ponsel"))
		$xt->assign("ponsel_fieldblock",true);
	else
		$xt->assign("ponsel_tabfieldblock",true);
	$xt->assign("ponsel_label",true);
	if(isEnableSection508())
		$xt->assign_section("ponsel_label","<label for=\"".GetInputElementId("ponsel", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("email"))
		$xt->assign("email_fieldblock",true);
	else
		$xt->assign("email_tabfieldblock",true);
	$xt->assign("email_label",true);
	if(isEnableSection508())
		$xt->assign_section("email_label","<label for=\"".GetInputElementId("email", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("hobi"))
		$xt->assign("hobi_fieldblock",true);
	else
		$xt->assign("hobi_tabfieldblock",true);
	$xt->assign("hobi_label",true);
	if(isEnableSection508())
		$xt->assign_section("hobi_label","<label for=\"".GetInputElementId("hobi", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("pendidikan"))
		$xt->assign("pendidikan_fieldblock",true);
	else
		$xt->assign("pendidikan_tabfieldblock",true);
	$xt->assign("pendidikan_label",true);
	if(isEnableSection508())
		$xt->assign_section("pendidikan_label","<label for=\"".GetInputElementId("pendidikan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("tanggal_masuk"))
		$xt->assign("tanggal_masuk_fieldblock",true);
	else
		$xt->assign("tanggal_masuk_tabfieldblock",true);
	$xt->assign("tanggal_masuk_label",true);
	if(isEnableSection508())
		$xt->assign_section("tanggal_masuk_label","<label for=\"".GetInputElementId("tanggal_masuk", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("status_kerja"))
		$xt->assign("status_kerja_fieldblock",true);
	else
		$xt->assign("status_kerja_tabfieldblock",true);
	$xt->assign("status_kerja_label",true);
	if(isEnableSection508())
		$xt->assign_section("status_kerja_label","<label for=\"".GetInputElementId("status_kerja", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("departemen"))
		$xt->assign("departemen_fieldblock",true);
	else
		$xt->assign("departemen_tabfieldblock",true);
	$xt->assign("departemen_label",true);
	if(isEnableSection508())
		$xt->assign_section("departemen_label","<label for=\"".GetInputElementId("departemen", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("organisasi"))
		$xt->assign("organisasi_fieldblock",true);
	else
		$xt->assign("organisasi_tabfieldblock",true);
	$xt->assign("organisasi_label",true);
	if(isEnableSection508())
		$xt->assign_section("organisasi_label","<label for=\"".GetInputElementId("organisasi", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("golongan"))
		$xt->assign("golongan_fieldblock",true);
	else
		$xt->assign("golongan_tabfieldblock",true);
	$xt->assign("golongan_label",true);
	if(isEnableSection508())
		$xt->assign_section("golongan_label","<label for=\"".GetInputElementId("golongan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("jabatan"))
		$xt->assign("jabatan_fieldblock",true);
	else
		$xt->assign("jabatan_tabfieldblock",true);
	$xt->assign("jabatan_label",true);
	if(isEnableSection508())
		$xt->assign_section("jabatan_label","<label for=\"".GetInputElementId("jabatan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_ktp"))
		$xt->assign("no_ktp_fieldblock",true);
	else
		$xt->assign("no_ktp_tabfieldblock",true);
	$xt->assign("no_ktp_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_ktp_label","<label for=\"".GetInputElementId("no_ktp", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_sim"))
		$xt->assign("no_sim_fieldblock",true);
	else
		$xt->assign("no_sim_tabfieldblock",true);
	$xt->assign("no_sim_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_sim_label","<label for=\"".GetInputElementId("no_sim", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_paspor"))
		$xt->assign("no_paspor_fieldblock",true);
	else
		$xt->assign("no_paspor_tabfieldblock",true);
	$xt->assign("no_paspor_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_paspor_label","<label for=\"".GetInputElementId("no_paspor", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_npwp"))
		$xt->assign("no_npwp_fieldblock",true);
	else
		$xt->assign("no_npwp_tabfieldblock",true);
	$xt->assign("no_npwp_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_npwp_label","<label for=\"".GetInputElementId("no_npwp", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_jamsostek"))
		$xt->assign("no_jamsostek_fieldblock",true);
	else
		$xt->assign("no_jamsostek_tabfieldblock",true);
	$xt->assign("no_jamsostek_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_jamsostek_label","<label for=\"".GetInputElementId("no_jamsostek", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_asuransi"))
		$xt->assign("no_asuransi_fieldblock",true);
	else
		$xt->assign("no_asuransi_tabfieldblock",true);
	$xt->assign("no_asuransi_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_asuransi_label","<label for=\"".GetInputElementId("no_asuransi", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("no_pensiun"))
		$xt->assign("no_pensiun_fieldblock",true);
	else
		$xt->assign("no_pensiun_tabfieldblock",true);
	$xt->assign("no_pensiun_label",true);
	if(isEnableSection508())
		$xt->assign_section("no_pensiun_label","<label for=\"".GetInputElementId("no_pensiun", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("pensiun"))
		$xt->assign("pensiun_fieldblock",true);
	else
		$xt->assign("pensiun_tabfieldblock",true);
	$xt->assign("pensiun_label",true);
	if(isEnableSection508())
		$xt->assign_section("pensiun_label","<label for=\"".GetInputElementId("pensiun", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("tanggal_pensiun"))
		$xt->assign("tanggal_pensiun_fieldblock",true);
	else
		$xt->assign("tanggal_pensiun_tabfieldblock",true);
	$xt->assign("tanggal_pensiun_label",true);
	if(isEnableSection508())
		$xt->assign_section("tanggal_pensiun_label","<label for=\"".GetInputElementId("tanggal_pensiun", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("foto"))
		$xt->assign("foto_fieldblock",true);
	else
		$xt->assign("foto_tabfieldblock",true);
	$xt->assign("foto_label",true);
	if(isEnableSection508())
		$xt->assign_section("foto_label","<label for=\"".GetInputElementId("foto", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("sk_tambahan"))
		$xt->assign("sk_tambahan_fieldblock",true);
	else
		$xt->assign("sk_tambahan_tabfieldblock",true);
	$xt->assign("sk_tambahan_label",true);
	if(isEnableSection508())
		$xt->assign_section("sk_tambahan_label","<label for=\"".GetInputElementId("sk_tambahan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("keterangan"))
		$xt->assign("keterangan_fieldblock",true);
	else
		$xt->assign("keterangan_tabfieldblock",true);
	$xt->assign("keterangan_label",true);
	if(isEnableSection508())
		$xt->assign_section("keterangan_label","<label for=\"".GetInputElementId("keterangan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("id_login"))
		$xt->assign("id_login_fieldblock",true);
	else
		$xt->assign("id_login_tabfieldblock",true);
	$xt->assign("id_login_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_login_label","<label for=\"".GetInputElementId("id_login", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("id_pelatihan"))
		$xt->assign("id_pelatihan_fieldblock",true);
	else
		$xt->assign("id_pelatihan_tabfieldblock",true);
	$xt->assign("id_pelatihan_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_pelatihan_label","<label for=\"".GetInputElementId("id_pelatihan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("id_penghasilan"))
		$xt->assign("id_penghasilan_fieldblock",true);
	else
		$xt->assign("id_penghasilan_tabfieldblock",true);
	$xt->assign("id_penghasilan_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_penghasilan_label","<label for=\"".GetInputElementId("id_penghasilan", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("id_penilaian"))
		$xt->assign("id_penilaian_fieldblock",true);
	else
		$xt->assign("id_penilaian_tabfieldblock",true);
	$xt->assign("id_penilaian_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_penilaian_label","<label for=\"".GetInputElementId("id_penilaian", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("id_absensi"))
		$xt->assign("id_absensi_fieldblock",true);
	else
		$xt->assign("id_absensi_tabfieldblock",true);
	$xt->assign("id_absensi_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_absensi_label","<label for=\"".GetInputElementId("id_absensi", $id, PAGE_EDIT)."\">","</label>");
		

	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("nip", $data)));
	//$xt->assign('editForm',true);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	if(!@$_SESSION[$strTableName."_noNextPrev"] && $inlineedit == EDIT_SIMPLE)
	{
		$next = array();
		$prev = array();
		$pageObject->getNextPrevRecordKeys($data,"Edit",$next,$prev);
	}
	$nextlink = $prevlink = "";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink.= "editid1=".htmlspecialchars(rawurlencode($next[1-1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\" align=\"absmiddle\"");
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink.= "editid1=".htmlspecialchars(rawurlencode($prev[1-1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\" align=\"absmiddle\"");
	}
	else 
		$xt->assign("prev_button",false);
	$xt->assign("resetbutton_attrs",'id="resetButton'.$id.'"');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	if($inlineedit == EDIT_SIMPLE)
	{
		$xt->assign("back_button",true);
		$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
	}
	// onmouseover event, for changing focus. Needed to proper submit form
	//$onmouseover = "this.focus();";
	//$onmouseover = 'onmouseover="'.$onmouseover.'"';
	
	$xt->assign("save_button",true);
	if(!$enableCtrlsForEditing)
		$xt->assign("savebutton_attrs", "id=\"saveButton".$id."\" type=\"disabled\" ");
	else
		$xt->assign("savebutton_attrs", "id=\"saveButton".$id."\"");
		
	$xt->assign("reset_button",true);

}

$xt->assign("message_block",true);
$xt->assign("message",$message);
if(!strlen($message))
{
	$xt->displayBrickHidden("message");
}
/////////////////////////////////////////////////////////////
//process readonly and auto-update fields
/////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////
//	return new data to the List page or report an error
/////////////////////////////////////////////////////////////
if (postvalue("a")=="edited" && ($inlineedit == EDIT_INLINE || $inlineedit == EDIT_POPUP))
{
	if(!$data)
	{
		$data = $evalues;
		$HaveData = false;
	}
	//Preparation   view values

//	detail tables
	$showDetailKeys["absensi"]["masterkey1"] = $data["nip"];		
	$showDetailKeys["pelatihan"]["masterkey1"] = $data["nip"];		
	$showDetailKeys["penghasilan"]["masterkey1"] = $data["nip"];		
	$showDetailKeys["penilaian"]["masterkey1"] = $data["nip"];		

	$keylink = "";
	$keylink.= "&key1=".htmlspecialchars(rawurlencode(@$data["nip"]));


//	nip - 
	$value = $pageObject->showDBValue("nip", $data, $keylink);
	$showValues["nip"] = $value;
	$showFields[] = "nip";
		$showRawValues["nip"] = substr($data["nip"],0,100);

//	nama - 
	$value = $pageObject->showDBValue("nama", $data, $keylink);
	$showValues["nama"] = $value;
	$showFields[] = "nama";
		$showRawValues["nama"] = substr($data["nama"],0,100);

//	jenis_kelamin - 
	$value = $pageObject->showDBValue("jenis_kelamin", $data, $keylink);
	$showValues["jenis_kelamin"] = $value;
	$showFields[] = "jenis_kelamin";
		$showRawValues["jenis_kelamin"] = substr($data["jenis_kelamin"],0,100);

//	tempat_lahir - 
	$value = $pageObject->showDBValue("tempat_lahir", $data, $keylink);
	$showValues["tempat_lahir"] = $value;
	$showFields[] = "tempat_lahir";
		$showRawValues["tempat_lahir"] = substr($data["tempat_lahir"],0,100);

//	tanggal_lahir - Short Date
	$value = $pageObject->showDBValue("tanggal_lahir", $data, $keylink);
	$showValues["tanggal_lahir"] = $value;
	$showFields[] = "tanggal_lahir";
		$showRawValues["tanggal_lahir"] = substr($data["tanggal_lahir"],0,100);

//	golongan_darah - 
	$value = $pageObject->showDBValue("golongan_darah", $data, $keylink);
	$showValues["golongan_darah"] = $value;
	$showFields[] = "golongan_darah";
		$showRawValues["golongan_darah"] = substr($data["golongan_darah"],0,100);

//	agama - 
	$value = $pageObject->showDBValue("agama", $data, $keylink);
	$showValues["agama"] = $value;
	$showFields[] = "agama";
		$showRawValues["agama"] = substr($data["agama"],0,100);

//	status_pernikahan - 
	$value = $pageObject->showDBValue("status_pernikahan", $data, $keylink);
	$showValues["status_pernikahan"] = $value;
	$showFields[] = "status_pernikahan";
		$showRawValues["status_pernikahan"] = substr($data["status_pernikahan"],0,100);

//	alamat_lengkap - 
	$value = $pageObject->showDBValue("alamat_lengkap", $data, $keylink);
	$showValues["alamat_lengkap"] = $value;
	$showFields[] = "alamat_lengkap";
		$showRawValues["alamat_lengkap"] = substr($data["alamat_lengkap"],0,100);

//	telepon_rumah - 
	$value = $pageObject->showDBValue("telepon_rumah", $data, $keylink);
	$showValues["telepon_rumah"] = $value;
	$showFields[] = "telepon_rumah";
		$showRawValues["telepon_rumah"] = substr($data["telepon_rumah"],0,100);

//	ponsel - 
	$value = $pageObject->showDBValue("ponsel", $data, $keylink);
	$showValues["ponsel"] = $value;
	$showFields[] = "ponsel";
		$showRawValues["ponsel"] = substr($data["ponsel"],0,100);

//	email - 
	$value = $pageObject->showDBValue("email", $data, $keylink);
	$showValues["email"] = $value;
	$showFields[] = "email";
		$showRawValues["email"] = substr($data["email"],0,100);

//	hobi - 
	$value = $pageObject->showDBValue("hobi", $data, $keylink);
	$showValues["hobi"] = $value;
	$showFields[] = "hobi";
		$showRawValues["hobi"] = substr($data["hobi"],0,100);

//	pendidikan - 
	$value = $pageObject->showDBValue("pendidikan", $data, $keylink);
	$showValues["pendidikan"] = $value;
	$showFields[] = "pendidikan";
		$showRawValues["pendidikan"] = substr($data["pendidikan"],0,100);

//	tanggal_masuk - Short Date
	$value = $pageObject->showDBValue("tanggal_masuk", $data, $keylink);
	$showValues["tanggal_masuk"] = $value;
	$showFields[] = "tanggal_masuk";
		$showRawValues["tanggal_masuk"] = substr($data["tanggal_masuk"],0,100);

//	status_kerja - 
	$value = $pageObject->showDBValue("status_kerja", $data, $keylink);
	$showValues["status_kerja"] = $value;
	$showFields[] = "status_kerja";
		$showRawValues["status_kerja"] = substr($data["status_kerja"],0,100);

//	departemen - 
	$value = $pageObject->showDBValue("departemen", $data, $keylink);
	$showValues["departemen"] = $value;
	$showFields[] = "departemen";
		$showRawValues["departemen"] = substr($data["departemen"],0,100);

//	organisasi - 
	$value = $pageObject->showDBValue("organisasi", $data, $keylink);
	$showValues["organisasi"] = $value;
	$showFields[] = "organisasi";
		$showRawValues["organisasi"] = substr($data["organisasi"],0,100);

//	golongan - 
	$value = $pageObject->showDBValue("golongan", $data, $keylink);
	$showValues["golongan"] = $value;
	$showFields[] = "golongan";
		$showRawValues["golongan"] = substr($data["golongan"],0,100);

//	jabatan - 
	$value = $pageObject->showDBValue("jabatan", $data, $keylink);
	$showValues["jabatan"] = $value;
	$showFields[] = "jabatan";
		$showRawValues["jabatan"] = substr($data["jabatan"],0,100);

//	no_ktp - 
	$value = $pageObject->showDBValue("no_ktp", $data, $keylink);
	$showValues["no_ktp"] = $value;
	$showFields[] = "no_ktp";
		$showRawValues["no_ktp"] = substr($data["no_ktp"],0,100);

//	no_sim - 
	$value = $pageObject->showDBValue("no_sim", $data, $keylink);
	$showValues["no_sim"] = $value;
	$showFields[] = "no_sim";
		$showRawValues["no_sim"] = substr($data["no_sim"],0,100);

//	no_paspor - 
	$value = $pageObject->showDBValue("no_paspor", $data, $keylink);
	$showValues["no_paspor"] = $value;
	$showFields[] = "no_paspor";
		$showRawValues["no_paspor"] = substr($data["no_paspor"],0,100);

//	no_npwp - 
	$value = $pageObject->showDBValue("no_npwp", $data, $keylink);
	$showValues["no_npwp"] = $value;
	$showFields[] = "no_npwp";
		$showRawValues["no_npwp"] = substr($data["no_npwp"],0,100);

//	no_jamsostek - 
	$value = $pageObject->showDBValue("no_jamsostek", $data, $keylink);
	$showValues["no_jamsostek"] = $value;
	$showFields[] = "no_jamsostek";
		$showRawValues["no_jamsostek"] = substr($data["no_jamsostek"],0,100);

//	no_asuransi - 
	$value = $pageObject->showDBValue("no_asuransi", $data, $keylink);
	$showValues["no_asuransi"] = $value;
	$showFields[] = "no_asuransi";
		$showRawValues["no_asuransi"] = substr($data["no_asuransi"],0,100);

//	no_pensiun - 
	$value = $pageObject->showDBValue("no_pensiun", $data, $keylink);
	$showValues["no_pensiun"] = $value;
	$showFields[] = "no_pensiun";
		$showRawValues["no_pensiun"] = substr($data["no_pensiun"],0,100);

//	pensiun - Checkbox
	$value = $pageObject->showDBValue("pensiun", $data, $keylink);
	$showValues["pensiun"] = $value;
	$showFields[] = "pensiun";
		$showRawValues["pensiun"] = substr($data["pensiun"],0,100);

//	tanggal_pensiun - Short Date
	$value = $pageObject->showDBValue("tanggal_pensiun", $data, $keylink);
	$showValues["tanggal_pensiun"] = $value;
	$showFields[] = "tanggal_pensiun";
		$showRawValues["tanggal_pensiun"] = substr($data["tanggal_pensiun"],0,100);

//	foto - 
	$value = $pageObject->showDBValue("foto", $data, $keylink);
	$showValues["foto"] = $value;
	$showFields[] = "foto";
		$showRawValues["foto"] = substr($data["foto"],0,100);

//	sk_tambahan - 
	$value = $pageObject->showDBValue("sk_tambahan", $data, $keylink);
	$showValues["sk_tambahan"] = $value;
	$showFields[] = "sk_tambahan";
		$showRawValues["sk_tambahan"] = substr($data["sk_tambahan"],0,100);

//	keterangan - 
	$value = $pageObject->showDBValue("keterangan", $data, $keylink);
	$showValues["keterangan"] = $value;
	$showFields[] = "keterangan";
		$showRawValues["keterangan"] = substr($data["keterangan"],0,100);

//	id_login - 
	$value = $pageObject->showDBValue("id_login", $data, $keylink);
	$showValues["id_login"] = $value;
	$showFields[] = "id_login";
		$showRawValues["id_login"] = substr($data["id_login"],0,100);

//	id_pelatihan - 
	$value = $pageObject->showDBValue("id_pelatihan", $data, $keylink);
	$showValues["id_pelatihan"] = $value;
	$showFields[] = "id_pelatihan";
		$showRawValues["id_pelatihan"] = substr($data["id_pelatihan"],0,100);

//	id_penghasilan - 
	$value = $pageObject->showDBValue("id_penghasilan", $data, $keylink);
	$showValues["id_penghasilan"] = $value;
	$showFields[] = "id_penghasilan";
		$showRawValues["id_penghasilan"] = substr($data["id_penghasilan"],0,100);

//	id_penilaian - 
	$value = $pageObject->showDBValue("id_penilaian", $data, $keylink);
	$showValues["id_penilaian"] = $value;
	$showFields[] = "id_penilaian";
		$showRawValues["id_penilaian"] = substr($data["id_penilaian"],0,100);

//	id_absensi - 
	$value = $pageObject->showDBValue("id_absensi", $data, $keylink);
	$showValues["id_absensi"] = $value;
	$showFields[] = "id_absensi";
		$showRawValues["id_absensi"] = substr($data["id_absensi"],0,100);
/////////////////////////////////////////////////////////////
//	start inline output
/////////////////////////////////////////////////////////////
	
	if($IsSaved)
	{
		if($pageObject->lockingObj)
			$pageObject->lockingObj->UnlockRecord($strTableName,$keys,"");
		
		$returnJSON['success'] = true;
		$returnJSON['keys'] = $pageObject->jsKeys;
		$returnJSON['keyFields'] = $pageObject->keyFields;
		$returnJSON['vals'] = $showValues;
		$returnJSON['fields'] = $showFields;
		$returnJSON['rawVals'] = $showRawValues;
		$returnJSON['detKeys'] = $showDetailKeys;
		$returnJSON['userMess'] = $usermessage;
		$returnJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
		
		if($inlineedit==EDIT_POPUP && isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
			$returnJSON['hideCaptcha'] = true;
			
		if($globalEvents->exists("IsRecordEditable", $strTableName))
		{
			if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
				$returnJSON['nonEditable'] = true;
		}
	}
	else
	{
		$returnJSON['success'] = false;
		$returnJSON['message'] = $message;
		
		if($pageObject->lockingObj)
			$returnJSON['lockMessage'] = $system_message;
		
		if($inlineedit == EDIT_POPUP && !$pageObject->isCaptchaOk)
			$returnJSON['captcha'] = false;
	}
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
} 
/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
//	validation stuff
$regex = '';
$regexmessage = '';
$regextype = '';
$control = array();

foreach($pageObject->editFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if (!$detailKeys || !in_array($fName, $detailKeys))
	{
		$control[$gfName] = array();
		$control[$gfName]["func"]="xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"] = $id;
		$control[$gfName]["params"]["ptype"] = PAGE_EDIT;
		$control[$gfName]["params"]["field"] = $fName;
		if(!IsNumberType($pageObject->pSet->getFieldType($fName)) || is_null(@$data[$fName]))
			$control[$gfName]["params"]["value"] = @$data[$fName];
		else
		{
			$control[$gfName]["params"]["value"] = str_replace(".",$locale_info["LOCALE_SDECIMAL"],@$data[$fName]);
		}
		$control[$gfName]["params"]["pageObj"] = $pageObject;
		
		//	Begin Add validation
		$arrValidate = $pageObject->pSet->getValidation($fName);
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation	
		$additionalCtrlParams = array();
		$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
		$control[$gfName]["params"]["additionalCtrlParams"] = $additionalCtrlParams;
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	
	if($inlineedit == EDIT_INLINE)
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))
			$control[$gfName]["params"]["mode"]="inline_edit";
		$controls["controls"]['mode'] = "inline_edit";
	}
	else{
			if (!$detailKeys || !in_array($fName, $detailKeys))
				$control[$gfName]["params"]["mode"] = "edit";
			$controls["controls"]['mode'] = "edit";
		}
																																						
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$data[$fName];
		
	// category control field
	$strCategoryControl = $pageObject->isDependOnField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $pageObject->editFields))
		$vals = array($fName => @$data[$fName],$strCategoryControl => @$data[$strCategoryControl]);
	else
		$vals = array($fName => @$data[$fName]);
		
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
		$controls["controls"]['preloadData'] = $preload;
	
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker
	if($pageObject->pSet->getEditFormat($fName) == 'Time')	
		$pageObject->fillTimePickSettings($fName, $data[$fName]);
	
	if($pageObject->pSet->getViewFormat($fName) == FORMAT_MAP)	
		$pageObject->googleMapCfg['isUseGoogleMap'] = true;
		
	if($detailKeys && in_array($fName, $detailKeys) && array_key_exists($fName, $data))
	{
		$value = $pageObject->showDBValue($fName, $data);
		
		$xt->assign($gfName."_editcontrol",$value);
	}
}
//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $pageObject->jsKeys;
$pageObject->jsSettings['tableSettings'][$strTableName]['keyFields'] = $pageObject->keyFields;
$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
if($pageObject->lockingObj)
{
	$pageObject->jsSettings['tableSettings'][$strTableName]["sKeys"] = $skeys;
	$pageObject->jsSettings['tableSettings'][$strTableName]["enableCtrls"] = $enableCtrlsForEditing;
	$pageObject->jsSettings['tableSettings'][$strTableName]["confirmTime"] = $pageObject->lockingObj->ConfirmTime;
}

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && $inlineedit!=EDIT_INLINE && !isMobile())
{
	if(count($dpParams['ids']))
	{
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		$xt->assign("detail_tables",true);	
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
		$options["masterPageType"] = PAGE_EDIT;
		$options["mainMasterPageType"] = PAGE_EDIT;
		$options['masterTable'] = "karyawan";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")){
			$strTableName = "karyawan";
			continue;
		}
		
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
		$masterKeys = array();
		$mkr = 1;
		
		foreach($mKeys[$strTableName] as $mk){
			$options['masterKeysReq'][$mkr] = $data[$mk];
			$masterKeys['masterKey'.$mkr] = $data[$mk];
			$mkr++;
		}
		
		$listPageObject = ListPage::createListPage($strTableName, $options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		// show page
		if($listPageObject->isDispGrid())
		{
			//set page events
			foreach($listPageObject->eventsObject->events as $event => $name)
				$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
			
			//add detail settings to master settings
			$listPageObject->addControlsJSAndCSS();
			$listPageObject->fillSetCntrlMaps();
			
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];
			
			foreach($listPageObject->jsSettings["global"]["shortTNames"] as $tName => $shortTName){
				$pageObject->settingsMap["globalSettings"]["shortTNames"][$tName] = $shortTName;
			}
			
			$dControlsMap[$strTableName] = $listPageObject->controlsMap;
			$dControlsMap[$strTableName]['masterKeys'] = $masterKeys;
			$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
			
			$xtParams = array("method"=>'showPage', "params"=> false);
			$xtParams['object'] = $listPageObject;
			$xt->assign("displayDetailTable_".GoodFieldName($listPageObject->tName), $xtParams);
			
			$pageObject->controlsMap['dpTablesParams'][] = array('tName'=>$strTableName, 'id'=>$options['id']);
		}
		$flyId = $listPageObject->recId+1;
	}
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap; 
	$strTableName = "karyawan";
}
/////////////////////////////////////////////////////////////
//fill jsSettings and ControlsHTMLMap
$pageObject->flyId = $flyId;
$pageObject->fillSetCntrlMaps();

$pageObject->addCommonJs();

//For mobile version in apple device

if($inlineedit == EDIT_SIMPLE)
{
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	$xt->assign("body", $pageObject->body);
	$xt->assign("flybody",true);
}

if($inlineedit == EDIT_POPUP){
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("body",$pageObject->body);
}

$xt->assign("style_block",true);

$pageObject->xt->assign("legend", true);

$viewlink = "";
$viewkeys = array();
	$viewkeys["editid1"] = postvalue("editid1");
foreach($viewkeys as $key => $val)
{
	if($viewlink)
		$viewlink.="&";
	$viewlink.=$key."=".$val;
}
$xt->assign("viewlink_attrs","id=\"viewButton".$id."\" name=\"viewButton".$id."\" onclick=\"window.location.href='karyawan_view.php?".$viewlink."'\"");
if(CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && $inlineedit == EDIT_SIMPLE)
	$xt->assign("view_button",true);
else
	$xt->assign("view_button",false);

/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if($eventObj->exists("BeforeShowEdit"))
	$eventObj->BeforeShowEdit($xt,$templatefile,$data, $pageObject);

if($inlineedit != EDIT_SIMPLE)
{
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}
	
if($inlineedit == EDIT_POPUP || $inlineedit == EDIT_INLINE)
{
	if($globalEvents->exists("IsRecordEditable", $strTableName))
	{
		if(!$globalEvents->IsRecordEditable($data, true, $strTableName))
			return SecurityRedirect($inlineedit);
	}
}
if($inlineedit == EDIT_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
	if(count($pageObject->includes_css))
		$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
	if(count($pageObject->includes_cssIE))
		$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON['idStartFrom'] = $flyId + 1;
	echo (my_json_encode($returnJSON)); 
}
elseif($inlineedit == EDIT_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($pageObject->editFields as $fName)
	{
		if($detailKeys && in_array($fName, $detailKeys))
			continue;
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");
	}
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON["additionalCSS"] = $pageObject->grabAllCSSFiles();
	echo (my_json_encode($returnJSON)); 
}
else
	$xt->display($templatefile);
	
function SecurityRedirect($inlineedit)
{
	if($inlineedit == EDIT_INLINE)
	{
		echo my_json_encode(array("success" => false, "message" => "The record is not editable"));
		return;
	}
	
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: menu.php?message=expired");	
}
?>
