<section class="first">
	<div class="columns leading">
			<form method="post" name="form" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<?php
			
			if($_GET['subpage'] == "Job")
			{
				$i=1;
				$customer = Customer();
				echo'<div class="clearfix">
						<label>Customer</label>
						<select name="customer">
							<option value="">All</option>';
				//<select name="customer" onchange="load_Customer(this.value)">
				
				//For Ajax on change to list order number from reports_job_order
				/*while($customer_list = mysql_fetch_assoc($customer))
				{
					if($_POST['customer']==$customer_list['name'])
						echo '<option selected="selected" value='.$customer_list['id'].'>'.$customer_list['name'].'</option>';		
					else
						echo '<option value='.$customer_list['id'].'>'.$customer_list['name'].'</option>';		
				}*/
				
				while($customer_list = mysql_fetch_assoc($customer))
				{
					if($_POST['customer']==$customer_list['id'])
						echo '<option selected="selected" value='.$customer_list['id'].'>'.$customer_list['name'].'</option>';		
					else
						echo '<option value='.$customer_list['id'].'>'.$customer_list['name'].'</option>';		
				}
				echo'</select>';
				$order_number = Order();
				echo'
					<label>Order Number</label>';
					echo'<select name="order_num">
					<option value="">All</option>';
					while($order = mysql_fetch_assoc($order_number))
					{
						if($_POST['order_num']==$order['id'])
							echo'<option selected="selected" value='.$order['id'].'>'.$order['number'].'</option>';
						else
							echo'<option value='.$order['id'].'>'.$order['number'].'</option>';	
					}
					echo'</select>';
				 echo '<label>Status</label>
						<select name="status">
							<option value="">All</option>';
							if($_POST['status']=='Enabled')
								echo '<option selected="selected" value="Enabled">Enabled</option>';
							else
								echo '<option value="Enabled">Enabled</option>';
							if($_POST['status']=='Disabled')
								echo'<option selected="selected" value="Disabled">Disabled</option>';
							else
								echo'<option value="Disabled">Disabled</option>
						</select>';
				$machine = Machine();
				echo '<label>Machine</label>
						<select name="machine_number">
						<option value="">All</option>';
				while($machine_list = mysql_fetch_assoc($machine))
				{
					if($machine_list['id']==$_POST['machine_number'])
						echo'<option selected="selected" value='.$machine_list['id'].'>'.$machine_list['machine_number'].'</option>';
					else
						echo'<option value='.$machine_list['id'].'>'.$machine_list['machine_number'].'</option>';
				}
				echo '</select></div>
					<button class="button button-green" type="submit" name="submit" value="Submit">Submit</button>';
			}
			?>
		</form>
	</div>
</section>
	<div class="columns leading">
		<div class="first">
			<table width="100%" class="paginate sortable full">
				<thead>
					<tr>
						<th>Sl.No.</th>
						<th>Date</th>
						<th>Order</th>
						<th>Customer</th>
						<th>Total Order</th>
						<th>Planned</th>
						<th>Machine</th>
						<th>Product Description</th>
						<th>Location</th>
						<th>Tentative Start</th>
						<th>Tentative End</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$job_report = Job_Report();
				if(mysql_num_rows($job_report)==0)
					echo'<tr><td colspan="17" style="color:red;"><center>No Data Found</center></td></tr>';
				else
				{
					while($report = mysql_fetch_assoc($job_report))
					{
						echo '<tr>
								<td>'.$i++.'</td>
								<td>'.$report['order_date'].'</td>
								<td>'.$report['number'].'</td>
								<td>'.$report['name'].'</td>
								<td>'.$report['quantity'].'</td>
								<td>'.$report['machine_id'].'</td>
								<td>'.$report['plannedquantity'].'</td>
								<td>'.$report['description'].'</td>
								<td>'.$report['locationid'].'</td>
								<td>'.$report['tentative_date'].'</td>
								<td>'.$report['tentative_end'].'</td>
							</tr>';
					}
				}?>
				</tbody>
			</table><br/>
			<img src="includes/job_report_chart.php" alt="job_report_chart" width="1000px"/>
		</div>
	</div>
<script>
function load_Customer(str)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('ordernumber').innerHTML =xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","includes/reports_job_order.php?ord_num="+str,true);
	xmlhttp.send();
}
</script>