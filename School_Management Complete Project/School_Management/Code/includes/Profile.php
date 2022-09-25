<section class="grid_6 first">
	<?php
		include("includes/Profile_Queries.php");
		
		if(isset($_POST['Update']))
		{
			if(strlen($_POST['phone']) != 10)
				$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
			else
			{
				if(mysql_num_rows(User_Select_ByNamePWD()))
				{
					if(mysql_num_rows(User_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This username and password already exists.</div>";
					else
					{
						User_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Your Profile updated successfully</div>";
					}
				}
				else
					$message = "<br /><div class='message error'><b>Message</b> : Current-Password entered is incorrect</div>";
			}
		}
		$User = mysql_fetch_assoc(User_Select_ById());
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php echo $_SESSION['SM_id']; ?>" required="required"/>
				<header><h2>Profile</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>First Name</label>
						<?php echo $User['firstname']; ?>
                    </div>
					<div class="clearfix">
                        <label>Last Name</label>
						<?php echo $User['lastname']; ?>
                    </div>
					<div class="clearfix">
                        <label>Name</label>
						<input type="hidden" id="name" name="name" required="required" value="<?php echo $User['name']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
						<?php echo $User['name']; ?>
					</div>
					<div class="clearfix">
                        <label>Current-Password <font color="red">*</font></label>
						<input type="password" id="password" name="password" required="required" value="" onkeypress="return isAlphaOrNumeric(event)" />
                    </div>
					<div class="clearfix">
                        <label>New-Password</label>
						<input type="password" id="newpassword" name="newpassword" value="<?php echo $User['newpassword']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Confirm-Password</label>
						<input type="password" id="confirmpassword" name="confirmpassword" value="<?php echo $User['confirmpassword']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Phone No. <font color="red">*</font></label>
						<input type="text" id="phone" name="phone" required="required" value="<?php echo $User['phone']; ?>" onkeypress="return isNumeric(event)"/>
                    </div>
					<div class="clearfix">
						<label>Role</label>
						<?php
							$rolename = mysql_fetch_array(User_Role($User['userrole_id']));
							echo  $rolename['role']; 
						?>
					</div>
				</fieldset>
				<hr />
				<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;
				<button class="button button-gray" type="reset">Reset</button>
			</form>
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
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("phone").value.length < 10)
			return true;
		else
			return false;
	}
	
	function validation()
	{
		var message = "", pass1 = document.getElementById('newpassword'), pass2 = document.getElementById('confirmpassword');	
		if(document.getElementById("password").value.length == 0)
			message = "Password is required";
		if(document.getElementById("password").value.length < 4 || document.getElementById("password").value.length > 15)
			message = "Password should be within 4 to 15 characters";
		if(document.getElementById("phone").value.length != 10)
			message = "Phone number is not valid";
		if(pass1.value != pass2.value)
			message = "Passwords do not match!";
		
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>