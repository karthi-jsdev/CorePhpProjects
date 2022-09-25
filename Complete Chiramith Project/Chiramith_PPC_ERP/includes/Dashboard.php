<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
	<?php
	$_GET['Initial'] = 1;
	include("includes/Dashboard_Table.php");
	?>
</form>

<script>
	$( document ).ready(function()
	{
		$('#uniform-CustomerWiseLimit').removeAttr('class');
		$('#uniform-CustomerWiseLimit').removeAttr('style');
		$('#CustomerWiseLimit').removeAttr('style');
		$("#uniform-CustomerWiseLimit span").remove();
		
		$('#uniform-MachineWise').removeAttr('class');
		$('#uniform-MachineWise').removeAttr('style');
		$('#MachineWise').removeAttr('style');
		$("#uniform-MachineWise span").remove();
		
		$('#uniform-ProductsWise').removeAttr('class');
		$('#uniform-ProductsWise').removeAttr('style');
		$('#ProductsWise').removeAttr('style');
		$("#uniform-ProductsWise span").remove();
		
		$('#uniform-Ajax_Pagination_Select').removeAttr('class');
		$('#uniform-Ajax_Pagination_Select').removeAttr('style');
		$('#Ajax_Pagination_Select').removeAttr('style');
		$("#uniform-Ajax_Pagination_Select span, br").remove();
	});

	function Ajax_Pagination(PaginationFor, CurrentPageNo, SelectId)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById(PaginationFor).innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Ajax_Pagination_Dashboard.php?page=<?php echo $_GET['page'];?>&pageno="+CurrentPageNo+"&total_pages="+total_pages+"&PaginationFor="+PaginationFor+"&limit="+SelectId, true);
		xmlhttp.send();
	}
	
	function CustomerWise(Limit)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("CustomerWise").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetCustomerWiseData.php?Limit="+Limit+"&Initial="+<?php echo $_GET['Initial'];?>+"&pageno="+<?php echo $_GET['pageno']; ?>+"&total_pages="+<?php echo $_GET['total_pages']; ?>, true);
		xmlhttp.send();
	}
</script>