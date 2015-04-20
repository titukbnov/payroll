<?php
$dalTableusers = array();
$dalTableusers["id"] = array("type"=>20,"varname"=>"id");
$dalTableusers["username"] = array("type"=>200,"varname"=>"username");
$dalTableusers["email"] = array("type"=>200,"varname"=>"email");
$dalTableusers["password"] = array("type"=>200,"varname"=>"password");
$dalTableusers["user_level"] = array("type"=>129,"varname"=>"user_level");
$dalTableusers["last_login"] = array("type"=>135,"varname"=>"last_login");
$dalTableusers["last_update"] = array("type"=>135,"varname"=>"last_update");
$dalTableusers["created"] = array("type"=>135,"varname"=>"created");
	$dalTableusers["id"]["key"]=true;
$dal_info["users"]=&$dalTableusers;

?>