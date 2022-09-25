<?php 
	include("includes/Reports_Queries.php");
?>
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
									while($Fetchclass  = mysql_fetch_array($Selectclass))
									{
										if($Fetchclass['sectionid']==$_POST['sectionid'])
											echo '<option value="'.$Fetchclass['sectionid'].'" selected>'.$Fetchclass['classname'].'  &  '.$Fetchclass['sname'].'</option>';
										else
											echo '<option value="'.$Fetchclass['sectionid'].'">'.$Fetchclass['classname'].'  &  '.$Fetchclass['sname'].'</option>';
									}
								?>
							</select>
						</td>
						<td>
							<b>Month</b>
							<br/>
							<select name="monthid" id="monthid">
								<option value="">All</option>
								<?php
								$monthnumber =  date('m', strtotime('-1 month'));
								$Currentmonthnumber = $monthnumber - 4;
									$month = array("1"=>"May","2"=>"Jun","3"=>"Jul","4"=>"Aug","5"=>"Sep","6"=>"Oct","7"=>"Nov","8"=>"Dec","9"=>"Jan","10"=>"Feb","11"=>"Mar","12"=>"Apr");
									foreach($month as $mo=>$mname)
									{
										if($_POST['monthid'] == $mo)
											echo '<option value='.$mo.' selected>'.$mname.'</option>';
										else if($Currentmonthnumber == $mo)	
											echo '<option value='.$mo.' selected>'.$mname.'</option>';
										else 	
											echo '<option value='.$mo.'>'.$mname.'</option>';
									}	
								?>
							</select>
						</td>
						<!--td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="startdate" id="startdate" value="<?php if($_POST['startdate']) echo $_POST['startdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="enddate" id="enddate" value="<?php if($_POST['enddate']) echo $_POST['enddate']; else echo date('d-m-Y');?>">
						</td-->
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if($_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&sectionid='.$_POST['sectionid'].'&feescategoryid='.$_POST['feescategoryid'].'&startdate='.$_POST['startdate'].'&enddate='.$_POST['enddate'].'&Search=1")\'>Download</a>';
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
				<a href="" title="Download" onclick='Exportalldata("getdata=Student_Paid_Status")'><img src="images/icons/download.png"></a>	
				<h3>Student Paid Information List
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
	}
	if($_POST['Search'])
		include("includes/ExportStudentPaidStatus.php");
	?>	
<script>
	function Export(PostBackValues)
	{
		window.open("includes/ExportStudentPaidStatus.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Exportalldata(PostBackValues)
	{
		window.open("includes/ExportAllStudentPaidStatus.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}			
</script>