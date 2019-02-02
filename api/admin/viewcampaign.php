
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lms/includes/class.campaigns.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

$campaign = new CAMPAIGNS;
$cid = $commonObj->Decrypt($_GET['ac']);
$campaigndetails = $campaign->getCampaignDetails($cid);
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
	<div><strong class="bigtxt">Campaign Deatils</strong></div>
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
                            <td align="right" class="boldtxt">Ad Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $campaigndetails["campaign_name"];?></td>
                    </tr>
		    <tr>
                            <td align="right" class="boldtxt">Project Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $campaigndetails["projectname"];?></td>
                    </tr>
		     <tr>
                            <td align="right" class="boldtxt">Ad Unit (Dimension)<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td>
                               <?php echo $_BANNERDIMENSIONS[$campaigndetails["dimensions"]];?>
                            </td>
                    </tr>
		      <tr>
                            <td align="right" class="boldtxt">Site Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo $_ADSITES[$campaigndetails["sitename"]];?></td>
                    </tr>
			<tr>
                            <td align="right" class="boldtxt">Date Added<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><?php echo date("d-M-Y",strtotime($campaignval["dateadded"]));?></td>
                    </tr>
                    <tr>
                            <td align="right" class="boldtxt">Landing Page<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td class="boldtxt">:</td>
                            <td><a class="mediumtxt clr1" href="<?php echo $campaigndetails["landingpage"]."?id=".$commonObj->Encrypt($campaigndetails["cid"])."&unit=".$commonObj->Encrypt($campaigndetails["dimensions"])."&sn=".$commonObj->Encrypt($campaigndetails["sitename"]);?>" target="_blank"><?php echo $campaigndetails["landingpage"]."?id=".$commonObj->Encrypt($campaigndetails["cid"])."&unit=".$commonObj->Encrypt($campaigndetails["dimensions"])."&sn=".$commonObj->Encrypt($campaigndetails["sitename"]);?></a></td>
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

