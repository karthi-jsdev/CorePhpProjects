<section role="main" id="main">
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<fieldset>	
				<div class="clearfix" id="machinereport" name="machinereport">
					<input type="hidden" id="machinemake" />
					<input type="hidden" id="machinetype" />
					<input type="hidden" id="machinespecification" />
					<input type="hidden" id="machineturningtools" />
					<input type="hidden" id="section_id" />
					<input type="hidden" id="subsection_id" />
				</div><br/>
				<center>
					<a class="button button-blue" name="filter" id="filter" onclick="Display_Status();">Filter</a>
					<a class="button button-blue" onclick="reset()">Reset</a>
					<a class="button button-blue" onclick="Export()">Download</a>
				</center>
			</fieldset>
		</form>	
	</div>
	<div class="columns">
		<div class="panel margin-bottom">
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
		xmlhttp.open("GET","includes/Machine_Status_Live_Data_machinereport.php?machinemake="+document.getElementById("machinemake").value+"&machinetype="+document.getElementById("machinetype").value+"&machinespecification="+document.getElementById("machinespecification").value+"&machineturningtools="+document.getElementById("machineturningtools").value+"&section_id="+document.getElementById("section_id").value+"&subsection_id="+document.getElementById("subsection_id").value, true);
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
	function Export()
	{
		window.open("includes/Machine_Status_Live_Data_machinereport.php?machinemake="+document.getElementById("machinemake").value+"&machinetype="+document.getElementById("machinetype").value+"&machinespecification="+document.getElementById("machinespecification").value+"&machineturningtools="+document.getElementById("machineturningtools").value+"&section_id="+document.getElementById("section_id").value+"&subsection_id="+document.getElementById("subsection_id").value+"&Export=1", 'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function reset()
	{
		document.getElementById("machinemake").selectedIndex = document.getElementById("machinespecification").selectedIndex = document.getElementById("machineturningtools").selectedIndex = document.getElementById("machinetype").selectedIndex = document.getElementById("section_id").selectedIndex = 0;
	}
</script>