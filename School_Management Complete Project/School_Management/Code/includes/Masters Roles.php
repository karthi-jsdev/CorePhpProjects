<section role="main" id="main">
	<?php
		$Columns = array("id", "role", "modules");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysqli_fetch_assoc(Roles_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Roles_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> :Roles name deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$RoleResource = Roles_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($RoleResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Roles name already exists</div>";
				else
				{
					Roles_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Roles name added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysqli_fetch_assoc($RoleResource);
				if(mysqli_num_rows(Roles_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : Roles name already exists</div>";
				else
				{
					Roles_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Roles name updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Add Roles</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Role Name <font color="red">*</font></label>
					<input type="text" id="role" name="role" required="required" value="<?php echo $_POST['role']; ?>" onkeypress="return AlphaNumCheck(event)"/>
				</div>
				<div class="clearfix">
					<label>Modules <font color="red">*</font></label>
					 <table>
						<tbody>
							<tr valign="top">
								<td></td>
								<td>
									<b>Assigned Tabs </b>
								</td>
								<td>
								</td>
								<td>
									<b>Available Tabs </b>
								</td>
							</tr>
							<tr valign="top">
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td>
									<select name="modules[]" id="s" size="10" multiple="multiple">
										<?php
										if($_POST['modules'] != "")
											$_POST['modules'] = explode(",", $_POST['modules']);
										$Modules = array("Dashboard", "Masters", "Students", "Staff", "Fees", "Salary", "Miscellaneous", "Reports");
										$AvailableModules = "";
										$i = 0;
										foreach($Modules as $Module)
										{
											if(in_array($Module, $_POST['modules']))
												echo "<option value='".$Module."'>".$Module."</option>";
											else
												$AvailableModules .= "<option value='".$Module."'>".$Module."</option>";
											$i++;
										}
										?>
									</select>
								</td>
								<td>									
									<a href="#" class="button button-green" onclick="listbox_moveacross('s', 'd')">&gt;&gt;</a><br />
									<a href="#" class="button button-green" onclick="listbox_moveacross('d', 's')">&lt;&lt;</a>									
								</td>	
								<td>
									<select id="d" size="10" multiple="multiple">
										<?php echo $AvailableModules; ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="selectAll();">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" onclick="selectAll();">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Roles List
				<?php
				$RolesTotalRows = mysqli_fetch_assoc(Roles_Select_Count_All());
				echo " : No. of total Users - ".$RolesTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Role</th>
						<th align="left">Modules</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$RolesTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($RolesTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $RolesTotalRows['total']- $Start;
					else
						$i = $RolesTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ClassRows = Roles_Select_ByLimit($Start, $Limit);
					while($Roles = mysqli_fetch_assoc($ClassRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i--."</td>
							<td>".$Roles['role']."</td>
							<td>".$Roles['modules']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Roles['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Roles['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	function selectAll() 
    {
        selectBox = document.getElementById("s");
        for (var i = 0; i < selectBox.options.length; i++)
             selectBox.options[i].selected = true;
    }
	
	function listbox_move(listID, direction)
	{
		var listbox = document.getElementById(listID);
		var selIndex = listbox.selectedIndex,increment = -1;
		if(-1 == selIndex)
		{
			alert("Please select an option to move.");
			return;
		}
		if (direction == 'up')
			increment = -1;
		else
			increment = 1;
		if ((selIndex + increment) < 0 || (selIndex + increment) > (listbox.options.length - 1))
			return;
		
		var selValue = listbox.options[selIndex].value, selText = listbox.options[selIndex].text;
		listbox.options[selIndex].value = listbox.options[selIndex + increment].value
		listbox.options[selIndex].text = listbox.options[selIndex + increment].text
		listbox.options[selIndex + increment].value = selValue;
		listbox.options[selIndex + increment].text = selText;
		listbox.selectedIndex = selIndex + increment;
	}

	function listbox_moveacross(sourceID, destID)
	{
		var src = document.getElementById(sourceID), dest = document.getElementById(destID);
		for(var count = 0; count < src.options.length; count++)
		{
			if(src.options[count].selected == true)
			{
				var option = src.options[count], newOption = document.createElement("option");
				newOption.value = option.value;
				newOption.text = option.text;
				newOption.selected = true;
				try
				{
					dest.add(newOption, null);
					src.remove(count, null);
				}
				catch (error)
				{
					dest.add(newOption);
					src.remove(count);
				}
				count--;
			}
		}
	}

	function listbox_selectall(listID, isSelect)
	{
		var listbox = document.getElementById(listID);
		for(var count = 0; count < listbox.options.length; count++)
			listbox.options[count].selected = isSelect;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8) 
			return true;
		 if (charCode >= 44 && charCode <= 47) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	function validation()
	{
		var message = "";
		if(document.getElementById("role").value.length < 2 || document.getElementById("role").value.length > 15)
			message = "Role name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>