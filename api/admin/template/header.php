<script language="javascript" src="js/jquery.js"></script>
<style>
	@import "css/tab.css";
</style>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td style="padding:10px 0px 5px 10px;"><a href="home.php"><img height="90px" src="images/icon.png" alt="" border="0" height="70px" /></a></td>
		<td style="padding:10px 10px 0px 0px;" valign="bottom" align="right"><h1 class="biggertxt clr1">ADMIN PANEL</h1>
		<?php if($session_name != ""){?><div class="mediumtxt" style="padding:0px 10px 0px 0px;float:right;">Welcome <b><?php echo ucwords($session_name);?></b><div>[ <a href="logout.php" class="mediumtxt clr1">Logout</a> ]</div> </div><?php }?>
		<br clear="all" /><br clear="all" />
		</td>
	</tr>
</table>
<div class="blueborder"><!--  --></div>

<!-- { Navigation -->
<?php 
if($session_name != ""){
	include "navigations.php";
}
?>
<div style="clear:both;"></div>

