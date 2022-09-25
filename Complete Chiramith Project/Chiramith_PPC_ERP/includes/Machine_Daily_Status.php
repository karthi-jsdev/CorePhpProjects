
<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
<script src="js/datepicker/jquery.ui.core.js"></script>
<script src="js/datepicker/jquery.ui.widget.js"></script>
<script src="js/datepicker/jquery.ui.datepicker.js"></script>
<script>
	$(function()
	{
		$("#date").datepicker({dateFormat: 'yy-mm-dd', maxDate: '0'});
	});
</script>
<div class="columns">
	<div class="panel">
		<table>
			<tr>
				<td width="270px">&nbsp;&nbsp;&nbsp;&nbsp;Select Date : <input type="text" id="date" value="<?php echo date("Y-m-d");?>" onkeypress="return false" placeholder="Start Date" /></td>
				<td><a class="button button-blue" type="text" onclick="Disaply_Machine_Status()">View</a>&nbsp;&nbsp;&nbsp;</td>
				<td><a class="button button-blue" type="text" onclick="Download()">Download</a>&nbsp;&nbsp;&nbsp;</td>
			</tr>
		</table>
	</div>
	
	<div class="panel margin-bottom">
		<div id="MachineStatus"></div>
	</div>
</div>
<script>
	Disaply_Machine_Status();
	function Disaply_Machine_Status()
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
				if(xmlhttp.responseText)
					document.getElementById("MachineStatus").innerHTML = xmlhttp.responseText;
				else
					document.getElementById("MachineStatus").innerHTML = "<center><b><font color='red'>No data found</font></b></center><br />";
			}
		}
		xmlhttp.open("GET","includes/Machine_Daily_Status_Actions.php?Action=Select&date="+document.getElementById("date").value, true);
		xmlhttp.send();
	}
	function Download()
	{
		window.open("includes/Machine_Daily_Status_Actions.php?Action=Select&Export=1&date="+document.getElementById('date').value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>