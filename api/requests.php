<?php
include_once "lib/init.php";

include_once $ROOTPATH."/includes/class.request.php";



$requestObj = new REQUESTS();
 $json = file_get_contents('php://input');
 $obj = json_decode($json, true);
 if($obj["requestCode"] === 1){ //create
    $response = $requestObj->createRequest($obj);
 }
 elseif($obj["requestCode"] === 2){
     $requestStatus = $obj["requestStatus"];
     $response = $requestObj->requestDetails($requestStatus);
 }
 elseif($obj["requestCode"] === 3){
     $listingId = $obj["listingId"];
     $doNumber = $obj["DOId"];
     $response = $requestObj->getViewDetails($listingId, $doNumber);
 }
 elseif($obj["requestCode"] === 4){
     $listingId = $obj["listingId"];
     $listingStatus = $obj["approveStatus"];
     $remarks = $obj["approverComments"];
     $response = $requestObj->updateRequestStatus($listingId, $listingStatus, $remarks);
 }
 elseif($obj["requestCode"] === 5){

     $response = $requestObj->updateRequestDetails($obj);
 }
 elseif($obj["requestCode"] === 6){

     $response = $requestObj->generateDO($obj);
 }
  elseif($obj["requestCode"] === 7){

     $response = $requestObj->doApprove($obj);
 }
 elseif($obj["requestCode"] === 8){

     $response = $requestObj->collectionUpdate($obj);
 }
 elseif($obj["requestCode"] === 9){
    $requestStatus = $obj["requestStatus"];
     $response = $requestObj->getListings($requestStatus);
 }

echo $response;

?>