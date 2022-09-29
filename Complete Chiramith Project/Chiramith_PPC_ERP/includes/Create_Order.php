<?php 
	include("includes/Create_Order_Queries.php");
?>
<section class="grid_6 first">
	<?php
		$Columns = array("id", "number", "customer_id", "quantity", "order_date");
		if($_GET['action'] == 'Edit')
		{
			$CreateOrder = mysqli_fetch_assoc(Create_Order_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $CreateOrder[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Create_Order_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Order deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			
			$CreateOrderResource = Create_Order_Select_ByName();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($CreateOrderResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Order already exists</div>";
				else
				{	
					Create_Order_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$CreateOrder = mysqli_fetch_assoc($CreateOrderResource);
				if(mysqli_num_rows(Create_Order_Select_ByNameId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Order already exists</div>";
				else
				{
					Create_Order_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Order details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Create Order</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Order No <font color="red">*</font></label>
						<input type="text" id="number" name="number" required="required" value="<?php echo $_POST['number']; ?>" onkeypress="return AlphaNumCheck(event)"/>
                    </div>
					<div class="clearfix">
						<label>Customer Name <font color="red">*</font></label>
						<select id="customer_id" name="customer_id">
							<option value="">Select</option>
							<?php
							$Customers = Customerss_Select_All();
							while($Customer = mysqli_fetch_assoc($Customers))
							{
								if($Customer['id'] == $_POST['customer_id'])
									echo "<option value=".$Customer['id']." selected>".$Customer['name']."</option>";
								else
									echo "<option value=".$Customer['id'].">".$Customer['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
                        <label>Total Order Quantity <font color="red">*</font></label>
						<input type="text" id="quantity" name="quantity" required="required" value="<?php echo $_POST['quantity']; ?>" onkeypress="return isNumeric(event)"/>
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
			<h3>Order List
				<?php
				$CreateOrderTotalRows = mysqli_fetch_assoc(Create_Order_Select_Count_All());
				echo " : Total Order List - ".$CreateOrderTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Date</th>
						<th align="left">Order No</th>
						<th align="left">Customer</th>
						<th align="left">Total Order Quantity</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$CreateOrderTotalRows['total'])
						echo '<tr><td colspan="6"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($CreateOrderTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$CreateOrderRows = Create_Order_Select_ByLimit($Start, $Limit);
					while($CreateOrder = mysqli_fetch_assoc($CreateOrderRows))
					{
						$customer = mysqli_fetch_assoc(Customers_Select_ById($CreateOrder['customer_id']));
						echo "<tr>
							<td align='center'>".$i++."</td>
							<td>".$CreateOrder['order_date']."</td>
							<td>".$CreateOrder['number']."</td>
							<td>".$customer['name']."</td>
							<td>".$CreateOrder['quantity']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$CreateOrder['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$CreateOrder['id'].")'>Delete</a></td>
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
	
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode >= 32)
			return true;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
		if(charCode==32)
			return false;
			return true;
    }
	function validation()
	{
		var message = "";
		if(document.getElementById("number").value.length < 4 || document.getElementById("number").value.length > 15)
			message = "Number should be within 4 to 15 characters";
		if(document.getElementById("customer_id").value=='')
			message = "Select the customer";		
		if(document.getElementById("quantity").value.length < 3 || document.getElementById("quantity").value.length > 15)
			message = "Quantity should be within 3 to 15 characters";
		if(document.getElementById("quantity").value <= 0)
			message = "Quantity should be greater than zero";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
	}
</script>