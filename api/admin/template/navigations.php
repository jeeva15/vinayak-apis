<link rel="stylesheet" type="text/css" href="dynamicmenu/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="dynamicmenu/ddlevelsmenu-topbar.css" />
<link rel="stylesheet" type="text/css" href="dynamicmenu/ddlevelsmenu-sidebar.css" />
<script type="text/javascript" src="dynamicmenu/ddlevelsmenu.js"></script>
<div id="ddtopmenubar" class="mattblackmenu">
<ul>
<li><a href="home.php">Home</a></li>
<?php if($session_type == 1){?>
<li><a href="users.php" rel="ddsubmenu1">Manage User</a></li>
<?php }?>
<?php if($session_type == 1 || $session_type == 2){?>
<li><a href="campaigns.php" rel="ddsubmenu2">Manage Category</a></li>
<?php }?>
<?php if($session_type == 1 || $session_type == 2){?>
<li><a href="projects.php" rel="ddsubmenu3">Manage Projects / Vehicles</a></li>
<?php }?>


</ul>
</div>
<script type="text/javascript">
	ddlevelsmenu.setup("ddtopmenubar", "topbar")
</script>

<ul id="ddsubmenu1" class="ddsubmenustyle">
	<li id="firstChild"><a href="users.php">View Users</a></li>
	<li><a href="createusers.php">Create User</a></li>		
</ul>
<ul id="ddsubmenu2" class="ddsubmenustyle">
	<li id="firstChild"><a href="campaigns.php">View Category</a></li>
	<li><a href="createcampaigns.php">Create Category</a></li>
	<li id="firstChild"><a href="subcategory.php">View Sub Category</a></li>		
	<li><a href="create-subcategory.php">Create Sub Category</a></li>		
</ul>
<ul id="ddsubmenu3" class="ddsubmenustyle">
	<li id="firstChild"><a href="projects.php">View Project</a></li>
	<li><a href="createproject.php">Create Project</a></li>
	<li id="firstChild"><a href="vehicles.php">View Vehicles</a></li>		
	<li><a href="createvehicle.php">Create Vehicle</a></li>		
</ul>

