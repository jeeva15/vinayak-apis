<?php
	include "./lib/init.php";

class LOGIN
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}

	function checkLogin($username,$password){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("userId","Name","userType");
		$whereClause = "userName='$username' AND password='".md5($password)."'";
		$res=$db->select($dbcon,$DBNAME["LMS"],$TABLEINFO["USERS"],$selectFileds,$whereClause);

		if($res[1] > 0){
			$userInfo = $db->fetchArray($res[0]);
			$this->common->setSession("lids", $userInfo['userId']);
			$this->common->setSession("lnams", $userInfo['Name']);
			$this->common->setSession("lutys", $userInfo['userType']);
			$this->common->RedirectTo('home.php');
		}
		else{
			return 0; //invalid login
		}
 
		
	}
}

?>
