<br/><br/>
<?php
	if(!$_GET['innersubpage'])
		$_GET['innersubpage'] = "Class";
		$subheaders = array("Class", "Sections", "Blood Group", "Nationality","Community","Religion","Subcaste");
	
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
		if($_GET['innersubpage'] == $subheaders[$i])
			echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		else
			echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
	}
	
	$filename = "includes/".$_GET['page']." ".$_GET['subpage']." ".$_GET['innersubpage'].".php";
	if(file_exists($filename) && in_array($_GET['innersubpage'], $subheaders))
	{
		echo '<div class="columns">';
		include($filename);
		echo '</div>';
	}
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
	?>
	<div class="clear">&nbsp;</div>