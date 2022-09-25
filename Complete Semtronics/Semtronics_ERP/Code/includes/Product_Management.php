<br/>
<?php
include("includes/Product_Management Queries.php");
if(!$_GET['ssubpage'])
	$_GET['ssubpage'] = "Product";
	$SubHeaders = array("Product", "Product_BOM", "BOM_Status","BOM_Versioning");
foreach($SubHeaders as $SubHeader)
	echo str_replace($_GET['ssubpage'].'" class="button button-gray', $_GET['ssubpage'].'" class="button button-orange',
		'<a href="index.php?page=Stores&subpage=spage->Product_Management,ssubpage->'.$SubHeader.'" class="button button-gray">'.str_replace("_"," ", $SubHeader).'</a>&nbsp;');

if(in_array($_GET['ssubpage'], $SubHeaders))
	include('includes/'.$_GET['ssubpage'].'.php');
else
	echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
?>