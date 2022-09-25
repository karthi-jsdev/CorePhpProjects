<section class="grid_6 first">
	<br />
	<?php
	include("includes/Biomedical_Queries.php");
	if($_SESSION['role'])
	{
		if(!$_GET['subpage'])
			$_GET['subpage'] = "Biomedical";
		if($_SESSION['roleid'] == 5 || $_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2)
			$subheaders = array("Biomedical", "Biomedical_Status");//,"Biomedical_Item"
		
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
</section>	