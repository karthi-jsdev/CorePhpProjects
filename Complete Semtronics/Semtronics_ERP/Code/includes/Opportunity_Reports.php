<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix" style="width:1000px;">
		<?php 	$status = Opportunity_Status(); ?>
							<label><strong>Status</strong>
								<select name="status_id" id="status_id">
									<option value="Select">Select</option>
									<?php
										while($opp_status = mysql_fetch_assoc($status))
										{
											echo'<option value="'.$opp_status['id'].'">'.$opp_status['status'].'</option>';
										}
									?>
								</select>
							</label><br />
				<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>		
		</div>		
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
	xmlhttp.open("GET","includes/Opportunity_Display_Table.php?status_id="+document.getElementById("status_id").value, true);
	xmlhttp.send();
}
function Export_Data(PostBackValues)
{
	window.open("includes/ExportOpportunityData.php?export=1&"+PostBackValues+"&status_id="+document.getElementById("status_id").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
}
</script>