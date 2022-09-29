<?php include("includes/Job_Queries.php"); ?>
<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script> 
		$(function() {
			$("#tentative_date").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
		});
	</script> 
</head>
<section class="grid_6 first">
	<?php
	$Columns = array("id", "order_id", "product_id","totalorderquantity", "plannedquantity", "machine_id", "productionhours","settingdays", "tentative_date");
	if($_GET['action'] == 'Edit')
	{
		$Job = mysqli_fetch_assoc(Job_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $Job[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Job_Delete_ById($_GET['id']);
		$message = "<br /><div class='message success'><b>Message</b> : One Job deleted successfully</div>";
	}
	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		if(isset($_POST['Submit']))
		{
			Job_Insert();
			$message = "<br /><div class='message success'><b>Message</b> : Job added successfully</div>";
		}
		else if(isset($_POST['Update']))
		{
			Job_Update();
			$message = "<br /><div class='message success'><b>Message</b> : Job details updated successfully</div>";
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	} ?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Create Job</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
						<label>Order No<font color="red">*</font></label>
						<select id="order_id" name="order_id" onchange="customername(this.value);">
							<option value="">Select</option>
							<?php
							$ordernos = Orderno_Select_All();
							while($orderno = mysqli_fetch_assoc($ordernos))
							{
								if($orderno['id'] == $_POST['order_id'])
									echo "<option value='".$orderno['id']."' selected>".$orderno['number']."</option>";
								else
									echo "<option value='".$orderno['id']."'>".$orderno['number']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Drawing Number <font color="red">*</font></label>
						<select id="product_id" name="product_id">
							<option value="">Select</option>
							<?php
							$Products = Products_Select_All();
							while($Product = mysqli_fetch_assoc($Products))
							{
								if($Product['id'] == $_POST['product_id'])
									echo "<option value=".$Product['id']." selected>".$Product['drawing_number']."</option>";
								else
									echo "<option value=".$Product['id'].">".$Product['drawing_number']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Customer Name</label>
						<div id="customer_id" name="customer_id">
						</div>
					</div>
					<div class="clearfix">
                        <label>Total Order Quantity <font color="red">*</font></label>
						<input type="text" id="totalorderquantity" name="totalorderquantity" required="required" value="<?php echo $_POST['totalorderquantity']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Planned Quantity <font color="red">*</font></label>
						<input type="text" id="plannedquantity"  name="plannedquantity" required="required" value="<?php echo $_POST['plannedquantity']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
						<label>Machine <font color="red">*</font></label>
						<select id="machine_id" name="machine_id">
							<option value="">Select</option>
							<?php
							$Machines = Machines_Select_All();
							while($Machine = mysqli_fetch_assoc($Machines))
							{
								if($Machine['id'] == $_POST['machine_id'])
									echo "<option value=".$Machine['id']." selected>".$Machine['machine_number']."</option>";
								else
									echo "<option value=".$Machine['id'].">".$Machine['machine_number']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
                        <label>Production Hours <font color="red">*</font></label>
						<input type="text" id="productionhours" name="productionhours" required="required" value="<?php echo $_POST['productionhours']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Total Number Of Machine Setting Days<font color="red">*</font></label>
						<input type="text" id="settingdays" name="settingdays" required="required" value="<?php echo $_POST['settingdays']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Tentative Machine Setting Date <font color="red">*</font></label>
						<input type="text" id="tentative_date" name="tentative_date" onkeypress="return false" required="required" value="<?php echo $_POST['tentative_date']; ?>" />
                    </div>
				</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-blue" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-blue" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Reset</button>
			</form>
		</div>
	</div>
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Job List
				<?php
				$JobTotalRows = mysqli_fetch_assoc(Job_Select_Count_All());
				echo " : No. of total Jobs - ".$JobTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Created Date</th>
						<th align="left">Order</th>
						<th align="left">Drawing Number</th>
						<th align="left">Customer</th>
						<th align="left">Total Order</th>
						<th align="left">Planned Order</th>
						<th align="left">Machine</th>
						<th align="left">Total Production</th>
						<th align="left">Setting Days</th>
						<th align="left">Tentative Start</th>
						<th align="left">Tentative End</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$JobTotalRows['total'])
						echo '<tr><td colspan="11"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($JobTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$JobRows = Job_Select_ByLimit($Start, $Limit);
					while($Job = mysqli_fetch_assoc($JobRows))
					{
						$OrderName = mysqli_fetch_assoc(Select_Order_ById($Job['order_id']));
						$DrawingNumber = mysqli_fetch_assoc(Select_DrawingNo_ById($Job['product_id']));
						$CustomerName = mysqli_fetch_assoc(Select_CustomerName_ById($OrderName['customer_id']));
						$MachineName = mysqli_fetch_assoc(Select_MachineName_ById($Job['machine_id']));
						echo "<tr>
							<td align='center'>".$i++."</td>
							<td>".$Job['createdate']."</td>
							<td>".$OrderName['number']."</td>
							<td>".$DrawingNumber['drawing_number']."</td>
							<td>".$CustomerName['name']."</td>
							<td>".$Job['totalorderquantity']."</td>
							<td>".$Job['plannedquantity']."</td>
							<td>".$MachineName['machine_number']."</td>
							<td>".$Job['productionhours']."</td>
							<td>".$Job['settingdays']."</td>
							<td>".$Job['tentative_date']."</td>
							<td>".$Job['tentative_enddate']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Job['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$Job['id'].")'>Delete</a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
		if($total_pages > 1)
			include("includes/Pagination.php");
	?>
</section>


<script>
	<?php 
	if($_POST['order_id'])
	{ ?>
		customername(<?php echo $_POST['order_id']; ?>);
	<?php
	} ?>
	
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("tentative_date").value=='')
			message = "Select The Tentative Date";
		if(document.getElementById("settingdays").value <= 0)
			message = "Setting Days should be Greater Than Zero";	
		if(document.getElementById("settingdays").value=='')
			message = "Enter the Setting Days";
		if(document.getElementById("settingdays").value.length < 1 || document.getElementById("settingdays").value.length > 250)
			message = "Settingdays should be within 1 to 250";
		if(document.getElementById("productionhours").value <= 0)
			message = "Production Hours should be Greater Than Zero";	
		if(document.getElementById("productionhours").value=='')
			message = "Enter the Production Hours";		
		if(document.getElementById("productionhours").value.length < 1 || document.getElementById("productionhours").value.length > 25000)
			message = "Production Hours should be within 1 to 25000";	
		if(document.getElementById("machine_id").value=='')
			message = "Select the Machine Name";
		if(document.getElementById("plannedquantity").value <= 0)
			message = "Planned Quantity should be Greater Than Zero";		
		if(document.getElementById("plannedquantity").value=='')
			message = "Enter the Planned Quantity";	
		if(document.getElementById("totalorderquantity").value <= 0)
			message = "Totalorderquantity should be Greater Than Zero";	
		if(document.getElementById("totalorderquantity").value=='')
			message = "Enter the Total Order Quantity";		
		if(document.getElementById("product_id").value=='')
			message = "Select the Product Drawing Number";
		if(document.getElementById("order_id").value=='')
			message = "Select the Order";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function customername(orderid)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('customer_id').innerHTML =xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Customer_Get_Values.php?orderid="+orderid,true);
		xmlhttp.send();
	}
	
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
	}
</script>