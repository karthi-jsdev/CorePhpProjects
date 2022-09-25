<div class="clear">&nbsp;</div>
<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
<script src="js/datepicker/jquery.ui.core.js"></script>
<script src="js/datepicker/jquery.ui.widget.js"></script>
<script src="js/datepicker/jquery.ui.datepicker.js"></script>
<script>
	$(function()
	{
		$("#startdate").datepicker({dateFormat: 'yy-mm-dd'});
		$("#enddate").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>
<div class="columns">
	<div style="border:1px solid;border-radius:10px;">
		<br />
		<table>
			<tr>
				<td width="265px">&nbsp;&nbsp;&nbsp;Issuance Code : <input type="text" id="number" onkeypress="return isNumeric(event);" /></td>
				<td>Issued To :&nbsp;</td>
				<td width="110px">
					<select id="issuedto" name="issuedto">
						<option value="">All</option>
						<?php
						$Users = mysql_query("SELECT * FROM issuanceuser ORDER BY id");
						while($User = mysql_fetch_assoc($Users))
						{
							if($User['id'] == $_POST['issuedto'])
								echo "<option value='".$User['id']."' selected>".$User['issuanceuser']."</option>";
							else
								echo "<option value='".$User['id']."'>".$User['issuanceuser']."</option>";
						} ?>
					</select>
				</td>
				<td>Date Limit : <input type="text" id="startdate" onkeypress="" placeholder="Start Date" /> - <input type="text" id="enddate" onkeypress="" placeholder="End Date" />&nbsp;&nbsp;</td>
				<td><a class="button button-green" type="text" onclick="Ajax_Pagination()">Submit</a>&nbsp;&nbsp;&nbsp;</td>
			</tr>
		</table>
		<br />
	</div>
	<div id="SummaryData"></div>
</div>
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
	//Ajax_Pagination("SummaryData", 1, "");
	 Ajax_Pagination();
	function Ajax_Pagination()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("SummaryData").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Issuance_Summary_FilterReports.php?Action=Filter&number="+document.getElementById("number").value+"&issuedto="+document.getElementById("issuedto").value+"&startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value, true);
		xmlhttp.send();
	}
	function Export_Data()
	{
		window.open("includes/Custom_Report_Actions.php?Module=Issuance&number="+$("#number").val()+"&issuedto="+$("#issuedto").val()+"&startdate="+$("#startdate").val()+"&enddate="+$("#enddate").val(),'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>