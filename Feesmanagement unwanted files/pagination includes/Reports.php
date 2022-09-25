<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#startdate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
			$("#enddate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
		});
	</script>
</head>
<br />
<center>
	<?php
	include("includes/Reports_Queries.php");
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Student_Information";
	$subheaders = array("Student_Information_Data","Payment_Information","Payment_Collection_Information");
	for($i = 0; $i < count($subheaders); $i++)
	{
		$split = explode("_", $subheaders[$i]);
		for($j = 0; $j < count($split); $j++)
		{
			if(!$j)
				$subpagename = $split[$j];
			else
				$subpagename = $subpagename." ".$split[$j];
		}
		if($_GET['subpage'] == $subheaders[$i])
			echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		else
			echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
	}
	?>
</center>
<?php 	include("includes/".$_GET['subpage'].".php"); ?>
<br />	
<?php
if(($_GET['subpage'] == 'Payment_Information'))
	{ ?>
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
						<!--td>
							<b>Fees Category</b>
							<br/>
							<select name="feescategoryid" id="feescategoryid">
								<option value="">All</option>
								<?php
									/* $Feescategory = Feescategory_List();
									while($FetchFeescategory  = mysql_fetch_array($Feescategory))
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
						if($PaymentTotalRows['total'])
						{
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
							} 
						}
						?>
					</tbody>
				</table>
			</div>
	<?php		
		}
	}
	else if($_GET['subpage'] == 'Payment_Collection_Information')
	{ ?>
		<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Class & Section:</b>
							<br/>
							<select name="sectionid" id="sectionid" onchange='Getfeescategory(this.value)'>
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
							<b>Fees Category</b>
							<br/>
							<div id='Feescategory'>
								<select name="feescategoryid" id="feescategoryid">
									<option value="">All</option>
									<?php
										$Feescategory = Feescategory_List();
										while($FetchFeescategory  = mysql_fetch_array($Feescategory))
										{
											if($FetchFeescategory['id']==$_POST['feescategoryid'])
												echo '<option value="'.$FetchFeescategory['id'].'" selected>'.$FetchFeescategory['name'].'</option>';
											else
												echo '<option value="'.$FetchFeescategory['id'].'">'.$FetchFeescategory['name'].'</option>';
										} 
									?>
								</select>
							</div>
						</td>
						<td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="startdate" id="startdate" value="<?php if($_POST['startdate']) echo $_POST['startdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="enddate" id="enddate" value="<?php if($_POST['enddate']) echo $_POST['enddate']; else echo date('d-m-Y');?>">
						</td>
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
				<a href="" title="Download" onclick='Exportalldata("getdata=Payment_Collection_Information")'><img src="images/icons/download.png"></a>	
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
	<?php		
		}
	}
	if($_POST['Search'])
		include("includes/Export.php");
	?>	
<script>
	function Export(PostBackValues)
	{
		window.open("includes/Export.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Exportalldata(PostBackValues)
	{
		window.open("includes/ExportAllData.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}	
	function Getfeescategory(sectionid)
	{
		var Response = $("#Feescategory").html(Ajax("POST","includes/Get_Fees_Categoryselect.php","sectionid="+sectionid));
	}
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		var Response = Ajax("POST","includes/Student_Information_Data.php","page=<?php echo $_GET['page'];?>"+"&PaginationFor="+PaginationFor+"&pageno="+CurrentPageNo+"&Rowsperpage="+$("#Rowsperpage").val()).split("#$");
		$("#Student_Data").html(Response[0]);
		$("#Student_Data_Pagination").html(Response[1]);
	}
</script>