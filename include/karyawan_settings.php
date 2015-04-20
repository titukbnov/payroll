<?php
require_once(getabspath("classes/cipherer.php"));
$tdatakaryawan = array();
	$tdatakaryawan[".NumberOfChars"] = 80; 
	$tdatakaryawan[".ShortName"] = "karyawan";
	$tdatakaryawan[".OwnerID"] = "";
	$tdatakaryawan[".OriginalTable"] = "karyawan";

//	field labels
$fieldLabelskaryawan = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelskaryawan["English"] = array();
	$fieldToolTipskaryawan["English"] = array();
	$fieldLabelskaryawan["English"]["nip"] = "Nip";
	$fieldToolTipskaryawan["English"]["nip"] = "";
	$fieldLabelskaryawan["English"]["nama"] = "Nama";
	$fieldToolTipskaryawan["English"]["nama"] = "";
	$fieldLabelskaryawan["English"]["jenis_kelamin"] = "Jenis Kelamin";
	$fieldToolTipskaryawan["English"]["jenis_kelamin"] = "";
	$fieldLabelskaryawan["English"]["tempat_lahir"] = "Tempat Lahir";
	$fieldToolTipskaryawan["English"]["tempat_lahir"] = "";
	$fieldLabelskaryawan["English"]["tanggal_lahir"] = "Tanggal Lahir";
	$fieldToolTipskaryawan["English"]["tanggal_lahir"] = "";
	$fieldLabelskaryawan["English"]["golongan_darah"] = "Golongan Darah";
	$fieldToolTipskaryawan["English"]["golongan_darah"] = "";
	$fieldLabelskaryawan["English"]["agama"] = "Agama";
	$fieldToolTipskaryawan["English"]["agama"] = "";
	$fieldLabelskaryawan["English"]["status_pernikahan"] = "Status Pernikahan";
	$fieldToolTipskaryawan["English"]["status_pernikahan"] = "";
	$fieldLabelskaryawan["English"]["alamat_lengkap"] = "Alamat Lengkap";
	$fieldToolTipskaryawan["English"]["alamat_lengkap"] = "";
	$fieldLabelskaryawan["English"]["telepon_rumah"] = "Telepon Rumah";
	$fieldToolTipskaryawan["English"]["telepon_rumah"] = "";
	$fieldLabelskaryawan["English"]["ponsel"] = "Ponsel";
	$fieldToolTipskaryawan["English"]["ponsel"] = "";
	$fieldLabelskaryawan["English"]["email"] = "Email";
	$fieldToolTipskaryawan["English"]["email"] = "";
	$fieldLabelskaryawan["English"]["hobi"] = "Hobi";
	$fieldToolTipskaryawan["English"]["hobi"] = "";
	$fieldLabelskaryawan["English"]["pendidikan"] = "Pendidikan";
	$fieldToolTipskaryawan["English"]["pendidikan"] = "";
	$fieldLabelskaryawan["English"]["tanggal_masuk"] = "Tanggal Masuk";
	$fieldToolTipskaryawan["English"]["tanggal_masuk"] = "";
	$fieldLabelskaryawan["English"]["status_kerja"] = "Status Kerja";
	$fieldToolTipskaryawan["English"]["status_kerja"] = "";
	$fieldLabelskaryawan["English"]["departemen"] = "Departemen";
	$fieldToolTipskaryawan["English"]["departemen"] = "";
	$fieldLabelskaryawan["English"]["organisasi"] = "Organisasi";
	$fieldToolTipskaryawan["English"]["organisasi"] = "";
	$fieldLabelskaryawan["English"]["golongan"] = "Golongan";
	$fieldToolTipskaryawan["English"]["golongan"] = "";
	$fieldLabelskaryawan["English"]["jabatan"] = "Jabatan";
	$fieldToolTipskaryawan["English"]["jabatan"] = "";
	$fieldLabelskaryawan["English"]["no_ktp"] = "No Ktp";
	$fieldToolTipskaryawan["English"]["no_ktp"] = "";
	$fieldLabelskaryawan["English"]["no_sim"] = "No Sim";
	$fieldToolTipskaryawan["English"]["no_sim"] = "";
	$fieldLabelskaryawan["English"]["no_paspor"] = "No Paspor";
	$fieldToolTipskaryawan["English"]["no_paspor"] = "";
	$fieldLabelskaryawan["English"]["no_npwp"] = "No Npwp";
	$fieldToolTipskaryawan["English"]["no_npwp"] = "";
	$fieldLabelskaryawan["English"]["no_jamsostek"] = "No Jamsostek";
	$fieldToolTipskaryawan["English"]["no_jamsostek"] = "";
	$fieldLabelskaryawan["English"]["no_asuransi"] = "No Asuransi";
	$fieldToolTipskaryawan["English"]["no_asuransi"] = "";
	$fieldLabelskaryawan["English"]["no_pensiun"] = "No Pensiun";
	$fieldToolTipskaryawan["English"]["no_pensiun"] = "";
	$fieldLabelskaryawan["English"]["pensiun"] = "Pensiun";
	$fieldToolTipskaryawan["English"]["pensiun"] = "";
	$fieldLabelskaryawan["English"]["tanggal_pensiun"] = "Tanggal Pensiun";
	$fieldToolTipskaryawan["English"]["tanggal_pensiun"] = "";
	$fieldLabelskaryawan["English"]["foto"] = "Foto";
	$fieldToolTipskaryawan["English"]["foto"] = "";
	$fieldLabelskaryawan["English"]["sk_tambahan"] = "Sk Tambahan";
	$fieldToolTipskaryawan["English"]["sk_tambahan"] = "";
	$fieldLabelskaryawan["English"]["keterangan"] = "Keterangan";
	$fieldToolTipskaryawan["English"]["keterangan"] = "";
	$fieldLabelskaryawan["English"]["id_login"] = "Id Login";
	$fieldToolTipskaryawan["English"]["id_login"] = "";
	$fieldLabelskaryawan["English"]["id_pelatihan"] = "Id Pelatihan";
	$fieldToolTipskaryawan["English"]["id_pelatihan"] = "";
	$fieldLabelskaryawan["English"]["id_penghasilan"] = "Id Penghasilan";
	$fieldToolTipskaryawan["English"]["id_penghasilan"] = "";
	$fieldLabelskaryawan["English"]["id_penilaian"] = "Id Penilaian";
	$fieldToolTipskaryawan["English"]["id_penilaian"] = "";
	$fieldLabelskaryawan["English"]["id_absensi"] = "Id Absensi";
	$fieldToolTipskaryawan["English"]["id_absensi"] = "";
	if (count($fieldToolTipskaryawan["English"]))
		$tdatakaryawan[".isUseToolTips"] = true;
}
	
	
	$tdatakaryawan[".NCSearch"] = true;



$tdatakaryawan[".shortTableName"] = "karyawan";
$tdatakaryawan[".nSecOptions"] = 0;
$tdatakaryawan[".recsPerRowList"] = 1;
$tdatakaryawan[".mainTableOwnerID"] = "";
$tdatakaryawan[".moveNext"] = 1;
$tdatakaryawan[".nType"] = 0;

$tdatakaryawan[".strOriginalTableName"] = "karyawan";




$tdatakaryawan[".showAddInPopup"] = true;

$tdatakaryawan[".showEditInPopup"] = true;

$tdatakaryawan[".showViewInPopup"] = true;

$tdatakaryawan[".fieldsForRegister"] = array();

if (!isMobile())
	$tdatakaryawan[".listAjax"] = true;
else 
	$tdatakaryawan[".listAjax"] = false;

	$tdatakaryawan[".audit"] = false;

	$tdatakaryawan[".locking"] = false;

$tdatakaryawan[".listIcons"] = true;
$tdatakaryawan[".edit"] = true;
$tdatakaryawan[".inlineEdit"] = true;
$tdatakaryawan[".inlineAdd"] = true;
$tdatakaryawan[".view"] = true;

$tdatakaryawan[".exportTo"] = true;

$tdatakaryawan[".printFriendly"] = true;

$tdatakaryawan[".delete"] = true;

$tdatakaryawan[".showSimpleSearchOptions"] = true;

$tdatakaryawan[".showSearchPanel"] = true;

if (isMobile())
	$tdatakaryawan[".isUseAjaxSuggest"] = false;
else 
	$tdatakaryawan[".isUseAjaxSuggest"] = true;

$tdatakaryawan[".rowHighlite"] = true;

// button handlers file names

$tdatakaryawan[".addPageEvents"] = false;

// use timepicker for search panel
$tdatakaryawan[".isUseTimeForSearch"] = false;



$tdatakaryawan[".useDetailsPreview"] = true;

$tdatakaryawan[".allSearchFields"] = array();

$tdatakaryawan[".allSearchFields"][] = "nip";
$tdatakaryawan[".allSearchFields"][] = "nama";
$tdatakaryawan[".allSearchFields"][] = "jenis_kelamin";
$tdatakaryawan[".allSearchFields"][] = "tempat_lahir";
$tdatakaryawan[".allSearchFields"][] = "tanggal_lahir";
$tdatakaryawan[".allSearchFields"][] = "golongan_darah";
$tdatakaryawan[".allSearchFields"][] = "agama";
$tdatakaryawan[".allSearchFields"][] = "status_pernikahan";
$tdatakaryawan[".allSearchFields"][] = "alamat_lengkap";
$tdatakaryawan[".allSearchFields"][] = "telepon_rumah";
$tdatakaryawan[".allSearchFields"][] = "ponsel";
$tdatakaryawan[".allSearchFields"][] = "email";
$tdatakaryawan[".allSearchFields"][] = "hobi";
$tdatakaryawan[".allSearchFields"][] = "pendidikan";
$tdatakaryawan[".allSearchFields"][] = "tanggal_masuk";
$tdatakaryawan[".allSearchFields"][] = "status_kerja";
$tdatakaryawan[".allSearchFields"][] = "departemen";
$tdatakaryawan[".allSearchFields"][] = "organisasi";
$tdatakaryawan[".allSearchFields"][] = "golongan";
$tdatakaryawan[".allSearchFields"][] = "jabatan";
$tdatakaryawan[".allSearchFields"][] = "no_ktp";
$tdatakaryawan[".allSearchFields"][] = "no_sim";
$tdatakaryawan[".allSearchFields"][] = "no_paspor";
$tdatakaryawan[".allSearchFields"][] = "no_npwp";
$tdatakaryawan[".allSearchFields"][] = "no_jamsostek";
$tdatakaryawan[".allSearchFields"][] = "no_asuransi";
$tdatakaryawan[".allSearchFields"][] = "no_pensiun";
$tdatakaryawan[".allSearchFields"][] = "pensiun";
$tdatakaryawan[".allSearchFields"][] = "tanggal_pensiun";
$tdatakaryawan[".allSearchFields"][] = "foto";
$tdatakaryawan[".allSearchFields"][] = "sk_tambahan";
$tdatakaryawan[".allSearchFields"][] = "keterangan";
$tdatakaryawan[".allSearchFields"][] = "id_login";
$tdatakaryawan[".allSearchFields"][] = "id_pelatihan";
$tdatakaryawan[".allSearchFields"][] = "id_penghasilan";
$tdatakaryawan[".allSearchFields"][] = "id_penilaian";
$tdatakaryawan[".allSearchFields"][] = "id_absensi";

$tdatakaryawan[".googleLikeFields"][] = "nip";
$tdatakaryawan[".googleLikeFields"][] = "nama";
$tdatakaryawan[".googleLikeFields"][] = "jenis_kelamin";
$tdatakaryawan[".googleLikeFields"][] = "tempat_lahir";
$tdatakaryawan[".googleLikeFields"][] = "tanggal_lahir";
$tdatakaryawan[".googleLikeFields"][] = "golongan_darah";
$tdatakaryawan[".googleLikeFields"][] = "agama";
$tdatakaryawan[".googleLikeFields"][] = "status_pernikahan";
$tdatakaryawan[".googleLikeFields"][] = "alamat_lengkap";
$tdatakaryawan[".googleLikeFields"][] = "telepon_rumah";
$tdatakaryawan[".googleLikeFields"][] = "ponsel";
$tdatakaryawan[".googleLikeFields"][] = "email";
$tdatakaryawan[".googleLikeFields"][] = "hobi";
$tdatakaryawan[".googleLikeFields"][] = "pendidikan";
$tdatakaryawan[".googleLikeFields"][] = "tanggal_masuk";
$tdatakaryawan[".googleLikeFields"][] = "status_kerja";
$tdatakaryawan[".googleLikeFields"][] = "departemen";
$tdatakaryawan[".googleLikeFields"][] = "organisasi";
$tdatakaryawan[".googleLikeFields"][] = "golongan";
$tdatakaryawan[".googleLikeFields"][] = "jabatan";
$tdatakaryawan[".googleLikeFields"][] = "no_ktp";
$tdatakaryawan[".googleLikeFields"][] = "no_sim";
$tdatakaryawan[".googleLikeFields"][] = "no_paspor";
$tdatakaryawan[".googleLikeFields"][] = "no_npwp";
$tdatakaryawan[".googleLikeFields"][] = "no_jamsostek";
$tdatakaryawan[".googleLikeFields"][] = "no_asuransi";
$tdatakaryawan[".googleLikeFields"][] = "no_pensiun";
$tdatakaryawan[".googleLikeFields"][] = "pensiun";
$tdatakaryawan[".googleLikeFields"][] = "tanggal_pensiun";
$tdatakaryawan[".googleLikeFields"][] = "foto";
$tdatakaryawan[".googleLikeFields"][] = "sk_tambahan";
$tdatakaryawan[".googleLikeFields"][] = "keterangan";
$tdatakaryawan[".googleLikeFields"][] = "id_login";
$tdatakaryawan[".googleLikeFields"][] = "id_pelatihan";
$tdatakaryawan[".googleLikeFields"][] = "id_penghasilan";
$tdatakaryawan[".googleLikeFields"][] = "id_penilaian";
$tdatakaryawan[".googleLikeFields"][] = "id_absensi";


$tdatakaryawan[".advSearchFields"][] = "nip";
$tdatakaryawan[".advSearchFields"][] = "nama";
$tdatakaryawan[".advSearchFields"][] = "jenis_kelamin";
$tdatakaryawan[".advSearchFields"][] = "tempat_lahir";
$tdatakaryawan[".advSearchFields"][] = "tanggal_lahir";
$tdatakaryawan[".advSearchFields"][] = "golongan_darah";
$tdatakaryawan[".advSearchFields"][] = "agama";
$tdatakaryawan[".advSearchFields"][] = "status_pernikahan";
$tdatakaryawan[".advSearchFields"][] = "alamat_lengkap";
$tdatakaryawan[".advSearchFields"][] = "telepon_rumah";
$tdatakaryawan[".advSearchFields"][] = "ponsel";
$tdatakaryawan[".advSearchFields"][] = "email";
$tdatakaryawan[".advSearchFields"][] = "hobi";
$tdatakaryawan[".advSearchFields"][] = "pendidikan";
$tdatakaryawan[".advSearchFields"][] = "tanggal_masuk";
$tdatakaryawan[".advSearchFields"][] = "status_kerja";
$tdatakaryawan[".advSearchFields"][] = "departemen";
$tdatakaryawan[".advSearchFields"][] = "organisasi";
$tdatakaryawan[".advSearchFields"][] = "golongan";
$tdatakaryawan[".advSearchFields"][] = "jabatan";
$tdatakaryawan[".advSearchFields"][] = "no_ktp";
$tdatakaryawan[".advSearchFields"][] = "no_sim";
$tdatakaryawan[".advSearchFields"][] = "no_paspor";
$tdatakaryawan[".advSearchFields"][] = "no_npwp";
$tdatakaryawan[".advSearchFields"][] = "no_jamsostek";
$tdatakaryawan[".advSearchFields"][] = "no_asuransi";
$tdatakaryawan[".advSearchFields"][] = "no_pensiun";
$tdatakaryawan[".advSearchFields"][] = "pensiun";
$tdatakaryawan[".advSearchFields"][] = "tanggal_pensiun";
$tdatakaryawan[".advSearchFields"][] = "foto";
$tdatakaryawan[".advSearchFields"][] = "sk_tambahan";
$tdatakaryawan[".advSearchFields"][] = "keterangan";
$tdatakaryawan[".advSearchFields"][] = "id_login";
$tdatakaryawan[".advSearchFields"][] = "id_pelatihan";
$tdatakaryawan[".advSearchFields"][] = "id_penghasilan";
$tdatakaryawan[".advSearchFields"][] = "id_penilaian";
$tdatakaryawan[".advSearchFields"][] = "id_absensi";

$tdatakaryawan[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main
				


$tdatakaryawan[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatakaryawan[".strOrderBy"] = $tstrOrderBy;

$tdatakaryawan[".orderindexes"] = array();

$tdatakaryawan[".sqlHead"] = "SELECT nip,   nama,   jenis_kelamin,   tempat_lahir,   tanggal_lahir,   golongan_darah,   agama,   status_pernikahan,   alamat_lengkap,   telepon_rumah,   ponsel,   email,   hobi,   pendidikan,   tanggal_masuk,   status_kerja,   departemen,   organisasi,   golongan,   jabatan,   no_ktp,   no_sim,   no_paspor,   no_npwp,   no_jamsostek,   no_asuransi,   no_pensiun,   pensiun,   tanggal_pensiun,   foto,   sk_tambahan,   keterangan,   id_login,   id_pelatihan,   id_penghasilan,   id_penilaian,   id_absensi";
$tdatakaryawan[".sqlFrom"] = "FROM karyawan";
$tdatakaryawan[".sqlWhereExpr"] = "";
$tdatakaryawan[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatakaryawan[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatakaryawan[".arrGroupsPerPage"] = $arrGPP;

$tableKeyskaryawan = array();
$tableKeyskaryawan[] = "nip";
$tdatakaryawan[".Keys"] = $tableKeyskaryawan;

$tdatakaryawan[".listFields"] = array();
$tdatakaryawan[".listFields"][] = "nip";
$tdatakaryawan[".listFields"][] = "nama";
$tdatakaryawan[".listFields"][] = "departemen";
$tdatakaryawan[".listFields"][] = "organisasi";
$tdatakaryawan[".listFields"][] = "golongan";
$tdatakaryawan[".listFields"][] = "jabatan";

$tdatakaryawan[".viewFields"] = array();
$tdatakaryawan[".viewFields"][] = "nip";
$tdatakaryawan[".viewFields"][] = "nama";
$tdatakaryawan[".viewFields"][] = "jenis_kelamin";
$tdatakaryawan[".viewFields"][] = "tempat_lahir";
$tdatakaryawan[".viewFields"][] = "tanggal_lahir";
$tdatakaryawan[".viewFields"][] = "golongan_darah";
$tdatakaryawan[".viewFields"][] = "agama";
$tdatakaryawan[".viewFields"][] = "status_pernikahan";
$tdatakaryawan[".viewFields"][] = "alamat_lengkap";
$tdatakaryawan[".viewFields"][] = "telepon_rumah";
$tdatakaryawan[".viewFields"][] = "ponsel";
$tdatakaryawan[".viewFields"][] = "email";
$tdatakaryawan[".viewFields"][] = "hobi";
$tdatakaryawan[".viewFields"][] = "pendidikan";
$tdatakaryawan[".viewFields"][] = "tanggal_masuk";
$tdatakaryawan[".viewFields"][] = "status_kerja";
$tdatakaryawan[".viewFields"][] = "departemen";
$tdatakaryawan[".viewFields"][] = "organisasi";
$tdatakaryawan[".viewFields"][] = "golongan";
$tdatakaryawan[".viewFields"][] = "jabatan";
$tdatakaryawan[".viewFields"][] = "no_ktp";
$tdatakaryawan[".viewFields"][] = "no_sim";
$tdatakaryawan[".viewFields"][] = "no_paspor";
$tdatakaryawan[".viewFields"][] = "no_npwp";
$tdatakaryawan[".viewFields"][] = "no_jamsostek";
$tdatakaryawan[".viewFields"][] = "no_asuransi";
$tdatakaryawan[".viewFields"][] = "no_pensiun";
$tdatakaryawan[".viewFields"][] = "pensiun";
$tdatakaryawan[".viewFields"][] = "tanggal_pensiun";
$tdatakaryawan[".viewFields"][] = "foto";
$tdatakaryawan[".viewFields"][] = "sk_tambahan";
$tdatakaryawan[".viewFields"][] = "keterangan";
$tdatakaryawan[".viewFields"][] = "id_login";
$tdatakaryawan[".viewFields"][] = "id_pelatihan";
$tdatakaryawan[".viewFields"][] = "id_penghasilan";
$tdatakaryawan[".viewFields"][] = "id_penilaian";
$tdatakaryawan[".viewFields"][] = "id_absensi";

$tdatakaryawan[".addFields"] = array();
$tdatakaryawan[".addFields"][] = "nip";
$tdatakaryawan[".addFields"][] = "nama";
$tdatakaryawan[".addFields"][] = "jenis_kelamin";
$tdatakaryawan[".addFields"][] = "tempat_lahir";
$tdatakaryawan[".addFields"][] = "tanggal_lahir";
$tdatakaryawan[".addFields"][] = "golongan_darah";
$tdatakaryawan[".addFields"][] = "agama";
$tdatakaryawan[".addFields"][] = "status_pernikahan";
$tdatakaryawan[".addFields"][] = "alamat_lengkap";
$tdatakaryawan[".addFields"][] = "telepon_rumah";
$tdatakaryawan[".addFields"][] = "ponsel";
$tdatakaryawan[".addFields"][] = "email";
$tdatakaryawan[".addFields"][] = "hobi";
$tdatakaryawan[".addFields"][] = "pendidikan";
$tdatakaryawan[".addFields"][] = "tanggal_masuk";
$tdatakaryawan[".addFields"][] = "status_kerja";
$tdatakaryawan[".addFields"][] = "departemen";
$tdatakaryawan[".addFields"][] = "organisasi";
$tdatakaryawan[".addFields"][] = "golongan";
$tdatakaryawan[".addFields"][] = "jabatan";
$tdatakaryawan[".addFields"][] = "no_ktp";
$tdatakaryawan[".addFields"][] = "no_sim";
$tdatakaryawan[".addFields"][] = "no_paspor";
$tdatakaryawan[".addFields"][] = "no_npwp";
$tdatakaryawan[".addFields"][] = "no_jamsostek";
$tdatakaryawan[".addFields"][] = "no_asuransi";
$tdatakaryawan[".addFields"][] = "no_pensiun";
$tdatakaryawan[".addFields"][] = "pensiun";
$tdatakaryawan[".addFields"][] = "tanggal_pensiun";
$tdatakaryawan[".addFields"][] = "foto";
$tdatakaryawan[".addFields"][] = "sk_tambahan";
$tdatakaryawan[".addFields"][] = "keterangan";
$tdatakaryawan[".addFields"][] = "id_login";
$tdatakaryawan[".addFields"][] = "id_pelatihan";
$tdatakaryawan[".addFields"][] = "id_penghasilan";
$tdatakaryawan[".addFields"][] = "id_penilaian";
$tdatakaryawan[".addFields"][] = "id_absensi";

$tdatakaryawan[".inlineAddFields"] = array();
$tdatakaryawan[".inlineAddFields"][] = "nip";
$tdatakaryawan[".inlineAddFields"][] = "nama";
$tdatakaryawan[".inlineAddFields"][] = "departemen";
$tdatakaryawan[".inlineAddFields"][] = "organisasi";
$tdatakaryawan[".inlineAddFields"][] = "golongan";
$tdatakaryawan[".inlineAddFields"][] = "jabatan";

$tdatakaryawan[".editFields"] = array();
$tdatakaryawan[".editFields"][] = "nip";
$tdatakaryawan[".editFields"][] = "nama";
$tdatakaryawan[".editFields"][] = "jenis_kelamin";
$tdatakaryawan[".editFields"][] = "tempat_lahir";
$tdatakaryawan[".editFields"][] = "tanggal_lahir";
$tdatakaryawan[".editFields"][] = "golongan_darah";
$tdatakaryawan[".editFields"][] = "agama";
$tdatakaryawan[".editFields"][] = "status_pernikahan";
$tdatakaryawan[".editFields"][] = "alamat_lengkap";
$tdatakaryawan[".editFields"][] = "telepon_rumah";
$tdatakaryawan[".editFields"][] = "ponsel";
$tdatakaryawan[".editFields"][] = "email";
$tdatakaryawan[".editFields"][] = "hobi";
$tdatakaryawan[".editFields"][] = "pendidikan";
$tdatakaryawan[".editFields"][] = "tanggal_masuk";
$tdatakaryawan[".editFields"][] = "status_kerja";
$tdatakaryawan[".editFields"][] = "departemen";
$tdatakaryawan[".editFields"][] = "organisasi";
$tdatakaryawan[".editFields"][] = "golongan";
$tdatakaryawan[".editFields"][] = "jabatan";
$tdatakaryawan[".editFields"][] = "no_ktp";
$tdatakaryawan[".editFields"][] = "no_sim";
$tdatakaryawan[".editFields"][] = "no_paspor";
$tdatakaryawan[".editFields"][] = "no_npwp";
$tdatakaryawan[".editFields"][] = "no_jamsostek";
$tdatakaryawan[".editFields"][] = "no_asuransi";
$tdatakaryawan[".editFields"][] = "no_pensiun";
$tdatakaryawan[".editFields"][] = "pensiun";
$tdatakaryawan[".editFields"][] = "tanggal_pensiun";
$tdatakaryawan[".editFields"][] = "foto";
$tdatakaryawan[".editFields"][] = "sk_tambahan";
$tdatakaryawan[".editFields"][] = "keterangan";
$tdatakaryawan[".editFields"][] = "id_login";
$tdatakaryawan[".editFields"][] = "id_pelatihan";
$tdatakaryawan[".editFields"][] = "id_penghasilan";
$tdatakaryawan[".editFields"][] = "id_penilaian";
$tdatakaryawan[".editFields"][] = "id_absensi";

$tdatakaryawan[".inlineEditFields"] = array();
$tdatakaryawan[".inlineEditFields"][] = "nip";
$tdatakaryawan[".inlineEditFields"][] = "nama";
$tdatakaryawan[".inlineEditFields"][] = "departemen";
$tdatakaryawan[".inlineEditFields"][] = "organisasi";
$tdatakaryawan[".inlineEditFields"][] = "golongan";
$tdatakaryawan[".inlineEditFields"][] = "jabatan";

$tdatakaryawan[".exportFields"] = array();
$tdatakaryawan[".exportFields"][] = "nip";
$tdatakaryawan[".exportFields"][] = "nama";
$tdatakaryawan[".exportFields"][] = "jenis_kelamin";
$tdatakaryawan[".exportFields"][] = "tempat_lahir";
$tdatakaryawan[".exportFields"][] = "tanggal_lahir";
$tdatakaryawan[".exportFields"][] = "golongan_darah";
$tdatakaryawan[".exportFields"][] = "agama";
$tdatakaryawan[".exportFields"][] = "status_pernikahan";
$tdatakaryawan[".exportFields"][] = "alamat_lengkap";
$tdatakaryawan[".exportFields"][] = "telepon_rumah";
$tdatakaryawan[".exportFields"][] = "ponsel";
$tdatakaryawan[".exportFields"][] = "email";
$tdatakaryawan[".exportFields"][] = "hobi";
$tdatakaryawan[".exportFields"][] = "pendidikan";
$tdatakaryawan[".exportFields"][] = "tanggal_masuk";
$tdatakaryawan[".exportFields"][] = "status_kerja";
$tdatakaryawan[".exportFields"][] = "departemen";
$tdatakaryawan[".exportFields"][] = "organisasi";
$tdatakaryawan[".exportFields"][] = "golongan";
$tdatakaryawan[".exportFields"][] = "jabatan";
$tdatakaryawan[".exportFields"][] = "no_ktp";
$tdatakaryawan[".exportFields"][] = "no_sim";
$tdatakaryawan[".exportFields"][] = "no_paspor";
$tdatakaryawan[".exportFields"][] = "no_npwp";
$tdatakaryawan[".exportFields"][] = "no_jamsostek";
$tdatakaryawan[".exportFields"][] = "no_asuransi";
$tdatakaryawan[".exportFields"][] = "no_pensiun";
$tdatakaryawan[".exportFields"][] = "pensiun";
$tdatakaryawan[".exportFields"][] = "tanggal_pensiun";
$tdatakaryawan[".exportFields"][] = "foto";
$tdatakaryawan[".exportFields"][] = "sk_tambahan";
$tdatakaryawan[".exportFields"][] = "keterangan";
$tdatakaryawan[".exportFields"][] = "id_login";
$tdatakaryawan[".exportFields"][] = "id_pelatihan";
$tdatakaryawan[".exportFields"][] = "id_penghasilan";
$tdatakaryawan[".exportFields"][] = "id_penilaian";
$tdatakaryawan[".exportFields"][] = "id_absensi";

$tdatakaryawan[".printFields"] = array();
$tdatakaryawan[".printFields"][] = "nip";
$tdatakaryawan[".printFields"][] = "nama";
$tdatakaryawan[".printFields"][] = "jenis_kelamin";
$tdatakaryawan[".printFields"][] = "tempat_lahir";
$tdatakaryawan[".printFields"][] = "tanggal_lahir";
$tdatakaryawan[".printFields"][] = "golongan_darah";
$tdatakaryawan[".printFields"][] = "agama";
$tdatakaryawan[".printFields"][] = "status_pernikahan";
$tdatakaryawan[".printFields"][] = "alamat_lengkap";
$tdatakaryawan[".printFields"][] = "telepon_rumah";
$tdatakaryawan[".printFields"][] = "ponsel";
$tdatakaryawan[".printFields"][] = "email";
$tdatakaryawan[".printFields"][] = "hobi";
$tdatakaryawan[".printFields"][] = "pendidikan";
$tdatakaryawan[".printFields"][] = "tanggal_masuk";
$tdatakaryawan[".printFields"][] = "status_kerja";
$tdatakaryawan[".printFields"][] = "departemen";
$tdatakaryawan[".printFields"][] = "organisasi";
$tdatakaryawan[".printFields"][] = "golongan";
$tdatakaryawan[".printFields"][] = "jabatan";
$tdatakaryawan[".printFields"][] = "no_ktp";
$tdatakaryawan[".printFields"][] = "no_sim";
$tdatakaryawan[".printFields"][] = "no_paspor";
$tdatakaryawan[".printFields"][] = "no_npwp";
$tdatakaryawan[".printFields"][] = "no_jamsostek";
$tdatakaryawan[".printFields"][] = "no_asuransi";
$tdatakaryawan[".printFields"][] = "no_pensiun";
$tdatakaryawan[".printFields"][] = "pensiun";
$tdatakaryawan[".printFields"][] = "tanggal_pensiun";
$tdatakaryawan[".printFields"][] = "foto";
$tdatakaryawan[".printFields"][] = "sk_tambahan";
$tdatakaryawan[".printFields"][] = "keterangan";

//	nip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "nip";
	$fdata["GoodName"] = "nip";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Nip"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "nip"; 
		$fdata["FullName"] = "nip";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=15";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["nip"] = $fdata;
//	nama
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "nama";
	$fdata["GoodName"] = "nama";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Nama"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "nama"; 
		$fdata["FullName"] = "nama";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["nama"] = $fdata;
//	jenis_kelamin
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "jenis_kelamin";
	$fdata["GoodName"] = "jenis_kelamin";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Jenis Kelamin"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "jenis_kelamin"; 
		$fdata["FullName"] = "jenis_kelamin";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "Pria";
	$edata["LookupValues"][] = "Wanita";
	$edata["LookupValues"][] = "Lainnya";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["jenis_kelamin"] = $fdata;
//	tempat_lahir
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "tempat_lahir";
	$fdata["GoodName"] = "tempat_lahir";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Tempat Lahir"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tempat_lahir"; 
		$fdata["FullName"] = "tempat_lahir";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["tempat_lahir"] = $fdata;
//	tanggal_lahir
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "tanggal_lahir";
	$fdata["GoodName"] = "tanggal_lahir";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Tanggal Lahir"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tanggal_lahir"; 
		$fdata["FullName"] = "tanggal_lahir";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["tanggal_lahir"] = $fdata;
//	golongan_darah
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "golongan_darah";
	$fdata["GoodName"] = "golongan_darah";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Golongan Darah"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "golongan_darah"; 
		$fdata["FullName"] = "golongan_darah";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "A";
	$edata["LookupValues"][] = "B";
	$edata["LookupValues"][] = "AB";
	$edata["LookupValues"][] = "O";
	$edata["LookupValues"][] = "A+";
	$edata["LookupValues"][] = "B+";
	$edata["LookupValues"][] = "AB+";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["golongan_darah"] = $fdata;
//	agama
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "agama";
	$fdata["GoodName"] = "agama";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Agama"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "agama"; 
		$fdata["FullName"] = "agama";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "Islam";
	$edata["LookupValues"][] = "Protestan";
	$edata["LookupValues"][] = "Katolik";
	$edata["LookupValues"][] = "Buddha";
	$edata["LookupValues"][] = "Hindu";
	$edata["LookupValues"][] = "Kon";
	$edata["LookupValues"][] = "";
	$edata["LookupValues"][] = "ju";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["agama"] = $fdata;
//	status_pernikahan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "status_pernikahan";
	$fdata["GoodName"] = "status_pernikahan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Status Pernikahan"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "status_pernikahan"; 
		$fdata["FullName"] = "status_pernikahan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "Sendiri";
	$edata["LookupValues"][] = "Menikah";
	$edata["LookupValues"][] = "Duda";
	$edata["LookupValues"][] = "Janda";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["status_pernikahan"] = $fdata;
//	alamat_lengkap
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "alamat_lengkap";
	$fdata["GoodName"] = "alamat_lengkap";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Alamat Lengkap"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "alamat_lengkap"; 
		$fdata["FullName"] = "alamat_lengkap";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["alamat_lengkap"] = $fdata;
//	telepon_rumah
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "telepon_rumah";
	$fdata["GoodName"] = "telepon_rumah";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Telepon Rumah"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "telepon_rumah"; 
		$fdata["FullName"] = "telepon_rumah";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["telepon_rumah"] = $fdata;
//	ponsel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "ponsel";
	$fdata["GoodName"] = "ponsel";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Ponsel"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ponsel"; 
		$fdata["FullName"] = "ponsel";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["ponsel"] = $fdata;
//	email
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "email";
	$fdata["GoodName"] = "email";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Email"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "email"; 
		$fdata["FullName"] = "email";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["email"] = $fdata;
//	hobi
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "hobi";
	$fdata["GoodName"] = "hobi";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Hobi"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "hobi"; 
		$fdata["FullName"] = "hobi";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["hobi"] = $fdata;
//	pendidikan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "pendidikan";
	$fdata["GoodName"] = "pendidikan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Pendidikan"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "pendidikan"; 
		$fdata["FullName"] = "pendidikan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "SD";
	$edata["LookupValues"][] = "SMP";
	$edata["LookupValues"][] = "SMA";
	$edata["LookupValues"][] = "D1";
	$edata["LookupValues"][] = "D2";
	$edata["LookupValues"][] = "D3";
	$edata["LookupValues"][] = "D4";
	$edata["LookupValues"][] = "S1";
	$edata["LookupValues"][] = "S2";
	$edata["LookupValues"][] = "S3";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["pendidikan"] = $fdata;
//	tanggal_masuk
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "tanggal_masuk";
	$fdata["GoodName"] = "tanggal_masuk";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Tanggal Masuk"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tanggal_masuk"; 
		$fdata["FullName"] = "tanggal_masuk";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["tanggal_masuk"] = $fdata;
//	status_kerja
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "status_kerja";
	$fdata["GoodName"] = "status_kerja";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Status Kerja"; 
	$fdata["FieldType"] = 129;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "status_kerja"; 
		$fdata["FullName"] = "status_kerja";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "Kontrak";
	$edata["LookupValues"][] = "Honorer";
	$edata["LookupValues"][] = "Tetap";
	$edata["LookupValues"][] = "PNS";
	$edata["LookupValues"][] = "OutSource";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["status_kerja"] = $fdata;
//	departemen
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "departemen";
	$fdata["GoodName"] = "departemen";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Departemen"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "departemen"; 
		$fdata["FullName"] = "departemen";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["departemen"] = $fdata;
//	organisasi
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "organisasi";
	$fdata["GoodName"] = "organisasi";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Organisasi"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "organisasi"; 
		$fdata["FullName"] = "organisasi";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["organisasi"] = $fdata;
//	golongan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "golongan";
	$fdata["GoodName"] = "golongan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Golongan"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "golongan"; 
		$fdata["FullName"] = "golongan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["golongan"] = $fdata;
//	jabatan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "jabatan";
	$fdata["GoodName"] = "jabatan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Jabatan"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "jabatan"; 
		$fdata["FullName"] = "jabatan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["jabatan"] = $fdata;
//	no_ktp
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "no_ktp";
	$fdata["GoodName"] = "no_ktp";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Ktp"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_ktp"; 
		$fdata["FullName"] = "no_ktp";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_ktp"] = $fdata;
//	no_sim
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 22;
	$fdata["strName"] = "no_sim";
	$fdata["GoodName"] = "no_sim";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Sim"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_sim"; 
		$fdata["FullName"] = "no_sim";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_sim"] = $fdata;
//	no_paspor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 23;
	$fdata["strName"] = "no_paspor";
	$fdata["GoodName"] = "no_paspor";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Paspor"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_paspor"; 
		$fdata["FullName"] = "no_paspor";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_paspor"] = $fdata;
//	no_npwp
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 24;
	$fdata["strName"] = "no_npwp";
	$fdata["GoodName"] = "no_npwp";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Npwp"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_npwp"; 
		$fdata["FullName"] = "no_npwp";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_npwp"] = $fdata;
//	no_jamsostek
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 25;
	$fdata["strName"] = "no_jamsostek";
	$fdata["GoodName"] = "no_jamsostek";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Jamsostek"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_jamsostek"; 
		$fdata["FullName"] = "no_jamsostek";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_jamsostek"] = $fdata;
//	no_asuransi
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 26;
	$fdata["strName"] = "no_asuransi";
	$fdata["GoodName"] = "no_asuransi";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Asuransi"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_asuransi"; 
		$fdata["FullName"] = "no_asuransi";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_asuransi"] = $fdata;
//	no_pensiun
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 27;
	$fdata["strName"] = "no_pensiun";
	$fdata["GoodName"] = "no_pensiun";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "No Pensiun"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "no_pensiun"; 
		$fdata["FullName"] = "no_pensiun";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["no_pensiun"] = $fdata;
//	pensiun
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 28;
	$fdata["strName"] = "pensiun";
	$fdata["GoodName"] = "pensiun";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Pensiun"; 
	$fdata["FieldType"] = 16;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "pensiun"; 
		$fdata["FullName"] = "pensiun";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Checkbox");
	
		
		
		
			
		
		
		
		
		
		
		
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Checkbox");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["pensiun"] = $fdata;
//	tanggal_pensiun
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 29;
	$fdata["strName"] = "tanggal_pensiun";
	$fdata["GoodName"] = "tanggal_pensiun";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Tanggal Pensiun"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tanggal_pensiun"; 
		$fdata["FullName"] = "tanggal_pensiun";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["tanggal_pensiun"] = $fdata;
//	foto
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 30;
	$fdata["strName"] = "foto";
	$fdata["GoodName"] = "foto";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Foto"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "foto"; 
		$fdata["FullName"] = "foto";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["foto"] = $fdata;
//	sk_tambahan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 31;
	$fdata["strName"] = "sk_tambahan";
	$fdata["GoodName"] = "sk_tambahan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Sk Tambahan"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "sk_tambahan"; 
		$fdata["FullName"] = "sk_tambahan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["sk_tambahan"] = $fdata;
//	keterangan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 32;
	$fdata["strName"] = "keterangan";
	$fdata["GoodName"] = "keterangan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Keterangan"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "keterangan"; 
		$fdata["FullName"] = "keterangan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["keterangan"] = $fdata;
//	id_login
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 33;
	$fdata["strName"] = "id_login";
	$fdata["GoodName"] = "id_login";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Id Login"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_login"; 
		$fdata["FullName"] = "id_login";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["id_login"] = $fdata;
//	id_pelatihan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 34;
	$fdata["strName"] = "id_pelatihan";
	$fdata["GoodName"] = "id_pelatihan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Id Pelatihan"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_pelatihan"; 
		$fdata["FullName"] = "id_pelatihan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["id_pelatihan"] = $fdata;
//	id_penghasilan
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 35;
	$fdata["strName"] = "id_penghasilan";
	$fdata["GoodName"] = "id_penghasilan";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Id Penghasilan"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_penghasilan"; 
		$fdata["FullName"] = "id_penghasilan";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["id_penghasilan"] = $fdata;
//	id_penilaian
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 36;
	$fdata["strName"] = "id_penilaian";
	$fdata["GoodName"] = "id_penilaian";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Id Penilaian"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_penilaian"; 
		$fdata["FullName"] = "id_penilaian";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["id_penilaian"] = $fdata;
//	id_absensi
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 37;
	$fdata["strName"] = "id_absensi";
	$fdata["GoodName"] = "id_absensi";
	$fdata["ownerTable"] = "karyawan";
	$fdata["Label"] = "Id Absensi"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "id_absensi"; 
		$fdata["FullName"] = "id_absensi";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatakaryawan["id_absensi"] = $fdata;

	
$tables_data["karyawan"]=&$tdatakaryawan;
$field_labels["karyawan"] = &$fieldLabelskaryawan;
$fieldToolTips["karyawan"] = &$fieldToolTipskaryawan;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["karyawan"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="absensi";
	$detailsParam["dDataSourceTable"]="absensi";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="absensi";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 0;
	$detailsParam["previewOnEdit"]= 0;
	$detailsParam["previewOnView"]= 0;
		
	$detailsTablesData["karyawan"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["karyawan"][$dIndex]["masterKeys"][]="nip";
		$detailsTablesData["karyawan"][$dIndex]["detailKeys"][]="nip";

$dIndex = 2-1;
			$strOriginalDetailsTable="pelatihan";
	$detailsParam["dDataSourceTable"]="pelatihan";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="pelatihan";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 0;
	$detailsParam["previewOnEdit"]= 0;
	$detailsParam["previewOnView"]= 0;
		
	$detailsTablesData["karyawan"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["karyawan"][$dIndex]["masterKeys"][]="nip";
		$detailsTablesData["karyawan"][$dIndex]["detailKeys"][]="nip";

$dIndex = 3-1;
			$strOriginalDetailsTable="penghasilan";
	$detailsParam["dDataSourceTable"]="penghasilan";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="penghasilan";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 0;
	$detailsParam["previewOnEdit"]= 0;
	$detailsParam["previewOnView"]= 0;
		
	$detailsTablesData["karyawan"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["karyawan"][$dIndex]["masterKeys"][]="nip";
		$detailsTablesData["karyawan"][$dIndex]["detailKeys"][]="nip";

$dIndex = 4-1;
			$strOriginalDetailsTable="penilaian";
	$detailsParam["dDataSourceTable"]="penilaian";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="penilaian";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 0;
	$detailsParam["previewOnEdit"]= 0;
	$detailsParam["previewOnView"]= 0;
		
	$detailsTablesData["karyawan"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["karyawan"][$dIndex]["masterKeys"][]="nip";
		$detailsTablesData["karyawan"][$dIndex]["detailKeys"][]="nip";

	
// tables which are master tables for current table (detail)
$masterTablesData["karyawan"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_karyawan()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "nip,   nama,   jenis_kelamin,   tempat_lahir,   tanggal_lahir,   golongan_darah,   agama,   status_pernikahan,   alamat_lengkap,   telepon_rumah,   ponsel,   email,   hobi,   pendidikan,   tanggal_masuk,   status_kerja,   departemen,   organisasi,   golongan,   jabatan,   no_ktp,   no_sim,   no_paspor,   no_npwp,   no_jamsostek,   no_asuransi,   no_pensiun,   pensiun,   tanggal_pensiun,   foto,   sk_tambahan,   keterangan,   id_login,   id_pelatihan,   id_penghasilan,   id_penilaian,   id_absensi";
$proto0["m_strFrom"] = "FROM karyawan";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = null;
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "nip",
	"m_strTable" => "karyawan"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "nama",
	"m_strTable" => "karyawan"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "jenis_kelamin",
	"m_strTable" => "karyawan"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "tempat_lahir",
	"m_strTable" => "karyawan"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "tanggal_lahir",
	"m_strTable" => "karyawan"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "golongan_darah",
	"m_strTable" => "karyawan"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "agama",
	"m_strTable" => "karyawan"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "status_pernikahan",
	"m_strTable" => "karyawan"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "alamat_lengkap",
	"m_strTable" => "karyawan"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "telepon_rumah",
	"m_strTable" => "karyawan"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "ponsel",
	"m_strTable" => "karyawan"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "email",
	"m_strTable" => "karyawan"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "hobi",
	"m_strTable" => "karyawan"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "pendidikan",
	"m_strTable" => "karyawan"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "tanggal_masuk",
	"m_strTable" => "karyawan"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "status_kerja",
	"m_strTable" => "karyawan"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "departemen",
	"m_strTable" => "karyawan"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
			$obj = new SQLField(array(
	"m_strName" => "organisasi",
	"m_strTable" => "karyawan"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
			$obj = new SQLField(array(
	"m_strName" => "golongan",
	"m_strTable" => "karyawan"
));

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto43=array();
			$obj = new SQLField(array(
	"m_strName" => "jabatan",
	"m_strTable" => "karyawan"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
			$obj = new SQLField(array(
	"m_strName" => "no_ktp",
	"m_strTable" => "karyawan"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
			$obj = new SQLField(array(
	"m_strName" => "no_sim",
	"m_strTable" => "karyawan"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
						$proto49=array();
			$obj = new SQLField(array(
	"m_strName" => "no_paspor",
	"m_strTable" => "karyawan"
));

$proto49["m_expr"]=$obj;
$proto49["m_alias"] = "";
$obj = new SQLFieldListItem($proto49);

$proto0["m_fieldlist"][]=$obj;
						$proto51=array();
			$obj = new SQLField(array(
	"m_strName" => "no_npwp",
	"m_strTable" => "karyawan"
));

$proto51["m_expr"]=$obj;
$proto51["m_alias"] = "";
$obj = new SQLFieldListItem($proto51);

$proto0["m_fieldlist"][]=$obj;
						$proto53=array();
			$obj = new SQLField(array(
	"m_strName" => "no_jamsostek",
	"m_strTable" => "karyawan"
));

$proto53["m_expr"]=$obj;
$proto53["m_alias"] = "";
$obj = new SQLFieldListItem($proto53);

$proto0["m_fieldlist"][]=$obj;
						$proto55=array();
			$obj = new SQLField(array(
	"m_strName" => "no_asuransi",
	"m_strTable" => "karyawan"
));

$proto55["m_expr"]=$obj;
$proto55["m_alias"] = "";
$obj = new SQLFieldListItem($proto55);

$proto0["m_fieldlist"][]=$obj;
						$proto57=array();
			$obj = new SQLField(array(
	"m_strName" => "no_pensiun",
	"m_strTable" => "karyawan"
));

$proto57["m_expr"]=$obj;
$proto57["m_alias"] = "";
$obj = new SQLFieldListItem($proto57);

$proto0["m_fieldlist"][]=$obj;
						$proto59=array();
			$obj = new SQLField(array(
	"m_strName" => "pensiun",
	"m_strTable" => "karyawan"
));

$proto59["m_expr"]=$obj;
$proto59["m_alias"] = "";
$obj = new SQLFieldListItem($proto59);

$proto0["m_fieldlist"][]=$obj;
						$proto61=array();
			$obj = new SQLField(array(
	"m_strName" => "tanggal_pensiun",
	"m_strTable" => "karyawan"
));

$proto61["m_expr"]=$obj;
$proto61["m_alias"] = "";
$obj = new SQLFieldListItem($proto61);

$proto0["m_fieldlist"][]=$obj;
						$proto63=array();
			$obj = new SQLField(array(
	"m_strName" => "foto",
	"m_strTable" => "karyawan"
));

$proto63["m_expr"]=$obj;
$proto63["m_alias"] = "";
$obj = new SQLFieldListItem($proto63);

$proto0["m_fieldlist"][]=$obj;
						$proto65=array();
			$obj = new SQLField(array(
	"m_strName" => "sk_tambahan",
	"m_strTable" => "karyawan"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "";
$obj = new SQLFieldListItem($proto65);

$proto0["m_fieldlist"][]=$obj;
						$proto67=array();
			$obj = new SQLField(array(
	"m_strName" => "keterangan",
	"m_strTable" => "karyawan"
));

$proto67["m_expr"]=$obj;
$proto67["m_alias"] = "";
$obj = new SQLFieldListItem($proto67);

$proto0["m_fieldlist"][]=$obj;
						$proto69=array();
			$obj = new SQLField(array(
	"m_strName" => "id_login",
	"m_strTable" => "karyawan"
));

$proto69["m_expr"]=$obj;
$proto69["m_alias"] = "";
$obj = new SQLFieldListItem($proto69);

$proto0["m_fieldlist"][]=$obj;
						$proto71=array();
			$obj = new SQLField(array(
	"m_strName" => "id_pelatihan",
	"m_strTable" => "karyawan"
));

$proto71["m_expr"]=$obj;
$proto71["m_alias"] = "";
$obj = new SQLFieldListItem($proto71);

$proto0["m_fieldlist"][]=$obj;
						$proto73=array();
			$obj = new SQLField(array(
	"m_strName" => "id_penghasilan",
	"m_strTable" => "karyawan"
));

$proto73["m_expr"]=$obj;
$proto73["m_alias"] = "";
$obj = new SQLFieldListItem($proto73);

$proto0["m_fieldlist"][]=$obj;
						$proto75=array();
			$obj = new SQLField(array(
	"m_strName" => "id_penilaian",
	"m_strTable" => "karyawan"
));

$proto75["m_expr"]=$obj;
$proto75["m_alias"] = "";
$obj = new SQLFieldListItem($proto75);

$proto0["m_fieldlist"][]=$obj;
						$proto77=array();
			$obj = new SQLField(array(
	"m_strName" => "id_absensi",
	"m_strTable" => "karyawan"
));

$proto77["m_expr"]=$obj;
$proto77["m_alias"] = "";
$obj = new SQLFieldListItem($proto77);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto79=array();
$proto79["m_link"] = "SQLL_MAIN";
			$proto80=array();
$proto80["m_strName"] = "karyawan";
$proto80["m_columns"] = array();
$proto80["m_columns"][] = "nip";
$proto80["m_columns"][] = "nama";
$proto80["m_columns"][] = "jenis_kelamin";
$proto80["m_columns"][] = "tempat_lahir";
$proto80["m_columns"][] = "tanggal_lahir";
$proto80["m_columns"][] = "golongan_darah";
$proto80["m_columns"][] = "agama";
$proto80["m_columns"][] = "status_pernikahan";
$proto80["m_columns"][] = "alamat_lengkap";
$proto80["m_columns"][] = "telepon_rumah";
$proto80["m_columns"][] = "ponsel";
$proto80["m_columns"][] = "email";
$proto80["m_columns"][] = "hobi";
$proto80["m_columns"][] = "pendidikan";
$proto80["m_columns"][] = "tanggal_masuk";
$proto80["m_columns"][] = "status_kerja";
$proto80["m_columns"][] = "departemen";
$proto80["m_columns"][] = "organisasi";
$proto80["m_columns"][] = "golongan";
$proto80["m_columns"][] = "jabatan";
$proto80["m_columns"][] = "no_ktp";
$proto80["m_columns"][] = "no_sim";
$proto80["m_columns"][] = "no_paspor";
$proto80["m_columns"][] = "no_npwp";
$proto80["m_columns"][] = "no_jamsostek";
$proto80["m_columns"][] = "no_asuransi";
$proto80["m_columns"][] = "no_pensiun";
$proto80["m_columns"][] = "pensiun";
$proto80["m_columns"][] = "tanggal_pensiun";
$proto80["m_columns"][] = "foto";
$proto80["m_columns"][] = "sk_tambahan";
$proto80["m_columns"][] = "keterangan";
$proto80["m_columns"][] = "id_login";
$proto80["m_columns"][] = "id_pelatihan";
$proto80["m_columns"][] = "id_penghasilan";
$proto80["m_columns"][] = "id_penilaian";
$proto80["m_columns"][] = "id_absensi";
$obj = new SQLTable($proto80);

$proto79["m_table"] = $obj;
$proto79["m_alias"] = "";
$proto81=array();
$proto81["m_sql"] = "";
$proto81["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto81["m_column"]=$obj;
$proto81["m_contained"] = array();
$proto81["m_strCase"] = "";
$proto81["m_havingmode"] = "0";
$proto81["m_inBrackets"] = "0";
$proto81["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto81);

$proto79["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto79);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_karyawan = createSqlQuery_karyawan();
																																					$tdatakaryawan[".sqlquery"] = $queryData_karyawan;
	
if(isset($tdatakaryawan["field2"])){
	$tdatakaryawan["field2"]["LookupTable"] = "carscars_view";
	$tdatakaryawan["field2"]["LookupOrderBy"] = "name";
	$tdatakaryawan["field2"]["LookupType"] = 4;
	$tdatakaryawan["field2"]["LinkField"] = "email";
	$tdatakaryawan["field2"]["DisplayField"] = "name";
	$tdatakaryawan[".hasCustomViewField"] = true;
}

$tableEvents["karyawan"] = new eventsBase;
$tdatakaryawan[".hasEvents"] = false;

$cipherer = new RunnerCipherer("karyawan");

?>