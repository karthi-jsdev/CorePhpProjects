<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix" style="width:1000px;">
			<label>Status <font color="red">*</font>
						<div>
							<select id="status" name="status">
								<option value="">Select</option>
								<?php
									$SelectStatus = SelectStatus();
									while($FetchStatus = mysqli_fetch_array($SelectStatus))
									{
										echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['sales_status'].'</option>';
									}
								?>
							</select>
						</div>
			</label>
			<br />
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
		xmlhttp.open("GET","includes/Sale_order_Display_Table.php?status="+document.getElementById("status").value, true);
		xmlhttp.send();
	}
	function Export_Data(PostBackValues)
	{
		window.open("includes/ExportSaleOrderData.php?export=1&"+PostBackValues+"&status="+document.getElementById("status").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>		