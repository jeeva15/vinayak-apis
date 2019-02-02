<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>{$TITLE}</title>
	<style>
		@import "css/style.css";
	</style>
</head>
<body>
	
	<div align="center">
		<form name="adduser" id="adduser" method="post">
			<input type="hidden" name="hAct" value="1">
			<input type="hidden" name="uid" value="{$uid}">
		<div class="mediumtxt boldtxt errortxt">{$err_msg}</div>
		<table cellpadding="0" cellspacing="0" border="0" class="mediumtxt">			
			<tr>
				<td colspan="2"></td>
				<td><strong class="bigtxt">Users Details</strong></td>				
			</tr>
			<tr>
				<td align="right"><strong class="mediumtxt">Name</strong></td>
				<td>:</td>
				<td>{$UserInfo.Name}</td>
			</tr>
			<tr>
				<td align="right"><strong class="mediumtxt">Email</strong></td>
				<td>:</td>
				<td>{$UserInfo.Email}</td>
			</tr>
			<tr>
				<td align="right"><strong class="mediumtxt">Mobile no</strong></td>
				<td>:</td>
				<td>{$UserInfo.MobileNo}</td>
			</tr>
			
						
			<tr>
				<td align="right"><strong class="mediumtxt">Users Type</strong></td>
				<td>:</td>
				<td>{$UserInfo.UserType}</td>
			</tr>
			{if $UserInfo.UserTypeId eq "4"}
			<tr>
				<td align="right"><strong class="mediumtxt">Branch</strong></td>
				<td>:</td>
				<td>
					{foreach from=$branchRes key=k item=BranchValue}
				                <label>{$k+1}.&nbsp;{$usersbranch[$BranchValue]}</label><br/>
					{/foreach}
				</td>
			</tr>
			
			
			<tr>
				<td align="right"><strong class="mediumtxt">Call Handling</strong></td>
				<td>:</td>
				<td>{$UserInfo.CallHandling}</td>
			</tr>
			
			
			
			<tr>
				<td align="right"><strong class="mediumtxt">Reporting To</strong></td>
				<td>:</td>
				<td>{$UserInfo.ReportingTo}</td>
			</tr>
			{/if}
			
			{if $UserInfo.CreatedBy neq ""}
			<tr>
				<td align="right"><strong class="mediumtxt">Created By</strong></td>
				<td>:</td>
				<td>{$UserInfo.CreatedBy}</td>
			</tr>
			{/if}
			
			<tr>
				<td align="right"><strong class="mediumtxt">Date Created</strong></td>
				<td>:</td>
				<td>{$UserInfo.DateAdded|date_format}</td>
			</tr>
			
			{if $UserInfo.DateModified neq ""}
			<tr>
				<td align="right"><strong class="mediumtxt">Date Modified</strong></td>
				<td>:</td>
				<td>{$UserInfo.DateModified|date_format}</td>
			</tr>
			{/if}
			
		</table>
		
		
		</form>
		
	</div>
	
	
</body>
</html>
