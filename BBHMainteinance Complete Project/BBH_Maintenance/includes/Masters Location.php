<section class="grid_6 first">
	<?php
		$Columns = array("id", "departmentid", "name","groupid");
		$_POST['name'] = $_POST['locationname'];
		if($_GET['action'] == 'Edit')
		{
			$Location = mysqli_fetch_assoc(Location_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Location[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Location_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Location deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(Location_Select_ByName($_POST['name'])))
					$message = "<br /><div class='message error'><b>Message</b> : This Location already exists</div>";
				else
				{
					Location_Insert($_POST['departmentid'], $_POST['name'],$_POST['groupid']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysqli_num_rows(Department_Select_ByNameId($_POST['name'], $_POST['id'])))
				$message = "<br /><div class='message error'><b>Message</b> : This department already exists</div>";
				else
				{
					Location_Update($_POST['departmentid'], $_POST['name'], $_POST['groupid'],$_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Location details updated successfully</div>";
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
				<header><h2>Add Location</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
						<label>Group <font color="red">*</font></label>
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
					<div class="clearfix">
						<label>Department <font color="red">*</font></label>
						<select id="departmentid" name="departmentid">
							<option value="" selected>Select</option>
							<?php
							$Departments = Department_Select_All();
							while($Department = mysqli_fetch_assoc($Departments))
							{
								if($Department['id'] == $_POST['departmentid'])
									echo "<option value=".$Department['id']." selected>".$Department['name']."</option>";
								else
									echo "<option value=".$Department['id'].">".$Department['name']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
                        <label>Location Name <font color="red">*</font></label>
						<input type="text" id="name" name="locationname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
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
			<h3>Location List
			<?php
			$LocationTotalRows = mysqli_num_rows(Location_Select_All());
			echo " : No. of total Locations - ".$LocationTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Location Name</th>
						<th align="left">Group</th>
						<th align="left">Department</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$LocationTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($LocationTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$LocationRows = Location_Select_ByLimit($Start, $Limit);
					while($Location = mysqli_fetch_assoc($LocationRows))
					{
						$Department = mysqli_fetch_assoc(Department_Select_ById($Location['departmentid']));
						$Group = mysqli_fetch_assoc (Group_Select_ById($Location['groupid']));
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Location['name']."</td>
						<td>".$Group['name']."</td>
						<td>".$Department['name']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Location['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Location['id'].")'>Delete</a></td>
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
	/*var total_pages = <?php echo "4";?>;
	function test(CurrentPageNo)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("result").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Ajax_Pagination.php?pageno="+CurrentPageNo+"&total_pages="+total_pages, true);
		xmlhttp.send();
	}
	*/
	function validation()
	{
		var message = "";
		if(document.getElementById('name').value.length < 2 || document.getElementById('name').value.length > 15)
			message = "Location name should be within 2 to 15 characters";
		if(document.getElementById('departmentid').value == "")
			message = "Please select a department";
		if(document.getElementById('groupid').value == "")
			message = "Please select a Group";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>