<?php
	header("Content-Type: application/msexcel");
	header("Content-Disposition: attachment; filename=".str_replace(" ", "_", 'CHIRAMITH PRECISION(INDIA) Report'.date("d-m-Y H-i")).".xls");
	header("Content-Type: application/octet-stream");
	
	include('Config.php');
	include('Reports_Queries.php');
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	echo'<h3 align="center"> CHIRAMITH PRECISION (INDIA) </h3>
	<h3 align="center"> Summary Of Reports &nbsp; DATE:'.date("d-m-Y H-i").'</h3>';
	
	$customer = Report_Customer();
	if(mysqli_num_rows($customer)==0)
		echo '<table><tr><td><i style="color:red">Customer:</i>All</td>';
	else
	{
		$cust= mysqli_fetch_assoc($customer);
		echo '<td><i style="color:red">Customer:</i>'.$cust['name'].'</td>';
	}
	$order = Report_Order();
	if(mysqli_num_rows($order)==0)
		echo '<td><i style="color:red">Order:</i>All</td>';
	else
	{
		$order_number= mysqli_fetch_assoc($order);
		echo '<td><i style="color:red">Order:</i>'.$order_number['number'].'</td>';
	}
	$product = Report_Description();
	if(mysqli_num_rows($product)==0)
		echo'<td><i style="color:red">Product:</i>All</td>';
	else
	{
		$product_description = mysqli_fetch_assoc($product);
		echo'<td><i style="color:red">Product Description:</i>'.$product_description['description'].'</td>';
	}
	$product_draw_no = Report_Drawing_number();
	if(mysqli_num_rows($product_draw_no)==0)
		echo'<td><i style="color:red">Drawing_number:</i>All</td>';
	else
	{
		$product_drawno = mysqli_fetch_assoc($product_draw_no);
		echo'<td><i style="color:red">Drawing_number:</i>'.$product_drawno['drawing_number'].'</td>';
	}
	$product_grade = Report_Grade();
	if(mysqli_num_rows($product_grade)==0)
		echo'<td><i style="color:red">Grade:</i>All</td>';
	else
	{
		$produc_grade = mysqli_fetch_assoc($product_grade);
		echo'<td><i style="color:red">Grade:</i>'.$produc_grade['grade'].'</td>';
	}
	$product_rawmaterialsize = Report_Rawmaterialsize();
	if(mysqli_num_rows($product_rawmaterialsize)==0)
		echo'<td><i style="color:red">Grade:</i>All</td>';
	else
	{
		$product_rawmaterialsize = mysqli_fetch_assoc($product_rawmaterialsize);
		echo'<td><i style="color:red">Grade:</i>'.$product_rawmaterialsize['material_size'].'</td>';
	}
	$machine = Report_Machine();
	if(mysqli_num_rows($machine)==0)
		echo '<td><i style="color:red">Machine_Number:</i>All</td>';
	else
	{
		$machine_number = mysqli_fetch_assoc($machine);
		echo '<td><i style="color:red">Machine_Number:</i>'.$machine_number['machine_number'].'</td>';
	}
	$specification = Report_Specification();
	if(mysqli_num_rows($specification)==0)
		echo '<td><i style="color:red">Specification:</i>All</td>';
	else
	{
		$machine_specification = mysqli_fetch_assoc($specification);
		echo '<td><i style="color:red">Specification:</i>'.$machine_specification['specification'].'</td>';
	}
	$tools = Report_Tools();
	if(mysqli_num_rows($tools)==0)
		echo '<td><i style="color:red">Machine Turning Tools</i>:All</td>';
	else
	{
		$machine_turningtool = mysqli_fetch_assoc($tools);
		echo '<td><i style="color:red">Machine Turning Tools:</i>'.$machine_turningtool['turningtool'].'</td></tr>';
	} ?>
	</table><br/>
	<table border="1">
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
		$allreport = Report_Data_Download_Excel();
		if(mysqli_num_rows($allreport) == 0)
			echo'<tr><td style="color:red" colspan="10"><center>No Data Found</center></td></tr>';
		else
		{
			while($reportsall = mysqli_fetch_assoc($allreport))
			{
				echo '<tbody>
					<tr>
						<td align="left">'.$i++.'</td>
						<td align="left">'.$reportsall['name'].'</td>
						<td align="left">'.$reportsall['number'].'</td>
						<td align="left">'.$reportsall['description'].'</td>
						<td align="left">'.$reportsall['draw_number'].'</td>
						<td align="left">'.$reportsall['grade'].'</td>
						<td align="left">'.$reportsall['material_size'].'</td>
						<td align="left">'.$reportsall['machineno'].'</td>
						<td align="left">'.$reportsall['specification'].'</td>
						<td align="left">'.$reportsall['tool'].'</td>
						<td align="left">'.date('d-m-Y',strtotime($reportsall['tentative_date'])).'</td>
						<td align="left">'.date('d-m-Y',strtotime($reportsall['tentative_enddate'])).'</td>
					</tr>
				</tbody>';
			}
		} ?>
	</table>