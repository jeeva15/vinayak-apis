<?php
include_once "./includes/class.campaigns.php";


if(trim($session_id) == ""){
	$commonObj->RedirectTo('logout.php');
}

if(trim($session_type) == 3){
	echo "You do not have access this page.";
	exit;
}
$campaign = new CAMPAIGNS;
$campaignlist = $campaign->getSubCategoryList();

$categorylist = $campaign->getCampaignList();
$categoryName = array();
foreach($categorylist as $value){
	$categoryName[$value["categoryId"]]=$value["categoryName"];
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>:: Category ::</title>
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
		
		<input type="hidden" name="hdnAction" id="hdnAction">
			<br>
		<a href="create-subcategory.php"><input type="button" name="createuser" value="Create Sub Category" class="button"></a>
		<br><br>
		<input type="text" id="myInput" placeholder="Search.."><br><br>
		<table  cellpadding="1" cellspacing="1" border="0" bgcolor="#EEEEEE" width="100%" class="mediumtxt">
		<thead>
			<tr bgcolor="#EEEEEE">
				<th>&nbsp;</th>				
				<th>Sub Category Name</th>
				<th>Category Name</th>
				<th>Date Added</th>
			
				<th>Action</th>
				
			</tr>
			</thead>
			<tbody id="myDIV">
			<?php

			if(count($campaignlist) > 0){
				$i=0;
			foreach($campaignlist as $campaignval){
                        $i++;
			?>
			
			<tr id="row_<?php echo $i?>" bgcolor="#FFFFFF">
				<td><?php echo $i?></td>				
				<td><a onclick='_getBox("view-subcategory.php?ac=<?php echo $commonObj->Encrypt($campaignval["subCategoryId"]);?>","35%","55%")' href="#" class="mediumtxt clr1"><?php echo $campaignval["subCategoryName"];?></a></td>
				<td><?php echo $categoryName[$campaignval["categoryId"]];?></td>
				<td><?php echo date("d-M-Y",strtotime($campaignval["createdOn"]));?></td>
				
				<td><a href="#" onclick='_getBox("editsubcategory.php?page=Edit&ac=<?php echo $commonObj->Encrypt($campaignval["subCategoryId"]);?>","40%","70%")'><img src="images/edit.gif" border="0" alt="edit" title="Edit"></a> &nbsp; &nbsp;<a href="javascript:void(0)" onclick="confimuser('<?php echo $commonObj->Encrypt($campaignval["subCategoryId"]);?>','<?php echo $i?>');"><img src="images/close.gif" border="0" alt="Delete" title="Delete"></td>
				
			</tr>
			<?php
			}
			
		}
		else
		{?>
		</tbody>
			<tr>
				<td colspan="8" align="center"><span class="mediumtxt boldtxt errortxt">No records found.</span></td>
			</tr>
		<?php }?>
		</table>
		
		</from>
	</div>
		<form name="delete">
			<input type="hidden" name="hAct" value="2">
			<input type="hidden" name="uid" value="">
		</form>
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
		
		function confimuser(id,rowid){
			confimationMsg('Are you sure you want to delete the campaign?','DeleteUser',id+"~~~~~"+rowid);
		}
		function DeleteUser(id){						
			str = id.split('~~~~~');
			$.ajax({
				type: "POST", url: 'subcategoryaction.php', data: "id="+str[0]+"&hAct=3",
				complete: function(data){
					$('#row_'+str[1]).hide('slow');
				}
			});
		}
		
		function ifCheckedit()
		{
		ptr=document.frmUser;
		len=ptr.elements.length;
		var i=0,j=0;
		for(i=0; i<len; i++) {
		
			if (ptr.elements[i].name=='Del_Id[]')
			{	
				if(ptr.elements[i].checked==true)	   
				{
					 j=j+1;	
					 val=ptr.elements[i].value; 
		
				}
			}
		}
			if(j==0)
			{
				alert("Check the checkbox");	
				return false;
				
			}
			if(j>1)	
			{	
			alert("You can edit only one user at a time");	
			return false;
			}
			_getBox("createusers.php?page=Edit&i="+val);
						
                }
		
		
		function ifCheck(val)
		{
		var flag=false;
		for(i=0;i<document.frmUser.elements.length;i++)
		{		
			if(document.frmUser.elements[i].name=="Del_Id[]")
			{
				if(document.frmUser.elements[i].checked)
				{
					flag=true;	
					break;
				}
			}

		}	
		if(flag)
		{

			document.frmUser.hdnAction.value=val;
			document.frmUser.submit();
			return true;
		}

		else
		{
			alert("Select atleast one user");
			return false;

		}

              }
	      
	      function ShowFilterUser()
	      {
		if(document.frmUser.txtUserName.value=="")
		{
			alert("Please enter the User Name");
			document.frmUser.txtUserName.style.borderColor="red";
			document.frmUser.txtUserName.focus();
			return false;
		}
		document.frmUser.submit();
		return true;
	      }
	      
	      function SelectAll()
		{
			var p=document.frmUser;
			len=p.elements.length;
			if((document.frmUser.check_all.checked==true) )
			{
		 	 var i=0;	
			 for(i=0; i<len; i++)
			   {
			   if (p.elements[i].name=='Del_Id[]')
		           p.elements[i].checked=1;
	
			   }
                        }

			if((document.frmUser.check_all.checked==false) )
			{
		 	var i=0;
			  for(i=0; i<len; i++)
			  {
		  	  if (p.elements[i].name=='Del_Id[]')
			   p.elements[i].checked=0;

			}

                       }
		}
	      
	      function ShowAllUser()
	      {
		document.frmUser.txtUserName.value="";
		document.frmUser.submit();
		return true;
		  }
		  
		  $(document).ready(function(){
			$("#myInput").bind("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#myDIV tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
			});
	
	</script>

</body>
</html>
