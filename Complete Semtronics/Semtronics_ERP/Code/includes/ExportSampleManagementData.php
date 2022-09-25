<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		$vendorname = mysql_fetch_assoc(mysql_query("SELECT samples.id,`oppurtunity_id`, leads.name,product.description,samples.date,samples.company,samples.contact_person,samples.designation,samples.email_id,samples.contact_no,samples.assigned_to,samples.sample_prize,samples.no_of_samples,samples.follow_up,samples.`specification` 
							from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id WHERE samples.date BETWEEN '".date('Y-m-d',strtotime($_GET["startdate"]))."' AND '".date('Y-m-d',strtotime($_GET["enddate"]))."' ORDER BY samples.id DESC"));
		echo '<div align="center">
		<h4>Sample Management Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$_GET['startdate'].  '-' .$_GET['enddate'].'</div><div align="right">Report Date:'.date("d-m-Y").'
		</h4></div>';
	}
	if($_GET['getdata']=='SampleManagement_Report')
	{ 
	$totaldata = mysql_fetch_assoc(Sample_Selection_ByCountdisplay());
	?>
	<h4>Total Number of Samples -  <?php echo $totaldata["total"];?></h4>
	<table class="paginate sortable full" border="1">
	<thead>
		<tr>
			<th>Sample No.</th>
			<th>Lead Name</th>
			<th>Work No.</th>
			<th>Specification</th>
			<th>Product</th>
			<th>Date</th>
			<th>Contact Person</th>
			<th>Designation</th>
			<th>Email</th>
			<th>Contact No.</th>
			<th>Company</th>
			<th>Assigned To</th>
			<th>Price</th>
			<th>Sample Quantity</th>
			<th>Follow Update</th>
		</tr>
	</thead>
	<?php
	if(!$totaldata['total'])
		echo'<tr><td style="color:#FF0000;" colspan="16"><center>No data Found</center></td></tr>';
	$i = 1;
	$i++;
	$sample_list = Sample_Selection();
	while($samplelist = mysql_fetch_assoc($sample_list))
	{
		$Samplesid = $samplelist['id'];
		if(strlen($Samplesid)==1)
			$sample = "S000000".$Samplesid;
		else if(strlen($Samplesid)==2)
			$sample = "S00000".$Samplesid;
		else if(strlen($Samplesid)==3)
			$sample = "S0000".$Samplesid;
		else if(strlen($Samplesid)==4)
			$sample = "S000".$Samplesid;
		else if(strlen($Samplesid)==5)
			$sample = "S00".$Samplesid;
		else if(strlen($Samplesid)==6)
			$sample = "S0".$Samplesid;
		else if(strlen($Samplesid)==7)
			$sample = "S".$Samplesid;
		$Work_d = $samplelist['oppurtunity_id'];
		if(strlen($Work_d)==1)
			$work = "WK000000".$Work_d;
		else if(strlen($Work_d)==2)
			$work = "WK00000".$Work_d;
		else if(strlen($Work_d)==3)
			$work = "WK0000".$Work_d;
		else if(strlen($Work_d)==4)
			$work = "WK000".$Work_d;
		else if(strlen($Work_d)==5)
			$work = "WK00".$Work_d;
		else if(strlen($Work_d)==6)
			$work = "WK0".$Work_d;
		else if(strlen($Work_d)==7)
			$work = "WK".$Work_d;
		echo'<tbody>
			<tr>
				<td>'.$sample.'</td>
				<td>'.$samplelist['name'].'</td>
				<td>'.$work.'</td>
				<td>'.wordwrap($samplelist['specification'],20,"\n",true).'</td>
				<td>'.$samplelist['description'].'</td>
				<td>'.date('d-m-Y',strtotime($samplelist['date'])).'</td>
				<td>'.$samplelist['contact_person'].'</td>
				<td>'.$samplelist['designation'].'</td>
				<td>'.$samplelist['email_id'].'</td>
				<td>'.$samplelist['contact_no'].'</td>
				<td>'.wordwrap($samplelist['company'],10,"\n",true).'</td>
				<td>'.$samplelist['assigned_to'].'</td>
				<td>'.$samplelist['sample_prize'].'</td>
				<td>'.$samplelist['no_of_samples'].'</td>
				<td>'.date('d-m-Y',strtotime($samplelist['follow_up'])).'</td>
			</tr>
		</tbody>';
	}
	?>	
</table>
	<?php
	} ?> 