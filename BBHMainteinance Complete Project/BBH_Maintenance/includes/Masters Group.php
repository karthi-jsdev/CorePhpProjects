<section class="grid_6 first">
	<?php
		$Columns = array("id", "name", "defaultadmin", "admins");
		$_POST['name'] = $_POST['groupname'];
		if($_GET['action'] == 'Edit')
		{
			$Group = mysqli_fetch_assoc(Group_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Group[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Group_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Group deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if($_POST['admins'])
				$_POST['admins'] = implode($_POST['admins'], ".");
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(Group_Select_ByName($_POST['name'])))
					$message = "<br /><div class='message error'><b>Message</b> : Group already exists</div>";
				/*else if(mysqli_num_rows(Group_Select_All()) == 3)
					$message = "<br /><div class='message error'><b>Message</b> : Already three groups are exists</div>";*/
				else
				{
					Group_Insert($_POST['name'], $_POST['defaultadmin'], $_POST['admins']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				Group_Update($_POST['name'], $_POST['defaultadmin'], $_POST['admins'], $_POST['id']);
				$message = "<br /><div class='message success'><b>Message</b> : Group details updated successfully</div>";
			}
			
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
		
	if($_GET['action'] == 'Edit' || $_SESSION['roleid'] == 5)
	{ ?>
	<div class="columns">
		<?php echo $message;?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Add Group</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Group Name <font color="red">*</font></label>
						<?php
						if($_SESSION['roleid'] != 5) 
						{
							echo '<input type="text" required="required" value="'.$_POST['name'].'" onkeypress="return isAlphaOrNumeric(event)" disabled/>
							<input type="hidden" id="groupname" name="groupname" required="required" value="'.$_POST['name'].'" onkeypress="return isAlphaOrNumeric(event)"/>';
						}
						else
							echo '<input type="text" id="groupname" name="groupname" required="required" value="'.$_POST['name'].'" onkeypress="return isAlphaOrNumeric(event)" />';
						?>
                    </div>
					<div class="clearfix">
						<label>Default Admin <font color="red">*</font></label>
						<select id="defaultadmin" name="defaultadmin">
							<option value="" selected>Select</option>
							<?php
							$Users = User_Select_ByRole(1,$_POST['id']);
							while($User = mysqli_fetch_assoc($Users))
							{
								if($User['id'] == $_POST['defaultadmin'])
									echo "<option value=".$User['id']." selected>".$User['firstname']."</option>";
								else
									echo "<option value=".$User['id'].">".$User['firstname']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Add Admins <font color="red">*</font></label>
						<table>
							<tbody>
								<tr valign="top">
									<td></td>
									<td>
										<b>Added Admins</b>
									</td>
									<td></td>
									<td>
										<b>Available Admins</b>
									</td>
								</tr>
								<tr valign="top">
									<td>&nbsp;&nbsp;&nbsp;</td>
									<td>
										<select name="admins[]" id="s" size="10" multiple="multiple">
											<?php
											if($_POST['admins'] != "")
												$_POST['admins'] = explode(".", $_POST['admins']);
											
											$AvailableUsers = "";
											$Users = User_Select_ByGroupId($_POST['id']);
											while($User = mysqli_fetch_assoc($Users))
											{
												if(in_array($User['id'], $_POST['admins']))
													echo "<option value='".$User['id']."'>".$User['firstname']."</option>";
												else
													$AvailableUsers .= "<option value='".$User['id']."'>".$User['firstname']."</option>";
											} ?>
										</select>
									</td>
									<td>									
										<a href="#" class="button button-green" onclick="listbox_moveacross('s', 'd')">&gt;&gt;</a><br />
										<a href="#" class="button button-green" onclick="listbox_moveacross('d', 's')">&lt;&lt;</a>									
									</td>
									<td>
										<select id="d" size="10" multiple="multiple">
											<?php echo $AvailableUsers; ?>
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
	</div>
	<?php
	} ?>
	
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Group List
				<?php
				$GroupTotalRows = mysqli_num_rows(Group_Select_All());
				echo " : No. of total Groups - ".$GroupTotalRows;
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Group Name</th>
						<th align="left">Default Admin</th>
						<th align="left">Admins</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$GroupTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($GroupTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$GroupRows = Group_Select_ByLimit($Start, $Limit);
					while($Group = mysqli_fetch_assoc($GroupRows))
					{
						$User = mysqli_fetch_assoc(User_Select_ById($Group['defaultadmin']));
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Group['name']."</td>
						<td>".$User['firstname']."</td>
						<td width='330px'>";
						if($Group['admins'])
						{
							$Admins = explode(".", $Group['admins']);
							$All = "";
							foreach($Admins as $Admin)
							{
								$User = mysqli_fetch_assoc(User_Select_ById($Admin));
								if($All)
									$All .= ", ".$User['firstname'];
								else
									$All .= $User['firstname'];
							}
						}
						echo $All."</td>
						<td width='75px'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Group['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a><!-- | <a href='#' onclick='deleterow(".$Group['id'].")'>Delete</a--></td>
						</tr>";
					} ?>
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
	
	function validation()
	{
		var message = "";
		if(document.getElementById('defaultadmin').value == "")
			message = "Please select a default admin";
		if(document.getElementById('groupname').value.length < 2 || document.getElementById('groupname').value.length > 15)
			message = "Group name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>