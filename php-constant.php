<?php
// TABLE `users`
define("USERS","users");
function users(){
	echo USERS;
}

define("US_ID", "us_id");
define("EMAIL_US","email");
define("PASSWORD","password");
define("ROLE","role");
define("RECOVERY_QUESTION","recovery_question");

function us_id(){
	echo US_ID;
}
function email_us(){
	echo EMAIL_US;
}
function password(){
	echo PASSWORD;
}
function role(){
	echo ROLE;
}
function recovery_question(){
	echo RECOVERY_QUESTION;
}



//TABLE `program_studi`
define("PROGRAM_STUDI","program_studi");
function program__studi(){
	echo PROGRAM_STUDI;
}

define("PS_ID","ps_id");
define("NAMA_PS","nama");

function ps_id(){
	echo PS_ID;
}
function nama_ps(){
	echo NAMA_PROGRAM_STUDI;
}



//TABLE `personal detail`
define("PERSONAL_DETAIL","personal_detail");
function personal_detail(){
	echo PERSONAL_DETAIL;
}

define("PD_ID","pd_id");
define("NO_INDUK","no_induk");
define("NAMA_PD","nama");
define("ALAMAT","alamat");
define("KOTA_PD","kota");
define("PROPINSI","propinsi");
define("KODE_POS","kode_pos");
define("NO_TELPON","no_telpon");
define("EMAIL_PD","email");
define("PATH_IMAGE","path_image");

function pd_id(){
	echo PD_ID;
}
function no_induk(){
	echo NO_INDUK;
}
function nama_pd(){
	echo NAMA_PD;
}
function alamat(){
	echo ALAMAT;
}
function kota_pd(){
	echo KOTA_PD;
}
function propinsi(){
	echo PROPINSI;
}
function kode_pos(){
	echo KODE_POS;
}
function no_telpon(){
	echo NO_TELPON;
}
function email_pd(){
	echo EMAIL_PD;
}
function path_image(){
	echo PATH_IMAGE;
}



//TABLE `empoloyment_objective`
define("EMPLOYMENT_OBJECTIVE","employment_objective");
function employment_objective(){
	echo EMPLOYMENT_OBJECTIVE;
}

define("EO_ID","eo_id");
define("OBJECTIVE","objective");

function eo_id(){
	echo EO_ID;
}
function objective(){
	echo OBJECTIVE;
}



//TABLE `higher_education`
define("HIGHER_EDUCATION","higher_education");
function higher_education(){
	echo HIGHER_EDUCATION;
}

define("HE_ID","he_id");
define("PD_ID","pd_id");
define("NAMA_HE","nama");
define("KOTA_HE","kota");
define("JURUSAN","jurusan");
define("CONCENTRATION","concentration");
define("GELAR","gelar");
define("IPK","ipk");
define("TANGGAL_HE","tanggal");
define("NEGARA_HE","negara");

function he_id(){
	echo HE_ID;
}
function pd_id(){
	echo PD_ID;
}
function nama_he(){
	echo NAMA_HE;
}
function kota_he(){
	echo KOTA_HE;
}
function jurusan(){
	echo JURUSAN;
}
function concentration(){
	echo CONCENTRATION;
}
function gelar(){
	echo GELAR;
}
function ipk(){
	echo IPK;
}
function tanggal_he(){
	echo TANGGAL_HE;
}
function negara_he(){
	echo NEGARA_HE;
}



// TABLE 'compulsary'
define("COMPULSARY","compulsary");
function compulsary(){
	echo COMPULSARY;
}

define("CO_ID","co_id");
define("NAMA_CO","nama");
define("TANGGAL_CO","tanggal");

function co_id(){
	echo CO_ID;
}
function nama_co(){
	echo NAMA_CO;
}
function tanggal_co(){
	echo TANGGAL_CO;
}



// TABLE 'experience'
define("EXPERIENCE","experience");
function experience(){
	echo EXPERIENCE;
}

define("EX_ID","ex_id");
define("NAMA_PERUSAHAAN","nama_perusahaan");
define("KOTA_EX","kota");
define("NEGARA_EX","negara");
define("DETAIL_PERUSAHAAN","detail_perusahaan");
define("POSISI_EX","posisi");
define("STATUS","status");
define("DETAIL_PEKERJAAN_EX","detail_pekerjaan");
define("TANGGAL_EX","tanggal");

function ex_id(){
	echo EX_ID;
}
function nama_perusahaan(){
	echo NAMA_PERUSAHAAN;
}
function kota_ex(){
	echo KOTA_EX;
}
function detail_perusahaan(){
	echo DETAIL_PERUSAHAAN;
}
function posisi_ex(){
	echo POSISI_EX;
}
function status(){
	echo STATUS;
}
function detail_pekerjaan_ex(){
	echo DETAIL_PEKERJAAN_EX;
}
function tanggal_ex(){
	echo TANGGAL_EX;
}



// TABLE `detail_job`
define("DETAIL_JOB","detail_job");
function detail_job(){
	echo DETAIL_JOB;
}

define("DJ_ID","dj_id");
define("DETAIL_PEKERJAAN_DJ","detail_pekerjaan");

function dj_id(){
	echo DJ_ID;
}
function detail_pekerjaan_dj(){
	echo DETAIL_PEKERJAAN_DJ;
}



//TABLE `technology`
define("TECHNOLOGY","technology");
function technology(){
	echo TECHNOLOGY;
}

define("TE_ID","te_id");
define("NAMA_TEKNOLOGI","nama_teknologi");

function te_id(){
	echo TE_ID;
}
function nama_teknologi(){
	echo NAMA_TEKNOLOGI;
}



// TABLE `detail technology`
define("DETAIL_TECHNOLOGY","detail_technology");
function detail_technology(){
	echo DETAIL_TECHNOLOGY;
}

define("DT_ID","dt_id");
define("DETAIL_TEKNOLOGI","detail_teknologi");

function dt_id(){
	echo DT_ID;
}
function detail_teknologi(){
	echo DETAIL_TEKNOLOGI;
}



//TABLE `award`
define("AWARD","award");
function award(){
	echo AWARD;
}

define("AW_ID","aw_id");
define("NAMA_AW","nama");
define("TANGGAL_AW","tanggal");

function aw_id(){
	echo AW_ID;
}
function nama_aw(){
	echo NAMA_AW;
}
function tanggal_aw(){
	echo TANGGAL_AW;
}



//TABLE `language`
define("LANGUAGE","language");
function language(){
	echo language;
}

define("LG_ID","lg_id");
define("NAMA_LG","nama");

function lg_id(){
	echo LG_ID;
}
function nama_lg(){
	echo NAMA_LG;
}



//TABLE `language_test`
define("LANGUAGE_TEST","language_test");
function language_test(){
	echo LANGUAGE_TEST;
}

define("LT_ID","lt_id");
define("JENIS_TEST","jenis_test");
define("SCORE","score");

function lt_id(){
	echo LT_ID;
}
function jenis_test(){
	echo JENIS_TEST;
}
function score(){
	echo SCORE;
}



//TABLE `organization`
define("ORGANIZATION","organization");
function organization(){
	echo ORGRANIZATION;
}

define("OR_ID","or_id");
define("NAMA_OR","nama");
define("POSISI_OR","posisi");
define("DETAIL_OR","detail_organisasi");
define("TANGGAL_OR","tanggal");

function or_id(){
	echo OR_ID;
}
function nama_or(){
	echo NAMA_OR;
}
function posisi_or(){
	echo POSISI_OR;
}
function detail_or(){
	echo DETAIL_OR;
}
function tanggal_or(){
	echo TANGGAL_OR;
}



// TABLE `other_experience`
define("OTHER_EXPERIENCE","other_experience");
function other_experience(){
	echo OTHER_EXPERIENCE:
}

define("OX_ID","ox_id");
define("NAMA_OX","nama");
define("POSISI_OX","posisi");
define("DETAIL_PEKERJAAN_OX","detail_pekerjaan");
define("TANGGAL_OX","tanggal");

function ox_id(){
	echo OX_ID;
}
function nama_ox(){
	echo NAMA_OX;
}
function posisi_ox(){
	echo POSISI_OX;
}
function detail_pekerjaan_ox(){
	echo DETAIL_PEKERJAAN_OX;
}
function tanggal_ox(){
	echo TANGGAL_OX;
}



//TABLE `certification`
define("CERTIFICATION","certification");
function certification(){
	echo CERTIFICATION;
}

define("CE_ID","ce_id");
define("NAMA_CE","nama");
define("SUMBER","sumber");
define("TANGGAL_CE","tanggal");

function ce_id(){
	echo CE_ID;
}
function nama_ce(){
	echo NAMA_CE;
}
function sumber(){
	echo SUMBER;
}
function tanggal_ce(){
	echo TANGGAL_CE;
}

?> 