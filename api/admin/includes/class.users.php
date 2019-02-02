<?php

include_once "./lib/init.php";
include_once "./includes/class.projects.php";

class USERS extends PROJECTS
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}

	function getUsersList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("userId","Name","userType","userName","projects");
		$whereClause = "userId != 0";
		$res=$db->select($dbcon,$DBNAME["LMS"],$TABLEINFO["USERS"],$selectFileds,$whereClause);
	
		if($res[1] > 0){
			$userInfo = $db->fetchArray($res[0],1);
			$returnval = $userInfo;
		}
		else{
			$returnval = 0; 
		}
		$db->dbClose();
		
		return $returnval;
 
		
	}
	function getUserDetails($uid){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("userId","Name","userType","userName","projects");
		$whereClause = "userId = $uid";
		$res=$db->select($dbcon, $DBNAME["LMS"],$TABLEINFO["USERS"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$userInfo = $db->fetchArray($res[0]);
			$returnval = $userInfo;
		}
		else{
			$returnval = 0; 
		}
		$db->dbClose();
		
		return $returnval;
 
		
	}
	function createUsers($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("userId");
		$whereClause = "userName = '".trim($postArr["txtUsername"])."'";
		$res=$db->select($dbCon, $DBNAME["LMS"],$TABLEINFO["USERS"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$returnval = 0;
		}else{
			$insertArr["userName"]=trim($postArr["txtUsername"]);
			$insertArr["Name"]=trim($postArr["txtName"]);
			$insertArr["password"]=md5(trim($postArr["txtPassword"]));
			
			// if(trim($postArr["txtMobileno"]) != "")
			// 	$insertArr["mobileno"]=trim($postArr["txtMobileno"]);
			$insertArr["userType"]=trim($postArr["selUsertype"]);
			$insertArr["createdBy"]=trim($postArr["createdBy"]);
			if($postArr["selUsertype"] == 5){
				$insertArr["projects"]=implode(",",$postArr["projects"]);
			}
			$dbm = new DB;
			$dbCon2 = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
			$insid = $dbm->insert($dbCon2, $DBNAME["LMS"],$TABLEINFO["USERS"],$insertArr,1,2);
			$dbm->dbClose();
			if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
			
		}
		$db->dbClose();
		return $returnval;
	}
	
	function editUsers($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		
		$whereClasue = "userId = ".$this->common->Decrypt($postArr['uid']);
		
		$insertArr["userName"]=trim($postArr["txtUsername"]);
		$insertArr["Name"]=trim($postArr["txtName"]);
		
		if($postArr["selUsertype"] == 5){
			$insertArr["projects"]=implode(",",$postArr["projects"]);
		}
		if($postArr["txtPassword"] != "")
			$insertArr["password"]=md5(trim($postArr["txtPassword"]));
		// if(trim($postArr["txtEmail"]) != '')
		// 	$insertArr["email"]=trim($postArr["txtEmail"]);
		// if(trim($postArr["txtMobileno"]) != "")
		// 	$insertArr["mobileno"]=trim($postArr["txtMobileno"]);
		$insertArr["userType"]=trim($postArr["selUsertype"]);
		$dbm = new DB;
		$dbCon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbCon, $DBNAME["LMS"],$TABLEINFO["USERS"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	
	function deleteUsers($uid){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME,$commonObj;
		
		$whereClasue = "userId = ".$commonObj->Decrypt($uid);
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->delete($dbcon,$DBNAME["LMS"],$TABLEINFO["USERS"],$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
}

?>

