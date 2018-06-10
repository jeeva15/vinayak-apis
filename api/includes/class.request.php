<?php
	include_once "lib/init.php";
	

class REQUESTS
{
	public $common;

	function __construct(){
		global $commonObj;
		$this->common = $commonObj;
	}
    function requestDetails($requestStatus){
// 		error_reporting(E_ALL);
// ini_set("display_errors",1);
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("requestId","createdBy","notificationType","projectIdFrom","requestStatus","createdOn");
		$whereClause = "requestStatus=".$requestStatus." order by requestId desc";
		$res=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$selectFileds,$whereClause);
		
		$projectArr = [];
		if($res[1] > 0){
			$projectArr = $db->fetchArray($res[0], 1);          	
			
		}
		else{
			$projectArr = []; 
		}

		$results = $projectArr;
		// if($requestStatus == "3"){
			foreach($projectArr as $key=>$value){
					
					$results[$key] = $value;
					// $results[$key]["REQID"] = $this->getDONumbers($value["requestId"]);
					$results[$key]["formattedReqID"] = $this->idGenerator($value["requestId"],$value["createdOn"]);
			}
		// }
		// pr($results);
 		// $results[$key]["REQID"] = 
		return $this->common->arrayToJson($results);
	}
	function getListings($requestStatus){
		
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$selectFileds=array("requestId");
		$whereClause = "requestStatus=".$requestStatus." order by requestId desc";
		$res=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$selectFileds,$whereClause);
		
		$projectArr = [];
		if($res[1] > 0){
			$projectArr = $db->fetchArray($res[0], 1);          	
			
		}
		else{
			$projectArr = []; 
		}
		$projectArr = array_unique($projectArr);
		$results = [];
		$listingids = [];
		// if($requestStatus == "3"){
			foreach($projectArr as $key=>$value){
					$selectFileds=array("requestId","createdBy","notificationType","projectIdFrom","requestStatus","createdOn");
					$whereClause = "requestId='".$value["requestId"]."'";
					$res2=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$selectFileds,$whereClause);
					$listingDetails = [];
					if($res[1] > 0){
						$listingDetails = $db->fetchArray($res2[0]);          	
						
					}					
					$results[$key] = $listingDetails;
					$results[$key]["REQID"] = $this->getDONumbers($value["requestId"],$requestStatus);
					$results[$key]["formattedReqID"] = $this->idGenerator($value["requestId"],$listingDetails["createdOn"]);
					$listingids[$key] = $value["requestId"];
			}
		// }
		// pr($results);
 		// $results[$key]["REQID"] = 
		return $this->common->arrayToJson($results);

	}
	
	function getDONumbers($requestId, $requestStatus){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$selectFileds=array("DONumber","createdOn","requestStatus");
		$whereClause = "requestId=".$requestId." AND requestStatus=".$requestStatus;
		$res1=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$selectFileds,$whereClause);
		$doNumbers = [];
		if($res1[1] > 0){
			$doresult = $db->fetchArray($res1[0], 1);		
			$i = 0;
			foreach($doresult as $dovalue){
				$doNumbers[$dovalue["DONumber"]]["id"] = $this->idGenerator($dovalue["DONumber"], $dovalue["modfiedOn"]);
				$doNumbers[$dovalue["DONumber"]]["requestStatus"] =$dovalue["requestStatus"];
				$i++;
			}
		}
		return $doNumbers;
	}
	function idGenerator($id, $date){
		$month = date("m", strtotime($date));
		return $month."/".sprintf("%'.04d\n", $id);
	
	}
    function getViewDetails($listingid, $doNumberReq){
            global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		

		$selectFileds=array("requestId","createdBy","notificationType","projectIdFrom","requestStatus","remarks","approx","notificationNumber","driverId","vehicleId","createdOn","DORemarks");
		$whereClause = "requestId='".$listingid."'";
		$res=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$selectFileds,$whereClause);
		
		$projectArr = [];
		if($res[1] > 0){
			$projectArr["request"] = $db->fetchArray($res[0]); 
		}
		else{
			$projectArr["request"] = []; //invalid login
		}
        $projectArr["request"]["REQID"] = $this->idGenerator($projectArr["request"]["requestId"], $projectArr["request"]["createdOn"]);
		if($doNumberReq != ""){ //particular DO details
			$selectFileds=array("id","requestId","categoryId","subCategoryId","quantityRequested","quantityDelivered","description");
			 $whereClause = "requestId=".$listingid." AND DONumber=".trim($doNumberReq);
			$res=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$selectFileds,$whereClause);

		}else{
			$selectFileds=array("id","categoryId","subCategoryId","quantityRequested","quantityDelivered","description","activeDoNumber","quantityRemaining","quantityAccepted","modfiedOn");
			 $whereClause = "requestId=".$listingid;
			$res=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$selectFileds,$whereClause);
		}
		
	
		if($res[1] > 0){
			$projectArr["matRequests"] = $db->fetchArray($res[0], 1); 
		}
		else{
			$projectArr["matRequests"] = []; //invalid login
		}
        
		$projectArr["request"]["activeDoNumber"] = $this->idGenerator($projectArr["matRequests"][0]["activeDoNumber"],$projectArr["matRequests"][0]["modfiedOn"]);
		return $this->common->arrayToJson($projectArr);
    }
	function updateRequestStatus($listingId, $listingStatus, $remarks){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;

		$dbm = new DB;
		$updateArr["requestStatus"]=trim($listingStatus);
		$updateArr["approverComments"] = trim($remarks);
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$updateArr,$whereClause);
		$returnval["response"] ="success";
        $returnval["responsecode"] = 1; 
		return $this->common->arrayToJson($returnval);
	}
	function generateDO($postArr){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		
 		$listingId = $postArr["listingId"];
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$selectFileds=array("max(DONumber) as DOno");
		$whereClause = "requestId!='0'";
		$res=$dbm->select($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$selectFileds,$whereClause);
		$DONumber = 1;
		$projectArr = [];
		if($res[1] > 0){
			$projectArr = $dbm->fetchArray($res[0]); 
			$DONumber = $projectArr["DOno"]+1;
		}
		
		$whereClause2 = "requestId =".$listingId;
		$updid = $dbm->delete($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$whereClause2);
		// $updateArr["active"]=0;
		// $insid2 = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$updateArr,$whereClause);
		
		$j = 0;
		$i = 0;
		foreach($postArr["multiCategory"] as $value){
			$insertArr2 = [];
			$uniqueId = $value["categoryId"]."-".$value["subCategoryId"]."-".$value["quantityRequested"];
			$qntyDelivered = trim($postArr[$uniqueId]);
			$qntityRemain = $postArr[$uniqueId."remain"];
			$remain = $qntityRemain - $qntyDelivered;
			$j++;
			if($remain == 0){
				$i++; 
			}
			$insertArr2["requestId"]=$listingId;     
			$insertArr2["categoryId"]=trim($value["categoryId"]);       
			$insertArr2["subCategoryId"]=trim($value["subCategoryId"]);
			$insertArr2["quantityRequested"]=trim($value["quantityRequested"]);
			$insertArr2["quantityDelivered"]=$qntyDelivered;
			$insertArr2["quantityAccepted"]=$qntyDelivered;
			$insertArr2["description"] = trim($value["description"]);
			$insertArr2["quantityRemaining"] = $remain;
			$insertArr2["activeDoNumber"] = $DONumber;
			$insertArr2["modfiedOn"] = date("Y-m-d H:i:s");
			// pr($insertArr2);
			$insid2 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$insertArr2,$whereClause);

			$insertArr3["requestId"]=$listingId;     
			$insertArr3["categoryId"]=trim($value["categoryId"]);       
			$insertArr3["subCategoryId"]=trim($value["subCategoryId"]);			
			$insertArr3["quantityRequested"]=trim($value["quantityRequested"]);
			$insertArr3["quantityDelivered"]=$qntyDelivered;	
			$insertArr3["description"]=trim($value["description"]);			
			$insertArr3["DONumber"] = $DONumber;
			$insid2 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$insertArr3,$whereClause);
		}
		//update driver details
		$updateArr = [];
		if($i == $j){
			$insertArr["requestStatus"] = 4;
		}
		else{
			$insertArr["requestStatus"] = 3;
			
		}
		$insertArr["modifiedOn"] = date("Y-m-d H:i:s");
		$insertArr["requestStatus"] = $updateArr["requestStatus"];
		$insertArr["modifiedBy"] = trim($postArr["userId"]);
		$insertArr["driverId"]=trim($postArr["driverName"]);
		$insertArr["vehicleId"]=trim($postArr["vehicleName"]);		
		$insertArr["DORemarks"]=trim($postArr["remarks"]);
		
		$whereClause="requestId=".$listingId;
		$insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);
		$updateArr["requestStatus"]=4;
		$whereClauseUpdate = "requestId=".$listingId." AND DONumber=".$DONumber;
		$insid2 = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$updateArr,$whereClauseUpdate);
		$returnval["response"] ="success";
		$returnval["responsecode"] = 1; 
		return $this->common->arrayToJson($returnval);
		
	}
	function collectionUpdate($postArr){

		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
 		$listingId = $postArr["listingId"];
		 $doNumber = $postArr["DOId"];
		$dbm = new DB;
		$insertArr["modifiedOn"] = date("Y-m-d H:i:s");
        // $insertArr["requestStatus"] = trim($postArr["requestStatus"]);
		$insertArr["modifiedBy"] = trim($postArr["userId"]);		 		
		$insertArr["collectionRemarks"]=trim($postArr["remarks"]);
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);
		
			foreach($postArr["multiCategory"] as $value){
				$insertArr2 = [];
				$uniqueId = $value["categoryId"]."-".$value["subCategoryId"]."-".$value["quantityRequested"];
				$qntyAccepted = trim($postArr[$uniqueId]);			
				
				$insertArr2["quantityAccepted"]=$qntyAccepted;
				$insertArr2["requestStatus"]=7;
				// $insertArr2["quantityRemaining"] = $qntityRemain - $qntyDelivered;
				// $insertArr2["activeDoNumber"] = $DONumber;
				$insertArr2["modifiedOn"] = date("Y-m-d H:i:s");
				$insertArr["modifiedBy"] = trim($postArr["userId"]);
				
				// pr($insertArr2);
				$whereClause2 = "requestId=".$listingId." AND id=".$value["id"]." AND DONumber=".$doNumber;
				 $insid2 = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$insertArr2,$whereClause2);

				
			}
		
			$returnval["response"] ="success";
			$returnval["responsecode"] = 1; 
			return $this->common->arrayToJson($returnval);
		
	}
	function doApprove($postArr){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
 		$listingId = $postArr["listingId"];
		$dbm = new DB;
	
        $insertArr["modifiedOn"] = date("Y-m-d H:i:s");
        // $insertArr["requestStatus"] = trim($postArr["requestStatus"]);
		$insertArr["modifiedBy"] = trim($postArr["userId"]);		 		
		$insertArr["driverRemarks"]=trim($postArr["remarks"]);
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);

		
		
		$DONumber = trim($postArr['DOId']);
		if($DONumber != ""){
			$insertArr2["modifiedOn"] = date("Y-m-d H:i:s");
			$insertArr2["modifiedBy"] = trim($postArr["userId"]);	
			$insertArr2["requestStatus"] = trim($postArr["requestStatus"]);
			
			$whereClause="requestId=".$listingId." AND DONumber=".$DONumber;
			$insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$insertArr2,$whereClause);
		}
		
		$returnval["response"] ="success";
        $returnval["responsecode"] = 1; 
		return $this->common->arrayToJson($returnval);
	}
	function updateRequestDetails($postArr){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
 		$listingId = $postArr["listingId"];
		$dbm = new DB;
		$insertArr["notificationType"]=trim($postArr["cboProjectsFrom"]);
        $insertArr["projectIdFrom"]=trim($postArr["cboProjectsFrom"]);
        $insertArr["projectIdTo"]=trim($postArr["cboProjectsTo"]);
        $insertArr["description"]=trim($postArr["description"]);
        $insertArr["driverId"]=trim($postArr["driverName"]);
        $insertArr["vehicleId"]=trim($postArr["vehicleName"]);
        $insertArr["remarks"]=trim($postArr["txtRemarks"]);
        $insertArr["notificationNumber"]=trim($postArr["notificationNo"]);
        $insertArr["notificationType"]=trim($postArr["requestType"]);
        $insertArr["modifiedOn"] = date("Y-m-d H:i:s");
        $insertArr["requestStatus"] = trim($postArr["requestStatus"]);
		$insertArr["modifiedBy"] = trim($postArr["userId"]);
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);
		$insid = $dbm->delete($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$whereClause);
		foreach($postArr["multiCategory"] as $value){
			$insertArr2 = [];
			$insertArr2["requestId"]=$listingId;     
			$insertArr2["categoryId"]=trim($value["categoryId"]);       
			$insertArr2["subCategoryId"]=trim($value["subCategoryId"]);
			$insertArr2["quantityRequested"]=trim($value["quantityRequested"]);
			$insertArr2["quantityRemaining"]=trim($value["quantityRequested"]);
			$insertArr2["description"]=trim($value["description"]);
			$insid2 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$insertArr2,$whereClause);
		}
		$returnval["response"] ="success";
        $returnval["responsecode"] = 1; 
		return $this->common->arrayToJson($returnval);
	}

	function createRequest($postArr){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;

        $insertArr["notificationType"]=trim($postArr["cboProjectsFrom"]);
        $insertArr["projectIdFrom"]=trim($postArr["cboProjectsFrom"]);
        $insertArr["projectIdTo"]=trim($postArr["cboProjectsTo"]);
        $insertArr["description"]=trim($postArr["description"]);
        $insertArr["driverId"]=trim($postArr["driverName"]);
        $insertArr["vehicleId"]=trim($postArr["vehicleName"]);
        $insertArr["remarks"]=trim($postArr["txtRemarks"]);
        $insertArr["notificationNumber"]=trim($postArr["notificationNo"]);
        $insertArr["notificationType"]=trim($postArr["requestType"]);
        $insertArr["createdOn"] = date("Y-m-d H:i:s");
        $insertArr["requestStatus"] = trim($postArr["requestStatus"]);
        $insertArr["createdBy"] = trim($postArr["userId"]);
      
        
        $dbm = new DB;
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
        $insid = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,1,2);
		foreach($postArr["multiCategory"] as $value){
			$insertArr2 = [];
			$insertArr2["requestId"]=$insid;       
			$insertArr2["categoryId"]=trim($value["categoryId"]);       
			$insertArr2["subCategoryId"]=trim($value["subCategoryId"]);
			$insertArr2["quantityRequested"]=trim($value["quantityRequested"]);
			$insertArr2["quantityRemaining"]=trim($value["quantityRequested"]);			
			$insertArr2["description"]=trim($value["description"]);
			$insid2 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$insertArr2,1,2);
		}
        $dbm->dbClose();
        if($insid == 0 || $insid == ''){ 
            $returnval["response"] ="fail";
               $returnval["responsecode"] = 0; 
        }else { 
            
            $returnval["response"] ="success";
            $returnval["responsecode"] = 1; 
            
            }
			
		
		
		return $this->common->arrayToJson($returnval);
	}
}

?>