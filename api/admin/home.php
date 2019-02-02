<?php
include "./lib/init.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Home ::</title>
	<style>
		@import "css/style.css";
	</style>
</head>
<body>
<center>
	<div id="mainwrapper">
		<div id="wrapper">
			<?php include "template/header.php";?>
				<p style="padding-top:100px;"><!-- --></p>
				<center><span class="biggertxt boldtxt">Welcome</span> <span class="biggertxt boldtxt clr2"><?php echo ucwords($session_name);?></span></center>
			<?php include "template/footer.php";?>
		</div>
	</div>
</center>
</body>
</html>        
