<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
		<script src="js/datepicker/jquery.ui.core.js"></script>
		<script src="js/datepicker/jquery.ui.widget.js"></script>
		<script src="js/datepicker/jquery.ui.datepicker.js"></script>
		<script>
			$(function()
			{
				$("#date").datepicker({dateFormat: 'yy-mm-dd'});
			});
		</script>
	</head>
<section role="main" id="main">
	<?php
	$Columns = array("id","vendorid","number","amount","invoicedate");
	if($_GET['action'] == 'Edit')
	{
		$invoice1 = mysql_fetch_assoc(Invoice_Selection_Byid());
		foreach($Columns as $Col)
			$_POST[$Col] = $invoice1[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Invoice_Delete();
		$message = "<br /><div class='message success'><b>Message</b> : One invoice deleted successfully</div>";
	}
	$invoice_num = Invoice_Selection1();
	while($invoice_number = mysql_fetch_assoc($invoice_num))
	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		if(isset($_POST['Submit']))
		{
			if($_POST['number'] == $invoice_number['number'])
				$message = "<br /><div class='message error'><b>Message</b> : Invoice number already exists</div>";
			else
			{
				Invoice_Insert();
				$message = "<br /><div class='message success'><b>Message</b> : Invoice added successfully</div>";
			}
		}
		else if(isset($_POST['Update']))
		{
			Invoice_Update();
			$message = "<br /><div class='message success'><b>Message</b> : Invoice updated successfully</div>";
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	}
	$i=1;
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<fieldset>
				<h3>Invoice List</h3>
				<div class="clearfix">
					<label>Date<font color="red">*</font></label>
					<input auotcomplete="off" type="text" id="date" name="date" required="required" value="<?php echo $_POST['invoicedate']; ?>"/> <!-- onkeypress="return isAlphabetic(event)"-->
				</div>
				<div class="clearfix">
					<label>Vendor Name <font color="red">*</font></label>
					<select id="vendorid" name="vendorid" required="required">
						<option value="">Select</option>
						<?php
						$vendor = Vendor_Dropdowndisplay();
						while($vendor_name = mysql_fetch_assoc($vendor))
						{
							if($_POST['vendorid']==$vendor_name['id'])
								echo '<option value="'.$vendor_name['id'].'" selected="selected">'.$vendor_name['name'].'</option>';
							else
								echo '<option value="'.$vendor_name['id'].'">'.$vendor_name['name'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Invoice Number<font color="red">*</font></label>
					<input type="text" auotcomplete="off" id="number" name="number" required="required" value="<?php echo $_POST['number']; ?>" onkeypress="return invoice_Number(event);"/> <!-- onkeypress="return isAlphabetic(event)"-->
				</div>
				<!--div class="clearfix">
					<label>Invoice Amount<font color="red">*</font></label>
					<input type="text" id="amount" name="amount" required="required" value="<?php //echo $_POST['amount']; ?>" onkeypress="return invoice_amount(event)"/>
				</div-->
			</fieldset>
			<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
				?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
	</div>
	<div class="columns">
		<h3>Invoice List
			<?php
			$InvoiceTotalRows = mysql_fetch_assoc(Invoice_Selection_ByCount());
			echo " : No. of total invoice - ".$InvoiceTotalRows['total'];
			$Limit = 10;
			$total_pages = ceil($InvoiceTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			?>
		</h3>
		<hr />
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th>Sl.No.</th>
					<th>Vendor Name</th>
					<th>Invoice Number</th>
					<th>Action</th>
				</tr>
			</thead>
	<?php
		$invoice = Invoice_Selection();
		if(mysql_num_rows(Invoice_Selection()==0))
			echo '<tr><td style="color:red;" colspan="5"><center>No data Found</center></td></tr>';
		else
		{
			while($invoice_list = mysql_fetch_assoc($invoice))
			{
				echo'
					<tbody>
						<tr>
							<td>'.$i++.'</td>
							<td>'.$invoice_list['vendorname'].'</td>
							<td>'.$invoice_list['number'].'</td>
							<td><a href=?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Stock&id='.$invoice_list['id'].'&action=Edit>Edit</a>|<a href="#" onclick="deleterow('.$invoice_list['id'].')">Delete</a></td>
						</tr>
					</tbody>';
			}
		}?>
		</table>
<?php
$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>
	</div>
</section>
</html>
<script>
	function invoice_Number(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8||charCode==127)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	function invoice_amount(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8||charCode==127||charCode==46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	function validation()
	{
		var count1 = document.getElementById("amount").value;
		var c = count1.split(".").length -1;
		if(c>1)
		{
			alert('Please Remove other dots(.)');
			return false;
		}
	}
	function deleterow(id)
	{
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Stock&id="+id+"&action=Delete");
	}
</script>