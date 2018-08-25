<?php
	include_once "lib/init.php";
	

class REPORTS
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
    }

    function getCurrentBalance($catId, $subCatId){

		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
 		
		$dbm = new DB;
		$dbcon = $dbm->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$selectFileds=array("currentBalance, storeBalance, storeIn, storeOut, price");
		$whereClause = "categoryId=".$catId." and subCategoryId=".$subCatId;
		$res=$dbm->select($dbcon, $DBNAME["NAME"],$TABLEINFO["SUBCATEGORY"],$selectFileds,$whereClause);
		$projectArr = [];
		if($res[1] > 0){
			$projectArr = $dbm->fetchArray($res[0]); 
			
		}
		return $this->common->arrayToJson($projectArr);

	}
	function getProjectReport($projectId){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$selectFileds=array("requestId",);
		$whereClause = "(projectIdFrom=".$projectId." and (notificationType=1 or notificationType=2)) or (projectIdTo=".$projectId." and notificationType=3)";
		$res=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$selectFileds,$whereClause);
		
		$categoryArr = [];
		$finalReport = [];
		if($res[1] > 0){
			$categoryArr = $db->fetchArray($res[0], 1);
			foreach($categoryArr as $key=>$value){
				$selectField=array("categoryId","subCategoryId","quantityAccepted","requestStatus");
				$where = "requestId=".$value["requestId"]." and (requestStatus = 7 or requestStatus = 13)";
				$res2=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$selectField,$where);
				$listingDetails = [];
				if($res[1] > 0){
					$listingDetails = $db->fetchArray($res2[0], 1);  
				
					foreach($listingDetails as $k=>$details){
						
						$uid = $details["subCategoryId"];
						$finalReport[$uid]["categoryId"] = $details["categoryId"];
						if($details["requestStatus"] == "7"){
							$finalReport[$uid]["requestedQuantity"] = $finalReport[$uid]["requestedQuantity"]+$details["quantityAccepted"];
						}
						elseif($details["requestStatus"] == "13"){
							$finalReport[$uid]["returnedQuantity"] = $finalReport[$uid]["returnedQuantity"]+$details["quantityAccepted"];
						}
						
					}
					
				}
				else{
					$finalReport=[];
				}					
			}
		}
		else{
			$finalReport=[];
		}
		// pr($finalReport);
		return $this->common->arrayToJson($finalReport);
	}
}
