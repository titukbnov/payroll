<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/penghasilan_variables.php");
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
$layout->blocks["top"][] = "details";$page_layouts["penghasilan_view"] = $layout;




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
	header("Location: penghasilan_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "id_penghasilan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_penghasilan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "nip";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("nip");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "gaji_pokok";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("gaji_pokok");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tunjangan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tunjangan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "insentif";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("insentif");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "bonus";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("bonus");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "thr";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("thr");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "pajak";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("pajak");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "pinjaman";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("pinjaman");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "gaji_bersih";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("gaji_bersih");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "cara_bayar";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("cara_bayar");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tanggal_bayar";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tanggal_bayar");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tanggal_transfer";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tanggal_transfer");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "nama_bank";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("nama_bank");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "nama_rekening";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("nama_rekening");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "no_rekening";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("no_rekening");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "sk_penghasilan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("sk_penghasilan");
$fieldsArr[] = $arr;

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("id_penghasilan", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_penghasilan"]));

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
//gaji_pokok - 
	
	$value = $pageObject->showDBValue("gaji_pokok", $data, $keylink);
	if($mainTableOwnerID=="gaji_pokok")
		$ownerIdValue=$value;
	$xt->assign("gaji_pokok_value",$value);
	if(!$pageObject->isAppearOnTabs("gaji_pokok"))
		$xt->assign("gaji_pokok_fieldblock",true);
	else
		$xt->assign("gaji_pokok_tabfieldblock",true);
////////////////////////////////////////////
//tunjangan - 
	
	$value = $pageObject->showDBValue("tunjangan", $data, $keylink);
	if($mainTableOwnerID=="tunjangan")
		$ownerIdValue=$value;
	$xt->assign("tunjangan_value",$value);
	if(!$pageObject->isAppearOnTabs("tunjangan"))
		$xt->assign("tunjangan_fieldblock",true);
	else
		$xt->assign("tunjangan_tabfieldblock",true);
////////////////////////////////////////////
//insentif - 
	
	$value = $pageObject->showDBValue("insentif", $data, $keylink);
	if($mainTableOwnerID=="insentif")
		$ownerIdValue=$value;
	$xt->assign("insentif_value",$value);
	if(!$pageObject->isAppearOnTabs("insentif"))
		$xt->assign("insentif_fieldblock",true);
	else
		$xt->assign("insentif_tabfieldblock",true);
////////////////////////////////////////////
//bonus - 
	
	$value = $pageObject->showDBValue("bonus", $data, $keylink);
	if($mainTableOwnerID=="bonus")
		$ownerIdValue=$value;
	$xt->assign("bonus_value",$value);
	if(!$pageObject->isAppearOnTabs("bonus"))
		$xt->assign("bonus_fieldblock",true);
	else
		$xt->assign("bonus_tabfieldblock",true);
////////////////////////////////////////////
//thr - 
	
	$value = $pageObject->showDBValue("thr", $data, $keylink);
	if($mainTableOwnerID=="thr")
		$ownerIdValue=$value;
	$xt->assign("thr_value",$value);
	if(!$pageObject->isAppearOnTabs("thr"))
		$xt->assign("thr_fieldblock",true);
	else
		$xt->assign("thr_tabfieldblock",true);
////////////////////////////////////////////
//pajak - 
	
	$value = $pageObject->showDBValue("pajak", $data, $keylink);
	if($mainTableOwnerID=="pajak")
		$ownerIdValue=$value;
	$xt->assign("pajak_value",$value);
	if(!$pageObject->isAppearOnTabs("pajak"))
		$xt->assign("pajak_fieldblock",true);
	else
		$xt->assign("pajak_tabfieldblock",true);
////////////////////////////////////////////
//pinjaman - 
	
	$value = $pageObject->showDBValue("pinjaman", $data, $keylink);
	if($mainTableOwnerID=="pinjaman")
		$ownerIdValue=$value;
	$xt->assign("pinjaman_value",$value);
	if(!$pageObject->isAppearOnTabs("pinjaman"))
		$xt->assign("pinjaman_fieldblock",true);
	else
		$xt->assign("pinjaman_tabfieldblock",true);
////////////////////////////////////////////
//gaji_bersih - 
	
	$value = $pageObject->showDBValue("gaji_bersih", $data, $keylink);
	if($mainTableOwnerID=="gaji_bersih")
		$ownerIdValue=$value;
	$xt->assign("gaji_bersih_value",$value);
	if(!$pageObject->isAppearOnTabs("gaji_bersih"))
		$xt->assign("gaji_bersih_fieldblock",true);
	else
		$xt->assign("gaji_bersih_tabfieldblock",true);
////////////////////////////////////////////
//cara_bayar - 
	
	$value = $pageObject->showDBValue("cara_bayar", $data, $keylink);
	if($mainTableOwnerID=="cara_bayar")
		$ownerIdValue=$value;
	$xt->assign("cara_bayar_value",$value);
	if(!$pageObject->isAppearOnTabs("cara_bayar"))
		$xt->assign("cara_bayar_fieldblock",true);
	else
		$xt->assign("cara_bayar_tabfieldblock",true);
////////////////////////////////////////////
//tanggal_bayar - Short Date
	
	$value = $pageObject->showDBValue("tanggal_bayar", $data, $keylink);
	if($mainTableOwnerID=="tanggal_bayar")
		$ownerIdValue=$value;
	$xt->assign("tanggal_bayar_value",$value);
	if(!$pageObject->isAppearOnTabs("tanggal_bayar"))
		$xt->assign("tanggal_bayar_fieldblock",true);
	else
		$xt->assign("tanggal_bayar_tabfieldblock",true);
////////////////////////////////////////////
//tanggal_transfer - Short Date
	
	$value = $pageObject->showDBValue("tanggal_transfer", $data, $keylink);
	if($mainTableOwnerID=="tanggal_transfer")
		$ownerIdValue=$value;
	$xt->assign("tanggal_transfer_value",$value);
	if(!$pageObject->isAppearOnTabs("tanggal_transfer"))
		$xt->assign("tanggal_transfer_fieldblock",true);
	else
		$xt->assign("tanggal_transfer_tabfieldblock",true);
////////////////////////////////////////////
//nama_bank - 
	
	$value = $pageObject->showDBValue("nama_bank", $data, $keylink);
	if($mainTableOwnerID=="nama_bank")
		$ownerIdValue=$value;
	$xt->assign("nama_bank_value",$value);
	if(!$pageObject->isAppearOnTabs("nama_bank"))
		$xt->assign("nama_bank_fieldblock",true);
	else
		$xt->assign("nama_bank_tabfieldblock",true);
////////////////////////////////////////////
//nama_rekening - 
	
	$value = $pageObject->showDBValue("nama_rekening", $data, $keylink);
	if($mainTableOwnerID=="nama_rekening")
		$ownerIdValue=$value;
	$xt->assign("nama_rekening_value",$value);
	if(!$pageObject->isAppearOnTabs("nama_rekening"))
		$xt->assign("nama_rekening_fieldblock",true);
	else
		$xt->assign("nama_rekening_tabfieldblock",true);
////////////////////////////////////////////
//no_rekening - 
	
	$value = $pageObject->showDBValue("no_rekening", $data, $keylink);
	if($mainTableOwnerID=="no_rekening")
		$ownerIdValue=$value;
	$xt->assign("no_rekening_value",$value);
	if(!$pageObject->isAppearOnTabs("no_rekening"))
		$xt->assign("no_rekening_fieldblock",true);
	else
		$xt->assign("no_rekening_tabfieldblock",true);
////////////////////////////////////////////
//sk_penghasilan - 
	
	$value = $pageObject->showDBValue("sk_penghasilan", $data, $keylink);
	if($mainTableOwnerID=="sk_penghasilan")
		$ownerIdValue=$value;
	$xt->assign("sk_penghasilan_value",$value);
	if(!$pageObject->isAppearOnTabs("sk_penghasilan"))
		$xt->assign("sk_penghasilan_fieldblock",true);
	else
		$xt->assign("sk_penghasilan_tabfieldblock",true);

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
		$options['masterTable'] = "penghasilan";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "penghasilan";
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
	$strTableName = "penghasilan";
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
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='penghasilan_edit.php?".$editlink."'\"");

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
