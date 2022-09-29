<table class="paginate sortable full">
	<thead>
		<tr>
			<th>Sl.No.</th>
			<th>Customer</th>
			<th>Order</th>
			<th>Product</th>
			<th>DrawingNumber</th>
			<th>Grade</th>
			<th>RawMaterial Size</th>
			<th>Machine</th>
			<th>Machine Specification</th>
			<th>No.of Tools</th>
			<th>Tentative StartDate</th>
			<th>Tentative EndDate</th>
		</tr>
	</thead>
<?php
	include('Config.php');
	include('Reports_Queries.php');
	ini_set("display_errors","0");
	$i=1;
	$report_totaldata = mysqli_fetch_assoc(Report_Total_Rows());
	$Limit = 20;
	$_GET['total_pages'] = ceil($report_totaldata['total'] / $Limit);
	if(!$_GET['CurrentPageNo'])
		$_GET['CurrentPageNo'] = 1;
	$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
	$i++;
	//$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
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
	}
	?>
</table>
<?php 
	echo "<h3><center>Total Summary of Orders -".$report_totaldata['total']."</center></h3>";
	$_GET['PaginationFor'] = "Filter_Display";
	if($_GET['total_pages'] > 1)
		include("Ajax_Pagination.php");
?>