<section role="main" id="main">
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<fieldset>	
				<div class="clearfix" id="machinereport" name="machinereport">
					<input type="hidden" id="machinemake" name="machinemake" value="">
					<input type="hidden" id="machinetype" name="machinetype" value="">
					<input type="hidden" id="machinespecification" name="machinespecification" value="">
					<input type="hidden" id="machineturningtools" name="machineturningtools" value="">
				</div>
				<a class="button button-blue" name="filter" id="filter" onclick="Display_Status();">Filter</a>
			</fieldset>
		</form>	
	</div>
	<div class="columns">
		<div class="panel margin-bottom">
			<center>
				<table>
					<tr>
						<td style='background:green;width:20px;'></td><td>&nbsp;Machine Assigned&nbsp;&nbsp;&nbsp;</td>
						<td style='background:orange;width:20px;'></td><td>&nbsp;Machine Assigned With Nearing&nbsp;&nbsp;&nbsp;</td>
						<td style='background:red;width:20px;'></td><td>&nbsp;Machine Not Assigned&nbsp;&nbsp;&nbsp;</td>
						<td style='background:yellow;width:20px;'></td><td>&nbsp;Available Locations&nbsp;&nbsp;&nbsp;</td>
						<td style='background:white;width:20px;'></td><td>&nbsp;Not Available Locations&nbsp;&nbsp;&nbsp;</td>
					</tr>
				</table>
			</center><br />
			<div id="Machine_Status"></div>
		</div>
	</div>
</section>
<script>
	Display_Status();
	function Display_Status()
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
				document.getElementById("Machine_Status").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Machine_Status_Live_Data_machinereport.php?machinemake="+document.getElementById("machinemake").value+"&machinetype="+document.getElementById("machinetype").value+"&machinespecification="+document.getElementById("machinespecification").value+"&machineturningtools="+document.getElementById("machineturningtools").value, true);
		xmlhttp.send();
	}
	Get_Module_Options("", "");
		function Get_Module_Options(selectedmodule, id)
		{
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
					document.getElementById("machinereport").innerHTML = xmlhttp.responseText;
			}
			xmlhttp.open("GET","includes/Machine_Status_Live_Data_Report.php?machinemake="+document.getElementById("machinemake").value+"&machinetype="+document.getElementById("machinetype").value+"&machinespecification="+document.getElementById("machinespecification").value+"&machineturningtools="+document.getElementById("machineturningtools").value+"&selectedmodule="+selectedmodule+"&id="+id, true);
			xmlhttp.send();
		}
</script>