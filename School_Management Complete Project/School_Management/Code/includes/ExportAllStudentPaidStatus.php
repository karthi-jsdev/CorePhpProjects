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
				<a href="" title="Download" onclick='Exportalldata("getdata=Student_Paid_Status")'><img src="images/icons/download.png"></a>	
				<?php 
					$monthnumber =  date('m', strtotime('-1 month'));
					$Currentmonthnumber = $monthnumber - 4; 
					$month = array("1"=>"May","2"=>"Jun","3"=>"Jul","4"=>"Aug","5"=>"Sep","6"=>"Oct","7"=>"Nov","8"=>"Dec","9"=>"Jan","10"=>"Feb","11"=>"Mar","12"=>"Apr");
					foreach ($month as $mo=>$mname)
					{
						if($Currentmonthnumber == $mo)
						$Monthname .= $mname;
					}	
				?>
				<h3><?php echo $Monthname."-MONTH-";?>Student Paid Information List
					<?php
						$PaymentpaidTotalRows = mysql_fetch_assoc(Paymentpaid_Select_Count_All());
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
							$paymentstatus_info = Paymentstatus_Select_ByLimit();
							while($paymentstatus = mysql_fetch_assoc($paymentstatus_info))
							{
								$Feescategory = "";
								if($paymentstatus['fees_catagoryids'])
								{
									$CatNames = mysql_query("SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id=".str_replace(",", " || fees_category_assign.id=", $paymentstatus['fees_catagoryids']));
									while($CatName = mysql_fetch_array($CatNames))
										$Feescategory .= $CatName['name'].", ";
								}
								$Totalamount = $paymentstatus['paidamount'] - $paymentstatus['scholarshipamount'] + $paymentstatus['fineamount'];
								echo "<tr style='valign:middle;'>
									<td align='center'>".$i++."</td>
									<td>".$paymentstatus['first_name']." ".$paymentstatus['last_name']."</td>
									<td>".$paymentstatus['cname']." & ".$paymentstatus['sname']."</td>
									<td>".$Feescategory."</td>
									<td>".$paymentstatus['paidamount']."</td>
									<td>".$paymentstatus['scholarshipamount']."</td>
									<td>".$paymentstatus['fineamount']."</td>
									<td>".$Totalamount."</td>";
									if($Totalamount)
										echo "<td style='color:green'>Paid</td>";
									else 	
										echo "<td style='color:red'>Not Paid</td>";
									echo"	
									<td>".$paymentstatus['contact_person']."</td>	
									<td>".$paymentstatus['contact_no']."</td>	
								</tr>";
							} 
						}
						?>
					</tbody>
				</table>
			</div>
	<?php		