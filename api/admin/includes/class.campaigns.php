<?php

include_once "./lib/init.php";

class CAMPAIGNS
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}

	function getCampaignList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("categoryId","categoryName","createdOn","consumable");
		$whereClause = "categoryId != 0";
		$res=$db->select($dbCon, $DBNAME["LMS"],$TABLEINFO["CATEGORY"],$selectFileds,$whereClause);
		
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
	function getSubCategoryList(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("subCategoryId","subCategoryName","categoryId","createdOn");
		$whereClause = "categoryId != 0";
		$res=$db->select($dbCon, $DBNAME["LMS"],$TABLEINFO["SUBCATEGORY"],$selectFileds,$whereClause);
		
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

	function getSubCategoryDetails($cid){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("subCategoryId","subCategoryName","categoryId","createdOn","measurements","price","storeBalance","currentBalance");
		$whereClause = "subCategoryId = $cid";
		$res=$db->select($dbCon,$DBNAME["LMS"],$TABLEINFO["SUBCATEGORY"],$selectFileds,$whereClause);
		
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
	function getCampaignDetails($cid){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbCon = $db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("categoryId","categoryName","createdOn","consumable");
		$whereClause = "categoryId = $cid";
		$res=$db->select($dbCon,$DBNAME["LMS"],$TABLEINFO["CATEGORY"],$selectFileds,$whereClause);
		
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

	function createCampaigns($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon=$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("categoryId");
		$whereClause = "categoryName = '".trim($postArr["txtName"])."'";
		$res=$db->select($dbcon,$DBNAME["LMS"],$TABLEINFO["CATEGORY"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$returnval = 0;
		}else{
			$insertArr["categoryName"]=trim($postArr["txtName"]);
			$insertArr["consumable"]=trim($postArr["Consumable"]);
			
			$dbm = new DB;
			$dbcon2 = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
			$insid = $dbm->insert($dbcon2,$DBNAME["LMS"],$TABLEINFO["CATEGORY"],$insertArr,1,2);
			$dbm->dbClose();
			if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
			
		}
		$db->dbClose();
		return $returnval;
	}
	function createSubCategory($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon=$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("subCategoryId");
		$whereClause = "subCategoryName = '".trim($postArr["txtName"])."' and categoryId=".trim($postArr["category"]);
		$res=$db->select($dbcon,$DBNAME["LMS"],$TABLEINFO["SUBCATEGORY"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$returnval = 0;
		}else{
			$insertArr["subCategoryName"]=trim($postArr["txtName"]);
			$insertArr["categoryId"]=trim($postArr["category"]);
			$insertArr["price"]=trim($postArr["price"]);
			$insertArr["measurements"]=trim($postArr["measurement"]);
			$insertArr["storeBalance"]=trim($postArr["balance"]);
			$insertArr["currentBalance"]=trim($postArr["balance"]);
			$insertArr["createdBy"]=trim($postArr["createdBy"]);
			// pr($insertArr);exit;
			$dbm = new DB;
			$dbcon2 = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
			$insid = $dbm->insert($dbcon2,$DBNAME["LMS"],$TABLEINFO["SUBCATEGORY"],$insertArr,1,2);
			$dbm->dbClose();
			if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
			
		}
		$db->dbClose();
		return $returnval;
	}
	function editSubCategory($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$whereClasue = "subCategoryId = ".$this->common->Decrypt($postArr['cid']);
		$insertArr["subCategoryName"]=trim($postArr["txtName"]);
		$insertArr["categoryId"]=trim($postArr["category"]);
		$insertArr["price"]=trim($postArr["price"]);
		$insertArr["measurements"]=trim($postArr["measurement"]);
		$insertArr["storeBalance"]=trim($postArr["balance"]);
		// $insertArr["currentBalance"]=trim($postArr["balance"]);
			
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbcon,$DBNAME["LMS"],$TABLEINFO["SUBCATEGORY"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	
	function editCampaign($postArr){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$whereClasue = "categoryId = ".$this->common->Decrypt($postArr['cid']);
		$insertArr["categoryName"]=trim($postArr["txtName"]);
		$insertArr["consumable"]=trim($postArr["Consumable"]);
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->update($dbcon,$DBNAME["LMS"],$TABLEINFO["CATEGORY"],$insertArr,$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	
	function deleteUsers($uid){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME,$commonObj;
		
		$whereClasue = "categoryId = ".$commonObj->Decrypt($uid);
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->delete($dbcon,$DBNAME["LMS"],$TABLEINFO["CATEGORY"],$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
	function deleteSubCategory($uid){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME,$commonObj;
		
		$whereClasue = "subCategoryId = ".$commonObj->Decrypt($uid);
		
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$insid = $dbm->delete($dbcon,$DBNAME["LMS"],$TABLEINFO["SUBCATEGORY"],$whereClasue);
		$dbm->dbClose();
		if($insid == 0 || $insid == ''){ $returnval = 2; }else { $returnval = 1; }
		
		return $returnval;
	}
}

?>

