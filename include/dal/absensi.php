<?php
$dalTableabsensi = array();
$dalTableabsensi["id_absensi"] = array("type"=>3,"varname"=>"id_absensi");
$dalTableabsensi["nip"] = array("type"=>200,"varname"=>"nip");
$dalTableabsensi["tanggal_absen"] = array("type"=>7,"varname"=>"tanggal_absen");
$dalTableabsensi["jam_masuk"] = array("type"=>134,"varname"=>"jam_masuk");
$dalTableabsensi["jam_keluar"] = array("type"=>134,"varname"=>"jam_keluar");
$dalTableabsensi["status_masuk"] = array("type"=>129,"varname"=>"status_masuk");
$dalTableabsensi["status_keluar"] = array("type"=>129,"varname"=>"status_keluar");
$dalTableabsensi["ket"] = array("type"=>200,"varname"=>"ket");
$dalTableabsensi["terlambat"] = array("type"=>129,"varname"=>"terlambat");
	$dalTableabsensi["id_absensi"]["key"]=true;
$dal_info["absensi"]=&$dalTableabsensi;

?>