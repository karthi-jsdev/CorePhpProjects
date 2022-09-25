<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#startdate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
			$("#enddate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
		});
	</script>
</head>
<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix">
			<label><strong>Start Date:</strong>
				<input type="text" name="startdate" id="startdate" value="<?php if($_POST['startdate']) echo $_POST['startdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
			</label>
			<label><strong>End Date:</strong>
				<input type="text" name="enddate" id="enddate" value="<?php if($_POST['enddate']) echo $_POST['enddate']; else echo date('d-m-Y');?>">
			</label>
		</div>	
		<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>		
	</fieldset>
</form>
<div id="main">
</div>
<script>
function Display_Table()
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
			document.getElementById("main").innerHTML = xmlhttp.responseText;
		}
			
	}
	xmlhttp.open("GET","includes/SampleManagement_Display_Table.php?startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value, true);
	xmlhttp.send();
}
function Export_Data(PostBackValues)
{
	window.open("includes/ExportsampleManagementData.php?export=1&"+PostBackValues+"&startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
}
</script>