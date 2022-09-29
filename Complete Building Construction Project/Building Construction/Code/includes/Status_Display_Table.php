<table class="paginate sortable full" id="Filter_Display">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Quotation Number</th>
			<th align="left">Client</th>
			<th align="left">Subject</th>
			<th align="left">Quotation Date</th>
			<th align="left">Status</th>
		</tr>
	</thead>
	<?php
	include('Config.php');
	include('Quotation_Queries.php');
	ini_set("display_errors","0");

	$status_totaldata = mysqli_fetch_assoc(Status_Total_Rows());
	echo "<br/><h3>Quotation Status: Total Number of Quotations - ".$status_totaldata["total"]."</h3>";
	if(!$_GET['Quotation_Status'])
		echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Status("getdata=particularstatus")\'><img src="images/icons/download.png"></a></div>';
	$Limit = 20;
	$total_pages = ceil($status_totaldata['total'] / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	//$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
	if(!$status_totaldata['total'])
		echo'<tr><td style="color:red" colspan="5"><center>No Data Found</center></td></tr>';
	else
	{
		$allstatus = Status_Data_ByLimit($Start,$Limit);
		while($statusall = mysqli_fetch_assoc($allstatus))
		{
			echo '<tbody>
				<tr>
					<td>'.$i++.'</td>
					<td><a href="?page=Quotation&subpage=Quotation Status&quotation_id='.$statusall['id'].'">'.$statusall['quotation_no'].'</a></td>
					<td>'.$statusall['client_name'].'</td>
					<td>'.$statusall['subject'].'</td>
					<td>'.$statusall['quotation_date'].'</td>';
					if($statusall['name'])
					{
						echo '<td>'.$statusall['name'].'</td>';
					}
					else
					{
						echo '<td>-</td>';
					}
				echo '</tr>
			</tbody>';
		}
	} ?>
</table>