<?php
include_once "./includes/class.projects.php";

/*error_reporting(E_ALL);
ini_set(display_errors,1);*/

$campaigns = new PROJECTS;
if($_POST['hAct'] == 1){	
	$userresp = $campaigns->createVehicle($_POST);
        $commonObj->RedirectTo('createvehicle.php?i='.$userresp);
}
elseif($_POST['hAct'] == 2){
        $userresp = $campaigns->editVehicle($_POST);
        $commonObj->RedirectTo('editvehicle.php?ac='.$_POST['cid'].'&i='.$userresp);
}
elseif($_POST['hAct'] == 3){
        echo $userresp = $campaigns->deleteVehicle($_POST['id']);
}



?>