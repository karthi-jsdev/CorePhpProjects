<?php
	include("includes/Reports_Queries.php");
	if(!$_GET['ssubpage'])
		$_GET['ssubpage'] = "Vendors_Reports";
	$SubHeaders = array("Vendors_Reports", "Invoice_Reports", "StockStatus_Reports","Inspection_Reports","Issuance_Reports","Product_Reports","ProductBOM_Reports","SavedKitting_Reports");

	foreach($SubHeaders as $SubHeader)
		echo str_replace($_GET['ssubpage'].'" class="button button-gray', $_GET['ssubpage'].'" class="button button-orange',
		'<a href="index.php?page=Reports&subpage=spage->'.$_GET['spage'].',ssubpage->'.$SubHeader.'" class="button button-gray">'.str_replace("_"," ", $SubHeader).'</a>&nbsp;');

	if(in_array($_GET['ssubpage'], $SubHeaders))
		include('includes/'.$_GET['ssubpage'].'.php');
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
?>
<div class="clear">&nbsp;</div>