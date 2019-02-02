<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lms/includes/class.report.php";

if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

if(trim($session_type) == 3){
	echo "You do not have access this page.";
	exit;
}

$report = new REPORT;
if($_POST['hAct'] == 1)
{
    $campaignreportarr = $report->getCampaignReport();

	foreach($campaignreportarr["click"] as $value){
		 $reportArr[$value["cid"]]["click"] = $value["cnt"];
	}
	foreach($campaignreportarr["lead"] as $value){
		 $reportArr[$value["cid"]]["lead"] = $value["cnt"];
	}
	
}
$campaigndet = $report->getCampaignList();
foreach($campaigndet as $val){
	$campaignArr[$val["cid"]] = $val["campaign_name"];

}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Campaign Report ::</title>
	<style>
		@import "css/style.css";		
		@import "css/tab.css";	
	</style>

	<script type="text/javascript" src="js/ajax.js"></script>	

</head>
<body>
	


<center>
	<div id="mainwrapper">
		<div id="wrapper">
		<?php include "template/header.php";?>
	<div align="center">
		
	        <form name="frmUser" id="frmUser" method="post">
		
		<input type="hidden" name="hAct" value="1">
			
		<br>
                <div><strong class="bigtxt">Campaign Report</strong></div>
		<table>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Select Campaign</td>
                        <td><select name="campaign">
                            <option value="">-Select-</option>
                            <?php
                            foreach($campaigndet as $values){?>
                            <option value="<?php echo $values['cid'];?>"><?php echo $values['campaign_name'];?> ( <?php echo $_BANNERDIMENSIONS[$values['dimensions']];?> )</option>
                            <?php }?>
                        </select></td>
                        <td>&nbsp;</td>
                    </tr>
                      <tr>
                        <td>Select Site Name</td>
                        <td><select name="sitename">
                            <option value="">-Select-</option>
                            <?php
                            foreach($_ADSITES as $key=>$value){?>
                            <option value="<?php echo $key?>"><?php echo $value;?></option>
                            <?php }?>
                        </select></td>
                        <td><input type="button" name="go" value="Go!" class="button" onclick="return search();"></td>
                    </tr>
                </table>
		
		</from>
                <?php if($_POST['hAct'] == 1){?>
                <br>
                <table cellpadding="1" cellspacing="1" border="0" bgcolor="#EEEEEE" width="60% class="mediumtxt">
			<tr bgcolor="#EEEEEE">
				<th>&nbsp;</th>				
				<th>Ad Name</th>
				<th align="center">No.of Clicks</th>
				<th align="center">No.of Leads</th>
				<?php if($session_type == 1){?>
				<th align="center">View Leads</th>
				<?php }?>
			</tr>
			<?php
			if(count($reportArr) > 0){
			foreach($reportArr as $key=>$campaignreport){
			?>
			<tr id="row_<?php echo $i?>" bgcolor="#FFFFFF">
				<td>&nbsp;</td>			
				<td><?php echo $campaignArr[$key];?></td>
				<td align="center"><?php echo $campaignreport["click"];?></td>
				<td align="center"><?php echo $campaignreport["lead"];?></a>						
				</td>
				<?php if($session_type == 1 && $campaignreport["lead"] > 0){?>
				<td align="center"><a class="mediumtxt clr1" href="registrations.php?cid=<?php echo $commonObj->Encrypt($_POST['campaign']);?>&sitename=<?php echo $commonObj->Encrypt($_POST['sitename']);?>"> View </a></td>
				<?php }?>
				
			
			</tr>
			<?php }
			
		}else{?>
		<tr><td colspan="6" align="center"><span class="mediumtxt boldtxt errortxt">No records found.</span></td></tr>
		<?php }?>
		
		</table>
                <?php }?>
	</div>
		
	<?php include "template/footer.php";?>
	</div>
	</div>
</center>


	<script type="text/javascript" src="js/fancybox.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<style>
		@import "css/fancybox.css";
	</style>
	<script type="text/javascript">
		
		function search() {
                    //alert(document.frmUser.campaign.value);
                    if(document.frmUser.campaign.value == "" && document.frmUser.sitename.value == ""){
                        alert('Please select any campaign or site name');
                        return false;
                    }
                    else {
                        document.frmUser.submit();
                    }
                }
	
	</script>

</body>
</html>
