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
	}
	if($_GET['getdata'] == "Student_Information")
	{ ?>
		<div class="columns">
			<h3>Student Information List
				<?php
					$StudentTotalRows = mysql_fetch_assoc(Student_Select_Count_All());
					echo " : No. of Students - ".$StudentTotalRows['total'];
				?>
			</h3>
			<hr />	
				
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Student Name</th>
						<th align="left">Father's Name</th>
						<th align="left">Admission Date</th>
						<th align="left">Class & Section</th>
						<th align="left">Gender</th>
						<th align="left">Residence Address</th>
						<th align="left">Contact Person</th>
						<th align="left">Contact Number</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$StudentTotalRows['total'])
						echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
					/* $Limit = 10;
					$total_pages = ceil($StudentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++; */
						$student_info = Student_Select_ByLimit($Start, $Limit);
					while($student = mysql_fetch_assoc($student_info))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$student['first_name']." ".$student['last_name']."</td>
							<td>".$student['father_name']."</td>
							<td>".$student['admission_date']."</td>
							<td>".$student['classname']." & ".$student['sname']."</td>
							<td>".$student['gender']."</td>
							<td>".$student['residenceaddress']."</td>
							<td>".$student['contact_person']."</td>
							<td>".$student['contact_no']."</td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
<?php	
	}
	else if($_GET['getdata'] == "Payment_Information")
	{ ?>
		<div class="columns">
			<h3>Payment Information List
				<?php
					$PaymentTotalRows = mysql_fetch_assoc(Payment_Select_Count_All());
					echo " : No. of PaymentDetails - ".$PaymentTotalRows['total'];
				?>
			</h3>
			<hr />	
				
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Student Name</th>
						<th align="left">Class & Section</th>
						<th align="left">Gender</th>
						<th align="left">FeesName</th>
						<th align="left">Total Amount</th>
						<th align="left">Scholarship Amount</th>
						<th align="left">Fine Amount</th>
						<th align="left">Paid Amount</th>
						<th align="left">Date Of Paid</th>
						<th align="left">Contact Person</th>
						<th align="left">Contact Number</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$PaymentTotalRows['total'])
						echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
					/* $Limit = 10;
					$total_pages = ceil($StudentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit; */
					$i = 1;
					$payment_info = Payment_Select_ByLimit($Start, $Limit);
					while($payment = mysql_fetch_assoc($payment_info))
					{
						$Amountpaid = $payment['paidamount'] - $payment['scholarshipamount'] + $payment['fineamount'];
								$Correctamount = $payment['paidamount'] - $payment['scholarshipamount'];
								$Feescategory = "";
								if($payment['fees_catagoryids'])
								{
									$CatNames = mysql_query("SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id=".str_replace(",", " || fees_category_assign.id=", $payment['fees_catagoryids']));
									while($CatName = mysql_fetch_array($CatNames))
										$Feescategory .= $CatName['name'].", ";
								}
								echo "<tr style='valign:middle;'>
									<td align='center'>".$i++."</td>
									<td>".$payment['first_name']." ".$payment['last_name']."</td>
									<td>".$payment['classname']." & ".$payment['sname']."</td>
									<td>".$payment['gender']."</td>
									<td>".$Feescategory."</td>
									<td>".$payment['paidamount']."</td>
									<td>".$payment['scholarshipamount']."</td>";
									if($payment['finepaid'] == '1')
										echo "<td>".$payment['fineamount']."</td><td>".$Amountpaid."</td>";
									else	
										echo "<td>0</td><td>".$Correctamount."</td>";
									echo 	
									"<td>".$payment['datetime']."</td>
									<td>".$payment['contact_person']."</td>
									<td>".$payment['contact_no']."</td>
								</tr>";
					} ?>
				</tbody>
			</table>
		</div>
<?php	
	}
	else if($_GET['getdata'] == "Payment_Collection_Information")
	{ ?>
		<div class="columns">
				<h3>Payment Collection Information List
					<?php
						$PaymentcollectionTotalRows = mysql_fetch_assoc(Paymentcollection_Select_Count_All());
						echo " : No. of PaymentDetails - ".$PaymentcollectionTotalRows['total'];
					?>
				</h3>
				<hr />	
				
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Class & Section</th>
							<th align="left">FeesName</th>
							<th align="left">Total Amount</th>
							<th align="left">Scholarship Amount</th>
							<th align="left">Fine Amount</th>
							<th align="left">Total Collection Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!$PaymentcollectionTotalRows['total'])
							echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
						/* $Limit = 10;
						$total_pages = ceil($StudentTotalRows['total'] / $Limit);
						if(!$_GET['pageno'])
							$_GET['pageno'] = 1;
						$i = $Start = ($_GET['pageno']-1)*$Limit; */
						$i = 1;
						if($PaymentcollectionTotalRows['total'])
						{
							$paymentcollection_info = Paymentcollection_Select_ByLimit();
							while($paymentcollection = mysql_fetch_assoc($paymentcollection_info))
							{
								$Feescategory = "";
								if($paymentcollection['fees_catagoryids'])
								{
									$CatNames = mysql_query("SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id=".str_replace(",", " || fees_category_assign.id=", $paymentcollection['fees_catagoryids']));
									while($CatName = mysql_fetch_array($CatNames))
										$Feescategory .= $CatName['name'].", ";
								}
								$Totalamount = $paymentcollection['paidamount'] - $paymentcollection['scholarshipamount'] + $paymentcollection['fineamount'];
								echo "<tr style='valign:middle;'>
									<td align='center'>".$i++."</td>
									<td>".$paymentcollection['classname']." & ".$paymentcollection['sname']."</td>
									<td>".$Feescategory."</td>
									<td>".$paymentcollection['paidamount']."</td>
									<td>".$paymentcollection['scholarshipamount']."</td>
									<td>".$paymentcollection['fineamount']."</td>
									<td>".$Totalamount."</td>
								</tr>";
							} 
						}
						?>
					</tbody>
				</table>
			</div>
	<?php }		
?>