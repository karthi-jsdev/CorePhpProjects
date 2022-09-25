<section role="main" id="main">
	<?php
		$Columns = array("id", "first_name", "last_name", "phone_number", "user_name", "password", "user_role_id");
		if($_GET['action'] == 'Edit')
		{
			$User = mysql_fetch_assoc(User_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $User[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			User_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One User deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(strlen($_POST['phone']) < 10)
				$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
			else
			{
				$UserResource = User_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows($UserResource))
						$message = "<br /><div class='message error'><b>Message</b> : This User already exists</div>";
					else
					{
						User_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : User added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$User = mysql_fetch_assoc($UserResource);
					if(mysql_num_rows(User_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This User already exists</div>";
					else
					{
						User_Update();
						$message = "<br /><div class='message success'><b>Message</b> : User details updated successfully</div>";
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
			<header><h2>Add User</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>First Name <font color="red">*</font></label>
					<input type="text" id="firstname" name="firstname" required="required" value="<?php echo $_POST['first_name']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Last Name <font color="red">*</font></label>
					<input type="text" id="lastname"  name="lastname" required="required" value="<?php echo $_POST['last_name']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Phone No. <font color="red">*</font></label>
					<input type="text" id="phone" name="phone" required="required" value="<?php echo $_POST['phone_number']; ?>" onkeypress="return isNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>User Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['user_name']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Password <font color="red">*</font></label>
					<input type="text" id="password" name="password" required="required" value="<?php echo $_POST['password']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>User Role <font color="red">*</font></label>
					<select id="userrole_id" name="userrole_id">
						<option value="" disabled>Select</option>
						<?php
						$Roles = UserRoles_Select_All();
						while($Role = mysql_fetch_assoc($Roles))
						{
							if($Role['id'] == $_POST['userrole_id'])
								echo "<option value=".$Role['id']." selected>".$Role['role']."</option>";
							else
								echo "<option value=".$Role['id'].">".$Role['role']."</option>";
						} ?>
					</select>
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
			<h3>User List
				<?php
				$UserTotalRows = mysql_fetch_assoc(User_Select_Count_All());
				echo " : No. of total Users - ".$UserTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">First Name</th>
						<th align="left">Last Name</th>
						<th align="left">User Name</th>
						<th align="left">Phone No.</th>
						<th align="left">Role</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$UserTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($UserTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $UserTotalRows['total']- $Start;
					else
						$i = $UserTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$UserRows = User_Select_ByLimit($Start, $Limit);
					while($User = mysql_fetch_assoc($UserRows))
					{
						$Role = mysql_fetch_assoc(UserRole_Select_ById($User['user_role_id']));
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$User['first_name']."</td>
							<td>".$User['last_name']."</td>
							<td>".$User['user_name']."</td>
							<td>".$User['phone_number']."</td>
							<td>".$Role['role']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$User['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$User['id'].")'>Delete</a></td>
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
		if (charCode == 8 || charCode == 9  || charCode == 46) 
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
		if(document.getElementById("password").value.length < 4 || document.getElementById("password").value.length > 15)
			message = "Password should be within 4 to 15 characters";
		if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 15)
			message = "User name should be within 4 to 15 characters";
		if(document.getElementById("phone").value.length < 10)
			message = "Phone number is not valid";
		if(document.getElementById("lastname").value.length < 1 || document.getElementById("lastname").value.length > 15)
			message = "Last name should be within 1 to 15 characters";
		if(document.getElementById("firstname").value.length < 4 || document.getElementById("firstname").value.length > 15)
			message = "First name should be within 4 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>