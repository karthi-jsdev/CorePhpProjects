<section class="first">
	<?php
		$Columns = array("id", "vendor_code", "client_name","phone","address");
		if($_GET['action'] == 'Edit')
		{
			$Client = mysql_fetch_assoc(Client_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Client[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Client_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Client deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows(Client_Select_ByName()))
						$message = "<br /><div class='message error'><b>Message</b> : This Client and Vendor code already exists</div>";
					else
					{
						Client_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Client added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					if(mysql_num_rows(Client_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Client and Vendor code already exists</div>";
					else
					{
						Client_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Client details updated successfully</div>";
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
				<header><h2>Client</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Vendor Number <font color="red">*</font></label>
						<input type="text" id="vendor_code" name="vendor_code"  required="required" value="<?php echo $_POST['vendor_code']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Name <font color="red">*</font></label>
						<input type="text" id="client_name" name="client_name" required="required" value="<?php echo $_POST['client_name']; ?>" onkeypress="return isAlphabetic(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Phone <font color="red">*</font></label>
						<input type="text" id="phone" name="phone"  required="required" value="<?php echo $_POST['phone']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Address <font color="red">*</font></label>
						<textarea id="address" name="address"  required="required"  onkeypress="return isAlphaOrNumeric(event)"/><?php echo $_POST['address']; ?></textarea>
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
			<h3>Client List
				<?php
				$Client_TotalRows = mysql_fetch_assoc(Client_Select_Count_All());
				echo " : No. of total Client - ".$Client_TotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Vendor No</th>
						<th align="left">Name</th>
						<th align="left">Phone</th>
						<th align="left">Address</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Client_TotalRows['total'])
						echo '<tr><td colspan="6"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Client_TotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $Client_TotalRows['total']- $Start;
					else
						$i = $Client_TotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ClientRows = Client_Select_ByLimit($Start, $Limit);
					while($Client = mysql_fetch_assoc($ClientRows))
					{
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$Client['vendor_code']."</td>
							<td>".$Client['client_name']."</td>
							<td>".$Client['phone']."</td>
							<td>".$Client['address']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Client['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$Client['id'].")'>Delete</a></td>
						</tr>";
					}?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
</section>

<?php
$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46 || charCode == 45 || charCode == 41 || charCode == 40 || charCode == 63 || charCode == 95) 
			return true;
		else if(charCode == 32 ||charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 )
			return true;
		else
			return false;
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 45 || charCode == 46 || charCode == 47) 
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("vendor_code").value.length < 3 || document.getElementById("vendor_code").value.length > 15)
			message = "vendorcode should be within 3 to 15 characters";
		if(document.getElementById("vendor_code").value.length ==0)
			message = "Please enter the vendorcode number";	
		if(document.getElementById("client_name").value.length ==0)
			message = "Please enter the client name";
		if(document.getElementById("phone").value.length <10)
			message = "phone number is not valid";
		if(document.getElementById("phone").value.length ==0)
			message = "Please enter the phone number";
		if(document.getElementById("address").value.length ==0)
			message = "Please enter the address";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>