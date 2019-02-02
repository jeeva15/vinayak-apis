<?php
include_once "./includes/class.campaigns.php";

/*error_reporting(E_ALL);
ini_set(display_errors,1);*/

$campaigns = new CAMPAIGNS;
if($_POST['hAct'] == 1){	
	$userresp = $campaigns->createCampaigns($_POST);
        $commonObj->RedirectTo('createcampaigns.php?i='.$userresp);
}
elseif($_POST['hAct'] == 2){
        $userresp = $campaigns->editCampaign($_POST);
        $commonObj->RedirectTo('editcampaigns.php?ac='.$_POST['cid'].'&i='.$userresp);
}
elseif($_POST['hAct'] == 3){
        echo $userresp = $campaigns->deleteUsers($_POST['id']);
}



?>