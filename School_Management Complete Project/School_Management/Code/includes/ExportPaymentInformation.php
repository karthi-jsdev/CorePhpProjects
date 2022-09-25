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
?>
<div class="columns">
			<h3>Payment Information List
				<?php
					$PaymentTotalRows = mysql_fetch_assoc(Payment_Select_Count_byclass());
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
					while($payment = mysql_fetch_assoc($payment_info))
					{
						$Amountpaid = $payment['paidamount'] - $payment['scholarshipamount'] + $payment['fineamount'];
								$Correctamount = $payment['paidamount'] - $payment['scholarshipamount'];
								$Feescategory = "";
								$feesname = explode(',',$payment['fees_catagoryids']);
								foreach($feesname as $id)
								{
									$Feescategorname  =	mysql_fetch_array(mysql_query("SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id = '".$id."'"));
									$Feescategory .= $Feescategorname['name'].",";
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