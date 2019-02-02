<?php

include_once "./lib/init.php";

class PROJECTS
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}

	function getProjectList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("projectName","projectStatus","projectId");
		$whereClause = "projectStatus != 9";
		$res=$db->select($dbCon, $DBNAME["LMS"],$TABLEINFO["PROJECTS"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$campaignInfo = $db->fetchArray($res[0],1);
			$returnval = $campaignInfo;
		}
		else{
			$returnval = 0; 
		}
		$db->dbClose();
		
		return $returnval;
 
		
	}
	function getActiveProjectList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("projectName","projectStatus","projectId");
		$whereClause = "projectStatus = 1";
		$res=$db->select($dbCon, $DBNAME["LMS"],$TABLEINFO["PROJECTS"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$campaignInfo = $db->fetchArray($res[0],1);
			$returnval = $campaignInfo;
		}
		else{
			$returnval = 0; 
		}
		$db->dbClose();
		
		return $returnval;
 
		
	}
	function getProjectDetails($cid){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("projectName","projectStatus","projectId");
		$whereClause = "projectId = $cid";
		$res=$db->select($dbCon,$DBNAME["LMS"],$TABLEINFO["PROJECTS"],$selectFileds,$whereClause);
		
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

	function createProject($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon=$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("projectName");
		$whereClause = "projectName = '".trim($postArr["txtName"])."' and projectStatus!=9";
		$res=$db->select($dbcon,$DBNAME["LMS"],$TABLEINFO["PROJECTS"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$returnval = 0;
		}else{
			$insertArr["projectName"]=trim($postArr["txtName"]);
			
			
			$dbm = new DB;
			$dbcon2 = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
			$insid = $dbm->insert($dbcon2,$DBNAME["LMS"],$TABLEINFO["PROJECTS"],$insertArr,1,2);
			$dbm->dbClose();
			if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
			
		}
		$db->dbClose();
		return $returnval;
	}
	
	
	function editProject($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$whereClasue = "projectId = ".$this->common->Decrypt($postArr['cid']);
		$insertArr["projectName"]=trim($postArr["txtName"]);
		$insertArr["projectStatus"]=trim($postArr["projectStatus"]);
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbcon,$DBNAME["LMS"],$TABLEINFO["PROJECTS"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	
	function deleteProject($uid){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$whereClasue = "projectId = ".$this->common->Decrypt($uid);
		
		$insertArr["projectStatus"]=9;
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbcon,$DBNAME["LMS"],$TABLEINFO["PROJECTS"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	function createVehicle($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon=$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("vehicleNumber");
		$whereClause = "vehicleNumber = '".trim($postArr["txtName"])."' and vehicleStatus!=9";
		$res=$db->select($dbcon,$DBNAME["LMS"],$TABLEINFO["VEHICLES"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$returnval = 0;
		}else{
			$insertArr["vehicleNumber"]=trim($postArr["txtName"]);
			
			
			$dbm = new DB;
			$dbcon2 = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
			$insid = $dbm->insert($dbcon2,$DBNAME["LMS"],$TABLEINFO["VEHICLES"],$insertArr,1,2);
			$dbm->dbClose();
			if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
			
		}
		$db->dbClose();
		return $returnval;
	}
	function getVehicleList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("vehicleNumber","vehicleId","vehicleStatus");
		$whereClause = "vehicleStatus != 9";
		$res=$db->select($dbCon, $DBNAME["LMS"],$TABLEINFO["VEHICLES"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$campaignInfo = $db->fetchArray($res[0],1);
			$returnval = $campaignInfo;
		}
		else{
			$returnval = 0; 
		}
		$db->dbClose();
		
		return $returnval;
 
		
	}
	function getVehicleDetails($cid){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("vehicleNumber","vehicleId","vehicleStatus");
		$whereClause = "vehicleId = $cid";
		$res=$db->select($dbCon,$DBNAME["LMS"],$TABLEINFO["VEHICLES"],$selectFileds,$whereClause);
		
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
	function editVehicle($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$whereClasue = "vehicleId = ".$this->common->Decrypt($postArr['cid']);
		$insertArr["vehicleNumber"]=trim($postArr["txtName"]);
		$insertArr["vehicleStatus"]=trim($postArr["projectStatus"]);
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbcon,$DBNAME["LMS"],$TABLEINFO["VEHICLES"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	
	function deleteVehicle($uid){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$whereClasue = "vehicleId = ".$this->common->Decrypt($uid);
		
		$insertArr["vehicleStatus"]=9;
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbcon,$DBNAME["LMS"],$TABLEINFO["VEHICLES"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
}

?>

