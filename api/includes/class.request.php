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
		
		$selectFileds=array("requestId","createdBy","notificationType","projectIdFrom","requestStatus","createdOn","projectIdTo");
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
		foreach($projectArr as $k=>$val){
			$uniqueReqId[$k] = $val["requestId"];
		}
			// pr($projectArr);
		
		$projectArr = array_unique($uniqueReqId);
		$results = [];
	
			$key = 0;
			foreach($projectArr as $k=>$value){
					$selectFileds=array("requestId","createdBy","notificationType","projectIdFrom","requestStatus","createdOn","projectIdTo");
					$whereClause = "requestId='".$value."'";
					$res2=$db->select($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$selectFileds,$whereClause);
					$listingDetails = [];
					if($res[1] > 0){
						$listingDetails = $db->fetchArray($res2[0]);          	
						
					}					
					$results[$key] = $listingDetails;
					$results[$key]["REQID"] = $this->getDONumbers($value,$requestStatus);
					$results[$key]["formattedReqID"] = $this->idGenerator($value,$listingDetails["createdOn"]);
					$key++;
			}
		
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
				$doNumbers[$dovalue["DONumber"]]["id"] = $this->idGenerator($dovalue["DONumber"], $dovalue["createdOn"]);
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
	function idfromDONumber($id){
		
		// return $month."/".sprintf("%'.04d\n", $id);
		$idArr = explode("/", $id);

		return $idArr[1];
	
	}
    function getViewDetails($listingid, $doNumberReq){
            global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		$db = new DB;
		$dbcon = $db->connect('S',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		

		$selectFileds=array("requestId","createdBy","notificationType","projectIdFrom","requestStatus","remarks","notificationNumber","createdOn","projectIdTo");
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
			$selectFileds=array("id","requestId","categoryId","subCategoryId","quantityRequested","quantityDelivered","description","DORemarks","collectionRemarks","driverId","vehicleId","driverRemarks","createdOn","requestStatus","approx");
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
        if($doNumberReq != ""){ 
			$projectArr["request"]["activeDoNumber"] = $this->idGenerator($doNumberReq, $projectArr["matRequests"][0]["createdOn"]);
		}else{
			$projectArr["request"]["activeDoNumber"] = $this->idGenerator($projectArr["matRequests"][0]["activeDoNumber"],$projectArr["matRequests"][0]["modfiedOn"]);
		}
		
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
	function generateDONumber(){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;		
 		
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
		return $DONumber;
	}
	function generateDO($postArr){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;
		
 		$listingId = $postArr["listingId"];
		$dbm = new DB;
		$dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		
		$DONumber = $this->generateDONumber();
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
			$insertArr3["DORemarks"]=trim($postArr["remarks"]);
			$insertArr3["driverId"]=trim($postArr["driverName"]);
			$insertArr3["vehicleId"]=trim($postArr["vehicleName"]);	
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
		$insertArr["requestStatus"] = $insertArr["requestStatus"];
		$insertArr["modifiedBy"] = trim($postArr["userId"]);
		// $insertArr["driverId"]=trim($postArr["driverName"]);
		// $insertArr["vehicleId"]=trim($postArr["vehicleName"]);		
		// $insertArr["DORemarks"]=trim($postArr["remarks"]);
		
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
		if($postArr[requestType] == 2){
			$insertArr["requestStatus"]=11;
		} 
		if($postArr[requestType] == 3){
			$insertArr["requestStatus"]=13;
		}		
		// $insertArr["collectionRemarks"]=trim($postArr["remarks"]);
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);
		$l = 0;
			foreach($postArr["multiCategory"] as $value){
				$insertArr2 = [];
				$uniqueId = $value["categoryId"]."-".$value["subCategoryId"]."-".$value["quantityRequested"];
				$qntyAccepted = trim($postArr[$uniqueId]);			
				if($value["quantityDelivered"] > $qntyAccepted){
					$l++;
				}
				$insertArr2["quantityAccepted"]=$qntyAccepted;
				if($postArr[requestType] == 2){
					$insertArr2["requestStatus"]=11;
				}
				else if($postArr[requestType] == 3){
					$insertArr2["requestStatus"]=13;
				}
				else{
					$insertArr2["requestStatus"]=7;
				}
				
				// $insertArr2["quantityRemaining"] = $qntityRemain - $qntyDelivered;
				// $insertArr2["activeDoNumber"] = $DONumber;
				$insertArr2["modifiedOn"] = date("Y-m-d H:i:s");
				$insertArr2["modifiedBy"] = trim($postArr["userId"]);
				$insertArr2["collectionRemarks"]=trim($postArr["remarks"]);
				
				// pr($insertArr2);
				$whereClause2 = "requestId=".$listingId." AND id=".$value["id"]." AND DONumber=".$doNumber;
				 $insid2 = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$insertArr2,$whereClause2);

				
			}
// 			error_reporting(E_ALL);
// ini_set("display_errors",1);
		// echo $l."===";
		// ini_set("SMTP","smtp.gmail.com");
		// ini_set("smtp_port","587");
		// ini_set("sendmail_from","jeevanantham.n@gmail.com");
		// if($l > 0){
		// 	// echo "inside<br>";
		// 	$to = "jeevanantham.n@gmail.com";
		// 	$subject = "Collection Notification";
		// 	$message = "There is variation between Quantity Delivered and Accepted. Details Below<br />
		// 	<strong>Request Number :</strong> ".$postArr["requestIdFormatted"]."<br /><strong>Request Number :</strong> ".$postArr["doIdFormatted"]."<br /><br />Thanks,<br />Admin.";
		// 	// echo $message;
		// 	$this->common->sendemail('admin@vk.com',$to,$subject,$message);
		// }
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
		// $insertArr["driverRemarks"]=trim($postArr["remarks"]);
		if(trim($postArr["requestType"]) == 2){
				$insertArr["requestStatus"] = 8;
		}
		if(trim($postArr["requestType"]) == 3){
				$insertArr["requestStatus"] = 10;
		}
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);

		
		
		$DONumber = trim($postArr['DOId']);
		if($DONumber != ""){
			$insertArr2["modifiedOn"] = date("Y-m-d H:i:s");
			$insertArr2["modifiedBy"] = trim($postArr["userId"]);	
			if(trim($postArr["requestType"]) == 2){
				$insertArr2["requestStatus"] = 8;
			}
			else if(trim($postArr["requestType"]) == 3){
				$insertArr2["requestStatus"] = 10;
			}
			else{
				$insertArr2["requestStatus"] = trim($postArr["requestStatus"]);
			}
			$insertArr2["driverRemarks"]=trim($postArr["remarks"]);
			
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
	
        $insertArr["projectIdFrom"]=trim($postArr["cboProjectsFrom"]);
        $insertArr["projectIdTo"]=trim($postArr["cboProjectsTo"]);
        $insertArr["description"]=trim($postArr["description"]);
        // $insertArr["driverId"]=trim($postArr["driverName"]);
        // $insertArr["vehicleId"]=trim($postArr["vehicleName"]);
        $insertArr["remarks"]=trim($postArr["txtRemarks"]);
        $insertArr["notificationNumber"]=trim($postArr["notificationNo"]);
		if(trim($postArr["notificationNo"]) != ""){
			$insertArr["transferId"] = $this->idfromDONumber($postArr["notificationNo"]);
		}
        $insertArr["notificationType"]=trim($postArr["requestType"]);
        $insertArr["modifiedOn"] = date("Y-m-d H:i:s");
        // $insertArr["requestStatus"] = trim($postArr["requestStatus"]);
		$insertArr["modifiedBy"] = trim($postArr["userId"]);
		if($postArr["requestStatus"] == 1 && ($postArr["requestType"] == 2 || $postArr["requestType"] == 3)){
        	$insertArr["requestStatus"] = 4;
		}
		else{
			$insertArr["requestStatus"] = trim($postArr["requestStatus"]);
		}
		
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$whereClause="requestId=".$listingId;
        $insid = $dbm->update($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,$whereClause);
		$insid = $dbm->delete($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$whereClause);
		$insid = $dbm->delete($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$whereClause);
		$DONumber = 0;
		if($postArr["requestType"] == 3){
			$DONumber = $this->generateDONumber();
		}
		foreach($postArr["multiCategory"] as $value){
			$insertArr2 = [];
			$insertArr2["requestId"]=$listingId;     
			$insertArr2["categoryId"]=trim($value["categoryId"]);       
			$insertArr2["subCategoryId"]=trim($value["subCategoryId"]);
			$insertArr2["quantityRequested"]=trim($value["quantityRequested"]);
			$insertArr2["quantityRemaining"]=trim($value["quantityRequested"]);
			$insertArr2["description"]=trim($value["description"]);
			$insid2 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$insertArr2,1,2);
			
			//if request type Return or transfer
			if($postArr["requestStatus"] == 1 && ($postArr["requestType"] == 2 || $postArr["requestType"] == 3)){
				$insertArr3["requestId"]=$listingId;         
				$insertArr3["categoryId"]=trim($value["categoryId"]);       
				$insertArr3["subCategoryId"]=trim($value["subCategoryId"]);
				$insertArr3["quantityRequested"]=trim($value["quantityRequested"]);
				$insertArr3["requestStatus"]= ($postArr["requestType"] == 3) ? 12 : 4;	
				// if($postArr["requestType"] == 2){
					$insertArr3["approx"]= $value["rdoApprox"];
					$insertArr3["driverId"]= (trim($postArr["driverName"]) != "")? $postArr["driverName"] : 1;
					$insertArr3["vehicleId"]= (trim($postArr["vehicleName"]) != "")? $postArr["vehicleName"] : 2;
					$insertArr3["quantityDelivered"]=trim($value["quantityRequested"]);
					$insertArr3["DONumber"]=$DONumber;
				// }
				// pr($insertArr3);
				$insertArr3["description"]=trim($value["description"]);
				$insid3 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$insertArr3,1,2);
			}
			else{
				$insid3 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["TRANSFERHISTORY"],$insertArr2,1,2);
			}
		}
		$returnval["response"] ="success";
        $returnval["responsecode"] = 1; 
		return $this->common->arrayToJson($returnval);
	}

	function createRequest($postArr){
		global $DBINFO,$TABLEINFO,$SERVERS,$DBNAME;

       
        $insertArr["projectIdFrom"]=trim($postArr["cboProjectsFrom"]);
        $insertArr["projectIdTo"]=trim($postArr["cboProjectsTo"]);
        $insertArr["description"]=trim($postArr["description"]);
        // $insertArr["driverId"]=trim($postArr["driverName"]);
        // $insertArr["vehicleId"]=trim($postArr["vehicleName"]);
        $insertArr["remarks"]=trim($postArr["txtRemarks"]);
        $insertArr["notificationNumber"]=trim($postArr["notificationNo"]);
		if(trim($postArr["notificationNo"]) != ""){
			$insertArr["transferId"] = $this->idfromDONumber($postArr["notificationNo"]);
		}
        $insertArr["notificationType"]=trim($postArr["requestType"]);
        $insertArr["createdOn"] = date("Y-m-d H:i:s");
		if($postArr["requestStatus"] == 1 && ($postArr["requestType"] == 2 || $postArr["requestType"] == 3)){
        	$insertArr["requestStatus"] = 4;
		}
		else{
			$insertArr["requestStatus"] = trim($postArr["requestStatus"]);
		}
        $insertArr["createdBy"] = trim($postArr["userId"]);
      
        
        $dbm = new DB;
        $dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
        $insid = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["REQUEST"],$insertArr,1,2);
		$DONumber = 0;
		if($postArr["requestType"] == 3){
			$DONumber = $this->generateDONumber();
		}
		foreach($postArr["multiCategory"] as $value){
			$insertArr2 = [];
			$insertArr2["requestId"]=$insid;       
			$insertArr2["categoryId"]=trim($value["categoryId"]);       
			$insertArr2["subCategoryId"]=trim($value["subCategoryId"]);
			$insertArr2["quantityRequested"]=trim($value["quantityRequested"]);
			$insertArr2["quantityRemaining"]=trim($value["quantityRequested"]);			
			$insertArr2["description"]=trim($value["description"]);
			$insid2 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["MATREQUEST"],$insertArr2,1,2);
			

			//if request type Return or transfer
			if($postArr["requestStatus"] == 1 && ($postArr["requestType"] == 2 || $postArr["requestType"] == 3)){
				$insertArr3["requestId"]=$insid;       
				$insertArr3["categoryId"]=trim($value["categoryId"]);       
				$insertArr3["subCategoryId"]=trim($value["subCategoryId"]);
				$insertArr3["quantityRequested"]=trim($value["quantityRequested"]);
				
				$insertArr3["requestStatus"]= ($postArr["requestType"] == 3) ? 12 : 4;	
				// if($postArr["requestType"] == 2){
					$insertArr3["approx"]= $value["rdoApprox"];
					$insertArr3["driverId"]= (trim($postArr["driverName"]) != "")? $postArr["driverName"] : 1;
					$insertArr3["vehicleId"]= (trim($postArr["vehicleName"]) != "")? $postArr["vehicleName"] : 2;
					$insertArr3["quantityDelivered"]=trim($value["quantityRequested"]);
					$insertArr3["DONumber"]=$DONumber;
					
				// }
				$insertArr3["description"]=trim($value["description"]);
				$insid3 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["DOGENERATIONHISTORY"],$insertArr3,1,2);
			}
			else{
				$insid3 = $dbm->insert($dbcon, $DBNAME["NAME"],$TABLEINFO["TRANSFERHISTORY"],$insertArr2,1,2);
			}
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