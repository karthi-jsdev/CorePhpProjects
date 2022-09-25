<section role="main" id="main">
	<?php
	include("includes/Issuance_Queries.php");
	if(!$_GET['ssubpage'])
		$_GET['ssubpage'] = "Add";
	
	echo str_replace($_GET['ssubpage'].'" class="button button-gray', $_GET['ssubpage'].'" class="button button-orange',
	'<a href="?page=Stores&subpage=spage->'.$_GET['spage'].',ssubpage->Add" class="button button-gray">Add</a>&nbsp;&nbsp;');
	if($_GET['ssubpage'] == "Status")
		echo '<a class="button button-orange" href="?page=Stores&subpage=spage->Issuance,ssubpage->Status">Status</a>&nbsp;&nbsp;';
	else
		echo '<a class="button button-gray" href="?page=Stores&subpage=spage->Issuance,ssubpage->Status">Status</a>&nbsp;&nbsp;';
	echo str_replace($_GET['ssubpage'].'" class="button button-gray', $_GET['ssubpage'].'" class="button button-orange',
	'<a href="?page=Stores&subpage=spage->'.$_GET['spage'].',ssubpage->Summary" class="button button-gray">Summary</a>&nbsp;&nbsp');
	if($_GET['ssubpage'] == "Delivery_Challan")
		echo '<a class="button button-orange" href="?page=Stores&subpage=spage->Issuance,ssubpage->Delivery_Challan">Delivery Challan</a>&nbsp;&nbsp;';
	else
		echo '<a class="button button-gray" href="?page=Stores&subpage=spage->Issuance,ssubpage->Delivery_Challan">Delivery Challan</a>&nbsp;&nbsp;';
	if($_GET['ssubpage'] == "Kitting")
		echo '<a class="button button-orange" href="?page=Stores&subpage=spage->Issuance,ssubpage->Kitting">Kitting</a>&nbsp;&nbsp;';
	else
		echo '<a class="button button-gray" href="?page=Stores&subpage=spage->Issuance,ssubpage->Kitting">Kitting</a>&nbsp;&nbsp;';
	include("includes/Issuance_".$_GET['ssubpage'].".php");
	?>
</section>