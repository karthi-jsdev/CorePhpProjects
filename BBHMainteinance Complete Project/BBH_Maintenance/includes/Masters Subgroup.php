<section class="grid_6 first">
	<?php
		$Columns = array("id", "name","complainttype", "groupid", "users");
		$_POST['name'] = $_POST['subgroupname'];
		$_POST['complainttype'] = $_POST['complainttypename'];
		if($_GET['action'] == 'Edit')
		{
			$Subgroup = mysqli_fetch_assoc(Subgroup_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Subgroup[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Subgroup_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Subgroup deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if($_POST['users'])
				$_POST['users'] = implode($_POST['users'], ".");
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(Subgroup_Select_ByName($_POST['name'])))
					$message = "<br /><div class='message error'><b>Message</b> : Subgroup already exists</div>";
				else
				{
					Subgroup_Insert($_POST['groupid'],$_POST['complainttype'], $_POST['name'], $_POST['users']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				Subgroup_Update($_POST['groupid'], $_POST['complainttype'],$_POST['name'], $_POST['users'], $_POST['id']);
				$message = "<br /><div class='message success'><b>Message</b> : Subgroup details updated successfully</div>";
			}
			
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message;?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Add Subgroup</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Subgroup Name <font color="red">*</font></label>
						<input type="text" id="subgroupname" name="subgroupname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Complaint Type Name <font color="red">*</font></label>
						<input type="text" id="complainttype" name="complainttypename" required="required" value="<?php echo $_POST['complainttype']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
						<label>Group <font color="red">*</font></label>
						<select id="groupid" name="groupid" onchange="GetGroup(this.value)">
							<option value="" selected>Select</option>
							<?php
							$Groups = Group_Select_All();
							while($Group = mysqli_fetch_assoc($Groups))
							{
								if($Group['id'] == $_POST['groupid'])
									echo "<option value=".$Group['id']." selected>".$Group['name']."</option>";
								else if((mysqli_num_rows(SubGroup_Select_MIS())==2 && $Group['name']=='MIS') || ($_SESSION['roleid']=='5' && $Group['name']=='MIS'))
									echo "<option value=".$Group['id']." disabled>".$Group['name']."</option>";
								else
									echo "<option value=".$Group['id'].">".$Group['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Technicians <font color="red">*</font></label>
						 <table>
							<tbody>
								<tr valign="top">
									<td></td>
									<td>
										<b>Added Technicians</b>
									</td>
									<td>
									</td>
									<td>
										<b>Available Technicians</b>
									</td>
								</tr>
								<tr valign="top">
									<td>&nbsp;&nbsp;&nbsp;</td>
									<td>
										<select name="users[]" id="s" size="10" multiple="multiple">
											<?php
											if($_POST['users'] != "")
												$_POST['users'] = explode(".", $_POST['users']);
											
											$AvailableUsers = "";
											$Users = User_Select_All();
											while($User = mysqli_fetch_assoc($Users))
											{
												if(in_array($User['id'], $_POST['users']))
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

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Subgroup List
				<?php
				$SubgroupTotalRows = mysqli_num_rows(Subgroup_Select_All());
				echo " : No. of total Subgroups - ".$SubgroupTotalRows;
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Subgroup Name</th>
						<th align="left">Complaint Type</th>
						<th align="left">Group</th>
						<th align="left">Technicians</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$SubgroupTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($SubgroupTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$SubgroupRows = Subgroup_Select_ByLimit($Start, $Limit);
					while($Subgroup = mysqli_fetch_assoc($SubgroupRows))
					{
						$Group = mysqli_fetch_assoc(Group_Select_ById($Subgroup['groupid']));
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Subgroup['name']."</td>
						<td>".$Subgroup['complainttype']."</td>
						<td>".$Group['name']."</td>
						<td width='330px'>";
						if($Subgroup['users'])
						{
							$Users = explode(".", $Subgroup['users']);
							$All = "";
							foreach($Users as $User)
							{
								$UserName = mysqli_fetch_assoc(User_Select_ById($User));
								if($All)
									$All.= ",".$UserName['firstname'];
								else
									$All.= $UserName['firstname'];
							}
						}
						echo $All."</td>
						<td width='75px'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Subgroup['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Subgroup['id'].")'>Delete</a></td>
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
		if(document.getElementById('groupid').value == "")
			message = "Please select a group";
		if(document.getElementById('complainttype').value.length < 2 || document.getElementById('complainttype').value.length > 15)
			message = "Complaint Type should be within 2 to 15 characters";
		if(document.getElementById('subgroupname').value.length < 2 || document.getElementById('subgroupname').value.length > 15)
			message = "Subgroup name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	
	function GetGroup(subgroup)
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
			{
				var results = xmlhttp.responseText;
				var values = results.split("#");
				var select = document.getElementById('d');
				select.options.length = 0; 	//For remove all options of dropdown list
				var source = document.getElementById('s');
				source.options.length = 0; 	//For remove all options of dropdown list
				for(var i = 0; i < values.length; i++)
				{
					if(i%2 == 0)
						select.options[select.options.length] = new Option(values[i],values[i+1]);
				}
			}
		}
		xmlhttp.open("GET","includes/Complaint_Get_subgroup.php?subgroup="+subgroup,true);
		xmlhttp.send();
	}
</script>