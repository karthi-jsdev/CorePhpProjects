<div class="columns">
<br />
	<div style="border:1px solid;border-radius:10px;">
		<br />
		<table>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;Customer Name : <input type="text" id="name" onkeypress="return isAlphabetic(event);" /></td>
				<td>&nbsp;&nbsp;&nbsp;Order Number : <input type="text" id="number" onkeypress="return isNumeric(event);" /></td>
				<td>&nbsp;&nbsp;&nbsp;<a class="button button-blue" type="text" onclick="Ajax_Pagination('SummaryData', 1, '')">Filter</a>&nbsp;&nbsp;&nbsp;</td>
			</tr>
		</table><br />
	</div>
	<div id="SummaryData"></div>
</div>
<div class="clear">&nbsp;</div>
<script>
	$(document).ready(function()
	{
		$('#uniform-issuedto').removeAttr('class');
		$('#uniform-issuedto').removeAttr('style');
		$('#issuedto').removeAttr('style');
		$("#uniform-issuedto span").remove();
	});
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	function Delete_Order(id)
	{
		document.getElementById(id).innerHTML = "<td colspan='6' align='center'><font color='orange'>Deleting the record...</font></td>";
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById(id).innerHTML = "<td colspan='6' align='center'><font color='green'>Successfully deleted the record.</font></td>";
		}
		xmlhttp.open("GET","includes/Order_Summary_Actions.php?Action=Delete&id="+id, true);
		xmlhttp.send();
	}
	Ajax_Pagination("SummaryData", 1, "");
	function Ajax_Pagination(PaginationFor, CurrentPageNo, Limit)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById(PaginationFor).innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Order_Summary_Filter.php?Action=Filter&name="+document.getElementById("name").value+"&number="+document.getElementById("number").value+"&PaginationFor="+PaginationFor+"&pageno="+CurrentPageNo+"&limit="+Limit, true);
		xmlhttp.send();
	}
</script>