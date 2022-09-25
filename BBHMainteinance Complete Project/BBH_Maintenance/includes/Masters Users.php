<section class="grid_6 first">
	<?php
		$Columns = array("id", "firstname", "lastname", "phonenumber", "username", "password", "userroleid", "departmentid","groupid","deptadmin");
		
		if($_GET['action'] == 'Edit')
		{
			$User = mysqli_fetch_assoc(User_Select_ById($_GET['id']));
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
			if(strlen($_POST['phonenumber']) != 10)
				$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
			else
			{
				$UserResource = User_Select_ByNamePWD($_POST['username'], $_POST['password']);
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($UserResource))
						$message = "<br /><div class='message error'><b>Message</b> : This User already exists</div>";
					else
					{
						User_Insert($_POST['firstname'], $_POST['lastname'], $_POST['phonenumber'], $_POST['username'], $_POST['password'], $_POST['userroleid'], $_POST['departmentid'] , $_POST['groupid'] ,$_POST['deptadmin']);
						$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$User = mysqli_fetch_assoc($UserResource);
					if(mysqli_num_rows(User_Select_ByNamePWDId($_POST['username'], $_POST['password'], $User['id'])))
						$message = "<br /><div class='message error'><b>Message</b> : This User already exists</div>";
					else
					{
						User_Update($_POST['firstname'], $_POST['lastname'], $_POST['phonenumber'], $_POST['username'], $_POST['password'], $_POST['userroleid'], $_POST['departmentid'], $_POST['groupid'], $_POST['deptadmin'],$_POST['id']);
						$message = "<br /><div class='message success'><b>Message</b> : User details updated successfully</div>";
					}
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
				<header><h2>Add User</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>First Name <font color="red">*</font></label>
						<input type="text" id="firstname" name="firstname" required="required" value="<?php echo $_POST['firstname']; ?>" onkeypress="return isAlphabetic(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Last Name <font color="red">*</font></label>
						<input type="text" id="lastname"  name="lastname" required="required" value="<?php echo $_POST['lastname']; ?>" onkeypress="return isAlphabetic(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Phone No. <font color="red">*</font></label>
						<input type="text" id="phonenumber" name="phonenumber" required="required" value="<?php echo $_POST['phonenumber']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>User Name <font color="red">*</font></label>
						<input type="text" id="username" name="username" required="required" value="<?php echo $_POST['username']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Password <font color="red">*</font></label>
						<input type="password" id="password" name="password" required="required" value="<?php echo $_POST['password']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
						<label>User Role <font color="red">*</font></label>
						<select id="userroleid" name="userroleid" onchange ="selectgroup(this.value);selectmandatory(this.value)">
							<?php
							$Roles = UserRoles_Select_All();
							while($Role = mysqli_fetch_assoc($Roles))
							{
								if($Role['id'] == $_POST['userroleid'])
									echo "<option value=".$Role['id']." selected>".$Role['role']."</option>";
								else
									echo "<option value=".$Role['id'].">".$Role['role']."</option>";
							} ?>
						</select>
						<div id="deptadminid">
							<?php 
							if($_POST['deptadmin'])
								echo '<input type="checkbox" name="deptadmin" id="deptadmin" value="1" checked>Dept Admin</input>';
							else
								echo '<input type="checkbox" name="deptadmin" id="deptadmin" value="1" >Dept Admin</input>';
							?>
						</div>
					</div>
					<div class="clearfix">
						<label>Department <font color="red">*</font></label>
						<select id="departmentid" name="departmentid">
							<option value="" selected>Select</option>
							<?php
							$Roles = Department_Select_All();
							while($Role = mysqli_fetch_assoc($Roles))
							{
								if($Role['id'] == $_POST['departmentid'])
									echo "<option value=".$Role['id']." selected>".$Role['name']."</option>";
								else
									echo "<option value=".$Role['id'].">".$Role['name']."</option>";
							} ?>
						</select>
					</div>
					
					<div class="clearfix">
						<label>Group<font color='red' id='mandatory'></font></label>
						<select id="groupid" name="groupid">
							<option value="">Select</option>
							<?php
							$Group = Group_Select_All();
							while($Fetch_Group = mysqli_fetch_assoc($Group))
							{
								if($Fetch_Group['id'] == $_POST['groupid'])
									echo "<option value=".$Fetch_Group['id']." selected>".$Fetch_Group['name']."</option>";
								else
									echo "<option value=".$Fetch_Group['id'].">".$Fetch_Group['name']."</option>";
							} ?>
						</select>
					</div>
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
	</div>

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>User List
				<?php
				if($_GET['Search'])
					$UserTotalRows = mysqli_num_rows(User_Select_AllsBySearch($_GET['Search']));
				else
					$UserTotalRows = mysqli_num_rows(User_Select_Alls());	
				echo " : No. of total Users - ".$UserTotalRows;
				?>
			</h3>
			<hr />	
			<input type="text" placeholder="Search" id="Search" name="search"><a href="#" onclick="Search()"><img src="images/search.png" title="Search"></a><br/>&nbsp;	
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">First Name</th>
						<th align="left">Last Name</th>
						<th align="left">Phone No.</th>
						<th align="left">User Name</th>
						<th align="left">Role</th>
						<th align="left">Department</th>
						<th align="left">Department Admin</th>
						<th align="left">Group</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
				if(!$_GET['Search'])
				{
					if(!$UserTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($UserTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$UserRows = User_Select_ByLimit($Start, $Limit);
					while($User = mysqli_fetch_assoc($UserRows))
					{
						$Role = mysqli_fetch_assoc(UserRole_Select_ById($User['userroleid']));
						$Department = mysqli_fetch_assoc(Department_Select_ById($User['departmentid']));
						$Group = mysqli_fetch_assoc (Group_Select_ById($User['groupid']));
						echo "<tr>
							<td align='center'>".$i++."</td>
							<td>".$User['firstname']."</td>
							<td>".$User['lastname']."</td>
							<td>".$User['phonenumber']."</td>
							<td>".$User['username']."</td>
							<td>".$Role['role']."</td>
							<td>".$Department['name']."</td>";
							if($User['deptadmin']==1)
								echo "<td>YES</td>";
							else	
								echo "<td>NO</td>";
							echo "<td>".$Group['name']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$User['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$User['id'].")'>Delete</a></td>
						</tr>";
					} 
				}	
				else
				{
					if(!$UserTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($UserTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$UserRows = User_Select_ByLimitSearch($Start, $Limit,$_GET['Search']);
					while($User = mysqli_fetch_assoc($UserRows))
					{
						$Role = mysqli_fetch_assoc(UserRole_Select_ById($User['userroleid']));
						$Department = mysqli_fetch_assoc(Department_Select_ById($User['departmentid']));
						$Group = mysqli_fetch_assoc (Group_Select_ById($User['groupid']));
						echo "<tr>
							<td align='center'>".$i++."</td>
							<td>".$User['firstname']."</td>
							<td>".$User['lastname']."</td>
							<td>".$User['phonenumber']."</td>
							<td>".$User['username']."</td>
							<td>".$Role['role']."</td>
							<td>".$Department['name']."</td>";
							if($User['deptadmin']==1)
								echo "<td>YES</td>";
							else	
								echo "<td>NO</td>";
							echo "<td>".$Group['name']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$User['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$User['id'].")'>Delete</a></td>
						</tr>";
					}				
				} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
</section>

<?php
if($_GET['Search'])
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&Search=".$_GET['Search']."&";
	else
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>
<script>
	<?php
	if(!$_POST['deptadmin'])
	{ ?>
		document.getElementById('deptadminid').style.display = "none";
	<?php
	} ?>
	var userroleid;
	function selectgroup(userrole)
	{
		userroleid = userrole;
		if(userroleid=='1')
		{
			document.getElementById('deptadminid').style.display = "block";
		}	
		else
		{
			document.getElementById('deptadminid').style.display = "none";
			document.getElementById("deptadmin").checked = false;
		}	
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 36 || charCode == 35 || charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 || charCode == 36 || charCode == 35 || charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("phonenumber").value.length < 10)
			return true;
		else
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("password").value.length < 4 || document.getElementById("password").value.length > 15)
			message = "Password should be within 4 to 15 characters";
		if(document.getElementById("username").value.length < 4 || document.getElementById("username").value.length > 15)
			message = "User name should be within 4 to 15 characters";
		if(document.getElementById("phonenumber").value.length != 10)
			message = "Phone number is not valid";
		if(document.getElementById("lastname").value.length < 1 || document.getElementById("lastname").value.length > 15)
			message = "Last name should be within 1 to 15 characters";
		if(document.getElementById("firstname").value.length < 4 || document.getElementById("firstname").value.length > 15)
			message = "First name should be within 4 to 15 characters";
		if(document.getElementById('departmentid').value == "")
			message = "Please select a department";
		if(userroleid=='3')
		{
			if(document.getElementById('groupid').value == "")
			message = "Please select a group";	
		}	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function Search()
	{
		//alert(document.getElementById("Search").value);
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo $_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
		//document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&pageno=<?php echo$_GET['pageno']; ?>&Search="+document.getElementById("Search").value);
	}
	function selectmandatory(userrole)
	{
		if(userrole == 3)
			document.getElementById('mandatory').innerHTML = "*";
		else
			document.getElementById('mandatory').innerHTML = "";
	}
</script>