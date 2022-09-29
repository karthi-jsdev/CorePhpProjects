	<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		$_POST['Search'] = $_GET['Search'];
		$_POST['sectionid'] = $_GET['sectionid'];
		$_POST['startdate'] = $_GET['startdate'];
		$_POST['enddate'] = $_GET['enddate'];
		$_POST['monthid'] = $_GET['monthid'];
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['subpage'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['subpage'] == 'Student_Information')
	{
	?>
		<div class="columns">
			<h3>Student Information List
				<?php
				if($_POST['Search'])
					$StudentTotalRows = mysqli_fetch_assoc(Student_Count_ByClass());
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
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$i = 1;
					/* $Limit = 10;
					$total_pages = ceil($StudentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++; */
					$student_info = Student_Select_ByClass($Start, $Limit);
					while($student = mysqli_fetch_assoc($student_info))
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
	else if($_GET['subpage'] == 'Payment_Information')
	{ ?>
		<div class="columns">
			<h3>Payment Information List
				<?php
					$PaymentTotalRows = mysqli_fetch_assoc(Payment_Select_Count_byclass());
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
					$i = 1;
					if(!$PaymentTotalRows['total'])
						echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
					/* $Limit = 10;
					$total_pages = ceil($StudentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit; */
					$payment_info = Payment_Select_ByclassLimit($Start, $Limit);
					while($payment = mysqli_fetch_assoc($payment_info))
					{
						$Amountpaid = $payment['paidamount'] - $payment['scholarshipamount'] + $payment['fineamount'];
								$Correctamount = $payment['paidamount'] - $payment['scholarshipamount'];
								$Feescategory = "";
								$feesname = explode(',',$payment['fees_catagoryids']);
								foreach($feesname as $id)
								{
									$Feescategorname  =	mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id = '".$id."'"));
									$Feescategory .= $Feescategorname['name'].",";
								}
								echo "<tr style='valign:middle;'>
									<td align='center'>".$i++."</td>
									<td>".$payment['first_name']." ".$payment['last_name']."</td>
									<td>".$payment['classname']." & ".$payment['sname']."</td>
									<td>".$payment['gender']."</td>
									<td>".$Feescategory."</td>
									<td>".number_format($payment['paidamount'],2)."</td>
									<td>".number_format($payment['scholarshipamount'],2)."</td>";
									if($payment['finepaid'] == '1')
										echo "<td>".number_format($payment['fineamount'],2)."</td><td>".number_format($Amountpaid,2)."</td>";
									else	
										echo "<td>0</td><td>".number_format($Correctamount,2)."</td>";
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
	else if($_GET['subpage'] == 'Payment_Collection_Information')
	{
	?>
		<div class="columns">
				<h3>Payment Collection Information List
					<?php
						$PaymentcollectionTotalRows = mysqli_num_rows(Paymentcollection_Select_Count_byclass());
						echo " : No. of PaymentDetails - ".$PaymentcollectionTotalRows;
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
						if($PaymentcollectionTotalRows == 0)
							echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
						/* $Limit = 10;
						$total_pages = ceil($StudentTotalRows['total'] / $Limit);
						if(!$_GET['pageno'])
							$_GET['pageno'] = 1;
						$i = $Start = ($_GET['pageno']-1)*$Limit; */
						$i = 1;
						if($PaymentcollectionTotalRows != 0)
						{
							$paymentcollection_info = Paymentcollection_Select_ByclassLimit();
							while($paymentcollection = mysqli_fetch_assoc($paymentcollection_info))
							{
								$Feescategory = "";
								if($paymentcollection['fees_catagoryids'])
								{
									$CatNames = mysqli_query($_SESSION['connection'],"SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id=".str_replace(",", " || fees_category_assign.id=", $paymentcollection['fees_catagoryids']));
									while($CatName = mysqli_fetch_array($CatNames))
										$Feescategory .= $CatName['name'].", ";
								}
								$Totalamount = $paymentcollection['paidamount'] - $paymentcollection['scholarshipamount'] + $paymentcollection['fineamount'];
								echo "<tr style='valign:middle;'>
									<td align='center'>".$i++."</td>
									<td>".$paymentcollection['classname']." & ".$paymentcollection['sname']."</td>
									<td>".$Feescategory."</td>
									<td>".number_format($paymentcollection['paidamount'],2)."</td>
									<td>".number_format($paymentcollection['scholarshipamount'],2)."</td>
									<td>".number_format($paymentcollection['fineamount'],2)."</td>
									<td>".number_format($Totalamount,2)."</td>
								</tr>";
							} 
						}
						?>
					</tbody>
				</table>
			</div>
<?php
	}
	else if($_GET['subpage'] == 'Student_Paid_Status')
	{ ?>
		<div class="columns">
		<h3>Student Paid Information List
			<?php
				$PaymentpaidTotalRows = mysqli_fetch_assoc(Paymentpaid_Select_Count_by_class());
				echo " : No. of PaymentDetails - ".$PaymentpaidTotalRows['total'];
			?>
		</h3>
		<hr />	
		
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">StudentName</th>
					<th align="left">Class & Section</th>
					<th align="left">FeesName</th>
					<th align="left">Total Amount</th>
					<th align="left">Scholarship Amount</th>
					<th align="left">Fine Amount</th>
					<th align="left">Total Collection Amount</th>
					<th align="left">Payment Status</th>
					<th align="left">Contact Person</th>
					<th align="left">Contact Number</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$PaymentpaidTotalRows['total'])
					echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
				/* $Limit = 10;
				$total_pages = ceil($StudentTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				$i = $Start = ($_GET['pageno']-1)*$Limit; */
				$i = 1;
				if($PaymentpaidTotalRows['total'])
				{
					$paymentstatus_info = Paymentstatus_Select_classByLimit();
					while($paymentstatus = mysqli_fetch_assoc($paymentstatus_info))
					{
						$Feescategory = "";
						if($paymentstatus['fees_catagoryids'])
						{
							$CatNames = mysqli_query($_SESSION['connection'],"SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id=".str_replace(",", " || fees_category_assign.id=", $paymentstatus['fees_catagoryids']));
							while($CatName = mysqli_fetch_array($CatNames))
								$Feescategory .= $CatName['name'].", ";
						}
						$Totalamount = $paymentstatus['paidamount'] - $paymentstatus['scholarshipamount'] + $paymentstatus['fineamount'];
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$paymentstatus['first_name']." ".$paymentstatus['last_name']."</td>
							<td>".$paymentstatus['cname']." & ".$paymentstatus['sname']."</td>
							<td>".$Feescategory."</td>
							<td>".number_format($paymentstatus['paidamount'],2)."</td>
							<td>".number_format($paymentstatus['scholarshipamount'],2)."</td>
							<td>".number_format($paymentstatus['fineamount'],2)."</td>
							<td>".number_format($Totalamount,2)."</td>";
							if($Totalamount)
								echo "<td style='color:green'>Paid</td>";
							else 	
								echo "<td style='color:red'>Not Paid</td>";
							echo"	
							<td>".$paymentstatus['contact_person']."</td>	
							<td>".$paymentstatus['contact_no']."</td>	
						</tr>";
					}
				} ?>
			</tbody>
		</table>
	</div>
<?php
	} ?>
	