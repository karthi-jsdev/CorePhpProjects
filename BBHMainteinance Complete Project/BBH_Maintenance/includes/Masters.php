<!-- Left column/section -->
<!--section class="grid_6 first"-->
	<br />
	<?php
	include("includes/Masters_Queries.php");
	if($_SESSION['role'])
	{
		if(!$_GET['subpage'])
			$_GET['subpage'] = "Division";
		if($_SESSION['roleid'] == 5 || $_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2)
			$subheaders = array("Division", "Department", "Location", "Zone", "Asset_Item", "Users", "Group", "Subgroup", "Source", "On-Hold Reason", "Softwares","Backup","Breakdown_Category");//,"Biomedical_Item","Biomedical_Make","Biomedical_Model","Biomedical_Equipment"
		
		for($i = 0; $i < count($subheaders); $i++)
		{
			$split = explode("_", $subheaders[$i]);
			for($j = 0; $j < count($split); $j++)
			{
				if($j == 0)
					$subpagename = $split[$j];
				else
					$subpagename = $subpagename." ".$split[$j];
			}
			if($_GET['subpage'] == $subheaders[$i])
				echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
			else
				echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		} ?>
		
		<div class="columns">
			<?php
			$filename = "includes/".$_GET['page']." ".$_GET['subpage'].".php";
			if(file_exists($filename))
				include($filename);
			else
				echo "Don't try to visit this website anonymously..!";
			?>
			<div class="clear">&nbsp;</div>
		</div>
	<?php
	}
	else
	{ ?>
		<div class="message info">
			<h3><font color="red">Note :</font></h3>
			<p>This page is only for Admins. If you have credentials of either, Please login to continue.</p>
		</div>
	<?php
	} ?>
<!--/section-->
<script>
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode >= 32)
			return true;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
	}
</script>