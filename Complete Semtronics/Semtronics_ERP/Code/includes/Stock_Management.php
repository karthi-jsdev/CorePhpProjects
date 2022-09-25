<?php
	include("includes/Stock_Management_Queries.php");
	if(!$_GET['ssubpage'])
		$_GET['ssubpage'] = "Invoice_Stock";
	$SubHeaders = array("Invoice_Stock", "Invoice_Details", "Invoice_Summary", "Stock_Status", "Inspection", "Inspection_Summary");

	foreach($SubHeaders as $SubHeader)
		echo str_replace($_GET['ssubpage'].'" class="button button-gray', $_GET['ssubpage'].'" class="button button-orange',
		'<a href="index.php?page=Stores&subpage=spage->'.$_GET['spage'].',ssubpage->'.$SubHeader.'" class="button button-gray">'.str_replace("_"," ", $SubHeader).'</a>&nbsp;');

	if(in_array($_GET['ssubpage'], $SubHeaders))
		include('includes/'.$_GET['ssubpage'].'.php');
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
?>
<div class="clear">&nbsp;</div>

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
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=Stores&subpage=<?php echo 'spage->'.$_GET['spage'].',ssubpage->'.$_GET['ssubpage']; ?>&id="+id+"&action=Delete");
	}
</script>