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
		$dbcon = $dbm->connect('M',$DBNAME["NAME"],$DBINFO["USERNAME"],$DBINFO["PASSWORD"]);
		$selectFileds=array("currentBalance, storeBalance, storeIn, storeOut, price");
		$whereClause = "categoryId=".$catId." and subCategoryId=".$subCatId;
		$res=$dbm->select($dbcon, $DBNAME["NAME"],$TABLEINFO["SUBCATEGORY"],$selectFileds,$whereClause);
		$projectArr = [];
		if($res[1] > 0){
			$projectArr = $dbm->fetchArray($res[0]); 
			
		}
		return $this->common->arrayToJson($projectArr);

	}
}
