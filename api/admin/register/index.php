<?php
/*error_reporting(E_ALL);
ini_set("display_errors",1);*/
include_once $_SERVER['DOCUMENT_ROOT']."/lms/includes/class.register.php";

if($_GET['i'] == "1")
	$success = "User Created Successfully";
elseif($_GET['i'] == "2")
	$error = "Error!! Please try again";
elseif($_GET['i'] == "0")
	$error = "Username already exists.";	


	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Create User ::</title>
	<style>
		@import "../css/style.css";
		@import "../css/validate.css";		
	</style>

	<style>
	.multiple_chk {height: 140px; width:  250px; padding: 5px; overflow: auto; font-size:12px; border: 1px solid #ccc;}
	</style>

</head>
<body onLoad="checkRefresh()">
<center>
	

	<div id="mainwrapper">
	<div id="wrapper">
	

	<div align="center">
		<br>
            <form name="frmuser" id="frmuser" method="post" action="registeraction.php">
		<input type="hidden" name="hAct" value="2">
		<input type="hidden" name="visited" value="">
		<input type="hidden" name="cid" value="<?php echo $_GET['id'];?>">
		<input type="hidden" name="unit" value="<?php echo $_GET['unit'];?>">
		<input type="hidden" name="visited" value="">         
                <div class="mediumtxt boldtxt errortxt" align="center"><?php echo $error;?></div>
	        <div class="mediumtxt boldtxt successtxt" align="center"><?php echo $success;?></div>
                <table cellpadding="0" cellspacing="0" border="0" class="mediumtxt">			
                    <tr>	
			    <td colspan="2"></td>
                            <td><strong class="bigtxt">Registration</strong></td>				
                    </tr>
                    <tr>
                            <td align="right">Name<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtName" id="txtName" value="" style="width:250px;"></td>
                    </tr>
		    <tr>
                            <td align="right">Email<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtEmail" id="txtEmail" value="" style="width:250px;"></td>
                    </tr>
                    <tr>
                            <td align="right">Mobile No<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtMobileno" id="txtMobileno" maxlength="10" value="" onkeypress="return allowNumeric(event);"></td>
                    </tr>         
		     <tr>
                            <td align="right">Landline</td>
                            <td>:</td>
                            <td><input type="text" name="txtLandline" id="txtLandline" value="" style="width:250px;"></td>
                    </tr>		   
		    <tr>
                            <td align="right">Location<strong style="color:#FE1100;padding-left:5px;">*</strong></td>
                            <td>:</td>
                            <td><input type="text" name="txtLocation" id="txtLocation" value="" style="width:250px;"></td>
                    </tr>
                    <tr>
			    <td colspan="2"></td>
                            <td><input type="submit" name="sbnAddUser" id="sbnAddUser" value="Submit" class="button"></td>				
                    </tr>
                </table>
            </form>		
	</div>
	

	
	</div>
	</div>


		
</center>
	<script type="text/javascript" src="../js/common.js"></script>
	<script language="javascript" src="../js/jquery.js"></script>
	<script language="javascript" src="../js/validate.js"></script>
	<script type="text/javascript">
	function checkRefresh()
	{		
	    if( document.frmuser.visited.value != "1" )
	    {              
		document.frmuser.visited.value = "1";
		var id = document.frmuser.cid.value;
		var unit = document.frmuser.unit.value;
		$.ajax({
				type: "POST", url: 'registeraction.php', data: "id="+id+"&unit="+unit+"&hAct=1",
				complete: function(data){
					$('#row_'+str[1]).hide('slow');
				}
			});
		   
	    }
	    else
	    {
		// This is a page refresh
		alert ( 'Page has been Refreshed, The AJAX call was not made');
	
	    }
	}
	</script>   
	<script language="javascript">	
		var toValidateElem = {
			'txtName' : new Array('empty',true),
			'txtEmail' : new Array('empty,email',false),
			'txtLocation' : new Array('empty',true),	
			'txtMobileno' : new Array('empty,is_number',true),
			
		}
		var toDisplayError = {
			'empty' : 'Must not be empty',
			'email' : 'Invalid email'
		}
		var _formId = "frmuser";
		var _submitId = "sbnAddUser";
	</script>
	
</body>
</html>

