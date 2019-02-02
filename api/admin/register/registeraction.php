<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lms/includes/class.register.php";

error_reporting(E_ALL);
ini_set(display_errors,1);

$register = new REGISTER;
if($_POST['hAct'] == 1){
        $clickDet['cid'] = $commonObj->Decrypt($_POST['id']);
        $clickDet['unit'] = $commonObj->Decrypt($_POST['unit']);
	$clickDet['sn'] = $commonObj->Decrypt($_POST['sn']);
	echo $register->insertClickTrack($clickDet);
       
}
elseif($_POST['hAct'] == 2){
        $userresp = $register->createRegistration($_POST);
        echo "1";
}



?>