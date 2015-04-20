<?php
$dalTablelogin = array();
$dalTablelogin["id_login"] = array("type"=>20,"varname"=>"id_login");
$dalTablelogin["username"] = array("type"=>200,"varname"=>"username");
$dalTablelogin["email"] = array("type"=>200,"varname"=>"email");
$dalTablelogin["password"] = array("type"=>200,"varname"=>"password");
$dalTablelogin["nip"] = array("type"=>20,"varname"=>"nip");
$dalTablelogin["user_level"] = array("type"=>129,"varname"=>"user_level");
$dalTablelogin["last_login"] = array("type"=>135,"varname"=>"last_login");
$dalTablelogin["last_update"] = array("type"=>135,"varname"=>"last_update");
$dalTablelogin["created"] = array("type"=>135,"varname"=>"created");
	$dalTablelogin["id_login"]["key"]=true;
$dal_info["login"]=&$dalTablelogin;

?>