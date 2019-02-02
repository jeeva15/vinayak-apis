
<?php
include_once "./includes/class.campaigns.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

$campaign = new CAMPAIGNS;
$cid = $commonObj->Decrypt($_GET['ac']);
$campaigndetails = $campaign->getSubCategoryDetails($cid);
if($_GET['i'] == "1")
	$success = "Campaign Created Successfully";
elseif($_GET['i'] == "2")
	$error = "Please change any value and try again";
elseif($_GET['i'] == "0")
	$error = "Campaign name already exists.";	

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
	<div><strong class="bigtxt">Sub Category Deatils</strong></div>
	<div align="center">
		<br>
            <form name="frmuser" id="frmuser" method="post" action="campaignaction.php">
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
                            <td align="right" class="boldtxt">Sub Category Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $campaigndetails["subCategoryName"];?></td>
                    </tr>
		 <!--   <tr>
                            <td align="right" class="boldtxt">Category Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $campaigndetails["projectname"];?></td>
                    </tr>-->
		     <tr>
                            <td align="right" class="boldtxt">Price<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td>
                               <?php echo $campaigndetails["price"]. "/".$_MEASUREMENTS[$campaigndetails["measurements"]];?>
                            </td>
                    </tr>
		      <tr>
                            <td align="right" class="boldtxt">In Stock<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $campaigndetails["storeBalance"];?></td>
					</tr>
					<tr>
                            <td align="right" class="boldtxt">Current Balance<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $campaigndetails["currentBalance"];?></td>
                    </tr>
			<tr>
                            <td align="right" class="boldtxt">Date Added<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo date("d-M-Y",strtotime($campaigndetails["createdOn"]));?></td>
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
			'txtsitename' : new Array('empty',true)			
		}
		var toDisplayError = {
			'empty' : 'Must not be empty'
		}
		var _formId = "frmuser";
		var _submitId = "sbnAddUser";
	</script>
	
</body>
</html>

