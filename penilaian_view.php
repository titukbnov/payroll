<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/penilaian_variables.php");
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
$layout->blocks["top"][] = "details";$page_layouts["penilaian_view"] = $layout;




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
	header("Location: penilaian_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "id_penilaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("id_penilaian");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "nip";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("nip");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "sk_penilaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("sk_penilaian");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "periode_penilaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("periode_penilaian");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "judul_penilaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("judul_penilaian");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "indikator_a";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("indikator_a");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "indikator_b";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("indikator_b");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "indikator_c";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("indikator_c");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "indikator_d";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("indikator_d");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "indikator_e";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("indikator_e");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "satuan";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("satuan");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "sasaran";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("sasaran");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "pencapaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("pencapaian");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "hasil_penilaian";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("hasil_penilaian");
$fieldsArr[] = $arr;

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("id_penilaian", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_penilaian"]));

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
//sk_penilaian - 
	
	$value = $pageObject->showDBValue("sk_penilaian", $data, $keylink);
	if($mainTableOwnerID=="sk_penilaian")
		$ownerIdValue=$value;
	$xt->assign("sk_penilaian_value",$value);
	if(!$pageObject->isAppearOnTabs("sk_penilaian"))
		$xt->assign("sk_penilaian_fieldblock",true);
	else
		$xt->assign("sk_penilaian_tabfieldblock",true);
////////////////////////////////////////////
//periode_penilaian - Short Date
	
	$value = $pageObject->showDBValue("periode_penilaian", $data, $keylink);
	if($mainTableOwnerID=="periode_penilaian")
		$ownerIdValue=$value;
	$xt->assign("periode_penilaian_value",$value);
	if(!$pageObject->isAppearOnTabs("periode_penilaian"))
		$xt->assign("periode_penilaian_fieldblock",true);
	else
		$xt->assign("periode_penilaian_tabfieldblock",true);
////////////////////////////////////////////
//judul_penilaian - 
	
	$value = $pageObject->showDBValue("judul_penilaian", $data, $keylink);
	if($mainTableOwnerID=="judul_penilaian")
		$ownerIdValue=$value;
	$xt->assign("judul_penilaian_value",$value);
	if(!$pageObject->isAppearOnTabs("judul_penilaian"))
		$xt->assign("judul_penilaian_fieldblock",true);
	else
		$xt->assign("judul_penilaian_tabfieldblock",true);
////////////////////////////////////////////
//indikator_a - 
	
	$value = $pageObject->showDBValue("indikator_a", $data, $keylink);
	if($mainTableOwnerID=="indikator_a")
		$ownerIdValue=$value;
	$xt->assign("indikator_a_value",$value);
	if(!$pageObject->isAppearOnTabs("indikator_a"))
		$xt->assign("indikator_a_fieldblock",true);
	else
		$xt->assign("indikator_a_tabfieldblock",true);
////////////////////////////////////////////
//indikator_b - 
	
	$value = $pageObject->showDBValue("indikator_b", $data, $keylink);
	if($mainTableOwnerID=="indikator_b")
		$ownerIdValue=$value;
	$xt->assign("indikator_b_value",$value);
	if(!$pageObject->isAppearOnTabs("indikator_b"))
		$xt->assign("indikator_b_fieldblock",true);
	else
		$xt->assign("indikator_b_tabfieldblock",true);
////////////////////////////////////////////
//indikator_c - 
	
	$value = $pageObject->showDBValue("indikator_c", $data, $keylink);
	if($mainTableOwnerID=="indikator_c")
		$ownerIdValue=$value;
	$xt->assign("indikator_c_value",$value);
	if(!$pageObject->isAppearOnTabs("indikator_c"))
		$xt->assign("indikator_c_fieldblock",true);
	else
		$xt->assign("indikator_c_tabfieldblock",true);
////////////////////////////////////////////
//indikator_d - 
	
	$value = $pageObject->showDBValue("indikator_d", $data, $keylink);
	if($mainTableOwnerID=="indikator_d")
		$ownerIdValue=$value;
	$xt->assign("indikator_d_value",$value);
	if(!$pageObject->isAppearOnTabs("indikator_d"))
		$xt->assign("indikator_d_fieldblock",true);
	else
		$xt->assign("indikator_d_tabfieldblock",true);
////////////////////////////////////////////
//indikator_e - 
	
	$value = $pageObject->showDBValue("indikator_e", $data, $keylink);
	if($mainTableOwnerID=="indikator_e")
		$ownerIdValue=$value;
	$xt->assign("indikator_e_value",$value);
	if(!$pageObject->isAppearOnTabs("indikator_e"))
		$xt->assign("indikator_e_fieldblock",true);
	else
		$xt->assign("indikator_e_tabfieldblock",true);
////////////////////////////////////////////
//satuan - 
	
	$value = $pageObject->showDBValue("satuan", $data, $keylink);
	if($mainTableOwnerID=="satuan")
		$ownerIdValue=$value;
	$xt->assign("satuan_value",$value);
	if(!$pageObject->isAppearOnTabs("satuan"))
		$xt->assign("satuan_fieldblock",true);
	else
		$xt->assign("satuan_tabfieldblock",true);
////////////////////////////////////////////
//sasaran - 
	
	$value = $pageObject->showDBValue("sasaran", $data, $keylink);
	if($mainTableOwnerID=="sasaran")
		$ownerIdValue=$value;
	$xt->assign("sasaran_value",$value);
	if(!$pageObject->isAppearOnTabs("sasaran"))
		$xt->assign("sasaran_fieldblock",true);
	else
		$xt->assign("sasaran_tabfieldblock",true);
////////////////////////////////////////////
//pencapaian - 
	
	$value = $pageObject->showDBValue("pencapaian", $data, $keylink);
	if($mainTableOwnerID=="pencapaian")
		$ownerIdValue=$value;
	$xt->assign("pencapaian_value",$value);
	if(!$pageObject->isAppearOnTabs("pencapaian"))
		$xt->assign("pencapaian_fieldblock",true);
	else
		$xt->assign("pencapaian_tabfieldblock",true);
////////////////////////////////////////////
//hasil_penilaian - 
	
	$value = $pageObject->showDBValue("hasil_penilaian", $data, $keylink);
	if($mainTableOwnerID=="hasil_penilaian")
		$ownerIdValue=$value;
	$xt->assign("hasil_penilaian_value",$value);
	if(!$pageObject->isAppearOnTabs("hasil_penilaian"))
		$xt->assign("hasil_penilaian_fieldblock",true);
	else
		$xt->assign("hasil_penilaian_tabfieldblock",true);

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
		$options['masterTable'] = "penilaian";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "penilaian";
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
	$strTableName = "penilaian";
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
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='penilaian_edit.php?".$editlink."'\"");

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
