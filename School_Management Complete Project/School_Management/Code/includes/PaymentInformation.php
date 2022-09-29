<?php include("includes/Reports_Queries.php");?>
<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Class & Section:</b>
							<br/>
							<select name="sectionid" id="sectionid">
								<option value="">All</option>
								<?php
									$Selectclass = Class_List();
									while($Fetchclass  = mysqli_fetch_array($Selectclass))
									{
										if($Fetchclass['sectionid']==$_POST['sectionid'])
											echo '<option value="'.$Fetchclass['sectionid'].'" selected>'.$Fetchclass['classname'].'  &  '.$Fetchclass['sname'].'</option>';
										else
											echo '<option value="'.$Fetchclass['sectionid'].'">'.$Fetchclass['classname'].'  &  '.$Fetchclass['sname'].'</option>';
									}
								?>
							</select>
						</td>
						<!--td>
							<b>Fees Category</b>
							<br/>
							<select name="feescategoryid" id="feescategoryid">
								<option value="">All</option>
								<?php
									/* $Feescategory = Feescategory_List();
									while($FetchFeescategory  = mysqli_fetch_array($Feescategory))
									{
										if($FetchFeescategory['id']==$_POST['feescategoryid'])
											echo '<option value="'.$FetchFeescategory['id'].'" selected>'.$FetchFeescategory['name'].'</option>';
										else
											echo '<option value="'.$FetchFeescategory['id'].'">'.$FetchFeescategory['name'].'</option>';
									} */
								?>
							</select>
						</td-->
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if($_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&sectionid='.$_POST['sectionid'].'&Search=1")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
			</form>
			<hr/>
		</div>
<?php		
		if(!$_POST['Search'])	
		{ ?>
			<div class="columns">
				<a href="" title="Download" onclick='Exportalldata("getdata=Payment_Information")'><img src="images/icons/download.png"></a>	
				<h3>Payment Information List
					<?php
						$PaymentTotalRows = mysqli_fetch_assoc(Payment_Select_Count_All());
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
							while($payment = mysqli_fetch_assoc($payment_info))
							{
								$Amountpaid = $payment['paidamount'] - $payment['scholarshipamount'] + $payment['fineamount'];
								$Correctamount = $payment['paidamount'] - $payment['scholarshipamount'];
								$Feescategory = "";
								if($payment['fees_catagoryids'])
								{
									$CatNames = mysqli_query($_SESSION['connection'],"SELECT fees_catagory.name FROM  fees_category_assign JOIN fees_catagory on fees_category_assign.feescategoryid = fees_catagory.id where fees_category_assign.id=".str_replace(",", " || fees_category_assign.id=", $payment['fees_catagoryids']));
									while($CatName = mysqli_fetch_array($CatNames))
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
							} 
						?>
					</tbody>
				</table>
			</div>
	<?php		
		} 
		if($_POST['Search'])
			include("includes/ExportPaymentInformation.php");	
	?>	
<script>
	function Export(PostBackValues)
	{
		window.open("includes/ExportPaymentInformation.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Exportalldata(PostBackValues)
	{
		window.open("includes/ExportAllPaymentInformation.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}	
</script>