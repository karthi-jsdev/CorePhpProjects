<br />
<?php
	if(!$_GET['subpage'])
		$_GET['subpage'] = "spage->Store_Reports";
	$ParseInputs = 'array('.str_replace("->", "=>", $_GET['subpage']).')';
	eval("\$Secondry = $ParseInputs;");
	$_GET['spage'] = $Secondry['spage'];
	$_GET['ssubpage'] = $Secondry['ssubpage'];
	
	$SubHeaders = array("Store_Reports", "Sale_Reports", "Custom_Reports");
	foreach($SubHeaders as $SubHeader)
		echo str_replace($_GET['spage'].'" class="button button-gray', $_GET['spage'].'" class="button button-blue',
		'<a href="index.php?page=Reports&subpage=spage->'.$SubHeader.'" class="button button-gray">'.str_replace("_"," ", $SubHeader).'</a>&nbsp;');
	echo "<hr />";
	if(in_array($_GET['spage'], $SubHeaders))
		include('includes/'.$_GET['spage'].'.php');
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
?>
