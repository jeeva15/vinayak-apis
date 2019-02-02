<?php

include_once $_SERVER['DOCUMENT_ROOT']."/lms/lib/init.php";

class REGISTER
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}

	function getRegistrationList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("rid","name","mobile","email","location","landline","dateadded","country","sitename","cid");
		if($_GET['cid'] != '' || $_GET['sitename'] != ''){
			if($_GET['cid'] != '')
				$whereClauseArr[] = "cid = ".$this->common->Decrypt($_GET['cid']);
			
			if($_GET['sitename'] != '')
				$whereClauseArr[] = "sitename = ".$this->common->Decrypt($_GET['sitename']);
			$whereClause = implode(" AND ",$whereClauseArr);	
		}else{
			if($_POST['hAct'] == 1){
				if($_POST['datereg'] != '')				
					$whereClauseArr[] = "dateadded >= '".$_POST['datereg']." 00:00:00' and dateadded <= '".$_POST['datereg']." 23:59:59'";
				if($_POST['sitename'] != '')
					$whereClauseArr[] = "sitename = ".$_POST['sitename'];
				
				$whereClause = implode(" AND ",$whereClauseArr);
			}
			else
				$whereClause = "dateadded >= '".date("Y-m-d")." 00:00:00' and dateadded <= '".date("Y-m-d")." 23:59:59'";
		}
		
		$res=$db->select($DBNAME["LMS"],$TABLEINFO["REGISTER"],$selectFileds,$whereClause);
		//print_r($db);
		
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
		$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("rid","name","mobile","email","location","landline","dateadded");
		$whereClause = "uid = $uid";
		$res=$db->select($DBNAME["LMS"],$TABLEINFO["REGISTER"],$selectFileds,$whereClause);
		
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
	function createRegistration($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
	
	

		$insertArr["name"]=trim($postArr["name"]);
		$insertArr["location"]=trim($postArr["city"]);
		$insertArr["email"]=trim($postArr["email"]);
		$insertArr["sitename"]=$this->common->Decrypt(trim($postArr["sn"]));
		$insertArr["country"]=trim($postArr["country"]);	
		$insertArr["mobile"]=trim($postArr["mobile"]);
		$insertArr["comments"]=trim($postArr["comments"]);
		$insertArr["cid"] = $this->common->Decrypt($_POST['id']);
		$dbm = new DB;
		$dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->insert($DBNAME["LMS"],$TABLEINFO["REGISTER"],$insertArr,1,2);
		//print_r($dbm);exit;
		$dbm->dbClose();
		if($insid != 0 || $insid != ''){
			 $clickDet['cid'] = $this->common->Decrypt($_POST['id']);
			$clickDet['unit'] = $this->common->Decrypt($_POST['unit']);
			$clickDet['sn'] = $this->common->Decrypt($_POST['sn']);
			$clickDet['country'] =$_POST['country'];
			$clickDet['rid'] = $insid;
			if($clickDet['cid'] != '')
				$this->insertLeadTrack($clickDet);
			return 1;
		}
		
		
		
		return $returnval;
	}
        function insertClickTrack($clickDet){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$insertArr["cid"]=trim($clickDet["cid"]);
		$insertArr["dimensions"]=trim($clickDet["unit"]);
		$insertArr["sitename"]=trim($clickDet["sn"]);
		$dbm = new DB;
		$dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->insert($DBNAME["LMS"],$TABLEINFO["CLICKTRACK"],$insertArr,1,2);
		//print_r($dbm);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		return $returnval;
			
        }
	function insertLeadTrack($clickDet){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$insertArr["cid"]=trim($clickDet["cid"]);
		$insertArr["dimensions"]=trim($clickDet["unit"]);
		$insertArr["rid"]=trim($clickDet["rid"]);
		$insertArr["sitename"]=trim($clickDet["sn"]);
		$insertArr["country"]=trim($clickDet["country"]);
		$dbm = new DB;
		$dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->insert($DBNAME["LMS"],$TABLEINFO["LEADTRACK"],$insertArr,1,2);
		//print_r($dbm);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		return $returnval;
			
        }
	function getProjectName($cid){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
                $selectFileds=array("projectname");
		$whereClause = "cid = ".$cid;
		$res=$db->select($DBNAME["LMS"],$TABLEINFO["CAMPAIGNS"],$selectFileds,$whereClause);
		//print_r($db);
		if($res[1] > 0){
			$Info = $db->fetchArray($res[0]);
			$returnval = $Info['projectname'];
		}
		$db->dbClose();
		return $returnval;
	}
	

}

?>

