
<section role="main" id="main">
	<?php
		$Columns = array("id", "company_name", "company_slogan", "address","contact_name", "designation", "phone", "email","service_taxno","pan_no","tin_no");
		if($_GET['action'] == 'Edit')
		{
			$Company = mysqli_fetch_assoc(Company_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Company[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Company_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Company deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(strlen($_POST['phone']) < 10)
				$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
			else
			{
				$CompanyResource = Company_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($CompanyResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Company already exists</div>";
					else
					{
						Company_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Company added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Company = mysqli_fetch_assoc($CompanyResource);
					if(mysqli_num_rows(Company_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Company already exists</div>";
					else
					{
						Company_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Company details updated successfully</div>";
					}
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add Company</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Company Name <font color="red">*</font></label>
					<input type="text" id="company_name" name="company_name" required="required" value="<?php echo $_POST['company_name']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Slogan Name <font color="red">*</font></label>
					<input type="text" id="company_slogan"  name="company_slogan" required="required" value="<?php echo $_POST['company_slogan']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Address. <font color="red">*</font></label>
					<textarea id="address" name="address" required="required"><?php echo $_POST['address']; ?></textarea>
				</div>
				<div class="clearfix">
					<label>Contact Person Name <font color="red">*</font></label>
					<input type="text" id="contact_name" name="contact_name" required="required"  value="<?php echo $_POST['contact_name']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div><div class="clearfix">
					<label>Designation <font color="red">*</font></label>
					<input type="text" id="designation" name="designation" required="required" value="<?php echo $_POST['designation']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div><div class="clearfix">
					<label>Phone No. <font color="red">*</font></label>
					<input type="text" id="phone" name="phone" required="required" maxlength='25' value="<?php echo $_POST['phone']; ?>" onkeypress="return isNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Email <font color="red">*</font></label>
					<input type="email" id="email" name="email" required="required" value="<?php echo $_POST['email']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Service_Tax_No <font color="red">*</font></label>
					<input type="text" id="service_taxno" name="service_taxno" maxlength='15' required="required" value="<?php echo $_POST['service_taxno']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>PAN_No <font color="red">*</font></label>
					<input type="text" id="pan_no" name="pan_no" required="required" maxlength='10' value="<?php echo $_POST['pan_no']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>TIN_No <font color="red">*</font></label>
					<input type="text" id="tin_no" name="tin_no" required="required" maxlength='11' value="<?php echo $_POST['tin_no']; ?>" onkeypress="return isNumeric(event)"/>
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
		
		<div class="columns">
			<h3>Company List
				<?php
				$CompanyTotalRows = mysqli_fetch_assoc(Company_Select_Count_All());
				echo " : No. of total Companies - ".$CompanyTotalRows['total'];
				?>
			</h3>
			<hr />	
			<div style="white-space:pre;overflow:auto;width:902px;padding:10px;">
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Company Name</th>
						<th align="left">Slogan Name</th>
						<th align="left">Address</th>
						<th align="left">Contact Person Name</th>
						<th align="left">Designation</th>
						<th align="left">Phone No.</th>
						<th align="left">Email</th>
						<th align="left">Service_Tax_No</th>
						<th align="left">PAN_No</th>
						<th align="left">TIN_No</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$CompanyTotalRows['total'])
						echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($CompanyTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $CompanyTotalRows['total']- $Start;
					else
						$i = $CompanyTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$CompanyRows = Company_Select_ByLimit($Start, $Limit);
					while($Company = mysqli_fetch_assoc($CompanyRows))
					{
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$Company['company_name']."</td>
							<td>".$Company['company_slogan']."</td>
							<td>".$Company['address']."</td>
							<td>".$Company['contact_name']."</td>
							<td>".$Company['designation']."</td>
							<td>".$Company['phone']."</td>
							<td>".$Company['email']."</td>
							<td>".$Company['service_taxno']."</td>
							<td>".$Company['pan_no']."</td>
							<td>".$Company['tin_no']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Company['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$Company['id'].")'>Delete</a></td>
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
		if (charCode == 8 || charCode == 9  || charCode == 46  || charCode == 32 ||charCode == 38 ||charCode == 37 ||charCode == 39 || charCode == 45 || charCode == 41 || charCode == 40 || charCode == 63 || charCode == 95) 
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
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
		if(document.getElementById("tin_no").value==0)
			message = "Please enter the tin_no";
		if(document.getElementById("pan_no").value==0)
			message = "Please enter the pan_no";
		if(document.getElementById("service_taxno").value==0)
			message = "Please enter the service tax no";
		if(document.getElementById("phone").value.length < 10)
			message = "Phone number is not valid";
		if(document.getElementById("designation").value==0)
			message = "Please enter the designation";	
		if(document.getElementById("contact_name").value==0)
			message = "Please enter the contact person name";		
		if(document.getElementById("address").value==0)
			message = "Please enter the company address";	
		if(document.getElementById("company_slogan").value==0)
			message = "Please enter the company slogan";
		if(document.getElementById("company_name").value==0)
			message = "Please enter the company name";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>