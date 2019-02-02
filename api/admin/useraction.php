<?php
include_once "./includes/class.users.php";
if(trim($session_type) != 1){
	echo "You do not have access this page.";
	exit;
}

$users = new USERS;
if($_POST['hAct'] == 1){	
	$userresp = $users->createUsers($_POST);
        $commonObj->RedirectTo('createusers.php?i='.$userresp);
}
elseif($_POST['hAct'] == 2){
        $userresp = $users->editUsers($_POST);
        $commonObj->RedirectTo('editusers.php?ac='.$_POST['uid'].'&i='.$userresp);
}
elseif($_POST['hAct'] == 3){
        echo $userresp = $users->deleteUsers($_POST['id']);
}



?>