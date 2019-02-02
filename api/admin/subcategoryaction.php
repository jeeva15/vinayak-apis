<?php
include_once "./includes/class.campaigns.php";

/*error_reporting(E_ALL);
ini_set(display_errors,1);*/

$campaigns = new CAMPAIGNS;
if($_POST['hAct'] == 1){	
	$userresp = $campaigns->createSubCategory($_POST);
        $commonObj->RedirectTo('create-subcategory.php?i='.$userresp);
}
elseif($_POST['hAct'] == 2){
        $userresp = $campaigns->editSubCategory($_POST);
        $commonObj->RedirectTo('editsubcategory.php?ac='.$_POST['cid'].'&i='.$userresp);
}
elseif($_POST['hAct'] == 3){
        echo $userresp = $campaigns->deleteSubCategory($_POST['id']);
}



?>