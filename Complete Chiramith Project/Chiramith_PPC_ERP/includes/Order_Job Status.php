<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#tentative_date").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
		});
	</script>
</head>
<?php
if($_GET['id'] && $_GET['action']=='Edit')	
	$Editing_Job = mysqli_fetch_array(JobEdit_Selected($_GET['id'],$_GET['jobid']));
if($_POST['update'])
	Job_All_Update_ById($_GET['jobid']);
if($_GET['action']=='Edit' && !isset($_POST['update']))
{ ?>
	<div class="columns">
		<?php echo $message; ?> 
		<div class="grid_6 first"  style="width:950px;">
			<form method="post" id="form" class="form panel" action="#" onsubmit="return validation()">
				<header><h2>Create Job</h2></header><hr />				
				<fieldset>
					<div class="clearfix" style="padding-left:25px;" >
						<label>Order No <font color="red">*</font>
						<input type="text"  id="number" name="number" required="required" value="<?php echo $Editing_Job['number']; ?>" onkeypress="return AlphaNumCheck(event)" disabled /></label>
						<label>Customer Name <font color="red">*</font>
							<select id="customer_id" name="customer_id" disabled>
								<option value="">Select</option>
								<?php
								$Customers = Customers_Select_All();
								while($Customer = mysqli_fetch_assoc($Customers))
								{
									if($Customer['id'] == $Editing_Job['customer_id'])
										echo "<option value=".$Customer['id']." selected>".$Customer['name']."</option>";
									else
										echo "<option value=".$Customer['id'].">".$Customer['name']."</option>";
								} ?>
							</select>
						</label>
					</div>
					<div id="New" style="border:1px solid;border-radius:15px;">
						<div class="clearfix" style="padding-left:25px;">
							<label>Drawing Number <font color="red">*</font>
								<select id="product_id" name="product_id" disabled>
									<option value="">Select</option>
									<?php
									$Products = Products_Select_All();
									while($Product = mysqli_fetch_assoc($Products))
									{
										if($Product['id'] == $Editing_Job['product_id'])
											echo "<option value=".$Product['id']." selected>".$Product['drawing_number']."</option>";
										else
											echo "<option value=".$Product['id'].">".$Product['drawing_number']."</option>";
									} ?>
								</select>
							</label>
							<label>Total Order Quantity <font color="red">*</font>
								<input type="text" id="totalorderquantity" name="totalorderquantity" required="required" value="<?php echo $Editing_Job['totalorderquantity']; ?>" onkeypress="return isNumeric(event)"/>
							</label>
							<label>Planned Quantity <font color="red">*</font>
								<input type="text" id="plannedquantity"  name="plannedquantity" required="required" value="<?php echo $Editing_Job['plannedquantity']; ?>" onkeypress="return isNumeric(event)"/>
							</label>
							<label>Total No.of Machine Setting Days<font color="red">*</font>
								<input type="text" id="settingdays" name="settingdays" required="required" value="<?php echo $Editing_Job['settingdays']; ?>" onkeypress="return isNumeric(event)"/>
							</label>
						</div>
						<div class="clearfix" style="padding-left:25px;">
							<label>Machine <font color="red">*</font>
								<select id="machine_id" name="machine_id" disabled>
									<option value="">Select</option>
									<?php
									$SelectedMachineId = "";
									$Machines = Machines_Select_All();
									while($Machine = mysqli_fetch_assoc($Machines))
									{
										if($Machine['id'] == $Editing_Job['machine_id'])
										{
											echo "<option value=".$Machine['id']." selected>".$Machine['machine_number']."</option>";
											$SelectedMachineId = $Machine['id'];
										}
										else
											echo "<option value=".$Machine['id'].">".$Machine['machine_number']."</option>";
									} ?>
								</select>
							</label>
							<label>Production Hours <font color="red">*</font>
								<input type="text" id="productionhours" name="productionhours" required="required" value="<?php echo $Editing_Job['productionhours']; ?>" onkeypress="return isNumeric(event)"/>
							</label>
							<label>Tentative Machine Setting Date <font color="red">*</font>
								<input type="text" id="tentative_date" name="tentative_date" required="required" value="<?php echo date("d-m-Y", strtotime($Editing_Job['tentative_date'])); ?>" onkeypress="return false" />
							</label>
							<label>Tentative Machine End Date <font color="red">*</font>
								<input type="text" id="tentative_enddate" name="tentative_enddate" required="required" value="<?php echo date("d-m-Y", strtotime($Editing_Job['tentative_enddate'])); ?>" onkeypress="return false;" />
							</label>
						</div>
						<div id="countingdays" name="countingactions" onclick="Countingdays()" style="padding-left:25px;">
							<table>
								<label>Actions <font color="red">*</font></label>
								<tr><td><input type="radio" value="add" id="actions" name="actions">add</input></td>
								<td><input type="radio" value="sub" id="actions" name="actions">sub</input></td></tr>
							</table>
						</div>
						<div id="Days" name="Days">
							<table>
								<tr>
									<td width="100px">
										<label>Counting Days <font color="red">*</font></label>
										<select name='counter' id='counter'>
											<option value="0">Select</option>
											<?php
											if($_GET['jobid'])
											{
												$NextJob = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT product.drawing_number, job.tentative_date, `order`.number FROM job
												JOIN product ON product.id=job.product_id
												JOIN `order` ON `order`.id=job.order_id
												WHERE job.machine_id=".$SelectedMachineId." && job.id!=".$_GET['jobid']." && tentative_date>".$Editing_Job['tentative_enddate']." ORDER BY job.id LIMIT 1"));
												$timeDiff = abs(strtotime($NextJob['tentative_date']) - strtotime($Editing_Job['tentative_enddate']));
												$IncLimit = intval($timeDiff/86400);
											}
											else
												$IncLimit = 31;
											for($i=1; $i<$IncLimit; $i++)
												echo "<option value=".$i.">".$i."</option>";
											?>
										</select>
									</td>
									<?php
									if($NextJob)
										echo "<td><label><font color='red'>Affecting job : ".$NextJob['drawing_number'].",<br /><a href='?page=Order&subpage=Job Status&number=".$NextJob['number']."'>Order No. : ".$NextJob['number']."</a>,<br />Setting Date : ".date("d-m-Y", strtotime($NextJob['tentative_date']))."</font></label></td>";
									?>
									<td>	
										<label>Reason</label>
										<textarea name="reason"  id="reason" value="reason"></textarea>
									</td>
								</tr>	
							</table>	
						</div><br />
					</div>
					<center style="padding-left:350px;">
						<br /><input type="submit" class="button button-green" name="update" value="update" />
					</center>
				</fieldset>
			</form>
		</div>
	</div>
<?php
}
if($_GET['action']=='Delete')
	JobDelete_Selected($_GET['jobid']);
?>
<div class="clear">&nbsp;</div>
<div class="columns" style="width:950px;">
	<h3>
		<?php
		$TotalOrder = mysqli_fetch_assoc(Count_All_Joborder_ById());
		echo "Order Code : ".$_GET['number'].", Total Jobs : ".$TotalOrder['total'];
		?>
	</h3><hr />
	<table class="paginate sortable full">
		<thead>
			<th width="43px" align="center">S.No.</th>
			<th align="left">Customer Name</th>
			<!--th align="left">Order Quantity</th-->
			<th align="left">Drawing Number</th>
			<th align="left">Total Order Quantity</th>
			<th align="left">Planned Quantity</th>
			<th align="left">Machine</th>
			<th align="left">Section</th>
			<th align="left">Production Hours</th>
			<th align="left">Total Number Of Machine Setting Days</th>
			<th align="left">Tentative Machine Setting Date</th>
			<th align="left">Tentative Production End Date</th>
			<th align="left">Reason</th>
			<th align="left">Action</th>
			<th><input type='button' value='Delete' onclick='deletedatas()' />
			<?php
			if($TotalOrder['total'])
				echo "<input type='checkbox' id='alldata'  onclick=\"checkAll();\" />";
			?>
			</th>
		</thead>
		<tbody>
			<form name="myform">
				<?php
				if(!$TotalOrder['total'])
					echo '<tr><td colspan="14"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($TotalOrder['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$Joborder = Select_Joborder_ByLimit($Start, $Limit);
				while($Joborders = mysqli_fetch_assoc($Joborder))
				{
					echo "<tr style='valign:middle;'>
						<td align='center'>".++$i."</td>
						<td>".$Joborders['name']."</td>
						<td>".$Joborders['drawing_number']."</td>
						<td>".$Joborders['totalorderquantity']."</td>
						<td>".$Joborders['plannedquantity']."</td>
						<td>".$Joborders['machine_number']."</td>
						<td>".$Joborders['section_name']."</td>
						<td>".$Joborders['productionhours']."</td>
						<td>".$Joborders['settingdays']."</td>
						<td>".date("d-m-Y", strtotime($Joborders['tentative_date']))."</td>
						<td>".date("d-m-Y", strtotime($Joborders['tentative_enddate']))."</td>
						<td>".$Joborders['reason']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&number=".$_GET['number']."&id=".$_GET['number']."&jobid=".$Joborders['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a></td>
						<td><input type='checkbox' id='CH".$i."' name='deleterecords' class='deleterecords' value='".$Joborders['id']."' onclick=\"checkUncheckParent(CH".$i.");\"</input></td>
					</tr>";
				}
				echo "<script>var initial = ".$i.", count=".mysqli_num_rows($Joborder).";</script>";
				?>
			</form>
		</tbody>
	</table>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&number=".$_GET['number']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</div>
<script>
	$( document ).ready(function()
	{
		$('.checker').replaceWith(function()
		{
			$("#alldata").removeAttr("style");
			return $('input', this);
		});
		
		for(var i = 1; i <= count; i++)
			$("#CH"+i).removeAttr("style");
	});
	function validation()
	{
		var message = "";
		if(document.getElementById("Days").value == "")
			message = "Please select Days";
		if(document.getElementById("tentative_date").value == "")
			message = "Please select tentative_date";
		if(document.getElementById("settingdays").value == "")
			message = "Please enter settingdays";
		if(document.getElementById("productionhours").value == "")
			message = "Please enter productionhours";
		if(document.getElementById("plannedquantity").value<=0)
			message = "Plannedquantity shouldbe greater than zero";	
		if(document.getElementById("plannedquantity").value == "")
			message = "Please enter plannedquantity";
		if(document.getElementById("totalorderquantity").value<=0)
			message = "Totalorderquantity shouldbe greater than zero";	
		if(document.getElementById("totalorderquantity").value == "")
			message = "Please enter totalorderquantity";	
		if(message)
			alert(message);	
		return true;
	}
	<?php
	if($_GET['action'] == 'Edit' && !isset($_POST['update']))
	{ ?>
		document.getElementById("Days").style.display = "none";
		function Countingdays()
		{
			document.getElementById("Days").style.display = "block";
			var CounterOptions = document.getElementById("counter");
			CounterOptions.options.length = 0;
			if(document.querySelector('input[name="actions"]:checked').value == "add")
			{
				for(var i = <?php if($IncLimit-1 < 31) echo $IncLimit-1; else echo "30"; ?>; i >= 1; i--)
				{
					var option = document.createElement('option');
					option.text = option.value = i;
					CounterOptions.add(option, 0);
				}
			}
			else
			{
				for(var i = 30; i >= 1; i--)
				{
					var option = document.createElement('option');
					option.text = option.value = i;
					CounterOptions.add(option, 0);
				}
			}
		}
	<?php
	} ?>
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	
	function deleterow(jobid)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&number=<?php echo $_GET['number']; ?>&jobid="+jobid+"&action=Delete");
	}
	function deletedatas()
	{
		var jobids = $("input[name=deleterecords]:checked").map(
		function () {return this.value;}).get().join(",");
	
		$.ajax(
		{
			type: "POST",
			async: false,
			cache: false,
			url: "includes/Getdeleterecords.php",
			data:"jobid="+jobids,
			dataType: 'html',
			success: function(Response)
			{
				location.reload(); 
			}
		});
	}
	var status = 0;
	function checkAll()
    {
		status = (status == 0) ? 1 : 0;
		for(var i = 1; i <= count; i++)
		{
			var check = (document.getElementById("CH"+i).checked == true) ? 1 : 0;
			if(status != check)
				document.getElementById("CH"+i).click();
		}
    }
	
	function checkUncheckParent(checkbox)
    {
		var checked = 0;
		for(var i = 1; i <= count; i++)
		{
			if(document.getElementById("CH"+i).checked == true)
				checked++;
		}
		if(checked == count)
		{
			if(document.getElementById("alldata").checked != true)
			{
				status = 1;
				$("#alldata").attr("checked", "checked");
			}
		}
		else
		{
			if(document.getElementById("alldata").checked == true)
				$("#alldata").attr("checked", "");
		}
	}
</script>