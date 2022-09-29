<?php
	include("Config.php");
	include("Reports_Queries.php");
	$totaldata = mysqli_fetch_assoc(Sample_Selection_ByCountdisplay());
?>
<h4>Total Number of Samples -  <?php echo $totaldata["total"];?></h4>
<div align="right"><a href="#" title="Download" onclick='Export_Data("getdata=SampleManagement_Report")'><img src="images/icons/download.png"></a></div>
<table class="paginate sortable full">
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
	while($samplelist = mysqli_fetch_assoc($sample_list))
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