<section role="main" id="main">
	<div class="columns" style='width:900px;'>
		<?php echo $message; ?>
		<form method="post" id="form" class="panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<?php
			if($_GET['page'] != "Machine_Status")
			{ ?>
				<header><h2>Machine Assignment & Removal: Section / Subsection / Location /</h2></header>
				<div id="main-nav">
					<ul class="clearfix">
						<?php
						echo "<li class='active' id='assign'><a href='#' onclick='SubModule(\"assign\")'>Assign</a></li>
						<li class='' id='remove'><a href='#' onclick='SubModule(\"remove\")'>Remove</a></li>";
						?>
						<hr />
					</ul>
				</div>
			<?php
			}
			
			if($_GET['page'] == "Machine_Status")
			{ ?>
				<div id="Filter_Options" ></div>
			<?php
			} ?>
			<br />
			<table>
				<tr>
					<?php
					if($_GET['page'] != "Machine_Status")
					{ ?>
						<td>
							<div id='section' style="width:160px;"><input id="section_id" type="hidden" value="" /></div>
						</td>
						<td>
							<div id='subsection' style="width:190px;"><input id="subsection_id" type="hidden" value="" /></div>
						</td>
						<td>
							<div id='locationreference' style="width:160px;"><input id="location_reference_id" type="hidden" value="" /></div>
						</td>
						<td>
							<div id='Machines' style="padding-left:5px;width:160px;"><input type='hidden' id='machine_id' value='' /></div>
						</td>
						<td>
							<a class="button button-blue" name="Update" onclick="Masters_Assign_Machines()">Update</a>
						</td>
					<?php
					}
					else
					{ ?>
						<tr>
							<td style="padding-left:10px">
								<a class="button button-blue" name="Update" onclick="Display_Status()">Filter</a>
							</td>
							<td style="padding-left:10px">	
								<a class="button button-blue" name="download" onclick="Export('Excel')">Download</a>
							</td>
						</tr>
					<?php
					}  ?>
				</tr>
			</table>
			<div id='info'></div>
		</form>
	</div>
	
	<div class="columns">
		<div class="panel margin-bottom">
			<div id="Machine_Status"></div>
		</div>
	</div>
</section>

<script>
	<?php
	if($_GET['page'] != "Machine_Status")
	{ ?>
		function SubModule(SubModuleId)
		{
			action = SubModuleId;
			document.getElementById("assign").className = document.getElementById("remove").className = "";
			document.getElementById(SubModuleId).className = "active";
			document.getElementById("Machines").innerHTML = "<input type='hidden' id='machine_id' value='' />";
			LocationReference(document.getElementById('subsection_id').value,'');
		}
		Section();
	<?php
	} ?>
	function Export(Type)
	{
		window.open("includes/Machine_Status_Live_Data.php?Export="+Type+"&customer_id="+document.getElementById('customer_id').value+"&order_id="+document.getElementById('order_id').value+"&drawing_id="+document.getElementById('drawing_id').value+"&status_id="+document.getElementById('status_id').value+"&section_id="+document.getElementById('section_id').value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	
	Get_Module_Options();
	Display_Status();
	function Get_Module_Options()
	{
		var Response;
		if(!$("#Filter_Options").html())
			Response = Ajax("POST", "includes/Machine_Status_Display.php", "");
		else
			Response = Ajax("POST", "includes/Machine_Status_Display.php", "section_id="+$("#section_id").val()+"&customer_id="+$("#customer_id").val()+"&order_id="+$("#order_id").val()+"&description="+$("#description").val()+"&product_id="+$("#product_id").val()+"&status_id="+$("#status_id").val());
		$("#Filter_Options").html(Response);
	}
	
	function Ajax(Type, URL, URLData)
	{
		var Responses = "";
		$.ajax(
		{
			type: Type,
			async: false,
			cache: false,
			url: URL,
			data:URLData,
			dataType: 'html',
			success: function(Response)
			{
				Responses = Response;
			}
		});
		return Responses;
	}
	
	function RemoveStyle(id)
	{
		$('#uniform-'+id).removeAttr('class');
		$('#uniform-'+id).removeAttr('style');
		$('#'+id).removeAttr('style');
		$("#uniform-"+id+" span").remove();
	}
	
	$( document ).ready(function()
	{
		["section_id", "customer_id", "order_id", "description", "product_id", "status_id"].forEach(function(id)
		{
			RemoveStyle(id);
		});
	});
	
	function Display_Status()
	{
		<?php
		if($_GET['page'] == "Machine_Status")
		{ ?>
			Get_Module_Options("section_id", '');
			Get_Module_Options("status_id", '');
		<?php
		} ?>
		var Response;
		<?php
		if($_GET['page'] != "Machine_Status")
		{ ?>
			Response = Ajax("GET", "includes/Machine_Status_Live_Data.php", "");
		<?php
		}
		else
		{ ?>	
			Response = Ajax("GET", "includes/Machine_Status_Live_Data.php", "section_id="+$("#section_id").val()+"&customer_id="+$("#customer_id").val()+"&order_id="+$("#order_id").val()+"&description="+$("#description").val()+"&product_id="+$("#product_id").val()+"&status_id="+$("#status_id").val());
			$("#Machine_Status").html(Response);
		<?php
		} ?>
	}
</script>