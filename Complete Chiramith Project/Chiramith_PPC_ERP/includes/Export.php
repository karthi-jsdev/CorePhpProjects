<?php
if($_GET['subpage'] == "All")
{ ?>
	<form method="post" id="form" class="form panel">
		<div id="Filter_Options" name="Filter_Options" onclick="download_hide(this.value);">
			<input type="hidden" id="cust_id" name="cust_id" value=""/>
			<input type="hidden" id="order_id" name="order_id" value="" />
			<input type="hidden" id="description" name="description" value="" />
			<input type="hidden" id="drawing_number" name="drawing_number" value="" />
			<input type="hidden" id="grade" name="grade" value="" />
			<input type="hidden" id="material_size" name="material_size" value="" />
			<input type="hidden" id="machine" name="machine" value="" />
			<input type="hidden" id="specification" name="specification" value="" />
			<input type="hidden" id="tools" name="tools" value="" />
		</div>
		<a class="button button-blue" name="submit" id="show" onclick="Display_Table();download_show()">Submit</a>
		<a class="button button-blue" name="export" id="hide" onclick="report_download();">Download PDF</a>
		<a class="button button-blue" name="export1" id="hide1" onclick="report_download_excel();">Download Excel</a>
	</form>
	<div id="Filter_Display"> 
		<table class="paginate sortable full" id="">
			<thead>
				<tr>
					<th>Sl.No.</th>
					<th>Customer</th>
					<th>Order</th>
					<th>Product</th>
					<th>DrawingNumber</th>
					<th>Grade</th>
					<th>Raw material size</th>
					<th>Machine</th>
					<th>Machine Specification</th>
					<th>No.of Tools</th>
					<th>Tentative StartDate</th>
					<th>Tentative EndDate</th>
				</tr>
			</thead>
			<?php
			$i=1;
			$report_totaldata=mysqli_fetch_array(Report_Total_Rows());
			$Limit = 20;
			$_GET['total_pages'] = ceil($report_totaldata['total'] / $Limit);
			if(!$_GET['CurrentPageNo'])
				$_GET['CurrentPageNo'] = 1;
			$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
			$i++;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			
			$allreport = Report_Data_ByLimit($Start,$Limit);
			if(mysqli_num_rows($allreport)==0)
				echo'<tr><td style="color:red" colspan="10"><center>No Data Found</center></td></tr>';
			else
			{
				while($reportsall = mysqli_fetch_assoc($allreport))
				{
				echo '<tbody>
						<tr>
							<td>'.$i++.'</td>
							<td>'.$reportsall['name'].'</td>
							<td>'.$reportsall['number'].'</td>
							<td>'.$reportsall['description'].'</td>
							<td>'.$reportsall['draw_number'].'</td>
							<td>'.$reportsall['grade'].'</td>
							<td>'.$reportsall['material_size'].'</td>
							<td>'.$reportsall['machineno'].'</td>
							<td>'.$reportsall['specification'].'</td>
							<td>'.$reportsall['tool'].'</td>
							<td>'.date('d-m-Y',strtotime($reportsall['tentative_date'])).'</td>
							<td>'.date('d-m-Y',strtotime($reportsall['tentative_enddate'])).'</td>
						</tr>
					</tbody>';
				}
			} ?>
		</table>
		<?php
		echo "<h3><center>Total Summary of Orders -".mysqli_num_rows($allreport)."</center></h3>";
		$_GET['PaginationFor']="Filter_Display";
		if($_GET['total_pages'] > 1)
			require("Ajax_Pagination.php");
		?>
	</div>
	<script>
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
					document.getElementById("Filter_Options").innerHTML = xmlhttp.responseText;
			}
			xmlhttp.open("GET","includes/Reports_Dropdown_Display.php?cust_id="+document.getElementById("cust_id").value+"&order_id="+document.getElementById("order_id").value+"&description="+document.getElementById("description").value+"&drawing_number="+document.getElementById("drawing_number").value+"&grade="+document.getElementById("grade").value+"&material_size="+document.getElementById("material_size").value+"&machine="+document.getElementById("machine").value+"&specification="+document.getElementById("specification").value+"&tools="+document.getElementById("tools").value+"&selectedmodule="+selectedmodule+"&id="+id, true);
			xmlhttp.send();
		}
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
					document.getElementById("Filter_Display").innerHTML = xmlhttp.responseText;
			}
			xmlhttp.open("GET","includes/Reports_Display_Table.php?cust_id="+document.getElementById("cust_id").value+"&order_id="+document.getElementById("order_id").value+"&description="+document.getElementById("description").value+"&drawing_number="+document.getElementById("drawing_number").value+"&grade="+document.getElementById("grade").value+"&material_size="+document.getElementById("material_size").value+"&machine="+document.getElementById("machine").value+"&specification="+document.getElementById("specification").value+"&tools="+document.getElementById("tools").value, true);
			xmlhttp.send();
		}
		function report_download()
		{
			window.location.assign("includes/download.php?cust_id="+document.getElementById("cust_id").value+"&order_id="+document.getElementById("order_id").value+"&description="+document.getElementById("description").value+"&drawing_number="+document.getElementById("drawing_number").value+"&grade="+document.getElementById("grade").value+"&material_size="+document.getElementById("material_size").value+"&machine="+document.getElementById("machine").value+"&specification="+document.getElementById("specification").value+"&tools="+document.getElementById("tools").value);
		}
		function report_download_excel()
		{
			window.location.assign("includes/downloadexcel.php?cust_id="+document.getElementById("cust_id").value+"&order_id="+document.getElementById("order_id").value+"&description="+document.getElementById("description").value+"&drawing_number="+document.getElementById("drawing_number").value+"&grade="+document.getElementById("grade").value+"&material_size="+document.getElementById("material_size").value+"&machine="+document.getElementById("machine").value+"&specification="+document.getElementById("specification").value+"&tools="+document.getElementById("tools").value);
		}
		function download_hide()
		{
			if(document.getElementById("cust_id").innerHTML)
			{
				document.getElementById("hide").style.visibility="hidden";
				document.getElementById("hide1").style.visibility="hidden";
			}
		}
		function download_show()
		{
			if(document.getElementById("show").innerHTML)
			{
				document.getElementById("hide").style.visibility="visible";
				document.getElementById("hide1").style.visibility="visible";
			}
		}
	
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		$.post("includes/Reports_Display_Table.php?PaginationFor="+PaginationFor+"&CurrentPageNo="+CurrentPageNo+"&cust_id="+document.getElementById("cust_id").value+"&order_id="+document.getElementById("order_id").value+"&description="+document.getElementById("description").value+"&drawing_number="+document.getElementById("drawing_number").value+"&grade="+document.getElementById("grade").value+"&material_size="+document.getElementById("material_size").value+"&machine="+document.getElementById("machine").value+"&specification="+document.getElementById("specification").value+"&tools="+document.getElementById("tools").value, 
		function(Response)
		{
			//var Results = Response.split('$');
			document.getElementById(PaginationFor).innerHTML = Response;
			//if(PaginationFor == "Filter_Display")	
				//document.getElementById("3").innerHTML = Results[1];
		});
	}
	$( document ).ready(function()
	{
		$('#uniform-pages').removeAttr('class');
		$('#uniform-pages').removeAttr('style');
		$('#pages').removeAttr('style');
		$("#uniform-pages span").remove();
	});
	</script>
	<?php
	}
	else if($_GET['subpage']=='Machine Availability')
	{
		include("includes/Machine Availability.php");
	} ?>