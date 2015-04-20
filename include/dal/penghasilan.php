<?php
$dalTablepenghasilan = array();
$dalTablepenghasilan["id_penghasilan"] = array("type"=>3,"varname"=>"id_penghasilan");
$dalTablepenghasilan["nip"] = array("type"=>200,"varname"=>"nip");
$dalTablepenghasilan["gaji_pokok"] = array("type"=>3,"varname"=>"gaji_pokok");
$dalTablepenghasilan["tunjangan"] = array("type"=>3,"varname"=>"tunjangan");
$dalTablepenghasilan["insentif"] = array("type"=>3,"varname"=>"insentif");
$dalTablepenghasilan["bonus"] = array("type"=>3,"varname"=>"bonus");
$dalTablepenghasilan["thr"] = array("type"=>3,"varname"=>"thr");
$dalTablepenghasilan["pajak"] = array("type"=>3,"varname"=>"pajak");
$dalTablepenghasilan["pinjaman"] = array("type"=>3,"varname"=>"pinjaman");
$dalTablepenghasilan["gaji_bersih"] = array("type"=>3,"varname"=>"gaji_bersih");
$dalTablepenghasilan["cara_bayar"] = array("type"=>129,"varname"=>"cara_bayar");
$dalTablepenghasilan["tanggal_bayar"] = array("type"=>7,"varname"=>"tanggal_bayar");
$dalTablepenghasilan["tanggal_transfer"] = array("type"=>7,"varname"=>"tanggal_transfer");
$dalTablepenghasilan["nama_bank"] = array("type"=>200,"varname"=>"nama_bank");
$dalTablepenghasilan["nama_rekening"] = array("type"=>200,"varname"=>"nama_rekening");
$dalTablepenghasilan["no_rekening"] = array("type"=>200,"varname"=>"no_rekening");
$dalTablepenghasilan["sk_penghasilan"] = array("type"=>200,"varname"=>"sk_penghasilan");
	$dalTablepenghasilan["id_penghasilan"]["key"]=true;
$dal_info["penghasilan"]=&$dalTablepenghasilan;

?>