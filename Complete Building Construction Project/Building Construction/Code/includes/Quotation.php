<br/><?php
	include("includes/Quotation_Queries.php");
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Add Quotation";
	
	if($_GET['subpage']=="Add Quotation")
		echo '<a href="index.php?page=Quotation&subpage=Add Quotation" class="button button-orange">Add Quotation</a>&nbsp;';
	else
		echo '<a href="index.php?page=Quotation&subpage=Add Quotation" class="button button-gray">Add Quotation</a>&nbsp;';
	if($_GET['subpage']=="Quotation Summary")
		echo '<a href="index.php?page=Quotation&subpage=Quotation Summary" class="button button-orange">Quotation Summary</a>&nbsp;';
	else
		echo '<a href="index.php?page=Quotation&subpage=Quotation Summary" class="button button-gray">Quotation Summary</a>&nbsp;';
	if($_GET['subpage']=="Quotation Retrieval")
		echo '<a href="index.php?page=Quotation&subpage=Quotation Retrieval" class="button button-orange">Quotation Retrieval</a>&nbsp;';
	else
		echo '<a href="index.php?page=Quotation&subpage=Quotation Retrieval" class="button button-gray">Quotation Retrieval</a>&nbsp;';
	if($_GET['subpage']=="Quotation Status")
		echo '<a href="index.php?page=Quotation&subpage=Quotation Status" class="button button-orange">Quotation Status</a>&nbsp;';
	else
		echo '<a href="index.php?page=Quotation&subpage=Quotation Status" class="button button-gray">Quotation Status</a>&nbsp;';
		
	if($_GET['subpage'])
	{
		if(!$_GET['subpage'])
			$_GET['subpage'] = "Add Quotation";
		
		if($_GET['subpage'] == "Add Quotation")
			include('includes/Add Quotation.php');
		else if($_GET['subpage'] == "Quotation Retrieval")
			include('includes/Quotation Retrieval.php');
		else if($_GET['subpage'] == "Quotation Summary")
			include('includes/Quotation Summary.php');
		else if($_GET['subpage'] == "Quotation Status")
			include('includes/Quotation Status.php');
		else
			echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
		?>
		<div class="clear">&nbsp;</div>
	<?php
	}
?>
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
</script>