<section class="grid_6 first">
	<?php
		$Columns = array("id", "divisionid", "name","extension","biomedical_department");
		foreach($_SESSION['GroupIds'] as $GroupId)
			$Columns[] = $GroupId;
		$_POST['name'] = $_POST['departmentname'];
		if($_GET['action'] == 'Edit')
		{
			$Department = mysqli_fetch_assoc(Department_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Department[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Department_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Department deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(Department_Select_ByName($_POST['name'])))
					$message = "<br /><div class='message error'><b>Message</b> : This department already exists</div>";
				else
				{
					Department_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysqli_num_rows(Department_Select_ByNameId($_POST['name'], $_POST['id'])))
					$message = "<br /><div class='message error'><b>Message</b> : This department already exists</div>";
				else
				{
					Department_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Department details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="wrapper">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Add Department</h2></header>
				<hr />	
				<fieldset>
					<div class="clearfix">
						<label>Division <font color="red">*</font></label>
						<select id="divisionid" name="divisionid">
							<option value="" selected>Select</option>
							<?php
							$Divisions = Division_Select_All();
							while($Division = mysqli_fetch_assoc($Divisions))
							{
								if($Division['id'] == $_POST['divisionid'])
									echo "<option value=".$Division['id']." selected>".$Division['name']."</option>";
								else
									echo "<option value=".$Division['id'].">".$Division['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
                        <label>Department Name <font color="red">*</font></label>
						<input type="text" id="name" name="departmentname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
						Biomedical Department
						<?php if($_POST['biomedical_department'])
						 echo '<input type="checkbox" name="biomedical" id="biomedical" value="1" checked>';
						else 
							echo '<input type="checkbox" name="biomedical" id="biomedical" value="1" >';
						?>	
					</div>
					<div class="clearfix">
                        <label>Extension </label>
						<input type="text" id="extension" name="extension" maxlength=5  value="<?php echo $_POST['extension']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
                    </div>
					<div class="clearfix">
						<?php 
						$Groupnames = mysqli_query($_SESSION['connection'],"SELECT id, name from `group`");
						while($Groups = mysqli_fetch_array($Groupnames))
						{
							echo '<label>'.$Groups['name'];
							?>
								<select name="<?php echo $Groups['id'];?>">
									<option value="" selected>Select</option>
									<?php
									$Default_Admin = mysqli_query($_SESSION['connection'],"SELECT id, firstname FROM user where groupid = '".$Groups['id']."' and userroleid='1'");
									while($Default_Admin_Names = mysqli_fetch_array($Default_Admin))
									{
										if($Default_Admin_Names['id'] == $_POST[$Groups['id']])
											echo "<option value=".$Default_Admin_Names['id']." selected>".$Default_Admin_Names['firstname']."</option>";
										else
											echo "<option value=".$Default_Admin_Names['id'].">".$Default_Admin_Names['firstname']."</option>";
									} ?>
								</select>
							</label>
						<?php
						} ?>
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
		<div class="wrapper">
			<h3>Department List
				<?php
				$DepartmentTotalRows = mysqli_num_rows(Department_Select_All());
				echo " : No. of total Departments - ".$DepartmentTotalRows;
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Department Name</th>
						<th align="left">Division</th>
						<th align="left">Extension</th>
						<th align="left">Is Biomedical</th>
						<?php 
						$Groups = mysqli_query($_SESSION['connection'],"SELECT * from `group`");
						$_SESSION['GroupIds'] = array();
						while($Group = mysqli_fetch_array($Groups))
						{
							echo '<th align="left">'.$Group['name'].'</th>';
							$_SESSION['GroupIds'][] = $Group['id'];
						} ?>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$DepartmentTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($DepartmentTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$DepartmentRows = Department_Select_ByLimit($Start, $Limit);
					$Status = Array("No", "YES");
					while($Department = mysqli_fetch_assoc($DepartmentRows))
					{
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Department['name']."</td>
						<td>".$Department['divisionname']."</td>
						<td>".$Department['extension']."</td>
						<td>".$Status[$Department['biomedical_department']]."</td>";
						if(count($_SESSION['GroupIds']))
						{
							$GroupCon = "";
							foreach($_SESSION['GroupIds'] AS $GroupId)
							{
								$User = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT groupid, firstname FROM user WHERE id=".$Department[$GroupId]));
								echo "<td>".$User['firstname']."</td>";
							}
						}
						echo "<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Department['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Department['id'].")'>Delete</a></td>
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
	function validation()
	{
		var message = "";
		if(document.getElementById('name').value.length < 2 || document.getElementById('name').value.length > 15)
			message = "Department name should be within 2 to 15 characters";
		if(document.getElementById('divisionid').value == "")
			message = "Please select a division";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>