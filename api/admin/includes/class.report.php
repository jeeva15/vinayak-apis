<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/lms/lib/init.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/lms/includes/class.campaigns.php";
        
class REPORT extends CAMPAIGNS
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}

	function getCampaignReport(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME,$_BANNERDIMENSIONS;
		$db = new DB;
		$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
                $selectFileds=array("campaign_name",'dimensions');
		$whereClause = "cid = ".$cid;
		$res=$db->select($DBNAME["LMS"],$TABLEINFO["CAMPAIGNS"],$selectFileds,$whereClause);
		
		if($res[1] > 0){
			$Info = $db->fetchArray($res[0]);
			$returnval['name'] = $Info['campaign_name']." (".$_BANNERDIMENSIONS[$Info['dimensions']].")";
		}
                
		$selectFileds=array("count(1) as cnt","cid");
		if($_POST['campaign'] != "" && $_POST['campaign'] != "0")
			$whereClauseArr[] = "cid = ".$_POST['campaign'];
		if($_POST['sitename'] != "" && $_POST['sitename'] != "0")
			$whereClauseArr[] = "sitename = ".$_POST['sitename'];
		
		$whereClause = implode(" AND ",$whereClauseArr);
		$whereClause .= " GROUP BY cid";
		$resclick=$db->select($DBNAME["LMS"],$TABLEINFO["CLICKTRACK"],$selectFileds,$whereClause);
	
		if($resclick[1] > 0){
			$clickInfo = $db->fetchArray($resclick[0],1);
			$returnval['click'] = $clickInfo;
		}
                else{
                    $returnval['click'] = 0;
                }
       
		//$whereClause = "cid = ".$cid;
		$reslead=$db->select($DBNAME["LMS"],$TABLEINFO["LEADTRACK"],$selectFileds,$whereClause);
		
		if($reslead[1] > 0){
			$leadInfo = $db->fetchArray($reslead[0],1);
			$returnval['lead'] = $leadInfo;
		}
                else{
                    $returnval['lead'] = 0;
                }
               return $returnval;

		
	}
        
        function getUnitReport(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME,$_BANNERDIMENSIONS;
		$db = new DB;
		$db->connect('S',$DBNAME["LMS"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
               
                
		$selectFileds=array("count(1) as cnt");
		$whereClause = "cid = ".$cid;
		$resclick=$db->select($DBNAME["LMS"],$TABLEINFO["CLICKTRACK"],$selectFileds,$whereClause);
		
		if($resclick[1] > 0){
			$clickInfo = $db->fetchArray($resclick[0]);
			$returnval['click'] = $clickInfo['cnt'];
		}
                else{
                    $returnval['click'] = 0;
                }
       
		$whereClause = "cid = ".$cid;
		$reslead=$db->select($DBNAME["LMS"],$TABLEINFO["LEADTRACK"],$selectFileds,$whereClause);
		
		if($reslead[1] > 0){
			$leadInfo = $db->fetchArray($reslead[0]);
			$returnval['lead'] = $leadInfo['cnt'];
		}
                else{
                    $returnval['lead'] = 0;
                }
               return $returnval;

		
	}
        
}

?>