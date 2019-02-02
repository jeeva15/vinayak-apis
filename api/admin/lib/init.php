<?php
/*error_reporting(E_ALL);
ini_set("display_errors",1);*/

error_reporting(0);
session_start();
// echo "===".$_SERVER['DOCUMENT_ROOT'];
//Global Class includes
include_once $_SERVER['DOCUMENT_ROOT']."/api/admin/lib/class.db.php";
include_once $_SERVER['DOCUMENT_ROOT']."/api/admin/lib/class.common.php";

//Global Vars includes 
include_once $_SERVER['DOCUMENT_ROOT']."/api/admin/conf/serverip.inc";
include_once $_SERVER['DOCUMENT_ROOT']."/api/admin/conf/dbinfo.inc";
include_once $_SERVER['DOCUMENT_ROOT']."/api/admin//conf/vars.inc";

//get use sessions
$commonObj = new COMMON;
$session_name = $commonObj->getSession('lnams');
$session_id = $commonObj->getSession('lids');
$session_type = $commonObj->getSession('lutys');

function pr($arr){
	echo "<pre>";
		print_r($arr);
	echo "</pre>";
}
?>
