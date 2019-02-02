<?php

include "./includes/class.login.php";

if($_POST['hAct'] != ""){
	$login = new LOGIN;
	$auth = $login->checkLogin(trim($_POST['username']),trim($_POST['pass']));
	if($auth == 0){
		$error = "Invalid Login.. Pls try again..";
	}
}
$loginid = $commonObj->getSession('lids');
if($loginid != ''){
	$commonObj->RedirectTo('home.php');
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Login ::</title>
	<style>
		@import "css/style.css";
		@import "css/validate.css";
	</style>
</head>
<body>
<center>
	<div id="mainwrapper">
		<div id="wrapper">
			<?php include "template/header.php";?>
		<form name="login" method="post" id="login">
			<input type="hidden" name="hAct" value="1">
			<div class="errortxt"><?php echo $error;?></div>
			<p class="padd10"><!-- --></p>

				<table cellpadding="0" cellspacing="0" border="0" style="text-align:right;">
					<tr>
						<td colspan="2" style="padding-bottom:15px;"><span class="hdtxt boldtxt clr4">Account Login</span></td>
					</tr>
					<tr>
						<td style="padding:0px 20px 10px 0px;"><label class="mediumtxt clr4" for="username">Username</label></td>
						<td style="padding:0px 0px 10px 0px;"><input type="text" name="username" id="username" style="width:200px;"></td>
					</tr>
					<tr>
						<td style="padding:0px 20px 10px 0px;"><label class="mediumtxt clr4" for="pass">Password</label></td>
						<td style="padding:0px 0px 10px 0px;"><input type="password" name="pass" id="pass" style="width:200px;"></td>
					</tr>
					<tr>
						<td><!-- --></td>
						<td><input type="submit" id="send" name="sub" class="button" value="Login"></td>
					</tr>
				</table>
		</form>
			<?php include "template/footer.php";?>
		</div>
	</div>
</center>

	<script language="javascript" src="js/validate.js"></script>

	<script language="javascript">	
		var toValidateElem = {
			'username' : new Array('empty',true),
			'pass' : new Array('empty',true)
		}
		var toDisplayError = {
			'empty' : 'Must not be empty',
			'email' : 'Invalid email'
		}
		var _formId = "login";
		var _submitId = "send";
	</script>

</body>
</html>
