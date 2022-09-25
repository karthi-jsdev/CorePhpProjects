<section class="grid_6 first">
	<?php
		$Columns = array("id", "name", "groupid");
		$_POST['name'] = $_POST['complainttypename'];
		if($_GET['action'] == 'Edit')
		{
			$Complaint_Type = mysqli_fetch_assoc(Complaint_Type_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Complaint_Type[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Complaint_Type_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Complaint type deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$Complaint_TypeResource = Complaint_Type_Select_ByName($_POST['name']);
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($Complaint_TypeResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Complaint type already exists</div>";
				else
				{
					Complaint_Type_Insert($_POST['name'], $_POST['groupid']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Complaint_Type = mysqli_fetch_assoc($Complaint_TypeResource);
				if(mysqli_num_rows(Complaint_Type_Select_ByNameId($_POST['name'], $Complaint_Type['id'])))
					$message = "<br /><div class='message error'><b>Message</b> : This Complaint type already exists</div>";
				else
				{
					Complaint_Type_Update($_POST['name'], $_POST['groupid'], $_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Complaint type details updated successfully</div>";
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
				<header><h2>Add Complaint Type</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Complaint Type Name <font color="red">*</font></label>
						<input type="text" id="complainttype" name="complainttypename" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
                    </div>
					<div class="clearfix">
						<label>Group <font color="red">*</font></label>
						<select id="groupid" name="groupid">
							<option value="" selected>Select</option>
							<?php
							$Groups = Group_Select_All();
							while($Group = mysqli_fetch_assoc($Groups))
							{
								if($Group['id'] == $_POST['groupid'])
									echo "<option value=".$Group['id']." selected>".$Group['name']."</option>";
								else
									echo "<option value=".$Group['id'].">".$Group['name']."</option>";
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
			<h3>Complaint Type List
			<?php
			$Complaint_TypeTotalRows = mysqli_num_rows(Complaint_Type_Select_All());
			echo " : No. of total Complaint Types - ".$Complaint_TypeTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Name</th>
						<th align="left">Group</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Complaint_TypeTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Complaint_TypeTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Complaint_Types = Complaint_Type_Select_ByLimit($Start, $Limit);
					while($Complaint_Type = mysqli_fetch_assoc($Complaint_Types))
					{
						$Group = mysqli_fetch_assoc(Group_Select_ById($Complaint_Type['groupid']));
						echo "<tr>
							<td align='center'>".$i++."</td>
							<td>".$Complaint_Type['name']."</td>
							<td>".$Group['name']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Complaint_Type['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Complaint_Type['id'].")'>Delete</a></td>
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
		if(document.getElementById('groupid').value == "")
			message = "Please select a group";
		if(document.getElementById('complainttype').value.length < 2 || document.getElementById('complainttype').value.length > 15)
			message = "Complaint type name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>