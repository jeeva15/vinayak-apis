<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lms/includes/class.register.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}
if(trim($session_type) == 2){
	echo "You do not have access this page.";
	exit;
}

$users = new REGISTER;
$userslist = $users->getRegistrationList();

if($_GET['sitename']!=''){
	$_POST['sitename']= $commonObj->Decrypt($_GET['sitename']);
	$fieldname = "sitename";
}
else{
	$fieldname = "sn";
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Registration ::</title>
	<style>
		@import "css/style.css";		
		@import "css/tab.css";
		@import "cal/cal.css";
	</style>

	<script type="text/javascript" src="js/ajax.js"></script>	

</head>
<body>
	


<center>
	<div id="mainwrapper">
		<div id="wrapper">
		<?php include "template/header.php";?>
	<div align="center">
		
	        <form name="frmUser" id="frmUser" method="post" action="registrations.php">
		
		<input type="hidden" name="hAct" value="1">
			<br>
		<table>
			<tr>
				<td>Date :</td>
				<td><input type="text" name="datereg" id="datereg" value="<?php echo $_POST['datereg'];?>"></td>
			</tr>
			<tr>
				<td>Site Name :</td>
				<td><select name="sitename">
                            <option value="">-Select-</option>
                            <?php
                            foreach($_ADSITES as $key=>$value){?>
                            <option value="<?php echo $key?>"><?php echo $value;?></option>
                            <?php }?>
                        </select></td>
			</tr>
			<tr>
				<td colspan="2"><input class="button" type="button" name="search" value="Search" onclick="return searchdate()"></td>
				
			</tr>
			
		</table>
		
		</form>
		<br><br>
		<?php
		if($_GET['cid'] == ''){
		?>
		<div class="errortxt">Users Registration on <?php if($_POST['datereg'] != ''){ echo date("d-M-Y",strtotime($_POST['datereg'])); }else{ echo date('d-M-Y');}?></div>
		<?php
		}?>
		<br>
		<table cellpadding="1" cellspacing="1" border="0" bgcolor="#EEEEEE" width="100%" class="mediumtxt">
			<tr bgcolor="#EEEEEE">
				<th>&nbsp;</th>				
				<th>Name</th>
				<th>Mobile</th>
				<th>Email</th>				
				<th>Project</th>
				<th>Site Name</th>
				<th>City</th>
				<th>Country</th>
				<th>Date Added</th>
				
			</tr>
	
			<?php

	
			if($userslist != 0){
				
				$i=0;
			foreach($userslist as $userval){
				$i++;
			?>
			<tr id="row_<?php echo $i?>" bgcolor="#FFFFFF">
				<td><?php echo $i?></td>				
				<td><?php echo $userval["name"];?></td>
				<td><?php echo $userval["mobile"];?></td>
				<td><?php echo $userval["email"];?></td>				
				<td><?php echo $users->getProjectName($userval["cid"]);?></td>
				<td><?php echo $_ADSITES[$userval["sitename"]]?></td>
				<td><?php echo $userval["location"]?></td>
				<td><?php echo $_LPCOUNTRY[$userval["country"]]?></td>  
				<td><?php echo date("d-M-Y",strtotime($userval["dateadded"]));?></td>
				
			</tr>
			<?php
			}?>
			<tr>
				<td colspan="7" align="center"><a href="downloadexcel.php?dat=<?php echo $_POST['datereg'];?>&cid=<?php echo $_GET['cid']?>&<?php echo $fieldname."=".$commonObj->Encrypt($_POST['sitename']);?>"><input type="button" class="button" value="Dowload Excel"></a></td>
			</tr>
			<?php
		}
		else
		{?>
			<tr>
				<td colspan="8" align="center"><span class="mediumtxt boldtxt errortxt">No records found.</span></td>
			</tr>
		<?php }?>
		</table>
		
		
	</div>
		
	<?php include "template/footer.php";?>
	</div>
	</div>
</center>
	
	<script type="text/javascript" src="js/fancybox.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="cal/cal.js"></script>
	<style>
		@import "css/fancybox.css";
	</style>
	<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"datereg",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				
				day:5,					
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
	
	
	function  searchdate() {
		var dat = document.frmUser.datereg.value;
		var sn  = document.frmUser.sitename.value;
		if (dat == "" && sn == '') {
			alert("Please any choose date or sitename");
			return false;
		}
		else{
			document.frmUser.submit();
			return true;
		}
	}
</script>

</body>
</html>
