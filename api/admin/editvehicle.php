
<?php
include_once "./includes/class.projects.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

$campaign = new PROJECTS;
$cid = $commonObj->Decrypt($_GET['ac']);
$campaigndetails = $campaign->getVehicleDetails($cid);
if($_GET['i'] == "1")
	$success = "Vehicle edited successfully";
elseif($_GET['i'] == "2")
	$error = "Updated Successfully";
elseif($_GET['i'] == "0")
	$error = "Vehicle number already exists.";	
// pr($campaigndetails);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Edit Vehicle ::</title>
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
	<div><strong class="bigtxt">Edit Vehicle</strong></div>
	<div align="center">
		<br>
            <form name="frmuser" id="frmuser" method="post" action="vehicleaction.php">
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
                            <td align="right">Vehicle Number<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtName" id="txtName" value="<?php echo $campaigndetails["vehicleNumber"];?>" style="width:250px;" maxlength="60"></td>
                    </tr>
		   
					<tr>
                            <td align="right">Vehicle Status<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><select name="projectStatus" id="projectStatus" onchange="return chkUserType(this.value);">
                                    <option value="">-Select-</option>
				    
					   <option value="1" <?php if($campaigndetails['vehicleStatus'] == 1) echo "selected";?>>Active</option>
					   <option value="2" <?php if($campaigndetails['vehicleStatus'] == 2) echo "selected";?>>In Active</option>
				
				   
				   
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
	<script language="javascript" src="js/validate.js"></script>

	<script language="javascript">	
		var toValidateElem = {
			'txtName' : new Array('empty',true),
			'selunittype' : new Array('empty',true),
			'txtsitename' : new Array('empty',true),
			'txtLandingPage' : new Array('empty',true),
			'txtprojectname' : new Array('empty',true)		
		}
		var toDisplayError = {
			'empty' : 'Must not be empty'
		}
		var _formId = "frmuser";
		var _submitId = "sbnAddUser";
	</script>
	
</body>
</html>
