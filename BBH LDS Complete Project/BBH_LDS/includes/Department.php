<Department role="main" id="main">
	<?php
		$Columns = array("id", "groupid","name");
		if($_GET['action'] == 'Edit')
		{
			$Department = mysql_fetch_assoc(Department_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Department[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Department_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Department name deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$DepartmentResource = Department_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($DepartmentResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Department name already exists</div>";
				else
				{
					Department_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Department added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				//$User = mysql_fetch_assoc($UserResource);
				if(mysql_num_rows(Department_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Department name already exists</div>";
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
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['SM_id']; ?>" required="required"/>
			<header><h2>Add Department</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Group <font color="red">*</font></label>
					<select id="groupid" name="groupid">
						<option value="">Select</option>
						<?php
						$Classes = Group_Select_All();
						while($Class = mysql_fetch_assoc($Classes))
						{
							if($Class['id'] == $_POST['groupid'])
								echo "<option value=".$Class['id']." selected>".$Class['name']."</option>";
							else
								echo "<option value=".$Class['id'].">".$Class['name']."</option>";
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label>Department Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?><button class="button button-gray" type="reset" name="reset">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Department List
				<?php
				$DepartmentTotalRows = mysql_fetch_assoc(Department_Select_Count_All());
				echo " : No. of total Departments - ".$DepartmentTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Group</th>
						<th align="left">Department Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$DepartmentTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($DepartmentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$DepartmentRows = Department_Select_ByLimit($Start, $Limit);
					while($Department = mysql_fetch_assoc($DepartmentRows))
					{
						$Class = mysql_fetch_assoc(Group_Select_ByIds($Department['groupid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Class['name']."</td>
							<td>".$Department['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Department['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Department['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</Department>
<script>
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 32) 
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
		if(document.getElementById("name").value == 0)
			message = "Please enter the department name";		
		if(document.getElementById("groupid").value == 0)
			message = "Please select group name";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	$( document ).ready(function()
	{
		$('#uniform-groupid').removeAttr('class');
		$('#uniform-groupid').removeAttr('style');
		$('#groupid').removeAttr('style');
		$("#uniform-groupid span").remove();
	});
</script>