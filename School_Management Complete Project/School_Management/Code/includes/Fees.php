<br />
<?php
include("includes/Fees_Queries.php");
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Pay Fees";
		$subheaders = array("Pay Fees", "Fees Details");
	
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
	}
	
	$filename = "includes/".$_GET['subpage'].".php";
	if(file_exists($filename) && in_array($_GET['subpage'], $subheaders))
	{
		echo '<div class="columns">';
		include($filename);
		echo '</div>';
	}
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
	?>
	<div class="clear">&nbsp;</div>
	
<script>
	function deleterow(id)
	{
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>&id="+id+"&action=Delete");
	}
</script>