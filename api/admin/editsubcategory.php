
<?php
include_once "./includes/class.campaigns.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

$campaign = new CAMPAIGNS;
$cid = $commonObj->Decrypt($_GET['ac']);
$campaigndetails = $campaign->getSubCategoryDetails($cid);
if($_GET['i'] == "1")
	$success = "Sub Category edited successfully";
elseif($_GET['i'] == "2")
	$error = "Updated Successfully";
elseif($_GET['i'] == "0")
	$error = "Category name already exists.";	
	
	$campaignlist = $campaign->getCampaignList();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Create User ::</title>
	<style>
		@import "css/style.css";
		@import "css/validate.css";		
	</style>

	<style>
	.multiple_chk {height: 140px; width:  250px; padding: 5px; overflow: auto; font-size:12px; border: 1px solid #ccc;}
	</style>

</head>
<body>
<center>
	<div><strong class="bigtxt">Edit Sub Category</strong></div>
	<div align="center">
		<br>
            <form name="frmuser" id="frmuser" method="post" action="subcategoryaction.php">
		<input type="hidden" name="hAct" value="2">
		<input type="hidden" name="cid" value="<?php echo $_GET['ac'];?>">         
                <div class="mediumtxt boldtxt errortxt" align="center"><?php echo $error;?></div>
	        <div class="mediumtxt boldtxt successtxt" align="center"><?php echo $success;?></div>
                <table cellpadding="0" cellspacing="0" border="0" class="mediumtxt">			
                    <tr>	
			    <td colspan="2">&nbsp;</td>
                            <td></td>				
                    </tr>
					<tr>
                            <td align="right">Sub Category Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtName" id="txtName" value="<?php echo $campaigndetails["subCategoryName"]?>" style="width:250px;" maxlength="60"></td>
					</tr>
					<tr>
                            <td align="right">Category Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><select name="category" id="category" onchange="return chkUserType(this.value);">
                                    <option value="">-Select-</option>
				    <?php
				    foreach($campaignlist as $key=>$values){
				    ?>
					   <option <?php if($campaigndetails["categoryId"] == $values["categoryId"]) echo "selected";?> value="<?php echo $values["categoryId"];?>"><?php echo $values["categoryName"]?></option>
				
				    <?php }?>
                                </select></td>
					</tr>
					
					
					<tr>
                            <td align="right">In Stock<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="number" name="balance" id="balance" value="<?php echo $campaigndetails["storeBalance"]?>" style="width:250px;" maxlength="60"></td>
					</tr>
					<tr>
                            <td align="right">Price<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="number" name="price" id="price" value="<?php echo $campaigndetails["price"]?>" style="width:250px;" maxlength="60"></td>
					</tr>
					<tr>
                            <td align="right">Measurement<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><select name="measurement" id="measurement" onchange="return chkUserType(this.value);">
                                    <option value="">-Select-</option>
				    <?php
				    foreach($_MEASUREMENTS as $key=>$values){
				    ?>
					   <option <?php if($campaigndetails["measurements"] == $key) echo "selected";?> value="<?php echo $key;?>"><?php echo $values?></option>
				
				    <?php }?>
                                </select></td>
					</tr>
		   
		    
					   
		    
                    <tr>
			    <td colspan="2"></td>
                            <td><input type="submit" name="sbnAddUser" id="sbnAddUser" value="Submit" class="button"></td>				
                    </tr>
                </table>
            </form>		
	</div>

		
</center>
	<script language="javascript" src="js/jquery.js"></script>
	<script language="javascript" src="js/validate.js?i=1"></script>

	<script language="javascript">	
		var toValidateElem = {
			'txtName' : new Array('empty',true),
			'category' : new Array('empty',true),
			'price' : new Array('empty,positive',true),			
			'balance' : new Array('empty,positive',true),
			'measurement' : new Array('empty',true)
		}
		var toDisplayError = {
			'empty' : 'Must not be empty',
			'positive' : 'Must be positive number'
		}
		var _formId = "frmuser";
		var _submitId = "sbnAddUser";
	</script>
	
</body>
</html>
