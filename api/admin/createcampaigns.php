<?php

include_once "./includes/class.campaigns.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}


if($_GET['i'] == "1")
	$success = "Category Created Successfully";
elseif($_GET['i'] == "2")
	$error = "Error!! Please try again";
elseif($_GET['i'] == "0")
	$error = "Category name already exists.";	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Create Category ::</title>
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
	

	<div id="mainwrapper">
	<div id="wrapper">
		<?php include "template/header.php"; ?>

	<div align="center">
		<br>
            <form name="frmuser" id="frmuser" method="post" action="campaignaction.php">
		<input type="hidden" name="hAct" value="1">         
                <div class="mediumtxt boldtxt errortxt" align="center"><?php echo $error;?></div>
	        <div class="mediumtxt boldtxt successtxt" align="center"><?php echo $success;?></div>
                <table cellpadding="0" cellspacing="0" border="0" class="mediumtxt">			
                    <tr>	
			    <td colspan="2"></td>
                            <td><strong class="bigtxt">Add Category</strong></td>				
                    </tr>
                    <tr>
                            <td align="right">Category Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtName" id="txtName" value="" style="width:250px;" maxlength="60"></td>
                    </tr>
					<tr>
                            <td align="right">Consumable<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><select name="Consumable" id="Consumable" onchange="return chkUserType(this.value);">
                                   
				    
					   <option value="0" >No</option>
					   <option value="1"> Yes</option>
				
				   
				   
                                </select></td>
                    </tr>
		    
			    <td colspan="2"></td>
                            <td><input type="submit" name="sbnAddUser" id="sbnAddUser" value="Submit" class="button"></td>				
                    </tr>
                </table>
            </form>		
	</div>
	

	<?php include "template/footer.php";?>
	</div>
	</div>


		
</center>
	
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
