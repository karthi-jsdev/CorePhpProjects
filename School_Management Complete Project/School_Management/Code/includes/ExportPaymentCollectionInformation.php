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
				<h3>Payment Collection Information List
					<?php
						$PaymentcollectionTotalRows = mysql_num_rows(Paymentcollection_Select_Count_byclass());
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